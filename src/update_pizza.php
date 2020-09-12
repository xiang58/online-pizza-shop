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
    echo $_POST['pizzaDescription'];
    $id=$_POST['pizza_id'];
    $pizza=$_POST['pizza_name'];
    $price=$_POST['base_price'];
    $description = $_POST['pizzaDescription'];
    $inventory =$_POST['inventory'];
    $category=$_POST['category'];
    $sql="UPDATE pizza SET pizza_name='$pizza', description='$description', base_price=$price, inventory=$inventory WHERE pizza_id=$id";
    echo $sql;
    $result = mysqli_query($conn,$sql);
    header('Location: home-admin.php'); 
    
?>