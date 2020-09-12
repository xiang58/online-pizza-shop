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
    $pizza=$_POST['pizza_name'];
    $sql= "SELECT * FROM pizza WHERE pizza_name = '$pizza'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    { 
        header('Location: addewpizza.html'); 
    }
    else
    {
        $price=$_POST['base_price'];
        $description = $_POST['pizzaDescription'];
        $inventory =$_POST['inventory'];
        $category=$_POST['category'];
        $sql="SELECT * FROM pizza";
        $result = mysqli_query($conn,$sql);
        $id=mysqli_num_rows($result)+1;
        $sql="INSERT INTO pizza(pizza_id,pizza_name,description,base_price,inventory,category,deleted) VALUES ($id,'$pizza','$description',$price,$inventory,'$category',0)";
        $result = mysqli_query($conn,$sql);
        header('Location: home-admin.php'); 
    }
    
?>