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

/*====================================================================================================================================
======================================================================================================================================
=============================================================WEST LOCATIONS===========================================================
======================================================================================================================================
======================================================================================================================================*/


/*--------------------------------------------------------------------------
-------------------------------Seattle, WA--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/seattle.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/seattle_1.jpg';

$location_activities = array("<strong>Seattle Aquarium:</strong> come visit the fun and exciting hands-on experience at the 
	Seattle Aquarium located on the beautiful Puget Sound", 
	"<strong>Mount Rainier National Park:</strong> located about an hour and half outside of Seattle is Mount Rainier National Park 
	where you can enjoy hiking among the beautiful terrain of the Northwest",
	"<strong>Space Needle:</strong> visit the 520ft tall Seattle Space Needle to catch a glimpse of the city, 
	the Puget Sound and surrounding landscape");

$location_restaurants = array("<strong>Altura:</strong> enjoy a delicious Italian fine dining experience at Altura, 
	take that special someone on a date or visit for a celebration dinner",
	"<strong>Bakery Nouveau:</strong> with all the rain and chill in Seattle, bakeries and coffee spots are a frequent 
	occurrence in this city. One that stands above the rest is Bakery Nouveau. 
	Come in for a delicious pastry and cup of coffee, or try one of the homemade pizzas");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/seattle_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/seattle_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/seattle_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Seattle, WA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------San Francisco, CA--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/sf.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/sf_1.jpg';

$location_activities = array("<strong>Alcatraz:</strong> take a ferry ride to the infamous Alcatraz prison in the 
	middle of San Francisco Bay and tour the facilities", 
	"<strong>Fisherman’s Wharf:</strong> visit the Fisherman’s Wharf located right on the San Francisco Bay and enjoy some fresh 
	seafood and local vendors",
	"<strong>Redwoods National Forest:</strong> drive across the Golden Gate Bridge to Redwoods National Forest for a 
	hike and to see the huge, glorious Redwoods");

$location_restaurants = array("<strong>Kokkari Estiatorio:</strong> enjoy a delicious and authentic Mediterranean meal and ambiance at 
	Kokkari Estiatorio, located in the Financial District near Chinatown",
	"<strong>Sotto Mare Oysteria & Seafood:</strong> grab some oysters on the half shell or clam chowder at Sotto Oysteria & 
	Seafood and enjoy the nice weather on patio",
	"<strong>Ike’s Place:</strong> if you’re looking to grab something thats a little more casual, stop into Ike’s Place for a deli sandwich");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/sf_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/sf_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/sf_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("San Francisco, CA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Jackson, WY--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/jackson.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/jackson_1.jpg';

$location_activities = array("<strong>Natural Museum of Wildlife Art:</strong> From the outside, this museum looks like a natural rock outcropping; 
	inside this building lies some of the world's finest wildlife art.", 
	"<strong>Jenny Lake:</strong> located in Grand Teton National Park, Jenny Lake supplies a stunning view of the Teton Range and 
	is a great place to relax by the crystal clear water",
	"<strong>Jackson Hole Mountain Resort:</strong> come to Jackson Hole during the cold months and enjoy one of the most iconic ski 
	resort in North America");

$location_restaurants = array("<strong>The Bird:</strong> grab a juicy burger, some hot fries and cold beer at Jackson Hole’s number one burger joint",
	"<strong>Persephone Bakery:</strong> stop into Persephone Bakery to get a pastry and some coffee before heading out for the day to ski or hike",
	"<strong>Bar J Chuckwagon Suppers:</strong> a great bar-b-q joint to bring the kids to or meet up with a big group and 
	eat some steak and potatoes");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/jackson_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/jackson_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/jackson_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Jackson, WY", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Portland, OR--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/portland.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/portland_1.jpg';

$location_activities = array("<strong>Forest Park:</strong> visit the largest urban park in the country and enjoy strolling along an 
	assortment of unique trails with lovely views", 
	"<strong>Living Room Theatre:</strong> located downtown, this very cool, small theatre/restaurant has a tapas bar and intimate 
	theatre that shows indie and foreign films, a place for a date or a hang out spot",
	"<strong>International Rose Test Garden:</strong> have a picnic in the beautiful International Rose Test Gardens, admission is free and 
	on a nice day you can catch a glimpse of Mt. Hood in the distance");

$location_restaurants = array("<strong>The Waffle Window:</strong> one of Portland’s funky food trucks that serves up an eclectic take on waffles",
	"<strong>Veritable Quandary:</strong> beautiful restaurant with big windows to let in the sunlight, delicious American cuisine 
	with Vegetarian options as well, and a very accommodating staff",
	"<strong>The Grilled Cheese Grill:</strong> this joint has a cool, hip atmosphere with its heavily tattooed staff who serve a 
	unique variety of grilled cheese sandwiches and burgers");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/portland_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/portland_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/portland_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Portland, OR", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Monterey, CA--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/monterey.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/monterey_1.jpg';

$location_activities = array("<strong>Vista Blue Spa:</strong> overlooking the tranquil Monterey Bay, Vista Blue Spa offers many relaxing massages, 
	facials, body wraps and signature treatments to rejuvenate the body and mind while experiencing incredible views of the bay", 
	"<strong>Wine Trolley Tours:</strong> the Wine Trolley Tours take their guests through the lovely Carmel Valley to a multitude of vineyards 
	to experience the beauty of the valley and do various wine tastings");

$location_restaurants = array("<strong>Loulou’s Griddle in the MIddle:</strong> Loulou’s is a tiny diner located on Monterey’s Wharf 2, 
	where you can watch the chefs prepare the food with a lot of heart and soul right in front of you, visit this historical 
	restaurant opened in 1948",
	"<strong>Montrio Bistro:</strong> a bistro whose fusion of French, Italian, and American food provides a lot of variety and a 
	casual and comfortable dining experience ");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/monterey_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/monterey_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/monterey_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Monterey, CA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
---------------------------------Sedona, AZ---------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/sedona.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/sedona_1.jpg';

$location_activities = array("<strong>Sedona Star Gazing:</strong> professional astronomers offer guests a breath-taking opportunity to sit 
	under the stars on chairs and blankets and learn about the constellations at a designated observation location", 
	"<strong>Amitabha Stupa & Peace Park:</strong> sitting majestically among the pinion and juniper pines, and surrounded by a landscape of 
	stunning crimson spires, Amitabha Stupa & Peace Park is the perfect place in Sedona to relax and enjoy meditation and healing");

$location_restaurants = array("<strong>Dahl & DiLuca:</strong> an Italian restaurant that offers great seafood dishes, outdoor seating and 
	delicious desserts, with a helpful and testroachable staff, this is a good place to enjoy a relaxing meal",
	"<strong>Wildflower Bread Company:</strong> a quaint deli and bakery with tasty and affordable cuisine thats perfect for a midday 
	snack or meal on a warm Sedona day");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/sedona_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/sedona_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/sedona_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Sedona, AZ", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;


/*--------------------------------------------------------------------------
-------------------------------Lake Tahoe, CA/NV----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/tahoe.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/tahoe_1.jpg';

$location_activities = array("<strong>Tahoe City Treetop Adventure Park:</strong> The Tahoe Treetop Adventure Park is the first aerial adventure 
	park in California and only one in the Tahoe basin, consisting of 70 tree platforms, 50+ bridges, and 15 zip lines, this park offers courses 
	for kids, adults and team building", 
	"<strong>The Gondola at Heavenly:</strong> Hop aboard an 8-passenger glass cabin and be whisked 2.4 miles up the side of a mountain for 
	breathtaking views of Lake Tahoe and the Sierra Nevada mountain range");

$location_restaurants = array("<strong>Driftwood Cafe:</strong> a great spot for brunch, lunch or dinner and to bring the kids, 
	Driftwood Cafe serves a variety of American cuisine that will suit any diner",
	"<strong>Rustic Lounge at Cedar Glen Lodge:</strong> American cuisine with a unique twist, the Rustic Lounge at Cedar Glen Lodge has a 
	warm and cozy ambiance, very welcoming staff, and is the perfect way to end a long day of hiking or skiing, depending on the month");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/tahoe_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/tahoe_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/tahoe_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Lake Tahoe, CA/NV", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
--------------------------------Napa Valley, CA-----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/napa.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/napa_1.jpg';

$location_activities = array("<strong>Alston Park:</strong> this lovely park is perfect to visit during any season, the various trails provide 
	panoramic views from the hills, and an off leash dog play area is great if you have pets", 
	"<strong>Napa Valley Opera House:</strong> The Napa Valley Opera House is a non-profit performing arts organization located in the heart 
	of downtown Napa and is a national historic landmark originally constructed in 1879, today its eclectic array of performing arts includes 
	theatre, dance, comedy, jazz, blues and world dance");

$location_restaurants = array("<strong>Market:</strong> quaint restaurant located downtown on main street with unique seafood dishes 
	and an excellent wine list with wines from various Napa Vineyards",
	"<strong>Tra Vigne:</strong> this restaurant has a beautiful location, making guests feel like they’re dining in a Tuscan village, 
	the food is comprised of Italian cuisine with some Californian twists");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/napa_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/napa_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/napa_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Napa Valley, CA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
--------------------------------Astoria, OR-----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/astoria.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/west/astoria_1.jpg';

$location_activities = array("<strong>The Lewis and Clark National and State Historical Parks:</strong> this historical site and museum is the 
	perfect stop for any history buff or nature lover; its trails take you along the same path that Lewis and Clark traveled along the Oregon 
	coast and also has an exact replica of their winter quarters", 
	"<strong>Astoria Riverfront Trolley:</strong> one of Astoria’s most popular and exciting attractions; 
	the conductors are local volunteers who receive training and certification and are great 'ambassadors' 
	for the city, they are very knowledgeable about Astoria's history and make every ride an interesting experience");

$location_restaurants = array("<strong>Bowpicker Fish & Chips:</strong> located on a tiny boat, this restaurant is a eclectic hole-in-the-wall 
	place that serves fresh, local seafood and makes it diners feel welcomed like family",
	"<strong>Blue Scorcher Bakery Cafe:</strong> a beautiful, warehouse converted into a restaurant that caters to families, has an interesting 
	staff and has lots of flyers hanging around the restaurant with information on cool, local things to partake in around Astoria");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/west/astoria_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/astoria_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/astoria_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/west/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/west/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Astoria, OR", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, WEST);

$location_array[] = $location;

/*====================================================================================================================================
======================================================================================================================================
=============================================================MIDWEST LOCATIONS========================================================
======================================================================================================================================
======================================================================================================================================*/

