<?php
require_once 'php-sdk/facebook.php';
require_once 'constants.php';
require_once 'identify_user_type.php';



$facebook = new Facebook(array(
'appId' => '802007503148785',
'secret' => 'de14f2547cc3eab99e800d5054120fce'
));

?>

<!DOCTYPE html>
<html lang="en">
<head>

	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<meta charset="utf-8" />

	<!-- bootstrap -->
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/custom.css" rel="stylesheet">
    <link rel="stylesheet" href="stately-master/assets/css/stately.css">
    <script src="bootstrap/js/respond.js"></script>

	<title>Home</title>

</head>


<body>

<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=802007503148785";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<?php

echo '
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
                    <li class="active"><a href="http://utopia.mynmi.net/app_bootstrap"><span class="glyphicon glyphicon-home"></span> Home</a></li>
                    <li><a href="http://utopia.mynmi.net/app_bootstrap/profile.php"><span class="glyphicon glyphicon-user"></span> My Profile</a></li>
                    <li><a href="#"><span class="glyphicon glyphicon-globe"></span> See All Locations</a></li>
                </ul> 
            </div>
         </nav> 
    </div>';

$user = $facebook->getUser();//get user from facebook object


if ($user): //check for existing user id
		
	$body_bg = e6f0df;

	$user_graph = $facebook->api('/me/');
	$user_travel_type_path = 'me/?fields=photos.fields(place),favorite_athletes.limit(1000),favorite_teams.limit(1000),religion.limit(1000),education.limit(1000),languages.limit(1000),political.limit(1000),books.limit(1000),television.limit(1000),music.limit(1000),movies.genre,movies.limit(1000),games.limit(1000),likes.limit(10000)';
	//$user_graph = $facebook->api('/v2.0/me/');
	//$user_travel_type_path = 'v2.0/me/?fields=photos.fields(place),tagged_places.limit(100),favorite_athletes.limit(1000),favorite_teams.limit(1000),religion.limit(1000),education.limit(1000),languages.limit(1000),political.limit(1000),books.limit(1000),television.limit(1000),music.limit(1000),movies.genre,movies.limit(1000),games.limit(1000),likes.limit(10000)';

	$travel_type_graph = $facebook->api($user_travel_type_path);

	$user_profile = new User($travel_type_graph, $user_type);

	echo '<div class="container">';
	echo '<div class="row">
			<center><h2>Hello, ',$user_graph['first_name'],'. Your travel type is <u>',$user_profile->get_type_as_string(), '</u>.</h2></center>
		  </div>';
	echo '<div class="row">
				<center><div class="logo"></div></center>
		</div>';
	echo '<div class="row">
			<center><h4>Select a region below to narrow your travel search:</h4></center>
		</div>';

generate_region_buttons($user_profile->user_type);

	echo
	'<div class="row">
			<center>
				<a href="logout.php">
					<div class="btn btn-lg btn-logout">
						log out
					</div>
				</a>
			</center>
		</a>
	</div>';//print logout link

else: //user doesn't exist

	$body_bg = e6f0df;

	$loginUrl = $facebook->getLoginUrl(array(
		'diplay'=>'popup',
		'scope'=>'basic_info, user_about_me, user_likes',
		'redirect_uri' => 'http://utopia.mynmi.net/app_bootstrap/'
	));
	echo '<div class="container" id="login_container">
			<div class="row">
				<div class="col-xs-8 col-xs-offset-2" id="login">
					<center>
						<p><h3>In order for us to determine your travel type, please:</h3>
							<br>
							<a href="', $loginUrl, '" target="_top">
								<div class="btn btn-lg btn-default">
									<strong>login</strong>
								</div>
							</a>
						</p>
					</center>
				</div>
			</div>
		</div>';
endif; //check for user id

