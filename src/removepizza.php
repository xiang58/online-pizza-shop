<?
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
    $pizza=$_POST['pizza_id'];
    $sql="DELETE from pizza WHERE pizza_id=$pizza";
    $result=mysqli_query($conn,$sql);
    header('Location: home-admin.php'); 
?>