<?php
session_start();
require 'db.php';

function pullTestName($inputVar){
    $userName = $_SESSION['username'];
    $results = mysqli_query($mysqli,"SELECT * FROM TESTLAB WHERE CONTACT_PERSON = '$inputVar'") or die($mysqli->error);;
    while($row = $results->fetch_assoc()){
        if(!empty($results) && $results->num_rows > 0){
            if($row['CONTACT_PERSON'] == $userName){
                $_SESSION['testName'] = $row['NAME'];
                
            }
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
    <title>PV Rating</title>
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
    white-space: nowrap;
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
            <form action="pvsearch.php" method="post" enctype="multipart/form-data">
            <h1>Search for PV Rating</h1>
            <br><br>
            <table>
                <tr><td>Manufacturer</td><td><input type="text" name="mfgVar"></td></tr>
            </table>            
            <br><br>            
            <div class="p-3" style="text-align: center;"><button value="Submit" name="search">Search</button></div>
            <?php
                        $dataArray = array();
                        if (isset($_POST['search']) && !empty($_POST['mfgVar'])){                            
                            $mfgVar = $_POST['mfgVar'];
                            $baseValue = 
                            $t = array("NAME","USERNAME","EMAIL","CELLTECHNOLOGY","MAXIMUMSYSTEMVOLTAGE","TESTSEQUENCE","AVERAGE_ISC","AVERAGE_VOC","AVERGAG_PMP");
                            $results = $mysqli->query("SELECT manufacturer.NAME,USERNAME,EMAIL,CELLTECHNOLOGY,MAXIMUMSYSTEMVOLTAGE,TESTSEQUENCE,AVG(ISC) AS AVERAGE_ISC,AVG(VOC) AS AVERAGE_VOC,AVG(PMP) AS AVERGAG_PMP FROM testresults LEFT JOIN product ON testresults.PRODUCT=product.MODELNUMBER LEFT JOIN manufacturer ON PRODUCT.MANUFACTURER=manufacturer.NAME LEFT JOIN users ON manufacturer.CONTACT_PERSON=users.USERNAME WHERE manufacturer.NAME='$mfgVar' GROUP BY TESTSEQUENCE") or die($mysqli->error);
                            if(!empty($results) && $results->num_rows > 0){
                                while($row = $results->fetch_assoc()){
                                    $j = count($dataArray);
                                    for($i = 0; $i < count($row); $i++){
                                        $dataArray[$j][$i] = $row[$t[$i]];
                                        if($i > 5){
                                            $dataArray[$j][$i] = number_format((float)$dataArray[$j][$i],2,".",",");
                                        }
                                    }
                                }
                                $labelArray = array("","Average ISC","Average VOC","Average PMAX");
                                echo "<br><tr><h5>PV Ratings</h5></tr>";
                                echo "<table><tbody>";
                                echo "<tr><td class=\"flabel\">Manufacturer</td><td colspan='".count($dataArray)."'>".$dataArray[0][0]."</td></tr>";
                                echo "<tr><td class=\"flabel\">Contact Name</td><td colspan='".count($dataArray)."'>".$dataArray[0][1]."</td></tr>";
                                echo "<tr><td class=\"flabel\">Contact Email</td><td colspan='".count($dataArray)."'>".$dataArray[0][2]."</td></tr>";
                                echo "<tr><td class=\"flabel\">Cell Technology</td><td colspan='".count($dataArray)."'>".$dataArray[0][3]."</td></tr>";
                                echo "<tr><td class=\"flabel\">Rated Power</td><td colspan='".count($dataArray)."'>".$dataArray[0][4]."</td></tr>";
                                
                                $avgDrop = array();
                                for($i = 5; $i < count($dataArray[$i]); $i++){
                                    $k = $i - 5;                                
                                    echo "<tr><td class=\"flabel\">".$labelArray[($k)]."</td>";
                                    for($j = 0; $j < count($dataArray); $j++){
                                        if($dataArray[$j][$i] == "Baseline"){
                                            $baseValue = floatval($dataArray[$j][8]);
                                        }
                                        echo "<td>".$dataArray[$j][$i]."</td>";
                                        $dropVal = (floatval($dataArray[$j][8])*100)/$baseValue;
                                        $avgDrop[$j] = number_format((float)$dropVal,2,".",",");
                                    }
                                    echo "</tr>";
                                }
                                //OUTPUT AVG DROP
                                echo "<tr><td>Average PMAX\ndrop from\nBaseline average</td>";
                                for($i = 0; $i < count($avgDrop); $i++){
                                    //new
                                    echo "<td>%".$avgDrop[$i]."</td>";
                                }
                                echo "</tr>";
                            }
                            else{
                                echo "Manufacturer does not exist. Please try again.";
                            }                            
                        }
                        else{
                            echo "You must enter a manufacturer to conduct a search.";
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