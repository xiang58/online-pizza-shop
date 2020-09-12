<?
    session_start();
    $user = 'root';
    $password = 'root';
    $host = 'localhost';
    $db = 'online_pizza';
    $port = 3306;

    $conn = mysqli_connect(
        $host,
        $user,
        $password,
        $db,
        $port
    );
    if(!$conn){
        echo "Connection Failed";
        exit;
    }  
    $uid=$_SESSION['id'];
    $sql="SELECT * FROM order_history";
    $result=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($result)+1;
    $sql="SELECT * FROM shopping_cart WHERE userid=$uid AND quantity>0";
    $result=mysqli_query($conn,$sql);
    $price=0;
    while($row = mysqli_fetch_array($result)){
        $pizza=$row['pizza_id'];
        $size=$row['size'];
        $quantity=$row['quantity'];
        $sql="INSERT INTO order_contents(order_id,pizza_id,size,quantity) VALUES ($num,$pizza,$size,$quantity)";
        $result2=mysqli_query($conn,$sql);
        $price=$price+$row['final_price']*$quantity;
        if($size==12)
        {
            $quantity*=2;
        }else if($size==14){
            $quantity*=3;
        }else if($size==16){
            $quantity*=4;
        }
        $sql="UPDATE pizza SET inventory=(inventory-$quantity) WHERE pizza_id=$pizza"; 
        $result2=mysqli_query($conn,$sql);
        $sql="DELETE from shopping_cart WHERE userid=$uid AND pizza_id=$pizza AND size=$size";
        $result2=mysqli_query($conn,$sql);
    }
    $sql="INSERT INTO order_history(userid,order_id,total_price)VALUE($uid,$num,$price)";
    $result=mysqli_query($conn,$sql);
    header('Location: confirmation.html'); 
?>