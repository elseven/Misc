<?php

require_once 'constants.php';
require_once 'location_class.php';




$location_array = array();
$user_id = $_GET['user_id'];
$location_array = getAllLocations();
$index=0;
$thumb_index=0;
$pic_index=0;
$my_locations = getListOfMyLocations($user_id);


$colIndex=0;

$matching_locations = null;
foreach ($location_array as $loc) {
	if(in_array($loc->name,$my_locations)){
		$matching_locations[] = $loc;
	}
	
}

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
	                    <li  class="active"><a href="http://utopia.mynmi.net/app/profile.php?user_id='.$user_id.'"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
	                    <li><a href="http://utopia.mynmi.net/app/see_all_locations.php?user_id='.$user_id.'"><span class="glyphicon glyphicon-globe"></span> See All Locations</a></li>
	                </ul> 
	            </div>
	         </nav> 
	    </div>
	    <div class="row">
	            <center>
	            	<h2>
	            		Here are all of the locations you have saved:
	            	</h2>
	            </center>
	    </div>
	 ';

echo '</div>';


echo '<div class="container">';

foreach($matching_locations as $loc){

			if($colIndex%3==0){
				echo '<div class="row">';
				
			}

			echo '<div class="col-lg-4 col-md-6">
				'.$loc->display_matching_places($index++,$user_id).'
			  </div>';

			  

			if($colIndex%3==2 || $colIndex == sizeof($matching_locations)-1){
				echo '</div>';

			}  

			$colIndex++;
}

echo '</div>';

?>