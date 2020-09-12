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
    $pizza=$_GET['name'];
    $size=$_GET['size'];
    $quantity=$_GET['quantity'];
    $uid = $_SESSION['id'];

    $sql = "SELECT pizza_id, base_price, inventory FROM pizza WHERE pizza_name= '$pizza'";  
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);
    $id=$row['pizza_id'];
    $price=$row['base_price'];
		$inventory=$row['inventory'];
		echo $quantity;
		echo $inventory;
		if($inventory<$quantity)
		{
			header('Location: home-customer.php');
			exit;
		}

    $sql="SELECT quantity FROM shopping_cart WHERE pizza_id =$id AND size=$size AND userid=$uid";
    $result= mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_array($result);
        $quantity = $quantity+$row['quantity'];
				if($inventory<$quantity)
				{
					header('Location: home-customer.php');
					exit;
				}
        $sql="UPDATE shopping_cart SET quantity = $quantity WHERE pizza_id = $id AND size=$size AND userid=$uid";
        $result= mysqli_query($conn,$sql);
        header('Location: home-customer.php');
    }
    else{
        $sql="SELECT price_added FROM size WHERE size=$size";
        $result = mysqli_query($conn,$sql);
        $row = mysqli_fetch_array($result);
        $price = $price+$row['price_added'];

        $sql="INSERT INTO shopping_cart (userid,pizza_id,size,final_price,quantity) VALUES($uid,$id,$size,$price,$quantity)";
        $result = mysqli_query($conn,$sql);
        header('Location: home-customer.php');
    }
    
    
?>