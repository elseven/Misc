<?php
require_once 'php-sdk/facebook.php';
require_once 'constants.php';
require_once 'identify_user_type.php';
require_once 'sql_queries.php';


$facebook = new Facebook(array(
'appId' => '802007503148785',
'secret' => 'de14f2547cc3eab99e800d5054120fce'
));

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8" />
	
	<title>Home</title>

	<!-- Media Query 1 -->
	<link href="css/phone.css" rel="stylesheet" type="text/css" media="only screen and (max-width:480px)" />
	<!-- Media Query 2 -->
	<link href="css/tablet.css" rel="stylesheet" type="text/css" media="only screen and (min-width:481px) and (max-width:768px)" />
	<!-- Media Query 3 -->
	<link href="css/desktop.css" rel="stylesheet" type="text/css" media="only screen and (min-width:769px)" />

</head>


<body>

<?php

$user = $facebook->getUser();//get user from facebook object
$user_id = 0;

if ($user): //check for existing user id

	$user_graph = $facebook->api('/me/');

	//$get_id_string = 'me/?fields=id';
	//$user_id_graph = $facebook->api($get_id_string);

	$user_id = $user_graph['id'];
	$stuff = getUserInfo($user_id);

	connect();




	$user_travel_type_path = 'me/?fields=photos.fields(place),favorite_athletes,favorite_teams,religion,education,languages,political,books,television,music,movies,games,likes';
	$travel_type_graph = $facebook->api($user_travel_type_path);

	$user_profile = new User($travel_type_graph, $user_type);

	echo '<div class="home_container">';
	echo '<img src=http://utopia.mynmi.net/test/images/logo_app.png>';
	echo '<h1>Hello, ',$user_graph['first_name'],'. Your travel type is ',$user_profile->get_type_as_string(), '.</h1>';

	echo '<h2>Select a region below to narrow your travel search:</h2>';

generate_region_buttons($user_profile->user_type);

	echo
	'<div id="logout_container">
		<a href="logout.php">
			<div id="logout">
				log out
			</div>
		</a>
	</div>';//print logout link

else: //user doesn't exist
	$loginUrl = $facebook->getLoginUrl(array(
		'diplay'=>'popup',
		'scope'=>'email, friends_likes',
		'redirect_uri' => 'http://utopia.mynmi.net/test/'
	));
	echo '<div class="notes">';
	echo '<p>In order for us to determine your travel type, please <a href="', $loginUrl, '" target="_top">login</a>.</p>';
	echo '</div>';
endif; //check for user id

function generate_region_buttons($user_type){
	global $user_id;
	$user_type_url = "&user_type=".$user_type."&user_id=".$user_id;

	echo "<div class='region_button_container'>

	<a href='http://utopia.mynmi.net/test/location_template.php?region=".WEST.$user_type_url."'>
	<div class='West'>
		West
	</div>
	</a>

	<a href='http://utopia.mynmi.net/test/location_template.php?region=".MIDWEST.$user_type_url."'>
		<div class='Midwest'>
			Midwest
		</div>
	</a>

	<a href='http://utopia.mynmi.net/test/location_template.php?region=".NORTHEAST.$user_type_url."'>
		<div class='Northeast'>
			Northeast
		</div>
	</a>

	<a href='http://utopia.mynmi.net/test/location_template.php?region=".SOUTHEAST.$user_type_url."'>
		<div class='Southeast'>
			Southeast
		</div>
	</a>
	</div>";
}

echo '</div>';

?>



</body>
</html>
