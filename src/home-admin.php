<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<title>Homepage</title>
	</head>
	<body>
    <header>
      <div id="navbar" class="navbar navbar-dark bg-dark shadow-sm">
        <div class="container d-flex justify-content-between">
          <div class="navbar-brand d-inline align-items-center">
            <a style="color:white" href=home-admin.php><i class="fas fa-chart-pie"></i></a>
            <a href="home-customer.php" class="navbar-brand d-inline align-items-center text-right">
              <i class="fas fa-sign-out-alt"></i>
              <strong>Customer Home</strong>
            </a>
          </div>
          <div class="inline">
            <a href="addnewpizza.html" class="navbar-brand d-inline align-items-center text-right">
              <i class="fas fa-sign-out-alt"></i>
              <strong>Add New Pizza</strong>
            </a>
            <a href="signout.html" class="navbar-brand d-inline align-items-center text-right">
              <i class="fas fa-sign-out-alt"></i>
              <strong>Sign Out</strong>
            </a>
          </div>
        </div>
      </div>
    </header>
    <main role="main">
      <section class="jumbotron text-center">
        <div class="container">
          <h1 class="jumbotron-heading">Manage Pizzas</h1>
          <p class="lead text-muted">You can add/delete/update pizzas here.</p>
          <div class="row" style="padding-top: 20px">
            <div class="col-lg-6">
              <h4 class="lead">Search Pizza by Name</h4>
              <div class="container my-2">
                <form class="form-inline my-2 my-lg-0 justify-content-center">
                  <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search" name="search">
                  <input id="search" class="btn btn-outline-success my-2 my-sm-0" value="Search">
                </form>
              </div>
            </div>
            <div class="col-lg-6">
              <h4 class="lead">Filter Pizza by Category</h4>
              <div class="container">
                <form>
									<input type="radio" name="category" value="meat" /> Meat &nbsp; &nbsp;
									<input type="radio" name="category" value="veggie" /> Veggie<br/><br/>
								</form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <div class="py-5 bg-light">
        <div class="container">
          <div class="row" id="pizzaList">
          </div>
          <ul class="pagination justify-content-center">
            <li class="page-item"><button id="previous" class="page-link">Previous</button></li>
            <li class="page-item"><button id="next" class="page-link">Next</button></li>
          </ul>
        </div>
      </div>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script>
      var page = 1;
      var itemPerPage = 3;
      var keyword = "";
      var url = "";

      $(document).ready(function() {
        if (url == "") {
          url = "searchWithKeyword.php";
          search();
        }

        $("#search").click(function() {
          keyword = $("input[name='search']").val();
          page = 1;
          url = "searchWithKeyword.php";
          search();
        });

        $("input[name='category'][value='meat']").click(function() {
          keyword = 'meat';
          page = 1;
          url = "filterWithKeyWord.php";
          search();
        });

        $("input[name='category'][value='veggie']").click(function() {
          keyword = 'veggie';
          page = 1;
          url = "filterWithKeyWord.php";
          search();
        });

        $("#previous").click(function() {
          if (page > 1) page -= 1; 
          search();
        });

        $("#next").click(function() {
          page += 1;
          search();
        });

      });

      function search() {
        $.ajax({
          type: "POST",
          url: url,
          data: {keyword: keyword},
          success: function(data) {
            var startIndex = (page - 1) * itemPerPage;
            var endIndex = page * itemPerPage;
            json = JSON.parse(data);

            if (startIndex >= json.length && page > 1) {
              page -= 1;
              startIndex -= itemPerPage;
              endIndex = json.length;
            }

            $("#pizzaList").html("");

            for (var i = 0; i < json.length; i++) {
              var item = JSON.parse(json[i]);
              if (i >= startIndex & i < endIndex) {
                $("#pizzaList").append('<div class="col-md-4"><div class="card mb-4 shadow-sm"><img class="card-img-top" src="' + item.name + '.jpg"><div class="card-body"><div class="d-flex justify-content-between"><h4 class="card-text" >' + item.name + '</h4></div><p class="card-text">' + item.description + '</p><div class="d-flex justify-content-between align-items-center"><div class="btn-group"><form action="editpizza.php" method="post"><input name="name" value="' + item.name + '" style="display:none"><button type="submit" class="btn btn-sm btn-warning" >Edit</button></form><form action="removepizza.php" method="post"><input name="pizza_id" value="' + item.id + '" style="display:none"><button type="submit" class="btn btn-sm btn-danger">Remove</button></form></div><input name="name" value="' + item.name + '" style="display:none"></div></div></div></div>');
              }
            }
          }
        });
      }

    </script>
  </body>
</html>