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
    $pizza=$_POST['pizza_id'];
    $size=$_POST['size'];
    $quantity=$_POST['quantity'];
    $sql="UPDATE shopping_cart SET quantity=$quantity WHERE userid=$uid AND pizza_id=$pizza AND size=$size";
    $result=mysqli_query($conn,$sql);
    header('Location: shoppingcart.php'); 
?>