/*--------------------------------------------------------------------------
-------------------------------Chicago, IL----------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/chicago.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/chicago_1.jpg';

$location_activities = array("<strong>Art Institute of Chicago:</strong> this Classical Renaissance structure, guarded by two bronze lions at 
	its entrance, boasts one of the world's great art collections, including the trademark 'American Gothic', you’ll want to spend the entire 
	day browsing through the Institute’s extensive galleries and collections", 
	"<strong>Wrigley Field:</strong> a great place to visit for sports fans, Wrigley Field is one of the smallest, 
	oldest and most well known ballparks in the country, come catch a game and watch the Chicago Cubs play");

$location_restaurants = array("<strong>Alinea:</strong> this is the perfect spot to treat yourself for a special occasion or to take someone 
	on a date, this high tier restaurant serves some of the best international cuisine in the city, and the unique presentation of the dishes is 
	what keeps its guests coming back",
	"<strong>Do-Rite Donuts:</strong> start your day in Chicago off right with Do-Rite Donuts, where their mouth-watering donut creations 
	will satisfy your testetite, try the maple bacon donut!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/chicago_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/chicago_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/chicago_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Chicago, IL", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Minneapolis, MN------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/minn.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/minn_1.jpg';

$location_activities = array("<strong>Minneapolis Sculpture Garden:</strong> This 11-acre beautiful park showcases more than 40 works from the 
	Walker Art Center’s renowned collection and is one of Minneapolis’s most acclaimed parks", 
	"<strong>Guthrie Theatre:</strong> founded in 1963, is an American center for theater performance, production, education and professional 
	training. By presenting both classical literature and new work from diverse cultures, the Guthrie illuminates the common humanity 
	connecting Minnesota to the peoples of the world");

$location_restaurants = array("<strong>112 Eatery:</strong> an upper scale American cuisine restaurant whose Duck Terrine and Rabbit 
	Pate are hailed as some of their signature dishes, a great place to visit if you’re trying to impress a date",
	"<strong>Pizzeria Lola:</strong> a great late night pizza joint whose wood fire pizza will spark your testetite, and their chocolate 
	chip cookies are returning customers dessert of choice!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/minn_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/minn_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/minn_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Minneapolis, MN", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Traverse City, MI----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/traverse.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/traverse_1.jpg';

$location_activities = array("<strong>Traverse City State Park:</strong> this is a popular park that offers a variety of outdoor 
	activities from swimming and sunbathing to biking and camping", 
	"<strong>Clinch Park:</strong> a beautiful park and marina; enjoy paddle boarding or 
	kayaking on the water, and if you htesten to be there during the fourth of July there are great fire works",
	"<strong>Jacob’s Corn Maze:</strong> a really intricate corn maze set on a little farm outside of Traverse City, very 
	friendly staff and a great way to spend your afternoon ");

$location_restaurants = array("<strong>Georgina’s:</strong> this little Asian and Cuban fusion restaurant located on the edge of 
	Traverse City is known for its Peanut Thai Shrimp and friendly atmosphere",
	"<strong>Chez Peres Cafe Bistrot:</strong> this french bistro has great breakfast and brunch- try the ham, cheese and bechamel crepes and 
	salmon omelet",
	"<strong>Moomers Homemade Ice Cream:</strong> a terrific place to stop in with the kids; 
	Amaretto Cherry Toasted Coconut Pumpkin are listed 
	as some of their best flavors");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/traverse_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/traverse_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/traverse_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Traverse City, MI", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Green Bay, WI--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/gb.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/gb_1.jpg';

$location_activities = array("<strong>Lambeau Field:</strong> experience the true essence of Green Bay and visit Lambeau Field, 
	home of the Green Bay Packers! after undergoing a dramatic facelift in 2003, Lambeau Field has been 
	transformed into to a year-round tourist destination with a host of new amenities and attractions", 
	"<strong>Green Bay Botanical Garden:</strong> open all year, Green Bay Botanical Garden is designed to provide interest with display 
	gardens that capture the beauty of northeastern Wisconsin’s four distinct and wonderful seasons");

$location_restaurants = array("<strong>Plae Bistro:</strong> enjoy the cozy atmosphere of Green Bay’s only neighborhood bistro, grab a long, 
	intimate dinner or a quick lunch, or if you’re with a big group make sure to reserve the Chef’s table, where your menu is completely 
	left up to the Chef",
	"<strong>Titletown Brewing Company:</strong> a big local restaurant with lots of Green Bay pride, history and a great beer selection, 
	perfect for any time of day with fast and friendly service");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/gb_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/gb_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/gb_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Green Bay, WI", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Austin, TX-----------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/austin.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/austin_1.jpg';

$location_activities = array("<strong>Town Lake:</strong> visitors can rent canoes, kayaks, paddle boards or rowboats along this part of 
	Lake Austin that flows five miles through the heart of downtown Austin; also take a walk along the trails and various parks that line 
	the Lake Austin", 
	"<strong>HOPE Outdoor Gallery:</strong> if you enjoy graffiti art, then you’ll love HOPE Outdoor Gallery; as you climb higher up the hill 
	you see more and more art and bring spray paint, because you are allowed to contribute to the murals ");

$location_restaurants = array("<strong>Franklin Barbecue:</strong> a small bar b q joint in the heart of Austin, Texas that serves up some 
	of the best bar bq in the state; you have to show up early, wait in line, and hope they don’t sell out before you get to the counter, 
	but its 100% worth the wait and anticipation",
	"<strong>Hopdoddy:</strong> a great burger joint with an entertaining staff and a varied beer selection and 
	whose outdoor seating is right next to the Congress Street Bridge where you can watch 1.5 million bats fly out from under it at dusk");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/austin_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/austin_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/austin_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Austin, TX", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Denver, CO-----------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/denver.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/denver_1.jpg';

$location_activities = array("<strong>Denver Museum of Nature & Science:</strong> the Denver Museum of Nature & Science is the Rocky Mountain 
	region’s leading resource for informal science education; it offers a variety of exhibitions, programs, and activities that help Museum 
	visitors experience the natural wonders of Colorado, Earth, and the universe", 
	"<strong>The Denver Center for the Performing Arts:</strong> The Denver Center for the Performing Arts is an exhilarating mix of 
	Broadway shows, professional theatre, backstage tours, acting instruction and breathtaking facilities");

$location_restaurants = array("<strong>Tables:</strong> this restaurant is small, but has a great atmosphere as it is a frequented hangout 
	for locals, the service is top notch and their famous for their lamb shank",
	"<strong>Snooze:</strong> a fun, street corner breakfast joint that serves up some of the best omelets in Denver",
	"<strong>Rioja:</strong> with a blend of French, Italian, Mediterranean, and Spanish, you'll find a diverse selection of meals
	Rioja they take great pride in creating the perfect dining experience for guests");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/denver_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/denver_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/denver_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/midwest/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Denver, CO", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Albuquerque, NM------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/al.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/albuquerque_1.jpg';

$location_activities = array("<strong>Balloon Fiesta Park:</strong> watch as 500-800 hot air balloons lift up into the air and fill the 
	sky with their colors, a very cool once in a lifetime sight to behold", 
	"<strong>Elena Gallegos Park:</strong> enjoy a picnic and watch the sunset in this small scenic park, or enjoy a walk on the little foot trails",
	"<strong>Lima Kai Massage:</strong> Enjoy a variety of relaxing massage therapy in a peaceful setting, in downtown Albuquerque");

$location_restaurants = array("<strong>Golden Crown Bakery:</strong> this small, colorful little shack has been serving authentic 
	Mexican breakfast and pastries for years to locals and new visitors alike! try the empanadas",
	"<strong>La Crepe Michel:</strong> seeming a little out of place for a French crepe restaurant in Albuquerque, New Mexico, 
	this quaint bistro won’t distestoint, try the French pate!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/albuquerque_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/albuquerque_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/albuquerque_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Albuquerque, NM", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Black Hills & Badlands, SD-------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/black.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/black_hills_1.jpg';

$location_activities = array("<strong>Custer State Park:</strong> Custer State Park , in the Black Hills of western South Dakota , 
	spans 71,000 acres and is one of the largest state parks in the United States; visitors can experience a variety of outdoor 
	activities: canoeing, paddleboating, Buffalo Safari Jeep Tours, chuck wagon cookouts, fishing, mountain biking, hiking, naturalist 
	programs, camping and rock climbing; more than 186 species live or migrate through the park, and western and eastern species often overlap");

$location_restaurants = array("<strong>Black Hills Burger and Bun Co.:</strong> stop in after a long day of hiking and exploring the various 
	parks and its wilderness and grab a juicy burger, and top it off with their famous custard pie",
	"<strong>Prairie Berry Winery:</strong> wind down after exploring the South Dakota wilderness with fresh, homemade wine and 
	cheese and fruit accompaniment");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/black_hills_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/black_hills_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/black_hills_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Black Hills & Badlands, SD", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Marfa, TX------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/marfa.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/marfa_1.jpg';

$location_activities = array("<strong>Gllider Rides:</strong> get taken into the air by these little glider planes and fly over the 
	beautiful West Texas country", 
	"<strong>Chinati Hot Springs:</strong> visit the Chinati Hot Springs, a perfect place to settle in the warm water and relax",
	"<strong>The Marfa Mystery Lights:</strong> these mysterious dancing lights, some call them “ghost lights” can be seen in the 
	sky over the small town of Marfa at night, a truly breath taking sight to behold!");

$location_restaurants = array("<strong>Food Shark:</strong> an excellent Mediterranean food truck with an extensive menu and 
	that serves some of the best fish tacos you’ll ever have",
	"<strong>Cochineal:</strong> a unique tapas restaurant with a great cocktail bar that keeps Mrfa locals and visitors coming 
	back again and again, perfect for a romantic dinner");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/marfa_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/marfa_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/marfa_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Marfa, TX", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Logan, OH------------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/logan.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/midwest/logan_1.jpg';

$location_activities = array( 
	"<strong>Rock Cave:</strong> small caves that have many openings to explore and to enter at various places; enjoy the 
	beautiful ice formations during the winter time",
	"<strong>Hocking Peaks Adventure Park:</strong> Hocking Peaks Adventure Park has an Aerial Challenge Zip with 16 zip lines and 
	30 challenges, Family/Child Zip, Canopy Tour, Moonlight Zip, Waterfront Zip, Paintball, Ogo Ball, Disc Golf, Guided Ranger Rides,and 
	a Educational Treasure Hunt");

$location_restaurants = array("<strong>Hocking Hills Dining Lodge:</strong> a great lodge with a pool to relax at after hiking and 
	exploring and serves awesome, American style cuisine for breakfast, brunch and lunch",
	"<strong>Millstone Restaurant Smoked BBQ:</strong> a great place for families with children and for big groups who are looking to 
	fill up on a hearty meal of bar-b-q after spending the day out hiking");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/midwest/logan_2.jpg', 
	'http://utopia.mynmi.net/test/pics/midwest/logan_3.jpg',
	'http://utopia.mynmi.net/test/pics/midwest/logan_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Logan, OH", $location_description, $location_img, $location_activities,  $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, MIDWEST);

$location_array[] = $location;


/*====================================================================================================================================
======================================================================================================================================
=============================================================NORTHEAST LOCATIONS======================================================
======================================================================================================================================
======================================================================================================================================*/


