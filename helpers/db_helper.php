<?php 
function replyCount($topic)
{$db=new Database;
$db->query("SELECT * FROM replies WHERE topic_id= :topic_id");
$db->bind(':topic_id',$topic);
$rows=$db->resultset();
return $db->rowCount();
} 
function getCategories()
{
$db=new Database;
$db->query("SELECT * FROM categories");
$categories=$db->resultset();
return $categories;
}
function topicsCount($category)
{$db=new Database;
if($category=="all")
$db->query("SELECT * FROM topics");
else 
{$db->query("SELECT * FROM topics WHERE category_id= :category_id");
$db->bind('category_id',$category);}
$count=$db->resultset();
return $db->rowCount();
}
function totUsers()
{
$db=new Database;
$db->query("SELECT * FROM users");
$db->resultset();
return $db->rowCount();
}

function totCategories()
{
$db=new Database;
$db->query("SELECT * FROM categories");
$db->resultset();
return $db->rowCount();
}
function getUserTopicCount($id,$name=null)
{
	
$db=new Database;
$db->query("SELECT * FROM topics WHERE user_id=:user_id");
$db->bind(":user_id",$id);
$db->resultset();
$topics=$db->rowCount();
$db->query("SELECT * FROM replies WHERE user_id=:user_id");
$db->bind(":user_id",$id);
$db->resultset();
$replies=$db->rowCount();
if($name=='topic')
return $topics;
else if($name=='replies')
	return $replies;
else if($name==null)
{return $topics+$replies;}
}
function fieldExists($table,$field,$value)
{$db=new Database;
$db->query("SELECT * FROM `".$table."` WHERE `".$field."` =:value");
$db->bind(":value",$value);
$db->resultset();
if(($db->rowCount())==0)
return false;
else if(($db->rowCount())==1)
return true;
}
function getReply($topic_id,$user_id=null)
{$db=new Database;
	if($user_id!=null)
	{
		$db->query("SELECT body,create_date FROM replies WHERE topic_id=:topic AND user_id=:user");
		$db->bind(":user",$user_id);
	}else if($user_id==null)
	{
		$db->query("SELECT body,create_date FROM replies WHERE topic_id=:topic ");
	}
	$db->bind(":topic",$topic_id);
	return $db->single();
	 
}
function getUpVoteCount($r_id)
{
	$db=new Database;
	$db->query("SELECT sum(vote) as countot FROM upvotes WHERE r_id=:r");
	$db->bind('r',$r_id);
	$db->execute();
		return $db->single();
}
function getUpVoteCountTopic($t_id)
{
	$db=new Database;
	$db->query("SELECT sum(vote) as countot FROM upvotes WHERE t_id=:r AND r_id='0'");
	$db->bind('r',$t_id);
	$db->execute();
		return $db->single();
}
function upvoted($user,$topic,$reply)
{
$db=new Database;
$db->query("SELECT * FROM upvotes WHERE u_id=:u_id AND t_id=:t_id AND r_id=:r_id");
$db->bind("u_id",$user);
$db->bind("t_id",$topic);
$db->bind("r_id",$reply);
$db->resultset();
$result=$db->single();
if($db->rowCount()!=0){
$result=$result->vote;
if($result==1)
return true;
else return false;}else return false;
}
function reported($t_id,$r_id=null,$u_id)
{$db=new Database;
	if($r_id==null)
		$r_id=0;
	$db->query("SELECT * FROM reports WHERE t_id=:t_id AND r_id=:r_id AND u_id=:u_id");
	$db->bind("t_id",$t_id);
	$db->bind("r_id",$r_id);
	$db->bind("u_id",$_SESSION['user_id']);
	$count=$db->rowCount();
	if($count==0)
		return false;
	else 
		return true;
}
function getUserDetails($user_id)
{
	$db=new Database;
	$db->query("SELECT id,name,about,email,avatar FROM users WHERE id=:id");
	$db->bind("id",$user_id);;
	$db->execute();
	if($db->rowCount()!=0)
		return $db->single();
	else 
		return false;
}
function following($user,$following)
{
	$db=new Database;
	$db->query("SELECT val FROM followers WHERE u_id=:u_id AND f_id=:f_id");
	$db->bind("u_id",$user);
	$db->bind("f_id",$following);
	$result=$db->single();
	if($result->val==1)
		return true;
	else return false;
}
function follow_no($type,$user)
{$db=new Database;
	switch($type)
	{
		case "following":
		$db->query("SELECT * FROM followers WHERE u_id=:u_id AND val='1'");
		$db->bind("u_id",$user);
		 return $result=$db->rowCount();
		break;
		case "followers":
			$db->query("SELECT * FROM followers WHERE f_id=:u_id AND u_id!=f_id AND val='1' ");
		$db->bind("u_id",$user);
		 return $result=$db->rowCount();
		 break;
		 
	}
}
function followers_id($user)
{
	$db=new Database;
	$_SESSION['followers']=array();
	$a=array();
		$db->query("SELECT u_id  FROM followers WHERE f_id=:user AND val='1' ");
		$db->bind("user",$user);
		$_SESSION['followers']=$db->resultset();
		return $a=$_SESSION['followers'];
}
function following_id($user)
{
	$db=new Database;
	$_SESSION['following']=array();
	    $a=array();
		$db->query("SELECT f_id  FROM followers WHERE u_id=:user AND val='1' ");
		$db->bind("user",$user);
		$_SESSION['following']=$db->resultset();
		return $a=$_SESSION['following'];
}
function add_notification($user_id,$body,$link,$link1,$users)
{
	$db=new Database;
	
	foreach($users as $name=>$id)
	{
		
		//$db->query("UPDATE notifications SET last_activity=:date,seen='1',hide='1' WHERE u_id=:u_id AND from_id=:from_id AND link=:link AND body=:body AND link1=:link1");
		$db->query("DELETE FROM notifications WHERE u_id=:u_id AND from_id=:from_id AND link=:link AND body=:body AND link1=:link1");
		$db->bind("u_id",$id->u_id);
		$db->bind("from_id",$user_id);
		$db->bind("link1",$link1);
		$db->bind("body",$u.' '.$body);
		$db->bind("link",$link);
		//$db->bind("date",date("Y-m-d H:i:s"));
		$db->execute();
		//if($db->rowCount()==0)
		{
		$db->query("INSERT INTO notifications VALUES ('',:u_id,:from_id,:body,:link,:link1,'0','0',:date)");
		$db->bind("u_id",$id->u_id);
		$db->bind("from_id",$user_id);
		$db->bind("link1",$link1);
		$db->bind("body",$u.' '.$body);
		$db->bind("link",$link);
		$db->bind("date",date("Y-m-d H:i:s"));
		$db->execute();
		}
	}
}
function getlastid($table)
{
	$db=new Database;
	$db->query("SELECT id FROM `".$table."` ORDER BY id DESC");
	$r=$db->single();
	return $r->id;
}
function notify_number()
{
	$u_id=$_SESSION['user_id'];
		$db=new Database;
		$db->query("SELECT DISTINCT  body,link FROM notifications WHERE u_id=:u_id AND seen='0' AND hide='0' AND u_id!=from_id");
		$db->bind("u_id",$u_id);
		$r=$db->resultset();
		if($db->rowCount()) return $db->rowCount();
}
function stats()
{
	$db=new Database;
	$db->query("SELECT SUM(vote) as result,users.id,users.name,users.username,users.about,users.email,users.avatar FROM upvotes INNER JOIN users ON upvotes.v_for=users.id GROUP BY upvotes.v_for  ORDER BY result DESC");
	return $db->single();
}

?>