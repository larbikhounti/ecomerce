<?php
session_start();
if(!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1 ){
    header("Location:"."../login.php");
}
include "../includes/mysql_connections/connect.php";
include "../const/bootstrap.php";
include "../const/navbar.php";
  
  try{
      // get total items(products) and get total clients
    $stm = $dbc->prepare('SELECT  (SELECT COUNT(*) FROM items) AS totalitems,(SELECT COUNT(*) FROM clients) AS totalclients,(SELECT COUNT(*) FROM orders) AS totalorders');
    $stm->execute();
    $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
    foreach ($data as $total ) {
        # code...
        $totalClients = $total["totalclients"];
        $totalitems = $total["totalitems"];
        $totalorders = $total["totalorders"];
    }
  

  }catch(Exception $e){
      echo $e;
      header("Location:"."../../members.php?statu=0");
  }






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
        <div class="col-md-4 col-sm-12 ">
            <div class="">
                <div class="card text-white bg-danger mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Products</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $totalitems;  ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="">
                <div class="card text-white bg-primary mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Clients</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $totalClients; ?></h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="">
                <div class="card text-white bg-success mb-3 shadow" style="max-width: 20rem;">
                        <div class="card-header text-center bg-dark"><h3>Orders</h3></div>
                        <div class="card-body text-center">
                        <h3 class="card-title"><?php echo $totalorders ;?></h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-md-6 col-sm-12">
            <div class="shadow">
                <canvas id="myChart1"  height="160px"></canvas>
             </div>
        </div>
        <div class="col-md-6 col-sm-12">
            <div class="shadow">
                <canvas id="myChart2"  height="160px" ></canvas>
             </div>
        </div>
   

    </div>
 
        
</div>
<?php echo  $bootstrapJQ; ?>
<?php echo  $bootstrapjS; ?>
<script src="../scriptsjs/chart.js"></script>
<script src="../scriptsjs/myscript.js">
showgraphs();
</script>
</body>

</html>

