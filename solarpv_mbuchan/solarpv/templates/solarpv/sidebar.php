<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <div class="titleRow">
    <?php
    if(isset($_SESSION['logged in'])&&$_SESSION['logged in'] == true){        
        echo "<a href=\"./register.php\">Register</a> | <a href=\"./logout.php\">Logout</a></tr>";
        ?>
        </div>
        <div class="titleCat"><a href="./addModule.php">PV Module</a></div>
        <ul>
            <li><a href="./import.php">Testing & Certification</a></li>
            <li><a href="./pvsearch.php">PV Rating</a></li>
        </ul>
        <div class="titleCat">PV System Performance</div>
        <ul>
            <li>Monitoring & Inspection</li>
            <li>Performance Analysis</li>
            <li>Compare System</li>
            <li>Certification</li>
        </ul>
        <div class="titleCat">Data Analytics</div>
        <ul>
            <li>Module lifetime prediction</li>
            <li>Energy Prediction</li>
        </ul>
        <div class="titleCat">Cybersecurity and Smart Grid Technologies</div>
        <div class="titleCat">Solar PV University</div>
    <?php
    }
    else{
        echo "<a href=\"./register.php\">Register</a> | <a href=\"./login.php\">Login</a></tr>";
        ?>
        </div>
        <div class="titleCat">PV Module</div>
        <ul>
            <li>Testing & Certification</li>
            <li>PV Rating</li>
        </ul>
        <div class="titleCat">PV System Performance</div>
        <ul>
            <li>Monitoring & Inspection</li>
            <li>Performance Analysis</li>
            <li>Compare System</li>
            <li>Certification</li>
        </ul>
        <div class="titleCat">Data Analytics</div>
        <ul>
            <li>Module lifetime prediction</li>
            <li>Energy Prediction</li>
        </ul>
        <div class="titleCat">Cybersecurity and Smart Grid Technologies</div>
        <div class="titleCat">Solar PV University</div>
        <?php
    }
    ?>
    </body>
</html>