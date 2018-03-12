<?php 
// полученные данные
header('Content-type: application/json');

$str_json = file_get_contents('php://input');

$personData = json_decode($str_json, true); // decoding received JSON to array

//var_dump($personData);

$con = mysqli_connect('localhost', "root", "1111", "testDB");
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

if($personData["mode"] == "register") 
{ 
    $strSQL="SELECT * FROM person WHERE email='".$personData["email_user"]."'"; 
    if (!$result = mysqli_query($con,$strSQL)) {
        die('Could not execute query: ' .mysqli_error($con));
	}    
	if($row=mysqli_fetch_array($result))  
	{ 
		$personData["name_user"] = $row["name_pers"]; 
		$personData["email_user"] = $row["email"]; 
		$personData["state_user"] = $row["id_state"]; 
		$personData["city_user"] = $row["id_city"]; 		
		$personData["district_user"] = $row["id_distr"]; 		
		$personData["mode"] = "exist"; 
		
     } 
	else 
	{ 
		$strSQL="INSERT INTO person  
         (name_pers, email, id_state, id_city, id_distr)   
         VALUES('".$personData["name_user"]."','".$personData["email_user"]."','".$personData["state_user"]."','".$personData["city_user"]."','".$personData["district_user"]."')"; 
		if (!$result = mysqli_query($con,$strSQL)) {
			die('Could not execute query: ' .mysqli_error($con));
		}
	} 

 } 
mysqli_close($con); 

echo json_encode($personData);
?>