/*--------------------------------------------------------------------------
-------------------------------Bar Harbor, ME-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/bar_harbor.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_1.jpg';

$location_activities = array("<strong>Land Bridge to Bar Island:</strong> when the tide is out, take a walk on the land bridge that testears! 
	Pretty walk and fun for everyone to enjoy the phenomenon!", 
	"<strong>Acadia National Park:</strong> find a tour or drive yourself through the park! Beautiful views and nature to explore!", 
	"<strong>Shore Path:</strong> for a flatter adventure, take a walk along the water!");

$location_restaurants = array("<strong>Bar Harbor Lobster Pound:</strong> pick your live lobster right from the tank and enjoy the 
	freshest meal around. Great prices for this hidden treasure!", 
	"<strong>The Thirsty Whale Tavern:</strong> perfect downtown location with amazing food and great prices! Be sure to try the lobster roll!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/bar_harbor_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/bar_harbor_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/dc_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/dc_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/dc_4.jpg');

$location_travel_types = array(ADVENTURE, LEISURE);

$location = new Location("Bar Harbor, ME", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Washington, D.C.-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/dc.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/dc_2.jpg';

$location_activities = array("<em>It’s hard to narrow this down to just 5, but these are some top suggestions!</em>", 
	"Lincoln Memorial and Reflecting Pool<br> -Library of Congress<br> -National Gallery of Art<br> 
	-Smithsonian National Museum of Natural History<br> -Jefferson Memorial<br> -National Mall<br>
	-US Capitol<br> -Washington Monument<br> -The White House");

$location_restaurants = array("<strong>Marcel’s:</strong> one of the best rated restaurants in DC with a very 
	sophisticated atmosphere and culinary experience", 
	"<strong>Founding Farmers:</strong> one of the country’s leading restaurants with farm-inspired American true food and drink in a modern and casual atmosphere. 
	Be wary of long lines at all times!", 
	"<strong>Rasik:</strong> best Indian food in DC!  Make sure to book ahead for reservations!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/dc_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/dc_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/dc_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/dc_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/dc_3.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/dc_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Washington, D.C.", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Newport, RI----------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/newport.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/newport_2.jpg';

$location_activities = array("<strong>The Breakers:</strong> the most impressive mansion museum on 13 acres on land overlooking the water", 
	"<strong>Gansett Cruises:</strong> perfect for a harbor tours, sunset cruises or private charters to other places in Rhode Island", 
	"<strong>10 Mile Mansion Drive:</strong> for a beautiful drive pick up the map to see some of the oldest and largest mansions in 
		the Newport area and learn all about their history!");

$location_restaurants = array("<strong>Restaurant Bouchard:</strong> with beautiful presentations of delicious food and a wonderful atmosphere, 
	its the perfect place to celebrate a special occasion!", 
	"<strong>Corner Cafe:</strong> best breakfast in Rhode Island!", 
	"<strong>Shore Path:</strong> for a flatter adventure, take a walk along the water!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/newport_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/newport_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/newport_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/newport_3.jpg');

$location_travel_types = array(ADVENTURE, LEISURE);

$location = new Location("Newport, RI", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Gettysburg, PA-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/gettysburg.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/gettysburg_3.jpg';

$location_activities = array("<strong>Victorian Photography Studio:</strong> a part of a theme park, you can’t miss dressing up in vintage 
	Civil War costumes and taking old pictures!", 
	"<strong>Gettysburg National Military Park:</strong>  very moving Battlefield and cemetery site", 
	"<strong>10 Mile Mansion Drive:</strong> for a beautiful drive pick up the map to see some of the oldest and largest mansions in 
		the Newport area and learn all about their history!");

$location_restaurants = array("<strong>1863 Restaurant:</strong> great service and food for American style food for this American historic town", 
	"<strong>Garryowen Irish Pub:</strong> American Irish food to fuel the soul.  Be sure to make reservations", 
	"<strong>Mr. G’s Ice Cream:</strong> best local ice cream shop");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/gettysburg_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/gettysburg_2.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/gettysburg_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/gettysburg_2.jpg');

$location_travel_types = array(CULTURE, ADVENTURE);

$location = new Location("Gettysburg, PA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Niagara Falls, NY----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/niagara_falls.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/niagara_1.jpg';

$location_activities = array("<strong>Cave of the Winds:</strong> tour that takes you into caves and along catwalks near the foot of the 
	falls for an up close and wet view of the cascading waters!", 
	"<strong>Niagara Falls State Park:</strong>  historic sites, the Erie Canal as well as boats to take you closer to the falls. A must see.");

$location_restaurants = array("<strong>Donatello’s:</strong> best pizza and wings in a relaxed family atmosphere", 
	"<strong>Frankie’s Donuts:</strong> delicious homemade donuts that will beat any chain donut you’ve ever tried!", 
	"<strong>Cates Steaks & BBQ:</strong> great food right next to the State Park with a fun Western American theme!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/niagara_2.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/niagara_2.jpg');

$location_travel_types = array(CULTURE, ADVENTURE);

$location = new Location("Niagara Falls, NY", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Cleveland, OH--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/cleveland.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/cleveland_3.jpg';

$location_activities = array("<strong>Emerald Necklace:</strong> great park for bike riding, running or just to enjoy for the day!", 
	"<strong>West Side Market:</strong>  historic and beautiful indoor public market with a vibrant restaurant, 
	breweries and other shops around for a fun atmosphere.",
	"<strong>Rock and Roll Hall of Fame and Museum</strong>  For music lovers — an absolute must visit to learn about all the 
	greats of the past in Rock and Roll.");

$location_restaurants = array("<strong>L’Albatros Brasserie & Bar:</strong> delicious French food and fun htesty hour! One of the best 
	spots in town for any occasion!  ", 
	"<strong>Slyman’s Deli:</strong>  great breakfast and sandwich shop known for delicious corned beef!", 
	"<strong>Presti’s Bakery & Cafe:</strong> delicious bakery, breakfast and brunch place with delicious treats for anytime of the day!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/cleveland_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/cleveland_2.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/cleveland_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/cleveland_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/cleveland_2.jpg',
	'http://utopia.mynmi.net/test/pics/northeast/cleveland_4.jpg');

$location_travel_types = array(ENTERTAINMENT);

$location = new Location("Cleveland, OH", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Seaside Heights, NJ--------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/seaside_heights.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/seaside_3.jpg';

$location_activities = array("<strong>Casino Pier and Breakwater Beach Water Park:</strong> Fun for all ages and groups of people looking for 
	a great time.  Casinos, arcades, waterpark and an antique carousel!", 
	"<strong>Boardwalk:</strong>  take long walks along the water and beach and explore all the fun activities, 
	shops and eateries the shore has to offer!");

$location_restaurants = array("<strong>Maruca’s Pizza:</strong> Known for having the best ‘pie’ (pizza) on the boardwalk that 
	is family owned and delicious", 
	"<strong>Bobber’s Family Restaurant:</strong>  great breakfast spot at great prices!", 
	"<strong>Hemingway’s Cafe:</strong> great place for htesty hour fun and great food with friends.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/seaside_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/seaside_2.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/seaside_1.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/seaside_2.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE);

$location = new Location("Seaside Heights, NJ", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Boston, MA-----------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/boston.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/boston_1.jpg';

$location_activities = array("<strong>Boston Symphony Orchestra:</strong> for lovers of music and the symphony, this is a place to visit!", 
	"<strong>Fenway Park:</strong>  can’t leave Boston without catching a Red Sox game!",
	"<strong>Freedom Trail:</strong>  follow the markers along the ground for a great historic walk around Boston",
	"<strong>Waterfront:</strong>  great place for watching the boats and water on a nice day!");

$location_restaurants = array("<strong>Atlantic Fish Company:</strong> best seafood in town with tons of options and great atmosphere.", 
	"<strong>Modern Pastry Shop:</strong>  Known best for their Cannoli, you really cannot go wrong with any dessert you choose!", 
	"<strong>Sams LaGrassa’s:</strong> best sandwich place in town with thick pastrami sandwiches that are sure to melt in your mouth.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/boston_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/boston_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/boston_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/boston_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE);

$location = new Location("Boston, MA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Burlington, VT-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/burlington.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/burlington_1.jpg';

$location_activities = array("<strong>Ben and Jerry’s:</strong> Founding place for the delicious ice cream creators.  
	Visit for a tour and tastings!", 
	"<strong>Flynn Center for the Performing Arts:</strong>  a member of the League of Historic American Theatres and is one of the 
	largest historic performing arts center in the northeast! over 300 events year round with a great jazz festival in early June.",
	"<strong>Waterfront Park:</strong>  beautiful scenery for a day on by the water");

$location_restaurants = array("<strong>Logan’s of Vermont:</strong> This family-operated upscale food market is located in historic 
	waterfront district of Burlington and specializes in diversity of delicious foods for all times of the day!", 
	"<strong>Revolution Kitchen:</strong>  burlington’s only all-vegetarian, vegan friendly and gluten friendly eatery! 
	A great place for fresh new food!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/burlington_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/burlington_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/burlington_2.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/burlington_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE);

$location = new Location("Burlington, VT", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------New Haven, CT--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/new_haven.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/northeast/new_haven_2.jpg';

$location_activities = array("<strong>Yale University:</strong> beautiful historic campus worth walking around!", 
	"<strong>Beinecke Rare Book & Manuscript Library:</strong>  Breathtaking and interesting library full of history and unique finds!",
	"<strong>Long Wharf Theatre:</strong>  great theater that features broadways shows!");

$location_restaurants = array("<strong>Modern Apizza Place:</strong> Delicious pizza spot in all of New Haven with huge family style 
	pizzas made perfect for large groups!", 
	"<strong>Barcelona Wine Bar and Restaurant:</strong>  spanish cuisine known for taps within a sophisticated atmosphere and great service");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/northeast/new_haven.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/new_haven_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/northeast/new_haven.jpg', 
	'http://utopia.mynmi.net/test/pics/northeast/new_haven_3.jpg');

$location_travel_types = array(ADVENTURE, LEISURE);

$location = new Location("New Haven, CT", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, NORTHEAST);

$location_array[] = $location;

/*====================================================================================================================================
======================================================================================================================================
=============================================================SOUTHEAST LOCATIONS======================================================
======================================================================================================================================
======================================================================================================================================*/

