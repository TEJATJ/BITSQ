<?php require("core/init.php");?>
<?php 

$user=new User;
$template=new Template("templates/register.php");
if(isset($_GET['token'])&&isset($_GET['mail']))
{

if($user->verifyToken($_GET['token'],$_GET['mail']))
$template->error= 'Thank You. Your Mail Has been verified. Please Login.';
else 
$template->error='Incorrect token. Please use the link in the mail sent to you .';
}



echo $template;
?>
