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
                if (!empty($_POST['category'])) {
                    if($_GET['action'] == 3){ // 3 =   add
                        try {
                            $stm = $dbc->prepare('INSERT into category (name) values(:category)'); // add category
                            $stm->bindParam(":category", $_POST["category"]);
                            $stm->execute();
                            // $data = $stm ->fetchAll(PDO::FETCH_ASSOC);
                            if ($stm->rowcount() > 0) {
                                header("Location:" . "../../pages/categories.php?statu=1");
                            }
                        } catch (Exception $e) {
                            // echo $e;
                            header("Location:" . "../../pages/categories.php?statu=0");
                        }
                    }elseif($_GET["action"] == 1){ // 1 = update
                        try {
                            $stm = $dbc->prepare('update  category set name = :name where id = :id'); // add category
                            $stm->bindParam(":id", $_GET["id"]);
                            $stm->bindParam(":name", $_POST["category"]);
                            $stm->execute();
                            header("Location:" . "../../pages/categories.php?statu=1");
                        } catch (Exception $e) {
                             //echo $e;
                            header("Location:" . "../../pages/categories.php?statu=0");
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
                        $stm = $dbc->prepare('delete from category where id = :id'); // add category
                        $stm->bindParam(":id", $_GET["id"]);
                        $stm->execute();
                        header("Location:" . "../../pages/categories.php?statu=1");
                    } catch (Exception $e) {
                        //echo $e;
                        header("Location:" . "../../pages/categories.php?statu=0");
                    } 
                }
            }
        }
    }
}
