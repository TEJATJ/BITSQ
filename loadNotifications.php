<div id="load">
<?php 
require("core/init.php");
if(isLoggedIn())
{	
$a=array();
		$u_id=$_SESSION['user_id'];
		$db=new Database;
		if(isset($_POST['hide']))
		$case="hide";
	else if(isset($_POST['seen']))
		$case="seen";
			if(isset($_POST['id']))
			{
				$db->query("UPDATE notifications SET `".$case."`='1' WHERE u_id=:u_id AND id=:id");
				$db->bind("u_id",$u_id);
				$db->bind("id",$_POST['id']);
				$db->execute();
				
			}
		
		$db->query("SELECT notifications.id,notifications.body,link,link1,avatar,username,seen,topics.title b FROM notifications 
		INNER JOIN users ON users.id=notifications.from_id 
		INNER JOIN topics ON topics.id=notifications.link WHERE u_id=:u_id AND hide='0' AND u_id!=from_id ORDER BY notifications.id DESC
		");
		$db->bind("u_id",$u_id);
		$r=$db->resultset();
		?>
		<p class="arrow-up" style="postion:relative;margin-top:-13px;margin-left:184px;">&nbsp;</p>
		<div style="max-height:300px;overflow-y:auto;">
		<ul id="notificationList">
		
		<?php
		if(!empty($r)):
	foreach($r as $result):
		?>
			
			<li id="not-<?php echo $result->id;?>" style="background:<?php if(($result->seen)==1) echo '#F4F2F2';?>"><a href="
			<?php /*if(strcmp($b,$c)==-1) echo 'topics.php?user=';else*/ echo 'topic.php?topic='; echo $result->link;if($result->link1!=0) {echo'#replyid'.$result->link1;}?>" onclick="notificationRead(<?php echo $result->id;?>)">
			<img src="<?php echo BASE_URI.'templates/avatars/'.$result->avatar;?>">
			<span id="title"><?php echo $result->username;?></span><span style="font-weight:normal;color:#888"><?php echo ' '.$result->body;?></span><br>
			<span style="font-weight:bold">" <?php echo substr($result->b,0,28);?>... "</span></a>
			<button type="button" class="close" title="hide/delete" aria-label="Close" onclick="notificationHide(<?php echo $result->id;?>);"><span aria-hidden="true">&times;</span></button>
			<?php if(($result->seen)==0):?><a href="#" id="notclk-<?php echo $result->id?>" onclick="notificationRead(<?php echo $result->id;?>)" title="Mark as read" class="glyphicon glyphicon-ok pull-right" style="margin-right: 5px; color: #888888; font-size: 12px;  margin-top: 3px;cursor:pointer" aria-hidden="true"></a><?php endif;?></li>
		
		<?php endforeach;else: echo '<li><div style="font-weight:bold;text-align:center !important;">No new notifications</div> </li>';endif;?>
		
		</ul>
		</div>
		<?php		
}else redirect("home.php");
?>
</div>
<div id="number">
<?php 
if(isLoggedIn())
{
	$u_id=$_SESSION['user_id'];
		$db=new Database;
		$db->query("SELECT DISTINCT body,link,id FROM notifications WHERE (u_id=:u_id AND u_id!=from_id AND seen='0' AND hide='0') ORDER BY id DESC ");
		$db->bind("u_id",$u_id);
		$r=$db->resultset();
		echo $db->rowCount();
}
?>
</div>