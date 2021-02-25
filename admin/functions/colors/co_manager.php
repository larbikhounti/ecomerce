<?php
session_start();
if (!isset($_SESSION["id"]) || $_SESSION["privilege"] != 1) {
    header("Location:" . "../login.php");
}
include "../../includes/mysql_connections/connect.php";
//check if its coming from post request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    //check if the user is an admin
    if (isset($_SESSION["privilege"])) {
        if ($_SESSION["privilege"] == 1) {
            // IS [action] variable is set ?
            if (isset($_GET["action"])) {
                if (!empty($_POST['color'])) {
                    if($_GET['action'] == 3){ // 3 =   add
                        try {
                            $stm = $dbc->prepare('INSERT into colors (name) values(:color)'); // add color
                            $stm->bindParam(":color", $_POST["color"]);
                            $stm->execute();
                            // $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
                            if ($stm->rowcount() > 0) {
                                header("Location:" . "../../pages/Colors.php?statu=1");
                            }
                        } catch (Exception $e) {
                            // echo $e;
                            header("Location:" . "../../pages/Colors.php?statu=0");
                        }
                    }elseif($_GET["action"] == 1){ // 1 = update
                        try {
                            $stm = $dbc->prepare('update  colors set name = :name where id = :id'); // update color
                            $stm->bindParam(":id", $_GET["id"]);
                            $stm->bindParam(":name", $_POST["color"]);
                            $stm->execute();
                            header("Location:" . "../../pages/Colors.php?statu=1");
                        } catch (Exception $e) {
                             //echo $e;
                            header("Location:" . "../../pages/Colors.php?statu=0");
                        } 
                    }

                }
            }
        }
    }
}
//check if its coming from get request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //check if the user is an admin
    if (isset($_SESSION["privilege"])) {
        if ($_SESSION["privilege"] == 1) {
            // IS [action] variable is set ?
            if (isset($_GET["action"]) && isset($_GET["id"])) {
                    if($_GET["action"] == 2){
                        try {
                        $stm = $dbc->prepare('delete from colors where id = :id'); // 
                        $stm->bindParam(":id", $_GET["id"]);
                        $stm->execute();
                        header("Location:" . "../../pages/Colors.php?statu=1");
                    } catch (Exception $e) {
                        //echo $e;
                        header("Location:" . "../../pages/Colors.php?statu=0");
                    } 
                }
            }
        }
    }
}
