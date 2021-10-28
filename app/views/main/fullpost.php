<?php foreach ($posts as $val): ?>
	<div class="my_content">
		<div class="card" style="width: 60rem; border: solid 2px;">
			<img src="../public/img/<?php echo $val['id']; ?>.jpg" class="card-img-top" style="max-height: 340px";>
			
			<div class="card-body">
				<h5 class="card-title text-center"><?php echo $val['name'];  ?></h5>
				<p class="card-text"><?php echo $val['description'];  ?></p>
				<p class="card-text"><?php echo $val['text'];  ?></p>

				<div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 2vw;">
				<?php if (isset($_SESSION['auth'])): ?>
					<form action="/like" method="post" id="">
          				<button class="btn btn-info btn-sm" name="like" 
           	 				value="<?php echo $val['id']; ?>">&#128150: <?php echo $val['goodlike'];  ?>
          				</button>
          				<button class="btn btn-info btn-sm" name="dislike" 
            				value="<?php echo $val['id']; ?>">&#128148: <?php echo $val['dislike']; ?>
          				</button>
        			</form>
   				<?php else: ?>
   					&#128150: <?php echo $val['goodlike'];  ?>
          			&#128148: <?php echo $val['dislike']; ?>
          			<div class="mytext";>
            			<p>  If you want to post like, register.</p>
          			</div>
   				<?php endif?>

   				<div class="author" style="margin-left: 22vw";>
        			<p>Author: <?php echo $val['author'];  ?></p>
     			</div>
			</div>
			</div>

			<div class="comments_content">
				<?php foreach ($comments as $el): ?>
					<div class="comments_block">
						<h6 class="card-text">Author: <?php echo $el['author'];  ?></h6>
						<p class="card-text"><?php echo $el['message'];  ?></p>
					</div>
				<?php endforeach ?>

				<?php if (isset($_SESSION['auth'])): ?>
					<form action="/coment" method="post">
						<div class="add_comment">
							<label>Add coment</label>
							<textarea class="form-control" type="text"name="message" style="height: 8vh;">
							</textarea> 
							<input class="input_post" type="text" name="ispost" value="<?php echo $val['id']; ?>">
							<button class="btn btn-primary"name="name" style="margin-top: 2vh" 
							value="<?php echo $val['name']; ?>">Send
						</button>
					</div>
				</form>
				<?php else: ?>
					<label>Add coment</label>
				 	<input class="form-control" type="text" placeholder="You need registrait if you want send comment">
				<?php endif?>
			</div>

		</div>
	</div>
<?php endforeach ?>
<div style="margin-top: 6vh; height: 6vh; background-color: #FEF6F6;"></div>