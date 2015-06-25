<?php /*require("includes/header.php");?>
<?php 


?>
<form role="form" enctype="multipart/form-data" method="post" action="create.php">
								<div class="form-group">
									<label>Question</label>
									<input type="text" class="form-control" name="question" placeholder="Enter your question">
								</div>
								<div class="form-group">
									<label>Categories</label>
									<select class="form-control" name="category">
									<?php if($categories): ?>
									<?php foreach($categories as $category):?>
										<option value="<?php echo $category->id;?>"><?php echo $category->name;?></option>
									<?php endforeach;?>
										<?php else: {} endif;?>
									</select>
									</div>
								<div class="form-group">
									<label>More description</label>
									<textarea id="body" class="form-control" rows="10" cols="80" name="body" placeholder="Type in the description"></textarea>
								</div>
								
								<button type="submit" name="do_create" class="btn btn-primary">OK</button>
							</form>
<?php require("includes/footer.php")*/?>