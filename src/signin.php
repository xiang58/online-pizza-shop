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
    $email=$_POST['email'];
    $password=trim(htmlspecialchars($_POST["password"]));
    $password=md5($password);
    $sql= "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    echo$sql;
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        $row = mysqli_fetch_array($result);
        $_SESSION['id']=$row['userid'];
        $_SESSION['email']=$row['email'];
        $_SESSION['name']=$row['name'];
        $_SESSION['address']=$row['address'];
        $_SESSION['admin']=$row['is_admin'];
        if($_SESSION['admin']==0){
            header('Location: home-customer.php'); 
        }
        else{
            header('Location: home-admin.php'); 
        }
    }
    else
    {
        header('Location: signin.html');
    }
    
?>