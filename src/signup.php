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
    $sql= "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn,$sql);
    if(mysqli_num_rows($result)>0)
    {
        echo '<p>email already been used.</p>'; 
    }
    else
    {
        $password=trim(htmlspecialchars($_POST["password"]));
        $retype=trim(htmlspecialchars($_POST["retype"]));
        if($password===$retype&&preg_match("/[0-9]+/",$password)&&preg_match("/[a-z]+/",$password)&&preg_match("/[A-Z]+/",$password)&&preg_match("/^.{6,}$/",$password)){
            $name=$_POST['name'];
            $password=md5($password);
            $address=$_POST['address'];
            $sql= "SELECT * from users";
            $result= mysqli_query($conn,$sql);
            $id= mysqli_num_rows($result)+1;
            $sql= "INSERT INTO users(userid, email,name,password,address,is_admin)VALUES ('$id','$email','$name','$password','$address','0')";
            $result = mysqli_query($conn,$sql); 
            $_SESSION['id']=$id;
            $_SESSION['email']=$email;
            $_SESSION['name']=$name;
            $_SESSION['address']=$address;
            $_SESSION['admin']=0;
            header('Location: home-customer.php'); 
        }
        else{
            header('Location: signup.html'); 
        }
    }
    mysqli_close($conn);
?>