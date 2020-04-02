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
        if(!empty($results) && $results->num_rows == 0){
            return true;
        }
        else{
            return false;
        }
    }
}
function checkManufacturer($inputVar){
    $results = mysqli_query($mysqli, "SELECT * FROM MANUFACTURER WHERE NAME = '$inputVar'");
    while ($row = $results->fetch_assoc()) {
        if(!empty($results) && $results->num_rows > 0){
            return true;
        }
        else{
            return false;
        }
    }
}
function checkDateFormat($inputVar){
    return preg_match('/^\d{4}[\/-]\d{1,2}[\/-]\d{1,2}$/',$inputVar);
}
function varCheck($inputVar, $varType){
    if($varType == 0){
        return is_string($inputVar);
        echo "<Script type=\"text/javascript\">alert(".json_encode($inputVar).");</Script>";
    }
    elseif($varType == 1){
        return is_float(floatval($inputVar));
        
    }
    elseif($varType == 2){
        return is_int(intval($inputVar));
        echo "<Script type=\"text/javascript\">alert(".json_encode($inputVar).");</Script>";
    }
    elseif($varType == 3){
        return checkDateFormat($inputVar);
        echo "<Script type=\"text/javascript\">alert(".json_encode($inputVar).");</Script>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>    
    <script src="./pageScript.js"></script>
    <title>Module Input</title>
</head>
<body>
    <div class="wrapper">
        <div class="head" id="header"></div>
        <div class="marqbar">
        <marquee behavior="scroll" direction="left">Racks & Trackers * PV Module * PV Systems * Data Analytics * Cybersecurity</marquee>
    </div>
    <div class="sidebar" id="sidebar"></div>
    <div class="main">
        <form method="post" enctype="multipart/form-data">
        <h3 class="text-center">Module Input</h3>
        <table class="m-auto">
        <tr><td class="flabel">Model Number</td><td class="ffield"><input type="text" id="MODELNUMBER" name="MODELNUMBER"></td></tr>
        
        <?php
        $mfgList = array();
        $results = mysqli_query($mysqli, "SELECT * FROM MANUFACTURER") or die($mysqli->error);
        while ($row = $results->fetch_assoc()) {
            if(!empty($results) && $results->num_rows > 0){                
                array_push($mfgList,$row['NAME']);
                //echo "<option value='".$row['NAME']."'>".$row['NAME']."</option>";
            }            
        }
        if(!empty($mfgList > 0)){
            ?>
            <tr><td class="flabel">Manufacturer</td><td class="ffield"><select id="MANUFACTURER" name="MANUFACTURER">
            <?php
            for($i = 0; $i < count($mfgList); $i++){
                echo "<option value='".$mfgList[$i]."'>".$mfgList[$i]."</option>";
            }
            
            echo "</select></td></tr>";
            
        }
        else{
            echo "<tr><td class=\"flabel\">Manufacturer</td><td class=\"ffield\">Please register a manufacturer</td></tr>";
        }
        ?>
        <tr><td class="flabel">Manufacture Date</td class="ffield"><td><input type="text" name="MANUFACTURINGDATE" placeholder="YYYY-MM-DD"></td></tr><div name="dNote"></div>
        <tr><td class="flabel">Length</td><td class="ffield"><input type="text" name="LENGTH"></td></tr>
        <tr><td class="flabel">Width</td><td class="ffield"><input type="text" name="WIDTH"></td></tr>
        <tr><td class="flabel">Weight</td><td class="ffield"><input type="text" name="WEIGHT"></td></tr>
        <tr><td class="flabel">Cell Area</td><td class="ffield"><input type="text" name="CELLAREA"></td></tr>
        <tr><td class="flabel">Cell Technology</td class="ffield"><td><input type="text" name="CELLTECHNOLOGY"></td></tr>
        <tr><td class="flabel">Total Cells</td><td class="ffield"><input type="text" name="TOTALNUMBEROFCELLS"></td></tr>
        <tr><td class="flabel">Cells in Series</td><td class="ffield"><input type="text" name="NUMBEROFCELLSINSERIES"></td></tr>
        <tr><td class="flabel">Series Strings</td><td class="ffield"><input type="text" name="NUMBEROFSERIESSTRINGS"></td></tr>
        <tr><td class="flabel">Bypass Diodes</td><td class="ffield"><input type="text" name="NUMBEROFBYPASSDIODES"></td></tr>
        <tr><td class="flabel">Series Fuse Rating</td><td class="ffield"><input type="text" name="SERIESFUSERATING"></td></tr>
        <tr><td class="flabel">Interconnect Material</td><td class="ffield"><input type="text" name="INTERCONNECTMATERIAL"></td></tr>
        <tr><td class="flabel">Interconnect Supplier</td><td class="ffield"><input type="text" name="INTERCONNECTSUPPLIER"></td></tr>
        <tr><td class="flabel">Superstrate Type</td><td class="ffield"><input type="text" name="SUPERSTRATETYPE"></td></tr>
        <tr><td class="flabel">Superstrate Manufacturer</td><td class="ffield"><input type="text" name="SUPERSTRATEMANUFACTURER"></td></tr>
        <tr><td class="flabel">Substrate Type</td><td class="ffield"><input type="text" name="SUBSTRATETYPE"></td></tr>
        <tr><td class="flabel">Substrate Manufacturer</td><td class="ffield"><input type="text" name="SUBSTRATEMANUFACTURER"></td></tr>
        <tr><td class="flabel">Frame Material</td><td class="ffield"><input type="text" name="FRAMEMATERIAL"></td></tr>
        <tr><td class="flabel">Frame Adhesive</td><td class="ffield"><input type="text" name="FRAMEADHESIVE"></td></tr>
        <tr><td class="flabel">Encapsulant Type</td><td class="ffield"><input type="text" name="ENCAPSULANTTYPE"></td></tr>
        <tr><td class="flabel">Encapsulant Manufacturer</td><td class="ffield"><input type="text" name="ENCAPSULANTMANUFACTURER"></td></tr>
        <tr><td class="flabel">Junction Box Type</td><td class="ffield"><input type="text" name="JUNCTIONBOXTYPE"></td></tr>
        <tr><td class="flabel">Junction Box Manufacturer</td><td class="ffield"><input type="text" name="JUNCTIONBOXMANUFACTURER"></td></tr>
        <tr><td class="flabel">Junction Box Adhesive</td><td class="ffield"><input type="text" name="JUNCTIONBOXADHESIVE"></td></tr>
        <tr><td class="flabel">Cable Type</td><td class="ffield"><input type="text" name="CABLETYPE"></td></tr>
        <tr><td class="flabel">Connector Type</td><td class="ffield"><input type="text" name="CONNECTORTYPE"></td></tr>
        <tr><td class="flabel">Max System Voltage</td><td class="ffield"><input type="text" name="MAXIMUMSYSTEMVOLTAGE"></td></tr>
        <tr><td class="flabel">Rated VOC</td><td class="ffield"><input type="text" name="RATEDVOC"></td></tr>
        <tr><td class="flabel">Rated ISC</td><td class="ffield"><input type="text" name="RATEDISC"></td></tr>
        <tr><td class="flabel">Rated VMP</td><td class="ffield"><input type="text" name="RATEDVMP"></td></tr>
        <tr><td class="flabel">Rated IMP</td><td class="ffield"><input type="text" name="RATEDIMP"></td></tr>
        <tr><td class="flabel">Rated PMP</td><td class="ffield"><input type="text" name="RATEDPMP"></td></tr>
        <tr><td class="flabel">Rated FF</td><td class="ffield"><input type="text" name="RATEDFF"></td></tr>
        </table>
        <div class="p-3" style="text-align: center;"><button value="Submit" name="addModule">Add Module</button></div>
        </form>
        <div id="result"></div>
        <?php
        if (isset($_POST['addModule'])){
            //SET VARIABLES
            $formList = array('MODELNUMBER','MANUFACTURER','MANUFACTURINGDATE','LENGTH','WIDTH','WEIGHT','CELLAREA','CELLTECHNOLOGY','TOTALNUMBEROFCELLS','NUMBEROFCELLSINSERIES','NUMBEROFSERIESSTRINGS','NUMBEROFBYPASSDIODES','SERIESFUSERATING','INTERCONNECTMATERIAL','INTERCONNECTSUPPLIER','SUPERSTRATETYPE','SUPERSTRATEMANUFACTURER','SUBSTRATETYPE','SUBSTRATEMANUFACTURER','FRAMEMATERIAL','FRAMEADHESIVE','ENCAPSULANTTYPE','ENCAPSULANTMANUFACTURER','JUNCTIONBOXTYPE','JUNCTIONBOXMANUFACTURER','JUNCTIONBOXADHESIVE','CABLETYPE','CONNECTORTYPE','MAXIMUMSYSTEMVOLTAGE','RATEDVOC','RATEDISC','RATEDVMP','RATEDIMP','RATEDPMP','RATEDFF');
            $fValType = array(0,0,3,1,1,1,1,0,2,2,2,2,1,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,1,1,1,1,1,1,1);
            $sqlList = array();
            $sqlValues = array();
            $alertlist = array();            
            for($i = 0; $i < count($formList); $i++){
                if(!empty($_POST[$formList[$i]])){
                    ${$formList[$i]} = $_POST[$formList[$i]];
                    //VERIFY DATA TYPES
                    if(varCheck(${$formList[$i]},$fValType[$i]) == true){
                        array_push($sqlList, $formList[$i]);
                        array_push($sqlValues, ${$formList[$i]});
                    }
                    else{
                        array_push($alertlist,$formList[$i]);
                    }
                }
                else{
                    array_push($alertlist,$formList[$i]);
                }
            }
            //CHECK FOR PROBELM FIELDS
            if(count($alertlist) > 0){
                $alertstr = "The following fields do no contain the appropriate data:\n";
                for($i = 0; $i < count($alertlist); $i++){
                    $alertstr = $alertstr.$alertlist[$i]."\n";
                }                
                echo "<Script type=\"text/javascript\">alert(".json_encode($alertstr).");</Script>";
                echo "Failed to add module.";
            }
            else{
                //Validation Notification
                $valStr = "The following data has been Validated:\nDATE\nSTRING Values\nFLOAT Values\nINT Values\n";
                echo "<Script type=\"text/javascript\">alert(".json_encode($valStr).");</Script>";

                //Push to database
                if(count($formList) == count($sqlList) && count($sqlList) == count($sqlValues)){
                    $sqlList = strtoupper(implode(",",$sqlList));
                    $sqlValues = "'". implode("','",$sqlValues) ."'";
                    $sqlinj = "INSERT INTO PRODUCT(".$sqlList.") VALUES (".$sqlValues.")";
                    if(mysqli_query($mysqli,$sqlinj)){
                        echo "Module Added";
                    }
                    else{
                        echo "Failed to add module.";
                    }
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