/*--------------------------------------------------------------------------
-------------------------------Virginia Beach, VA---------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/virginia_beach.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/virginia_4.jpg';

$location_activities = array("<strong>Military Aviation Museum:</strong> great for aviation lovers and full of fun activities and 
	facts for the whole family!", 
	"<strong>Sandbridge Beach:</strong>  a hidden gem, a little south of Virginia Beach, but worth it if you’re looking for a 
	quieter day on a less crowded beach",
	"<strong>Virginia Beach Boardwalk:</strong>  a staple place to be on a pretty day for anyone in the area, locals and visitors 
	included! From parks to amusement parks to fishing and hanging on the beach, The Boardwalk is the place to be with tons of things to do!");

$location_restaurants = array("<strong>Mannino’s italian Bistro:</strong> for excellent Italian at a great price, you cannot miss out on Mannino’s", 
	"<strong>Firebrew:</strong>  great pub food with a fully stocked bar and a fun time", 
	"<strong>Tautogs Restaurant:</strong> specialising in American style dishes and seafood, this place offers a wider variety of 
	meals at affordable costs and one of the favorite places by locals!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/virginia.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/virginia_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/virginia_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/virginia.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/virginia_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/virginia_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Virginia Beach, VA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Asheville, NC--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/asheville.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/asheville_4.jpg';

$location_activities = array("<strong>Blue Ridge Parkway:</strong> a beautiful 469-mile scenic drive of the Blue Ridge mountains, 
	recommended by anyone who lives in or around this area.  Great to visit in the fall when the leaves change!", 
	"<strong>Biltmore Estate:</strong>  a historic and American treasure of a house and estate that can fill two days of adventure and touring!");

$location_restaurants = array("<strong>Curate:</strong> spanish and mediterranean foods served tapas style for a fun dining experience!", 
	"<strong>Sunny Point Cafe:</strong>  family owned and serving comfort foods all day long that are all made-from-scratch");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/asheville.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/asheville_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/asheville_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/asheville.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/asheville_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/asheville_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Asheville, NC", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------St. Petersburg, FL---------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/st_petersburg.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/st_pete.jpg';

$location_activities = array("<strong>The Dali Museum:</strong> Amazing art museum featuring the largest collection of Dali’s work outside of Spain.  
	Also enjoy the labyrinth garden for a tranquil place to take a break.", 
	"<strong>St. Petersburg Sunken Gardens:</strong>  A botanical paradise in the middle of the city and the oldest living museum of the area at 
	100 years old.  Great place for a stroll and exploring tropical plants!");

$location_restaurants = array("<strong>Mazzaro Coffee & Italian market:</strong> Filled with everything from coffees to fresh deli options and 
	gourmet baked goods, pastas and cheeses, this is a one-of-a-kind place that is one of Tampa Bay’s favorite culinary destination", 
	"<strong>400 Beach Seafood and Tap house:</strong>  a perfect combination of all kinds of dishes served here, specializing in seafood dishes!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/st_pete_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/st_pete_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/st_pete_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/st_pete_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("St. Petersburg, FL", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Blue Ridge, GA-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/blue_ridge.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/blue_ridge_4.jpg';

$location_activities = array("<strong>Mercier Orchards:</strong> Fun and yummy place for the whole family!  Venture through store the 
	stocked with delicious testles of the season as well as many other yummy treats! Now also featuring ciders.", 
	"<strong>Blue Ridge Scenic Railway:</strong> Great trip along the Toccoa River that stops in McCaysville and Copperhill, TN!  
	Round trip lasts 4 hours and is 26 miles in total.");

$location_restaurants = array("<strong>Joes BBQ:</strong> Amazing BBQ located right in downtown with cheap food and friendly service!", 
	"<strong>Harvest on Main:</strong>  A newer restaurant in the area that is filled with deliciously rich new foods and 
	perfect for a special occasion! ");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/blue_ridge.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/blue_ridge_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/blue_ridge_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/blue_ridge.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/blue_ridge_2.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/blue_ridge_3.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Blue Ridge, GA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------New Orleans, LA------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/new_orleans.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/no.jpg';

$location_activities = array("<strong>The National WWII Museum:</strong> This museum focuses on the remembrance and celebration of the 
	American spirit, teamwork courage and sacrifice of the men and women who served.", 
	"<strong>New Orleans City Park:</strong>  one of the largest urban parks in the country and has golf, tennis and horseback riding. ",
	"<strong>Royal Street:</strong>  One of the city’s oldest streets and full of unusual shopping!");

$location_restaurants = array("<strong>Commander’s Palace:</strong> Named Travelers’ Choice 2013 Winner, 
	this palace features a combination of American and cajun style dishes.", 
	"<strong>Avery’s Po-Boys:</strong>  Laid-back funky atmosphere featuring fresh food and is known best for their po-boy’s.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/no_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/no_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/no_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/no_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/no_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/no_4.jpg');

$location_travel_types = array(CULTURE, ENTERTAINMENT, LEISURE, ADVENTURE);

$location = new Location("New Orleans, LA", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Nashville, TN--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/nashville.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/nashville_3.jpg';

$location_activities = array("<strong>Grand Ole Opry:</strong> An American icon and Nashville’s #1 attraction.  
	Known for creating one-of-a-kind entertainment for audiences of all ages and where country music stars and legends love to perform.", 
	"<strong>Parthenon:</strong> Great landmark and park to spend an afternoon relaxing and seeing what the Parthenon would have looked like! 
	It's the only full-size replica in the world!",
	"<strong>Country Music Hall of Fame:</strong>  This free museum highlights the history of country music from the birthplace and 
	roots of the genre to present day fun facts!");

$location_restaurants = array("<strong>Pancake Pantry:</strong> Received a certificate of excellence in 2013 and is known best for obviously, 
	amazing pancakes! Amazing choices and a great place for breakfast all day long.", 
	"<strong>Loveless Cafe:</strong>  Known best for their fried chicken and biscuits this cafe has been around for more than 60 years 
	and is must visit for anyone looking for real southern food in Nashville.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/nashville.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/nashville_2.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/nashville.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/nashville_2.jpg');

$location_travel_types = array(CULTURE, ENTERTAINMENT, LEISURE, ADVENTURE);

$location = new Location("Nashville, TN", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Lexington, KY--------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/lexington.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/lexington_3.jpg';

$location_activities = array("<strong>Kentucky Horse Park:</strong> A Travelers’ Choice 2013 recipient, this place is a specialty park that 
	is a working horse farm but also features an educational theme park! ", 
	"<strong>Wild Turkey Distillery:</strong>  Free for military personnel, and it’s open every day of the week excluding major holidays.  
	One of many great distilleries to visit in KY for old lovers of bourbon or new adventurers.");

$location_restaurants = array("<strong>Bourbon n’ Toulouse:</strong> Cajun & creole inspired dishes that feature vegan and vegetarian 
	options at great prices and located right in downtown Lexington.", 
	"<strong>Gumbo YA YA:</strong>  Another Cajun and creole inspired dishes that feature more seafood meals at great prices and fun atmosphere.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/lexington.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/lexington_2.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/lexington.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/lexington_2.jpg');

$location_travel_types = array(CULTURE, ENTERTAINMENT, LEISURE, ADVENTURE);

$location = new Location("Lexington, KY", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Charleston, SC-------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/charleston.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/charleston_2.jpg';

$location_activities = array("<strong>Charleston Waterfront Park:</strong> A Traveler’s Choice award recipient for 2013 and 
	is the place for spending an afternoon in a beautiful beach front park.", 
	"<strong>Middleton Place:</strong>  18th century rice plantation and national historic landmark that features beautiful waterfront gardens.  
	A great place to spend a leisure afternoon in a historical area.");

$location_restaurants = array("<strong>Halls Chophouse:</strong> Travelers’ Choice Award recipient for 2013 that is the place 
	to go in the area for the best steaks and seafood.", 
	"<strong>Slightly North of Broad:</strong>  A great place for lunch serving American style meals and good prices.");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/charleston.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/charleston_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/charleston_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/charleston.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/charleston_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/charleston_4.jpg');

$location_travel_types = array(CULTURE, ENTERTAINMENT, LEISURE, ADVENTURE);

$location = new Location("Charleston, SC", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Little Rock, AR------------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/little_rock.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/little_rock.jpg';

$location_activities = array("<strong>Central High Museum and Visitor Center:</strong> A place dedicated to understanding the fight for 
	desegregation in Arkansas.", 
	"<strong>William J. Clinton Presidential Library:</strong>  A beautiful and historic library named after the local President that is 
	located on the banks of the Arkansas River.",
	"<strong>Riverfront Park:</strong>  A great place to lounge about or take a casual stroll on this riverfront oasis.");

$location_restaurants = array("<strong>Flying Fish of Little Rock:</strong> Best seafood spot in town with a large assortment of 
	fish to choose from!", 
	"<strong>Whole Hog Cafe:</strong>  Known for amazing barbecue, this cafe prepares award winning recipes from Memphis-in-May World 
	BBQ Championship competition. A great gathering place for groups of friends or just for any meal of the day!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/little_rock_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/little_rock_3.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/little_rock_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/little_rock_3.jpg');

$location_travel_types = array(CULTURE, ENTERTAINMENT, LEISURE, ADVENTURE);

$location = new Location("Little Rock, AR", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;

/*--------------------------------------------------------------------------
-------------------------------Orange Beach, AL-----------------------------
----------------------------------------------------------------------------*/

