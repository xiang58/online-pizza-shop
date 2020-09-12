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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <title>Shopping Cart</title>
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
      <section class="jumbotron text-center" style="background-color: white">
        <div class="container">
          <h1 class="jumbotron-heading">Shopping Cart</h1>
          <p class="lead text-muted">Please view your shopping cart here.</p>
          <p>
            <a href="checkout.php" class="btn btn-primary my-2">Check Out</a>
            <a href="home-customer.php" class="btn btn-secondary my-2">Continue Shopping</a>
          </p>
        </div>
      </section>
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js" type="text/javascript">
            $(document).ready(function(){
                $("#remove").click(function() {
                    alert("Hello");
                    /*var data ={};
                    data.pizza_id=this.$row['pizza_id'];
                    data.size=this.$row['size'];
                    $.ajax({
                        type:"POST",
                        url:"remove.php",
                        data:data,
                        success: function{
                            window.alert(5);      
                        }
                    });*/
                  });
            });
            
          </script>
        
          
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
                $sql="SELECT * FROM shopping_cart WHERE userid=$uid AND quantity>0";
                $result=mysqli_query($conn,$sql);
                while($row = mysqli_fetch_array($result)){
                    $price = $row["final_price"]*$row["quantity"];
                    $id=$row['pizza_id'];
                    $sql="SELECT * FROM pizza WHERE pizza_id= $id";
                    $result2=mysqli_query($conn,$sql);
                    $row2=mysqli_fetch_array($result2);
                    echo    '<div class="media text-muted pt-3">';
                    echo      '<div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">';
                    echo        '<div class="row align-items-center">';
                    echo          '<div class="col-lg-2">';
                    echo            '<img src="'.$row2["pizza_name"].'.jpg" style="width: 100%">';
                    echo          '</div>';
                    echo          '<div class="col-lg-10">';
                    echo            '<div class="d-flex justify-content-between align-items-center">';
                    echo              '<h4>'.$row2["pizza_name"].'</h4>';
                    echo                '<p class="col-md-4 col-form-label">Size:'.$row["size"].'"</p>';
                    echo              '<h4 class="text-muted text-right">'.$price.'</h4>';
                    echo            '</div>';
                    echo            '<p class="card-text">'.$row2["description"].'</p>';
                    echo            '<div class="row">';
                    echo              '<div class="col-md-8 row">';
                    echo                '<label class="col-md-1 col-form-label" for="quantity">Quantity</label>';
                    echo                '<div class="col-md-2">';
                    echo                    '<form action="update.php" method="post">';
                    echo                    '<input name="pizza_id" value="'.$id.'" style="display:none">';
                    echo                    '<input name="size" value="'.$row['size'].'" style="display:none">';
                    echo                    '<input type="text" class="form-control" name="quantity" placeholder="" value="'.$row["quantity"].'" required>';
                    echo                '</div>';
                    echo                '<div class="col-md-2">';
                    echo                    '<button type="submit" class="btn btn-sm btn-success">Update</button>';
                    echo                '</div>';
                    echo                '</form>';
                    echo                '<form action="remove.php" method="post">';
                    echo                '<input name="pizza_id" value="'.$id.'" style="display:none">';
                    echo                '<input name="size" value="'.$row['size'].'" style="display:none">';
                    echo                '<div class="col-md-2">';
                    echo                '<button type="submit" class="btn btn-sm btn-danger">Remove</button>';
                    echo                '</div>';
                    echo                '</form>';
                    echo              '</div>';
                    
                   
                    echo            '</div>';
                    echo          '</div>';
                    echo        '</div>';
                    echo      '</div>';
                    echo    '</div>';
                }
            ?>
          

        <?/*
        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="row align-items-center">
              <div class="col-lg-2">
                <img src="MeatZZa.jpg" style="width: 100%">
              </div>
              <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center">
                  <h4>MeatZZa</h4>
                  <h4 class="text-muted text-right">$10</h4>
                </div>
                <p class="card-text">Pepperoni, ham, Italian sausage and beef, all sandwiched between two layers of cheese made with 100% real mozzarella.</p>
                <div class="row">
                  <div class="col-md-3 row">
                    <label class="col-md-4 col-form-label" for="firstName">Quantity</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    </div>
                  </div>
                  <button class="btn btn-sm btn-danger">Remove</button>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="media text-muted pt-3">
          <div class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
            <div class="row align-items-center">
              <div class="col-lg-2">
                <img src="MeatZZa.jpg" style="width: 100%">
              </div>
              <div class="col-lg-10">
                <div class="d-flex justify-content-between align-items-center">
                  <h4>MeatZZa</h4>
                  <h4 class="text-muted text-right">$10</h4>
                </div>

                <p class="card-text">Pepperoni, ham, Italian sausage and beef, all sandwiched between two layers of cheese made with 100% real mozzarella.</p>
                <div class="row">
                  <div class="col-md-3 row">
                    <label class="col-md-4 col-form-label" for="firstName">Quantity</label>
                    <div class="col-md-8">
                      <input type="text" class="form-control" id="firstName" placeholder="" value="" required>
                    </div>
                  </div>
                  <button class="btn btn-sm btn-danger">Remove</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <script>
            $(document).ready({
                $("#remove").click({
                    var data ={};
                    data.pizza_id=this.$row['pizza_id'];
                    data.size=this.$row['size'];
                    $.ajax({
                        type:"POST",
                        url:"remove.php",
                        data:data,
                        success: function{
                            window.alert(5);      
                        }
                    });
                  });
            });
            
          </script>
          
        */?>

      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  </body>
</html>