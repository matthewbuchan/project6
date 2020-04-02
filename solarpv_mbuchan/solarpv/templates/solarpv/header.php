<?php
session_start();
require 'db.php';
?>
<!DOCTYPE html>
<html lang="en">    
<style>
.hpanel{
    width: 100%;
    height: 100%;
    background-image: url("./banner.jpg");
    background-size: cover;
    background-repeat: no-repeat;
    padding: 1em;
}
.hgrid{
    display: grid;
    grid-template-columns: 50% 50%;
}
.rpanel > div{    
    text-align: right;
    -webkit-text-stroke: .5px white;
} 
</style>
<body>
    <div class="hpanel">
    <?php if(isset($_SESSION['username'])){echo "Welcome ".$_SESSION['username'];}?>
        <div class="hgrid">
            <div><a href="./index.php"><img src="./Logo.gif" style="height: 90px;" alt="Company Logo"></a></div>
            <div class="rpanel">
                <div class="navlinks links"><a href="./aboutus.html">About Us</a> | <a href="./contactus.html">Contact Us</a></div>
                <div class="navlinks social" style="bottom: 0;"><img style="height: 75px;" src="./socialmedia.gif" alt=""></div>
            </div>
        </div>
    </div>
</body>
</html>