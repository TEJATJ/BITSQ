<?php include("core/init.php");
if(isset($_POST['do_login']))
{
error_reporting(E_ALL & ~E_NOTICE);
ini_set('error_reporting', E_ALL);
$user=new User;
$username=($_POST['username']);

$password=md5(md5(($_POST['password'])));
if($user->doLogin($username,$password))
{echo 'hai';redirect(false,"Successfully Logged In.","success");
}else redirect("index.php","Failed to login. Use proper login credentials.","error");

}else redirect("index.php");


?>
