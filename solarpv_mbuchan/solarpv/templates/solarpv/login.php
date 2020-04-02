<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script src="./pageScript.js"></script>
    <title>Login!</title>
</head>
<body>
    <div class="wrapper">
        <div class="head" id="header"></div>
        <div class="marqbar">
        <marquee behavior="scroll" direction="left">Racks & Trackers * PV Module * PV Systems * Data Analytics * Cybersecurity</marquee>
    </div>
    <div class="sidebar" id="sidebar"></div>
    <div class="main">
    <?php        
        if (isset($_SESSION['logged in']) && $_SESSION['logged in'] == true ){?>
            <h3 class="text-center">You are logged in <?php 
            echo $_SESSION['username'];               
        }
        else{
            //LOGIN FORM
            ?>
            <form method="post" enctype="multipart/form-data">
            <h3 class="text-center">User Login</h3>
            <table class="m-auto">
                <tr><td>Username</td><td><input name="uName" type="text" placeholder="required"></td></tr>
                <tr><td>Password</td><td><input name="uPass" type="password" placeholder="required"></td></tr>
            </table>            
            <div class="p-3" style="text-align: center;"><button value="Submit" name="login">Login</button></div>
            </form>
            <div id="result"></div>
            <?php
        if (isset($_POST['login'])){
            $userName = $_POST['uName'];
            $userPassword = $_POST['uPass'];
            if(!empty($userName) && !empty($userPassword)){
                $results = $mysqli->query("SELECT * FROM USERS WHERE USERNAME = '$userName'") or die($mysqli->error);
                while($row = $results->fetch_assoc()){
                    if(!empty($results) && $results->num_rows > 0){
                        if($row['USERNAME'] == $userName && $row['USERPASSWORD'] == $userPassword){
                            echo "Login successful.";
                            $_SESSION['username'] = $row['USERNAME'];
                            $_SESSION['logged in'] = true;
                            header("location:index.php");
                        }
                        else{echo "Username or password invalid, Please try again.";}
                    }
                }
            }
            else{echo "Username or password invalid, Please try again.";}
        }
    }
    ?>
    </div>
    <div class="newsbar" id="newsbar"></div>
    <div class="foot" id="footer"></div>
    </div>
</body>
</html>