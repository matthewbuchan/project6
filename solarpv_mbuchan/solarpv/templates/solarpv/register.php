<?php
session_start();
require 'db.php';

function checkPhone($inputVar){
    if(preg_match('/^\d{3}-?\d{3}-?\d{4}$/',$inputVar)){return true;}
    else{return false;}

}
function checkEmail($inputVar){
    if(preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$inputVar)){return true;}
    else{return false;}
}
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
    <title>Registration</title>
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
        if (isset($_SESSION['logged in']) && $_SESSION['logged in'] == true ){            
            //LOGGED IN
            ?>
            <script type="text/javascript">
            //Show/hide registration fields
            window.onload = function(){
                document.getElementById('countryRow').style.display='none';
                document.getElementById('addressRow').style.display='none';
                document.getElementById('contactRow').style.display='none';
                
                }
            function registerShowHide(){
                var dOption = document.getElementById('cType').value;
                if(dOption == "manufacturer"){
                    document.getElementById('countryRow').style.display='';
                    document.getElementById('addressRow').style.display='none';
                    document.getElementById('contactRow').style.display='';
                }
                if(dOption == 'testLab'){
                    document.getElementById('countryRow').style.display='none';
                    document.getElementById('addressRow').style.display='';
                    document.getElementById('contactRow').style.display='';
                }
            }
            </script>
            <form method="post" enctype="multipart/form-data">
            <h3 class="text-center">Please register a manufacturer or test site.</h3>
            <h5 class="text-center">Note: You must have a test site registered to you before importing data.</h5>
            <table class="m-auto">
            <tr><td class="flabel">Manufacturer/Site Name</td><td class="ffield"><input name="cName" type="text"></td></tr>            
            <tr><td class="flabel">Category</td><td class="ffield"><select id="cType" name="cType" onchange="registerShowHide();"><option value="te"></option><option value="testLab">Test Lab<option value="manufacturer">Manufacturer</option></select></td></tr>
            <tr id="countryRow"><td class="flabel">Country</td><td class="ffield"><input type="text" name="mCountry"></td></tr>
            <tr id="addressRow"><td class="flabel">Address</td><td class="ffield"><input type="text" name="tAddr"></td></tr>
            <tr id="contactRow"><td class="flabel">Contact Name</td><td class="ffield"><input name="contactName" type="text"></td></tr>
            </table>
            <div class="p-3" style="text-align: center;"><button value="Submit" name="register">Register</button></div>
            </form>
            <div id="result"></div>
            <?php
            if (isset($_POST['register'])){
                //Populate variabes
                $contactName = $_POST['contactName'];
                $cName = $_POST['cName'];
                $country = $_POST['mCountry'];
                $address = $_POST['tAddr'];
                $sqlList = array();
                $sqlValues = array();
                
                if(isset($_POST['cType']) && $_POST['cType'] == "manufacturer"){
                    $iField = array('cName','country','contactName');
                    $sqlList = array('NAME','REGISTERED_COUNTRY','CONTACT_PERSON');
                    for($i = 0; $i < count($iField); $i++){
                        array_push($sqlValues,${$iField[$i]});
                    }
                    $sqlList = strtoupper(implode(",",$sqlList));
                    $sqlValues = "'". implode("','",$sqlValues) ."'";
                    $sqlinj = "INSERT INTO MANUFACTURER(".$sqlList.") VALUES (".$sqlValues.")";
                    if(mysqli_query($mysqli,$sqlinj)){echo "Registration Successful";}
                    else{echo "Registration Failed";}
    
                }
                elseif(isset($_POST['cType']) && $_POST['cType'] == "testLab"){
                    //testlab
                    $iField = array('cName','address','contactName');
                    $sqlList = array('NAME','ADDRESS','CONTACT_PERSON');
                    for($i = 0; $i < count($iField); $i++){
                        array_push($sqlValues,${$iField[$i]});
                    }
                    $sqlList = strtoupper(implode(",",$sqlList));
                    $sqlValues = "'". implode("','",$sqlValues) ."'";
                    $sqlinj = "INSERT INTO TESTLAB(".$sqlList.") VALUES (".$sqlValues.")";
                    if(mysqli_query($mysqli,$sqlinj)){echo "Registration Successful";}
                    else{echo "Registration Failed";}
                }
            }
        }
        else{
            //NOT LOGGED IN
            ?>
            <form method="post" enctype="multipart/form-data">
            <h3 class="text-center">User Registration Form</h3>
            <table class="m-auto">
                <tr><td class="flabel">Username</td><td class="ffield"><input name="uName" type="text" placeholder="required" autocomplete="username"></td></tr>
                <tr><td class="flabel">Password</td><td class="ffield"><input name="uPass" type="password" placeholder="required" autocomplete="current-password"></td></tr>
                <tr><td class="flabel">First name</td><td class="ffield"><input name="fName" type="text"></td></tr>
                <tr><td class="flabel">Middle name</td><td class="ffield"><input name="mName" type="text"></td></tr>
                <tr><td class="flabel">Last name</td><td class="ffield"><input name="lName" type="text"></td></tr>
                <tr><td class="flabel">Address</td><td class="ffield"><input name="uAddr" type="text"></td></tr>
                <tr><td class="flabel">Office Phone number</td><td class="ffield"><input name="oPhone" type="tel"></td></tr>
                <tr><td class="flabel">Cell Phone number</td><td class="ffield"><input name="cPhone" type="tel"></td></tr>
                <tr><td class="flabel">Email</td><td class="ffield"><input name="uEmail" type="text"></td></tr>
            </table>
            <div class="p-3" style="text-align: center;"><button value="Submit" name="register">Register</button></div>
        </form>
        <div id="result"></div>
        <?php
        if (isset($_POST['register'])){
            $formList = array('userName','userPassword','firstName','middleName','lastName','Address','officePhone','cellPhone','email');
            $sqlList = array();
            $sqlValues = array();
            $errList = array();
            
            //Populate variabes
            $userName = $_POST['uName'];
            $userPassword = $_POST['uPass'];
            $firstName = $_POST['fName'];
            $middleName = $_POST['mName'];
            $lastName = $_POST['lName'];
            $Address = $_POST['uAddr'];
            $officePhone = $_POST['oPhone'];
            $cellPhone = $_POST['cPhone'];
            $email = $_POST['uEmail'];
            $validation = "";

            //Validate
            for($i = 0; $i < count($formList); $i++){
                if(${$formList[$i]}){                    
                    if(strpos($formList[$i],'Phone') !== false){                        
                        if(checkPhone(${$formList[$i]}) !== false){                            
                            $validation = $validation."PHONE\n";
                            array_push($sqlList, $formList[$i]);
                            array_push($sqlValues, ${$formList[$i]});
                        }
                        else{break;}
                    }
                    elseif(strpos($formList[$i], 'email') !== false){
                        if(checkEmail(${$formList[$i]}) !== false){
                            $validation = $validation."EMAIL\n";
                            array_push($sqlList, $formList[$i]);
                            array_push($sqlValues, ${$formList[$i]});}
                        else{break;}
                    }
                    else{
                        array_push($sqlList, $formList[$i]);
                        array_push($sqlValues, ${$formList[$i]});
                    }
                }
            }
            //Validate all fields are filled
            echo "<Script type=\"text/javascript\">alert(" . json_encode($validation) . ");</Script>";
            if(count($sqlList) != count($formList)){
                echo "<Script type=\"text/javascript\">alert(" . json_encode($errList) . ");</Script>";
            }
            else{
                //Push to database
                $sqlList = strtoupper(implode(",",$sqlList));
                $sqlValues = "'". implode("','",$sqlValues) ."'";
                $sqlinj = "INSERT INTO USERS(".$sqlList.") VALUES (".$sqlValues.")";
                if(mysqli_query($mysqli,$sqlinj)){
                    echo "Registration Successful";
                }
                else{echo "Registration Failed";}
                }
            }
        }
        ?>
    </div>
    <div class="newsbar" id="newsbar"></div>
    <div class="foot" id="footer"></div>
    </div>
</body>
</html>