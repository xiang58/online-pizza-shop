
<?
    session_start();
?>
<!doctype html>
<html lang="en">
  <head>
      <script>
			$(function() {
				$('#new_pizza').submit(function(e) {
					var pizza = $('#pizzaName').val();
					var price = $('#base_price').val();
					var description = $('#pizzaDescription').val();
					var inventory = $('#inventory').val();
                    var category= $('#category').val;	
					if (pizza=='' || price=='' || description=='' || inventory=='' ||category=='') {
						alert('Please enter all fileds!');
						e.preventDefault();
					}
                    else if(!price.match(/^[0-9]+\056[0-9][0-9]$/)){
                        alert('Please enter a price in the form XX.XX!');
						e.preventDefault();
                    }
                    else if(/^\d+*$/){
                        alert('Please enter an inventory number greater than or equal to 0!');
						e.preventDefault();        
                    }
                });
            });
      </script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <title>Add New Pizza</title>
  </head>
  <body class="bg-light">
    <header>
      <div id="navbar" class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <div class="navbar-brand d-inline align-items-center">
            <a style="color:white" href="home-admin.php"><i class="fas fa-chart-pie"></i></a>
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
    <main role="main">
      <section class="jumbotron text-center" style="background-color: white">
        <div class="container">
          <h1 class="jumbotron-heading">Edit an Existing Pizza</h1>
          <p class="lead text-muted">You can edit pizzas here.</p>
        </div>
      </section>
      <div class="container" style="margin-bottom: 40px">
        <div class="row">
          <div class="col-md-8 offset-md-2">
            <form action="update_pizza.php" method='post' id="edit_pizza" class="needs-validation" novalidate>
              <div class="mb-3">
                <label for="pizza_name">Pizza Name</label>
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
                    $pizza=$_POST['name'];
                    $sql= "SELECT * FROM pizza WHERE pizza_name= '$pizza'";
                    $result = mysqli_query($conn,$sql)or trigger_error("Query Failed! SQL: $sql - Error: ".mysqli_error($conn), E_USER_ERROR);
                    $row=mysqli_fetch_array($result);
                    echo $sql;
                    echo '<input name="pizza_id" value="'.$row["pizza_id"].'" style="display:none">';
                    echo '<input type="text" class="form-control" name="pizza_name" value="'.$pizza.'"id="pizzaName" placeholder="Pizza Name" required>';
                
                echo '<label class="label-danger" for="pizza_name">*Make sure image is stored in format pizzaname.jpg</label>';
              echo '</div>';
              echo '<div class="mb-3">';
                echo '<label for="base_price">Base Price</label>';
                echo '<input type="text" class="form-control" value="'.$row["base_price"].'" name="base_price" id="base_price" placeholder="Base Price" required>';
              echo '</div>
               <div class="mb-3">
                <label for="description">Pizza Description</label>';
                echo '<textarea style="resize:none" type="text" class="form-control" name="pizzaDescription" id="pizzaDescription" placeholder="Pizza Description" rows="5" required>'. $row["description"].'</textarea>';
              echo '</div>
              <div class="mb-3">
                <label for="inventory">Inventory</label>';
                echo '<input type="text" class="form-control" value="'.$row["inventory"].'" name="inventory" id="inventory" placeholder="inventory" required>';
              echo '</div>
              <div class="mb-3">
                <label for="category">Category</label>
                <select required class="custom-select" name="category" id="category" style="margin-right: 1%">
                    <option value="" disabled>Category...</option>';
                  if($row["category"]=="meat")
                  {
                      echo '<option value="meat" selected>Meat</option>
                    <option value="veggie">Veggie</option>';
                  }else{
                      echo '<option value="meat" >Meat</option>
                    <option value="veggie" selected>Veggie</option>';
                  }
                    
               echo     '</select>';                  
                  ?>
              </div>
              <div class="row justify-content-center">
                <div class="col-md-4">
                  <button class="btn btn-primary btn-lg btn-block" type="submit">Update</button>
                </div>
                <div class="col-md-4">
                  <button class="btn btn-secondary btn-lg btn-block btn-danger" type="reset">Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
      
  </body>
</html>