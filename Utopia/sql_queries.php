<?php
//SQL QUERIES

$connection = null;
$db_select = null;
$user_id = 0;

if(isset($_POST['uid']) && !empty($_POST['uid'])){
	$uid=$_POST['uid'];
}
if(isset($_POST['actionStruct']) && !empty($_POST['actionStruct'])){


		$actionStruct = $_POST['actionStruct'];
		$action = explode("~",$actionStruct)[0];
	    $locationName = split("~",$actionStruct)[1];
	    $uid = split("~",$actionStruct)[2];
	    switch($action) {
	        case 'addUserLocation' : addUserLocation($uid,$locationName);break;
	        case 'blah' : blah();break;
	    }
}








function connect(){
	global $connection,$db_select;
	$connection =mysql_connect("localhost","utopia_database","~.ngd,Q2*eak");
	if (! $connection) {
		die("Database connection failed: ".mysql_error());
	}
	$db_select = mysql_select_db("utopia_db2",$connection);
	if (! $db_select) {
		die("Database connection failed: ".mysql_error());
	}
}

function getUserInfo($fb_id){
	global $connection;
	$getInfoQuery = "SELECT * FROM user WHERE id=$fb_id";

	$result=null;
	if (!($result=mysql_query($getInfoQuery,$connection)))
	{  
		echo "this didn't work <br/><br/>";  //if failure, “this didn’t work”
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { 
		echo "select worked<br>";
		if($result){
			echo "not null<br>";
			$row =  mysql_fetch_assoc($result);
			echo  "test".$row['id'];
			echo "<br>lskfjsldf<br>";

		}else{
			echo "NOT OKAY!";
		}
		while ($row = mysql_fetch_array($result)) {
			var_dump($row);
			echo "hi:";
	   		echo $row['id'];
		}

	} 

	if(mysql_num_rows($result)==0){
		echo "<br>$fb_id not in system<br>";
		$result = createNewUser($fb_id);
	}else{
		echo "already exists";
	}

	while ($row = mysql_fetch_assoc($result)) {
	   echo "id is: ".$row['id'];


	}
}

function createNewUser($fb_id){
	global $connection;
	$newUserQuery = "INSERT INTO user (id) 
					VALUES('$fb_id');";
	if (!($result=mysql_query($newUserQuery,$connection)))
	{  
		echo "COULDN'T ADD USER<br/><br/>";  //if failure, “this didn’t work”
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { echo " It worked!";}  //this one should be obvious :-)


	$getInfoQuery = "SELECT * from user WHERE id=$fb_id";

	$result=null;
	if (!($result=mysql_query($getInfoQuery,$connection)))
	{  
		echo "COULDN'T GET STUFF AFTER INSERTING <br/><br/>";  //if failure, “this didn’t work”
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { echo "YAY! It worked!";}  //this one should be obvious :-)

	return $result;
}


function addUserLocation($uid,$loc_name){
	global $connection;
	connect();

	
	$newUserLocQuery = "INSERT INTO user_location (user_id,location_name) 
					VALUES('$uid','$loc_name')";
	$result = null;
	if (!($result=mysql_query($newUserLocQuery,$connection)))
	{  
		echo "COULDN'T ADD user $uid location $loc_name entry";  //if failure, “this didn’t work”
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { echo " user location entry added!";}  //this one should be obvious :-)
}


//==========================ADDED 4-23=========================//
function getAllLocations(){


	global $connection;
	connect();
	
	//$description = htmlentities($description);
	//$updateLocation = 	"SELECT location.*,FROM location";
	
$query = "SELECT * FROM location";

	$result = null;
	if (!($result=mysql_query($query,$connection)))
	{  
		echo "COULDN'T update";  //if failure, “this didn't work”
		die('Error: ' . mysql_error()); 
	}  



	$name_array = array();
	while ($row = mysql_fetch_assoc($result)) {
		
		$name_array[] = $row['name'];
	}


	$result=null;






	$location_array = array();



	foreach($name_array as $name){





		$query = "SELECT location.*,
			activity.description AS activity_description,
	        picture.url,
	        restaurant.description AS restaurant_description,
		    travel_type.type
			from location
				join picture         
		        	ON picture.location_name=location.name
		        JOIN restaurant
		        	ON restaurant.location_name=location.name
		        JOIN activity
		        	on activity.location_name=location.name
		        join travel_type
		        	on travel_type.location_name=location.name
	        WHERE location.name='$name'";

		$result = null;
		if (!($result=mysql_query($query,$connection)))
		{  
			echo "COULDN'T update";  //if failure, “this didn't work”
			die('Error: ' . mysql_error()); 
		}  


	    $done = false;

	    $more_pics = array();
	    $travel_types = array();
	    $restaurants = array();
	    $activities = array();
		while ($row = mysql_fetch_assoc($result)) {
			if(!$done){
				$name = $row['name'];
				$main_photo = $row['main_picture'];
				$description = $row['description'];
				$region=$row['region'];
				$done=true;
			}
	
			$pic = $row['url'];
			$type = $row['type'];
			$rest = $row['restaurant_description'];
			$act = $row['activity_description'];
			if(!in_array($pic, $more_pics)){
				$more_pics[]=$pic;
			}

			if(!in_array($type, $travel_types)){
				$travel_types[]=$type;
			}

			if(!in_array($rest, $restaurants)){
				$restaurants[]=$rest;
			}

			if(!in_array($act, $activities)){
				$activities[]=$act;
			}

		}//while

		$loc = new Location($name, $description, $main_photo, $activities, $restaurants, $more_pics, $more_pics_thumb, $travel_types, $region);

		$location_array[]=$loc;





		

	}//foreach

	return $location_array;

}



function getListOfMyLocations($user_id){



	global $connection;
	connect();
	

	$query = "SELECT * FROM user_location WHERE user_id='$user_id';";

	$result = null;
	if (!($result=mysql_query($query,$connection)))
	{  
		echo "COULDN'T get my locations";  //if failure, “this didn't work”
		die('Error: ' . mysql_error()); 
	}  



	$name_array = array();
	while ($row = mysql_fetch_assoc($result)) {
		
		$name_array[] = $row['location_name'];
	}

	return $name_array;
}








?>