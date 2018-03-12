<?php
$type=isset($_POST["type"])?$_POST["type"] : "" ; 
$parent=isset($_POST["parent"])?$_POST["parent"] : "" ; 
 
$terr_msg = "";
 
switch ($type) {
    case "1":
        $terr_msg = "state";
        break;
    case "2":
        $terr_msg = "city";
        break;
    case "3":
        $terr_msg = "district";
        break;
    default:
        $terr_msg = "state";
} 
 
 
echo " <option value=''>Select ".$terr_msg.":</option> ";
 
$con = mysqli_connect('localhost', "root", "1111", "testDB");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if ($parent == ""){
	$strSQL="SELECT id_terr, name_terr FROM territory  WHERE type_terr='".$type."' AND id_parent_terr IS NULL"; }
else {
	$strSQL="SELECT id_terr, name_terr FROM territory  WHERE type_terr='".$type."' AND id_parent_terr='".$parent."'"; }

if (!$result = mysqli_query($con,$strSQL)) {
        die('Could not execute query: ' .mysqli_error($con));
 }
	
while($row = mysqli_fetch_array($result)) {
   echo "<option value='".$row['id_terr']."'>".$row['name_terr']."</option>";
}
mysqli_close($con);
?>