<?php include("includes/header.php");?>
<div id="topicscroll" style="padding:4px;" >
<?php if($topics) : ?>
<?php foreach($topics as $topic) :?>

<div class="topics-pane">
		<div class="title">
			<div class="content">
			<h2><a href="topic.php?topic=<?php echo urlFormat($topic->id);?>"><?php echo $topic->title;?></a></h2>
			<div class="info">
			<img src="<?php echo avatar.$topic->avatar;?>" />
			<a class="user" href="topics.php?user=<?php echo urlFormat($topic->user_id);?>"><?php echo $topic->username;?></a>
			<a class="hide">Posted on</a> <?php echo formatDate($topic->create_date);?><br>
			<a class="upvotes"><span id="topicCount-<?php echo $topic->id;?>"><?php $d=getUpVoteCountTopic($topic->id);echo $d->countot;?></span> Upvotes</a>
			<div class="content-body">
			<?php 
			{echo substr($topic->body,0,500).' ...<a href="topic.php?topic='.urlFormat($topic->id).'">More</a>';}?>
			</div>
			<div class="content-footer">
			<?php if(!reported($topic->id)): ?>
				<span id="upvoteTopic-<?php echo $topic->id;?>">
				<input type="hidden" id="upvotesCountTopic-<?php echo $topic->id;?>" Value=<?php $d=getUpVoteCountTopic($topic->id);if($d->countot==0) echo "0";else echo $d->countot;?> />
				<span class="dTopic"><a id="linkTopic"  <?php if(upvoted($user_id,$topic->id,0)) echo 'onclick="addLikesTopic(0,\'downvote\','.$topic->id.');"';
				else  echo 'onclick="addLikesTopic(0,\'upvote\','.$topic->id.');"';?>  class="upvotes upvoteborder" >
				<span class="resultTopic"><?php if(upvoted($user_id,$topic->id,0)) echo 'Upvoted';else echo 'Upvote'; ?><?php $d=getUpVoteCountTopic($topic->id);if(!empty($d->countot)) echo ' | '.$d->countot;else echo ' ';?></span></a></span></span>
				<?php endif;?>&nbsp;
				<span id="downvoteTopic-<?php echo $topic->id;?>"><a id="downvote" <?php if(!reported($topic->id)) echo  'onclick="report(\'topic\','.$topic->id.',0);"';else echo 'onclick=""';?> class="upvotes"><?php if(reported($topic->id)) echo 'Reported';else echo 'Report'?></a></span>
				<a id="answer" href="topic.php?topic=<?php echo urlFormat($topic->id);?>" class="upvotes">Answer</a>				
				<a class="upvotes" ><?php echo replyCount($topic->id);if(replyCount($topic->id)==1) echo ' Answer';else echo ' Answers';?> </a>
				
				
			</div>
			</div>
			</div>
		</div>	
	</div>
	<?php endforeach;?>
<?php else : echo ''; endif;?>
	</div>
<?php include("includes/footer.php");?>