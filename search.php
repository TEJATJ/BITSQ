<?php
require("core/init.php");
if(isLoggedIn())
{mysql_connect("localhost","root","8504066489.tJ");
mysql_select_db("bits_quora");
    $key=strtolower(mysql_real_escape_string($_GET['key']));
	$array=array();
    $query=mysql_query("SELECT topics.*,users.username,users.avatar,categories.name FROM topics INNER JOIN users ON topics.user_id=users.id INNER JOIN categories ON topics.category_id=categories.id WHERE topics.title LIKE '%".$key."%' OR users.username LIKE '%".$key."%' OR users.email LIKE '%".$key."%' OR categories.name LIKE '%".$key."%' ORDER BY create_date DESC");
	
	
    while($row=mysql_fetch_assoc($query))
    {
      $array[] = '<a style="color:black;background:none;"  href="topic.php?topic='.urlencode($row['id']).'">'.$row['title'].'</a>';
	 
	}
	$query2=mysql_query("SELECT id,name,avatar FROM users WHERE email LIKE '%".$key."%' OR username LIKE '%".$key."%' OR name LIKE '%".$key."%'");
	 while($row2=mysql_fetch_assoc($query2))
	 {
		  $array[] = '<a style="color:black;background:none;"  href="topics.php?user='.urlencode($row2['id']).'"><img style="padding-right:5px;" src="'.BASE_URI.'templates/avatars/'.$row2['avatar'].'" width="50px" height="50px">'.$row2['name'].'<span class="glyphicon glyphicon-send pull-right " style="margin-top:10px;"></span> </a>';
	 }
    echo json_encode($array);
	
}else redirect("home.php");
?>
