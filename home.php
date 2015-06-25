<?php 
include("core/init.php");
$topic=new Topic;
error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL);
 $template=new Template("templates/home.php");
if(isset($_POST['do_login']))
{
	
$user=new User;
$username=($_POST['username']);
$password=md5(md5(($_POST['password'])));
if($user->doLogin($username,$password))
{redirect(false,"Successfully Logged In.","success");
}else redirect("home.php","Failed to login. Use proper login credentials.","error");

}



echo $template;
?>
