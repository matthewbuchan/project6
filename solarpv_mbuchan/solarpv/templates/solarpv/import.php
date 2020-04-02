<?php
session_start();
require 'db.php';

$userName = $_SESSION['username'];
$results = mysqli_query($mysqli,"SELECT * FROM TESTLAB WHERE CONTACT_PERSON = '$userName'") or die($mysqli->error);

while($row = $results->fetch_assoc()){    
    if(!empty($results) && $results->num_rows > 0){
        if($row['CONTACT_PERSON'] == $userName){
            $_SESSION['testName'] = $row['NAME'];
        }
    }
}
function checkModule($inputVar){
    $model = $inputVar;
    $results = mysqli_query($mysqli,"SELECT * FROM PRODUCT WHERE MODELNUMBER = '$model'") or die($mysqli->error);
    while($row = $results->fetch_assoc()){
        if(!empty($results) && $results->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="./pageScript.js"></script>    
    <title>Welcome to SolarPV</title>
</head>
<style>
table{
    margin: auto;
}
.ffield{
    white-space: nowrap;
    text-align: center;
    border-style: solid;
    border-width: 1px;    
    padding-right: 2em;
    padding-left: 2em;
}
td{
    white-space: wrap;
    text-align: center;
    border-style: solid;
    border-width: 1px;    
    padding-right: 1em;
    padding-left: 1em;
}
</style>
<body>
    <div class="wrapper">
        <div class="head" id="header"></div>
        <div class="marqbar">
        <marquee behavior="scroll" direction="left">Racks & Trackers * PV Module * PV Systems * Data Analytics * Cybersecurity</marquee>
    </div>
    <div class="sidebar" id="sidebar"></div>
    <div class="main">
            <h1>Test Data Upload</h1>
            <h5>Note: CSV file formats must be utilized</h5>
            <br><br>
            <table>
                <tr><td class="flabel">Contact</td><td class="ffield"><?php echo $_SESSION['username']; ?></td></tr>
                <tr><td class="flabel">Test Site</td><td class="ffield"><?php if(isset($_SESSION['testName'])){echo $_SESSION['testName'];}else{header("location:register.php");} ?></td></tr>
            </table>
            <br><br>
            <form action="import.php" method="post" enctype="multipart/form-data">
            <div>
                <input type="file" method="file" name="inputfile">
                <button name="submit">Import</button>
            </div>
                <table>
                    <tbody>
                        <?php
                        function checkEmail($inputVar){
                            if(preg_match('/^([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})$/',$inputVar)){
                                echo "GOOD EMAIL";
                                return true;}
                            else{return false;}
                        }
                        if (isset($_POST['submit'])){
                            // Variables removed. Logged in user data provides information.
                            //Obtain testlab info from user                            
                            $file = $_FILES['inputfile']['tmp_name'];
                            $file = fopen($file, 'r');
                            $flag = true;
                            echo "<br><tr><h5>File Import Results</h5></tr>";
                            echo "<tr><td>STATUS</td><td>SITE</td><td>PRODUCT</td><td>TESTSEQUENCE</td><td>REPORTINGCONDITION</td><td>TESTDATE</td><td>ISC</td><td>VOC</td><td>IMP</td><td>VMP</td><td>FF</td><td>PMP</td><td>NOCT</td></tr>";
                            while (($row = fgetcsv($file)) !== FALSE){
                                if($flag) { $flag = false; continue;}
                                $date = date("Y-m-d",strtotime($row[3]));
                                $row[3] = $date;
                                $values = "'". implode("','",$row) ."'";                               
                                $string = explode("/",$row[3]);                                
                                //Insert TEST DATA TABLE
                                $sqlinj = "SELECT * FROM PRODUCT WHERE MODELNUMBER = '$row[0]'";
                                $results = mysqli_query($mysqli,$sqlinj);
                                if(!empty($results) && $results->num_rows > 0){
                                    $sqlinj = "INSERT INTO TESTRESULTS(DATASOURCE,PRODUCT,TESTSEQUENCE,REPORTINGCONDITION,TESTDATE,ISC,VOC,IMP,VMP,FF,PMP,NOCT) VALUES ('".$_SESSION['testName']."',".$values.")";
                                    if(mysqli_query($mysqli,$sqlinj)){
                                        echo "<tr><td>Success</td><td>{$_SESSION['testName']}</td><td>{$row[0]}</td><td>{$row[2]}</td><td>{$row[1]}</td><td>{$date}</td><td>{$row[4]}</td><td>{$row[5]}</td><td>{$row[6]}</td><td>{$row[7]}</td><td>{$row[9]}</td><td>{$row[8]}</td><td>{$row[9]}</td></tr>";
                                    }
                                    else{
                                        echo "<tr><td>Failed</td><td>{$_SESSION['testName']}</td><td>{$row[0]}</td><td>{$row[2]}</td><td>{$row[1]}</td><td>{$date}</td><td>{$row[4]}</td><td>{$row[5]}</td><td>{$row[6]}</td><td>{$row[7]}</td><td>{$row[9]}</td><td>{$row[8]}</td><td>{$row[9]}</td></tr>";
                                    }
                                }
                                else{
                                    echo "<tr><td>Failed\nUnregistered Model</td><td>{$_SESSION['testName']}</td><td>{$row[0]}</td><td>{$row[2]}</td><td>{$row[1]}</td><td>{$date}</td><td>{$row[4]}</td><td>{$row[5]}</td><td>{$row[6]}</td><td>{$row[7]}</td><td>{$row[9]}</td><td>{$row[8]}</td><td>{$row[9]}</td></tr>";
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </form>
        </div>
        <div class="newsbar" id="newsbar"></div>
    <div class="foot" id="footer"></div>
    </div>
</body>
</html>