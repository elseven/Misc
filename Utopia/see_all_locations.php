<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Location</title>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js">
</script>

</head>

<?php
require_once 'constants.php';
require_once 'location_class.php';





$location_array = array();
$target_region = $_GET['region'];
$user_type = $_GET['user_type'];
$user_id = $_GET['user_id'];

$location_array = getAllLocations();
$index=0;
$thumb_index=0;
$pic_index=0;

$colIndex=0;

$matching_locations = null;


echo '<div class="container-fluid">
		<div class="row">
	    	<nav class="navbar navbar-default navbar-fixed-top">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#collapse">
	                  <span class="sr-only">Toggle navigation</span>
	                  <span class="glyphicon glyphicon-arrow-down"></span>
	                  MENU
	                </button>
	            </div>
	            <div class="collapse navbar-collapse" id="collapse">
	                <ul class="nav navbar-nav">
	                    <li><a href="http://utopia.mynmi.net/app"><span class="glyphicon glyphicon-home"></span> Home</a></li>
	                    <li><a href="http://utopia.mynmi.net/app/profile.php?user_id='.$user_id.'"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
	                    <li class="active"><a href="#"><span class="glyphicon glyphicon-globe"></span> See All Locations</a></li>
	                </ul> 
	            </div>
	         </nav> 
	    </div>
	 ';

echo '</div>';


echo '<div class="container">';

foreach($location_array as $loc){

			if($colIndex%3==0){
				echo '<div class="row">';
				
			}

			echo '<div class="col-lg-4 col-md-6">
				'.$loc->display_matching_places($index++,$user_id).'
			  </div>';

			  

			if($colIndex%3==2 || $colIndex == sizeof($location_array)-1){
				echo '</div>';

			}  

			$colIndex++;
}

echo '</div>';





?>

<body>
</body>
</html>