<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}
include "../const/bootstrap.php";
include "../const/navbar.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php echo  $bootstrapCSS; ?>
    <link rel='stylesheet' type='text/css' href='../styles/nav.css'>
    <title>welcomepage</title>
</head>

<body>
<?php echo $navbar; ?>
<div class="container">
        <div class="row mt-5">
        <div class="col-md-4 col-sm-12">
            <div class="">
                <div class="card text-white bg-danger mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Products</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title">1500</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="">
                <div class="card text-white bg-primary mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Clients</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title">200</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="">
                <div class="card text-white bg-success mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Orders</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title">50</h3>
                    </div>
                </div>
            </div>
        </div>
        </div>
</div>
<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
</body>

</html>