$location_description = file_get_contents("descriptions/orange_beach.txt", true); 

$location_img = 'http://utopia.mynmi.net/test/pics/southeast/orange.jpg';

$location_activities = array("<strong>Back Country Trail:</strong> Great trails for running, hiking, biking and spending a day in nature.", 
	"<strong>The beach!:</strong>  Tons of attractions from golf, water sports and zip lines to 
	fill your days at the beach with adventure!");

$location_restaurants = array("<strong>Cafe Grazie:</strong> For great Italian, this is the perfect place to go and indulge in 
	local italian dishes at great prices!", 
	"<strong>Shipp’s Harbour Grill:</strong>  A great waterfront place with beautiful views and delicious food all day 
	long for a perfect place to relax!");

$location_more_pics = array('http://utopia.mynmi.net/test/pics/southeast/orange_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/orange_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/orange_4.jpg');

$location_more_pics_thumb = array('http://utopia.mynmi.net/test/pics/southeast/orange_2.jpg', 
	'http://utopia.mynmi.net/test/pics/southeast/orange_3.jpg',
	'http://utopia.mynmi.net/test/pics/southeast/orange_4.jpg');

$location_travel_types = array(CULTURE, ADVENTURE, LEISURE, ENTERTAINMENT);

$location = new Location("Orange Beach, AL", $location_description, $location_img, $location_activities, $location_restaurants, $location_more_pics, $location_more_pics_thumb, $location_travel_types, SOUTHEAST);

$location_array[] = $location;




$index=0;
$thumb_index=0;
$pic_index=0;
foreach ($location_array as $loc) {
	
	if ( ($loc->region == $target_region)
		 && (in_array($user_type, $loc->travel_types) )) {
		echo $loc->place_hover($index++);

	}
}






?>

<body>
</body>
</html>