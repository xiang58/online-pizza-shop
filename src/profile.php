<?
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <link href="listpage.css" rel="stylesheet">
    <title>Profile</title>
  </head>
  <body>
    <header>
      <div id="navbar" class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <div class="navbar-brand d-inline align-items-center">
            <a style="color:white" href=home-customer.php><i class="fas fa-chart-pie"></i></a>
          </div>
          <div class="inline">
            <a href="signout.html" class="navbar-brand d-inline align-items-center text-right">
              <i class="fas fa-sign-out-alt"></i>
              <strong>Sign Out</strong>
            </a>
            </div>
          </div>
        </div>
    </header>
    <main role="main" class="container">
      <div class="d-flex align-items-center p-3 my-3 rounded shadow-sm" >
        <div class="lh-100 align-items-center">
            <?
                $name = $_SESSION['name'];
                echo    '<h1 class="mb-0 lh-100">'.$name.'</h1>';
                ?>
        </div>
      </div>
      <div class="p-3 my-3 rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Address</h6>
        <div class="media text-muted pt-3 d-flex align-items-center justify-content-between">
          <div class="align-items-center">
            <?
                $address= $_SESSION['address'];
                echo    '<p class="mb-1 lh-100">'.$name.'</p>';
                echo    '<p class="mb-1 lh-100">'.$address.'</p>';    
            ?>
          </div>
        </div>
      </div>
      <div class="my-3 p-3 bg-white rounded shadow-sm">
        <h6 class="border-bottom border-gray pb-2 mb-0">Purchase History</h6>
          
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
                $uid=$_SESSION['id'];
                $sql="SELECT * FROM order_history WHERE userid=$uid ORDER BY order_id DESC";
                $result=mysqli_query($conn,$sql);
                $i=mysqli_num_rows($result);
                while($row = mysqli_fetch_array($result)){
                    echo    '<div class="media text-muted pt-3">';
                    echo      '<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                    echo        '<strong class="d-block text-gray-dark">Order '.$i.'</strong>';
                    echo        '<table style="width:100%">';
                    $oid=$row['order_id'];
                    $price=$row['total_price'];
                    
                    $sql="SELECT * FROM order_contents WHERE order_id=$oid";
                    $result2=mysqli_query($conn,$sql);
                    $j=mysqli_num_rows($result2);
                    
                    while($row2=mysqli_fetch_array($result2)){
                        $pid=$row2['pizza_id'];
                        $size=$row2['size'];
                        $quantity=$row2['quantity'];
                        $sql="SELECT pizza_name FROM pizza WHERE pizza_id=$pid";
                        $result3=mysqli_query($conn,$sql);
                        $row3=mysqli_fetch_array($result3);
                        $name=$row3['pizza_name'];
                        echo          '<tr>';
                        echo            '<td>'.$quantity.' - '.$name.' - '.$size.'"</td>';
                        echo          '</tr>';
                        $j--;
                    }
                    echo          '<tr>';
                    echo            '<td style="width: 25%">Total</td>';
                    echo            '<td>$'.$price.'</td>';
                    echo          '</tr>';
                    echo        '</table>';
                    echo      '</div>';
                    echo    '</div>';
                    $i--;
                }
            ?>  
          
        <?/*<div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark">MM-DD-YYYY</strong>
            <table style="width:100%">
              <tr>
                <td>Pizza 1</td>
                <td>$10</td>
              </tr>
              <tr>
                <td style="width: 50%">Total</td>
                <td>$10</td>
              </tr>
            </table>
          </div>
        </div>
          
        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <strong class="d-block text-gray-dark">MM-DD-YYYY</strong>
            <table style="width:100%">
              <tr>
                <td>Pizza 2</td>
                <td>$10</td>
              </tr>
              <tr>
                <td style="width: 50%">Total</td>
                <td>$10</td>
              </tr>
            </table>
          </div>
        </div>*/?>
          
        <small class="d-block text-right mt-3">
          <a href="home-customer.php">Back to Homepage</a>
        </small>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>