<!DOCTYPE html> 
<html lang="en"> 
<head> 
<meta charset="utf-8"> 
<title>Test project</title> 
<meta name="description" content="Test Project using PHP MySQL Ajax."> 
  <link rel="stylesheet" href="choosen/docsupport/style.css">
  <link rel="stylesheet" href="choosen/docsupport/prism.css">
  <link rel="stylesheet" href="choosen/chosen.css">
<style type="text/css">
	body {padding-top: 40px; padding-left: 25%}
	select {width:220px;}
	select option {width:220px;}
	input {width:220px;}
	.label_desc{display: block;}
	.error{display: none;}
	.error_disp{display: block; color: red;}
</style>
</head>
<body>
<form  name="test-form" id="test-form" onsubmit="return validateForm()">
<div >
    <label class="label_desc">Name:</label>
    <input type="text" id="name_user" value=""/>
    <br/>
     
    <label class="label_desc">E-mail:</label>
    <input type="email" id="email_user" value=""/> 
    <br/>
     
	<label class="label_desc">State:</label>
	<select name="state_user" id="state_user" class="chosen-select"  onchange="loadCity(this.value)">
		<option value="">Select state:</option>
		<option value="1">Kharkiv state</option>
		<option value="2">Kiev state</option>
		<option value="3">Poltava state</option>		
	</select>
    <br/>
	
	<label class="label_desc">City:</label>
	<select name="city_user" id="city_user" class="chosen-select" onchange="loadDistrict(this.value)">
		<option value="">Select city:</option>		
	</select>
    <br/>
	
	<label class="label_desc">District:</label>
	<select name="district_user" id="district_user" class="chosen-select" >
		<option value="">Select district:</option>		
	</select>
    <br/>
          
	 <label id="user_error" class="error" >Please fill in all the required fields!</label>
	 <br/> 
	 <label id="result_msg"></label>	 
    <br/> 
 </div>
 <div >
     <div >
        <button type="submit" >Submit</button>
     </div>
 </div>
</form>
<script>

function validateForm()
{
	document.getElementById("user_error").className = ("error");	
	var name_user = document.getElementById("name_user").value;
	var email_user = document.getElementById("email_user").value;
	var district_user = document.getElementById("district_user").value;	
	var error_lbl = document.getElementById("user_error");
	if(name_user == "" || email_user == "" || district_user == "") 
	{
		document.getElementById("user_error").className = ("error_disp");
		return false;
	}
	
	loadPerson();
		
	return false;
}

function loadCity(parent) {
 dest = "city_user";
 loadTerritory("2", parent, dest);
}

function loadDistrict(parent) {
 dest = "district_user";
 loadTerritory("3", parent, dest);
}


function loadTerritory(type, parent, dest) {
if (parent == "") { return; }
var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = "type=" + type + "&parent=" + parent;
     xhr.open("POST", "loadoption.php", true); 
     xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");                  
     xhr.send(data);
	 xhr.onreadystatechange = display_data;
	function display_data() {
	 if (xhr.readyState == 4) {
      if (xhr.status == 200) {    
	  document.getElementById(dest).innerHTML = xhr.responseText;	
      } else {
        alert('There was a problem with the request.');
      }
     }
	}
}

function loadPerson() {

var name = document.getElementById("name_user").value;
var email = document.getElementById("email_user").value;
var state = document.getElementById("state_user").value;
var city = document.getElementById("city_user").value;
var district = document.getElementById("district_user").value;

var person_data = {
  "name_user": name,
  "email_user": email,
  "state_user": state,
  "city_user": city,
  "district_user": district,
  "mode": "register"
};

var json_data = JSON.stringify(person_data);
var xhr;
 if (window.XMLHttpRequest) { // Mozilla, Safari, ...
    xhr = new XMLHttpRequest();
} else if (window.ActiveXObject) { // IE 8 and older
    xhr = new ActiveXObject("Microsoft.XMLHTTP");
}
var data = json_data;
     xhr.open("POST", "loadperson.php", true); 
     xhr.setRequestHeader("Content-Type", "application/json");                  
     xhr.send(data);
	 xhr.onreadystatechange = display_data;
	function display_data() {
	 if (xhr.readyState == 4) {
      if (xhr.status == 200) {
	  var data_result = JSON.parse(xhr.responseText);
		if (data_result["mode"] != "register")
		{
			document.getElementById("result_msg").innerText = "User with such email already exists!";
			document.getElementById("name_user").value = data_result["name_user"];
			document.getElementById("email_user").value = data_result["email_user"];
			document.getElementById("state_user").value = data_result["state_user"];
			loadCity(data_result["state_user"]);
			setCity(data_result["city_user"]);
			loadDistrict(data_result["city_user"]);
			setDistrict(data_result["district_user"]);

		}
		else
			document.getElementById("result_msg").innerText = "User successfully registered!";			
		} else {
        alert('There was a problem with the request.');
      }
     }
	}
}

function setCity(value) {
 var dest = "city_user";
 setSelectOption(value, dest);
}

function setDistrict(value) {
 var dest = "district_user";
 setSelectOption(value, dest);
}

function setSelectOption(val, dest){
var destSelectObj = document.getElementById(dest);
for (var i = 0; i < destSelectObj.length; i++) 
    if (destSelectObj[i].value == val) destSelectObj[i].selected = true;
}

function cancelBubble() {
 var evt = window.event;
 if (evt.stopPropagation) {
    evt.stopPropagation();
 }
 if (evt.cancelBubble!=null) {
    evt.cancelBubble = true;
 }
}

</script>
</body>
</html>

