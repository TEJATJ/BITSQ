<?php 
function redirect($page=FALSE,$message = NULL, $message_type = NULL)
{if(is_string($page)){
$location=$page;
}else {
	$location=$_SERVER['SCRIPT_NAME'];
}
if($message!=NULL)
{
$_SESSION['message']=$message;
}
//check for type
if($message_type !=NULL){
$_SESSION['message_type']=$message_type;
}

header('Location: '.$location."");
exit;

}
function displayMessage()
{if(!empty($_SESSION['message']))
{$message=$_SESSION['message'];
if(!empty($_SESSION['message_type']))
{$message_type=$_SESSION['message_type'];
//create output
if($message_type== 'error')
{echo '<div class="al alert alert-danger" style="text-align:center">'.$message.'</div>';
}else if($message_type== 'success')
{echo '<div class="al alert alert-success" style="text-align:center">'.$message.'</div>';
}else if($message_type== 'warning')
{echo '<div class="al alert alert-warning" style="text-align:center">'.$message.'</div>';
}

}unset($_SESSION['message']);
unset($_SESSION['message_type']);
}
else echo '';
}
function curPage()
{return substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
}
function isLoggedIn()
{if(!empty($_SESSION['user_id']))
{$db=new Database;
$db->query("SELECT username,about FROM users WHERE id=:u_id");
$db->bind("u_id",$_SESSION['user_id']);
$result=$db->single();
$_SESSION['username']=$result->username;
$_SESSION['details']=$result->about;
return true;}
else return false;}

function requiredFields($required,$array)
{$flag=true;
foreach($required as $field):
if($array[''.$field.'']==null||$array[''.$field.'']=="0"):
$flag=false;
endif;
endforeach;
return $flag;
}
?>
