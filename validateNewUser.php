
<?php require("core/init.php");
require("class.phpmailer.php");
require("class.smtp.php");
define('GUSER', 'f2013152@pilani.bits-pilani.ac.in'); // GMail username
define('GPWD', '498033');
function smtpmailer($to, $from, $from_name, $subject,$avatar,$user,$link) {
global $error;

$mail = new PHPMailer();  // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true;  // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
$mail->Host = 'smtp.gmail.com';
$mail->Port = 465;
$mail->Username = GUSER;  
$mail->Password = GPWD;
$mail->IsHTML(true);          
$mail->SetFrom($from, $from_name);
$mail->Subject = $subject;
$mail->AddEmbeddedImage('background1.jpg','background1img');
$name=explode($avatar,'.'); 
$mail->AddEmbeddedImage('templates/avatars/'.$avatar,'avatarimg'); 
$mail->Body = "<div style='width:100%;background-color:rgb(77, 16, 1);height:500px;font-size:20px;color:#fff'>
		<font face='century Gothic,sans-serif'>
		<img src='cid:background1img' style='z-index:-2;text-align:center;margin-left:195px;width:300px;'>
		
		<div style='margin-left:0px;margin-top:30px;text-align:center;'><img src='cid:avatarimg' style='width:100px;height:100px;padding:1px;border:3px solid #ddd;margin-top:5px;margin-left:-5px;' /><div style='margin-top:5px;margin-left:-5px;'>Hello ".$user."</div>
			<p style='text-align:justify;max-width:500px;margin-left:120px;'>\"Campus Connect\" is an initiative by a group of student enthusiasts, aiming to solve some of the issues faced by BITSians.\"BITS QUORA\" is one of the many projects covered under this initiative. </p>
		
		<div style='text-align:center'><br>
		<p style='text-align:center'><a href='http://BITSQ/register.php?token=".$link."&mail=".$to."' style='margin-top:18px;color:#fff;text-decoration:none;cursor:pointer;background:green;padding:6px;border:2 px solid darkgreen;border-radius:2px'>Click here to confirm your mail.</a></p> </div>
		</div>
		<div style='color:#fff;font-size:18px;position:absolute;bottom:0px;margin-left:100px;'>
		Regards<br>
		Akhil Reddy<br>
		H-Rep VK-BHAWAN<br>
		7728835792<br><br>
		</div>		
		</div>
		</font></div>";
$mail->AddAddress($to);
if(!$mail->Send()) {
 $error = 'Mail error: '.$mail->ErrorInfo;
return false;
} else {
 $error = 'Confirmation Mail sent to the the provided mail!';
return true;
}
}
$user=new User;

if(isset($_POST['do_register']))
{
	$data=array();
	$data['name']=strip_tags($_POST['name'],"");
	$data['email']=strip_tags($_POST['email']);
	$data['username']=strip_tags($_POST['username']);
	$data['password']=md5(md5($_POST['password']));
	$data['password2']=md5(md5($_POST['re_password']));
	$data['about']=strip_tags($_POST['about']);
	$data['last_activity']=date("Y-m-d H:i:s",time());
	$avatar=md5($data['last_activity'].$data['email']);
	$temp=explode (".",$_FILES["avatar"]["name"]);
	$extension= end($temp);
	//upload Avatar
	
	 if($user->validateUser($data)){
		if(isset($_FILES['avatar']))
		{if($user->uploadAvatar($avatar))
	{$data['avatar']=$avatar.'.'.$extension;
	}else {
	 $data['avatar']='gravatar.jpg';
	 }}else $data['avatar']='gravatar.jpg';
	 $token=md5("ournextpresAkhil@".$data['name'].$data['password'].$data['email']
	 			."ournextpresAkhil@");
	 if(smtpmailer($data['email'],
	 			"f2013152@pilani.bits-pilani.ac.in",
	 			"AKHIL_REDDY @BITS_QUORA",
	 			"Mail confirmation for BITS-QUORA"
	 			,$data['avatar'],$data['name'],$token)){
	 			 
	 if($user->register($data))
	 {
echo "Registered Successfully.Please verify the mail.";
}
	 else echo "Sorry, we cannot register you right now. Please try later.";}
	 else echo 'Couldn\'t register at this time. Please try later.';
	 }
}


?>
