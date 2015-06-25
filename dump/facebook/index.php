<?php
require_once("dbcontroller.php");
$db_handle = new DBController();
$query ="SELECT * FROM tutorial";
$result = $db_handle->runQuery($query);
?>
<HTML>
<HEAD>
<TITLE>PHP Dynamic Star Rating using jQuery</TITLE>
<style>
body{width:610;}
.demo-table {width: 100%;border-spacing: initial;margin: 20px 0px;word-break: break-word;table-layout: auto;line-height:1.8em;color:#333;}
.demo-table th {background: #81CBFD;padding: 5px;text-align: left;color:#FFF;}
.demo-table td {border-bottom: #f0f0f0 1px solid;background-color: #ffffff;padding: 5px;}
.demo-table td div.feed_title{text-decoration: none;color:#40CD22;font-weight:bold;}
.demo-table ul{margin:0;padding:0;}
.demo-table li{cursor:pointer;list-style-type: none;display: inline-block;color: #F0F0F0;text-shadow: 0 0 1px #666666;font-size:20px;}
.demo-table .highlight, .demo-table .selected {color:#F4B30A;text-shadow: 0 0 1px #F48F0A;}
.btn-likes {float:left; padding: 0px 5px;cursor:pointer;}
.btn-likes input[type="button"]{width:20px;height:20px;border:0;cursor:pointer;}
.like {background:url('like.png')}
.unlike {background:url('unlike.png')}
.label-likes {font-size:12px;color:#2F529B;height:20px;}
.desc {clear:both;color:#999;}

</style>
<script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
<script src="like.js" type="text/javascript"></script>

</HEAD>
<BODY>
<table class="demo-table">
<tbody>
<tr>
<th><strong>Tutorials</strong></th>
</tr>
<?php
if(!empty($result)) {
$ip_address = $_SERVER['REMOTE_ADDR'];
foreach ($result as $tutorial) {
?>
<tr>
<td valign="top">
<div class="feed_title"><?php echo $tutorial["title"]; ?></div>
<div id="tutorial-<?php echo $tutorial["id"]; ?>">
<input type="hidden" id="likes-<?php echo $tutorial["id"]; ?>" value="<?php echo $tutorial["likes"]; ?>">
<?php
$query ="SELECT * FROM ipaddress_likes_map WHERE tutorial_id = '" . $tutorial["id"] . "' and ip_address = '" . $ip_address . "'";
$count = $db_handle->numRows($query);
$str_like = "like";
if(!empty($count)) {
$str_like = "unlike";
}
?>
<div class="btn-likes"><input type="button" title="<?php echo ucwords($str_like); ?>" class="<?php echo $str_like; ?>" onClick="addLikes(<?php echo $tutorial["id"]; ?>,'<?php echo $str_like; ?>')" /></div>
<div class="label-likes"><?php if(!empty($tutorial["likes"])) { echo $tutorial["likes"] . " Like(s)"; } ?></div>
</div>
<div class="desc"><?php echo $tutorial["description"]; ?></div>
</td>
</tr>
<?php		
}
}
?>
</tbody>
</table>
</BODY>
</HTML>