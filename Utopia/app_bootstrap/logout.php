<?php
	require_once 'php-sdk/facebook.php';

	//Your App ID and App Secret goes here
	$facebook = new Facebook(array(
		'appId' => '802007503148785',
		'secret' => 'de14f2547cc3eab99e800d5054120fce'
	));
	
	setcookie('fbs_'.$facebook->getAppId(),'', time()-100, '/',
		'simpsonj.mynmi.net/fb2/');
		$facebook->destroySession();
		header('location: index.php');
?>

	