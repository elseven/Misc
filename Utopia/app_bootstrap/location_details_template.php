<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Location</title>
</head>

<?php

require_once 'constants.php';
require_once 'location_class.php';
require_once 'location_class_template.php';



$target_region = $_GET['region'];


echo $location->place_details();

/*$target_location = $_GET['location'];

if ($target_location) {
echo $loc->place_details();
}*/

?>

<body>
</body>
</html>