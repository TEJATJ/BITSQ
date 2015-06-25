<?php include("includes/header.php");?>

<?php if($topicSel) :?>
<div class="topics-pane">
		<div class="title">
			<div class="content">

			<h2><a href="topic.php?topic=<?php echo urlFormat($topicSel->id);?>"><?php echo $topicSel->title;?></a></h2>
			<div class="info">
			<img src="<?php echo avatar.$topicSel->avatar;?>" />
			<a class="user" href="topics.php?user=<?php echo urlFormat($topicSel->user_id);?>"><?php echo $topicSel->username;?></a>
			 <a class="hide">Posted on</a> <?php echo formatDate($topicSel->create_date);?><br>
			<a class="upvotes"><span id="topicCount-<?php echo $topicSel->id;?>"><?php $d=getUpVoteCountTopic($topicSel->id);echo $d->countot;?></span> Upvotes</a>
			<div class="content-body">
			<?php 
			echo $topicSel->body;?>
			</div>
			<div class="content-footer">
				<?php if(!reported($topicSel->id)): ?>
				<span id="upvoteTopic-<?php echo $topicSel->id;?>">
				<input type="hidden" id="upvotesCountTopic-<?php echo $topicSel->id;?>" Value=<?php $d=getUpVoteCountTopic($topicSel->id);if($d->countot==0) echo "0";else echo $d->countot;?> />
				<span class="dTopic"><a id="linkTopic" <?php if(upvoted($user_id,$topicSel->id,0)) echo 'onclick="addLikesTopic(0,\'downvote\','.$topicSel->id.');"';
				else  echo 'onclick="addLikesTopic(0,\'upvote\','.$topicSel->id.');"';?>  class="upvotes upvoteborder" >
				<span class="resultTopic"><?php if(upvoted($user_id,$topicSel->id,0)) echo 'Upvoted';else echo 'Upvote'; ?> | <?php $d=getUpVoteCountTopic($topicSel->id);echo $d->countot;?></span></a></span></span>
				<?php endif;?>
				<span id="downvoteTopic-<?php echo $topicSel->id;?>"><a id="downvote" <?php if(!reported($topicSel->id)) echo  'onclick="report(\'topic\','.$topicSel->id.',0);"';?> class="upvotes"><?php if(reported($topicSel->id)) echo 'Reported';else echo 'Report'?></a></span>
							
				<a class="upvotes" ><?php echo replyCount($topicSel->id);if(replyCount($topicSel->id)==1) echo ' Answer';else echo ' Answers';?> </a><hr>
				
				
			</div>
			<?php if(isLoggedIn()):?>
						
							
								<div class="form-group">
								<label>Add your answer</label>
								<div class="reply">
								<img class="" src="<?php echo BASE_URI.'/templates/avatars/'.$avatar;?>" />
								<a class="user" ><?php echo $username;?></a><br>
								<a class="user" ><?php echo $details;;?></a><br>
								
								<!---<textarea  placeholder="Add Your Answer" style="margin-right:0px;" class="textarea1 form-control" name="reply" ></textarea>-->
								<form  action="topic.php?topic=<?php echo urlFormat($_GET['topic']);?>" method="POST">
								<div class="form-group" style="padding-top:10px;">
								<input type="hidden" name="newAns" value="<?php echo getlastid("replies")+1;?>">
								<textarea name="reply"  class="ckeditor" rows="5" cols="34" ></textarea>
								</div>
								<button type="submit" name="do_reply" class="btn btn-primary">Reply</button>
							</form>
								</div>
								<!--<button style="margin:10px 0px 0px 10px;;" type="submit" name="do_reply" class="btn btn-primary">Reply</button>-->
								</div>									
												
								
								
<?php else : echo "<p style='text-align:center'>Please Login to add your answer.</p>";endif;?>
			</div>
			</div>
		</div>	
	</div>
	<div> <!--id="topicscroll" style="height:300px;padding:10px;"-->
	<div class="topics-pane">
		<div class="title">
			<div class="content">
			<h2 style="padding-bottom:10px;">Answers</h2>
			<?php if($replies):?>
<?php foreach($replies as $reply) :?>
				<div class="info" id="replyid<?php echo $reply->id;?>">
			<img src="<?php echo avatar.$reply->avatar;?>" />
			<a class="user" href="topics.php?user=<?php echo urlFormat($reply->user_id);?>"><?php echo $reply->username;?></a>
			 Posted on <?php echo formatDate($reply->create_date);?><br>
			<a class="upvotes"><span id="replyUpCount-<?php echo $reply->id;?>"><?php $d=getUpVoteCount($reply->id);if($d->countot==0) echo "0";else echo $d->countot;?> </span> Upvotes</a>
			<div class="content-body">
			<?php 
			echo str_replace('<script>',"[--! hack reported @admin--]",$reply->body);?>
			</div>
			<div class="content-footer">
				<?php if(!reported($topicSel->id,$reply->id)): ?>
				<span id="upvote-<?php echo $reply->id;?>">
				<input type="hidden" id="upvotesCount-<?php echo $reply->id;?>" Value=<?php $d=getUpVoteCount($reply->id);if($d->countot==0) echo "0";else echo $d->countot;?> />
				<span class="d"><a id="link" <?php if(upvoted($user_id,$topicSel->id,$reply->id)) echo 'onclick="addLikes('.$reply->id.',\'downvote\','.$topicSel->id.');"';
				else  echo 'onclick="addLikes('.$reply->id.',\'upvote\','.$topicSel->id.');"';?>  class="upvotes upvoteborder" >
				<span class="result"><?php if(upvoted($user_id,$topicSel->id,$reply->id)) echo 'Upvoted';else echo 'Upvote'; ?> | <?php $d=getUpVoteCount($reply->id);echo $d->countot;?></span></a></span></span>
				<?php endif;?>
				<span id="downvoteReply-<?php echo $reply->id;?>"><a id="downvote" <?php if(!reported($topicSel->id,$reply->id)) echo  'onclick="report(\'reply\','.$topicSel->id.','.$reply->id.');"';?> class="upvotes"><?php if(reported($topicSel->id,$reply->id)) echo 'Reported';else echo 'Report'?></a></span>	

				<hr>
			</div>
			</div>
	

	<?php $val=$reply->id; endforeach;?>
	
	<?php else : echo '<p style="text-align:center">No one replied to this post</p>';endif;?>
	</div></div></div></div>
	<?php else: echo 'Invalid Selection';endif;?>


<?php include("includes/footer.php");?>

