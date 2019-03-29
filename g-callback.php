<?php 
require_once "config.php";


if(isset($_SESSION['access_token_principal']))
$gClient->setAccessToken($_SESSION['access_token_principal']);
else if(isset($_GET['code'])){
	$token=$gClient->fetchAccessTokenWithAuthCode($_GET['code']);
	$_SESSION['access_token_principal']=$token;
}else{

header('Location:login.php');
}


$oAuth=new Google_Service_Oauth2($gClient);
$userData=$oAuth->userinfo_v2_me->get();

$_SESSION['id']=$userData['id'];
$_SESSION['email']=$userData['email'];
$_SESSION['gender']=$userData['gender'];
$_SESSION['picture']=$userData['picture'];
$_SESSION['familyName']=$userData['familyName'];
$_SESSION['givenName']=$userData['givenName'];

header('Location:index.php');
exit();

/*
echo "<pre>";
var_dump($userData);
*/
?>