function generate_region_buttons($user_type){

	$user_type_url = "&user_type=".$user_type;

	echo "<div class='row'>
			<ul id='plain' class='stately'> 
			    <li data-state='al' class='al'>A</li>
			    <li data-state='ak' class='ak'>B</li>
			    <li data-state='ar' class='ar'>C</li>						
			    <li data-state='az' class='az'>D</li>
			    <li data-state='ca' class='ca'>E</li>
			    <li data-state='co' class='co'>F</li>
			    <li data-state='ct' class='ct'>G</li>
			    <li data-state='de' class='de'>H</li>
			    <li data-state='dc' class='dc'>I</li>
			    <li data-state='fl' class='fl'>J</li>
			    <li data-state='ga' class='ga'>K</li>
			    <li data-state='hi' class='hi'>L</li>
			    <li data-state='id' class='id'>M</li>
			    <li data-state='il' class='il'>N</li>
			    <li data-state='in' class='in'>O</li>
			    <li data-state='ia' class='ia'>P</li>
			    <li data-state='ks' class='ks'>Q</li>
			    <li data-state='ky' class='ky'>R</li>
			    <li data-state='la' class='la'>S</li>
			    <li data-state='me' class='me'>T</li>
			    <li data-state='md' class='md'>U</li>
			    <li data-state='ma' class='ma'>V</li>
			    <li data-state='mi' class='mi'>W</li>
			    <li data-state='mn' class='mn'>X</li>
			    <li data-state='ms' class='ms'>Y</li>
			    <li data-state='mo' class='mo'>Z</li>
			    <li data-state='mt' class='mt'>a</li>
			    <li data-state='ne' class='ne'>b</li>
			    <li data-state='nv' class='nv'>c</li>
			    <li data-state='nh' class='nh'>d</li>
			    <li data-state='nj' class='nj'>e</li>
			    <li data-state='nm' class='nm'>f</li>
			    <li data-state='ny' class='ny'>g</li>
			    <li data-state='nc' class='nc'>h</li>
			    <li data-state='nd' class='nd'>i</li>
			    <li data-state='oh' class='oh'>j</li>			
			    <li data-state='ok' class='ok'>k</li>
			    <li data-state='or' class='or'>l</li>
			    <li data-state='pa' class='pa'>m</li>
			    <li data-state='ri' class='ri'>n</li>
			    <li data-state='sc' class='sc'>o</li>
			    <li data-state='sd' class='sd'>p</li>
			    <li data-state='tn' class='tn'>q</li>
			    <li data-state='tx' class='tx'>r</li>
			    <li data-state='ut' class='ut'>s</li>
			    <li data-state='va' class='va'>t</li>
			    <li data-state='vt' class='vt'>u</li>			
			    <li data-state='wa' class='wa'>v</li>
			    <li data-state='wv' class='wv'>w</li>
			    <li data-state='wi' class='wi'>x</li>
			    <li data-state='wy' class='wy'>y</li>
			</ul>
		</div>
		<div class='row'>
			<div class='col-sm-3'>
				<a href='http://utopia.mynmi.net/app_bootstrap/location_template.php?region=".WEST.$user_type_url."'>
				<div class='btn btn-lg btn-block' id='west_button'>
					West
				</div>
				</a>
			</div>

			<div class='col-sm-3'>
				<a href='http://utopia.mynmi.net/app_bootstrap/location_template.php?region=".MIDWEST.$user_type_url."'>
					<div class='btn btn-lg btn-block' id='mw_button'>
						Midwest
					</div>
				</a>
			</div>

			<div class='col-sm-3'>
				<a href='http://utopia.mynmi.net/app_bootstrap/location_template.php?region=".NORTHEAST.$user_type_url."'>
					<div class='btn btn-lg btn-block' id='ne_button'>
						Northeast
					</div>
				</a>
			</div>

			<div class='col-sm-3'>
				<a href='http://utopia.mynmi.net/app_bootstrap/location_template.php?region=".SOUTHEAST.$user_type_url."'>
					<div class='btn btn-lg btn-block' id='se_button'>
						Southeast
					</div>
				</a>
			</div>
		</div>

		
			";
}

echo '</div>';

?>

<script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script>

		$(function() {
		     $('#west_button').hover(
		         function () {
		            $('.stately').attr('id', 'west');         
		         }
		    );
		});

		$(function() {
		     $('#mw_button').hover(
		         function () {
		            $('.stately').attr('id', 'midwest');         
		         }
		    );
		});
		
		$(function() {
		     $('#ne_button').hover(
		         function () {
		            $('.stately').attr('id', 'northeast');         
		         }
		    );
		});
		
		$(function() {
		     $('#se_button').hover(
		         function () {
		            $('.stately').attr('id', 'southeast');         
		         }
		    );
		});

		</script>

</body>
</html>
