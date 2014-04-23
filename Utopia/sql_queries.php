<?php
//SQL QUERIES
$connection = null;
$db_select = null;
$user_id = null;



if(isset($_POST['actionStruct']) && !empty($_POST['actionStruct'])){


		$actionStruct = $_POST['actionStruct'];
		$action = explode("~",$actionStruct)[0];
	    $locationName = split("~",$actionStruct)[1];
	    $id = split("~",$actionStruct)[2];

	    switch($action) {
	        case 'addUserLocation' : addUserLocation($id,$locationName);break;
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



function getUserInfo($user_id){
	global $connection;
	connect();
	$_POST['user_id']=$user_id;
	echo "<br>getUserInfo thinks fbid is $user_id <br>";
	$getInfoQuery = "SELECT * FROM user WHERE id='$user_id'";
	echo $getInfoQuery;

	$result=null;
	if (!($result=mysql_query($getInfoQuery,$connection)))
	{  
		echo "BAD SQL IN (SELECT * FROM) IN getUserInfo>";
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { 
		echo "SELECT OK<br>";
		if($result){
			echo "getUserInfo RESULT NOT NULL<br>";

			while ($row = mysql_fetch_assoc($result)) {
				echo "hi:";
		  		echo $row['id'];
			}
		}else{
			echo "RESULT IS NULL!!!";
		}

	} 


	if(mysql_num_rows($result)==0){
		echo "<br>$user_id NOT IN THE SYSTEM<br>";
		$result = null;
		$result = createNewUser($user_id);
	}else{
		echo "A L R E A D Y - E X I S T S";
		$test_id = $user_id;
		echo "test id is : $test_id";
	}

	while ($row = mysql_fetch_assoc($result)) {
	   echo "id is: ".$row['id'];
	}

}

function createNewUser($user_id){
	global $connection,$test_id;
	connect();
	$test_id = $user_id;

	echo "<br>createNewUser thinks fbid is $user_id <br>";
	$newUserQuery = "INSERT INTO user (id) 
					VALUES('$user_id');";

	echo $newUserQuery;
	if (!($result=mysql_query($newUserQuery,$connection)))
	{  
		echo "<br>COULDN'T ADD USER $user_id <br/><br/>";  
		die('BAD SQL ADDING USER: ' . mysql_error()); 
	}  //gives information about the error
	else { echo " It worked!";}  //this one should be obvious :-)


	$getInfoQuery = "SELECT * from user WHERE id=$user_id";

	$result=null;
	if (!($result=mysql_query($getInfoQuery,$connection)))
	{  
		echo "COULDN'T GET STUFF AFTER INSERTING <br/><br/>";  //if failure, “this didn’t work”
		die('SQL ERROR AT THIS ONE PLACE: ' . mysql_error()); 
	}  //gives information about the error
	else { echo "YAY! It worked!";}  //this one should be obvious :-)

	return $result;
}




function addUserLocation($id,$loc_name){
	global $connection;
	connect();
	$newUserLocQuery = "INSERT INTO user_location (user_id,location_name) 
					VALUES('$id','$loc_name')";


	$result = null;
	if (!($result=mysql_query($newUserLocQuery,$connection)))
	{  
		echo "COULDN'T ADD USER $id AND $loc_name";  //if failure, “this didn’t work”
		die('Error: ' . mysql_error()); 
	}  //gives information about the error
	else { echo " user location entry added!";}  //this one should be obvious :-)

	
	
}
?>