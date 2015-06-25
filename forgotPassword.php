
<?php require("core/init.php");
require("class.phpmailer.php");
require("class.smtp.php");
define('GUSER', 'f2013152@pilani.bits-pilani.ac.in'); // GMail username
define('GPWD', '498033');
function smtpmailer($to, $from, $from_name, $subject,$avatar,$user,$username,$password) {
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
$mail->Body = "<div style='width:100%;background:rgb(77, 16, 1);height:500px;font-size:20px;color:#fff'>
		<font face='century Gothic,sans-serif'>
		<img src='cid:background1img' style='z-index:-2;text-align:center;margin-left:210px;width:300px;'>
		
		<div style='margin-left:0px;margin-top:30px;text-align:center;'><img src='cid:avatarimg' style='width:100px;height:100px;padding:1px;border:3px solid #ddd;margin-top:5px;margin-left:-5px;' /><div style='margin-top:5px;margin-left:-5px;'>Hello ".$user."</div>
			<p style='text-align:justify;max-width:500px;margin-left:120px;'>
			<table>
			</table> </p>
		
		<div style='text-align:center'><br>
		<p style='text-align:center'>Your Accout details<br><br>
		<table style='text-align:left;margin-left:36%'>
		<tr><td style='padding-right:20px'>UserId</td><td>:".$username."</td></tr>
		<tr><td style='padding-right:20px'>New Password</td><td>:".$password."</td></tr>
		</table> </div>
		</div>
		<div style='color:#fff;font-size:18px;position:absolute;bottom:0px;margin-left:100px;'>
		Regards<br>
		Akhil Reddy<br>
		H-Rep VK-BHAWAN<br>
		850066489<br><br>
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
$db=new Database;
if(isset($_POST['do_forgot']))
{
if(!empty($_POST['f_email']))
{
$db->query("SELECT * FROM users WHERE email=:email AND status='1'");
$db->bind("email",$_POST['f_email']);
$result=$db->single();
if($db->rowCount()==1)
{
$pass=$result->password;
$pass=substr($pass,0,6);
if(smtpmailer($result->email, "f2013152@pilani.bits-pilani.ac.in", "AKHIL REDDY@ BITS QUORA", "Password reset for your account",$result->avatar,$result->name,$result->username,$pass))
{
$db->query("UPDATE users SET password=:pass WHERE email=:email");
$db->bind("pass",md5(md5($pass)));
$db->bind("email",$result->email);
$db->execute();
echo 'We have sent your accout details to your mail.';
}
else echo 'Please try after some time';
}
else echo 'Please register this email first.';
}else echo 'please provide us your email';
}else echo 'not valid';


?>
