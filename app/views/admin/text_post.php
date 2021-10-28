<?php foreach ($posts as $val): ?>
	<div class="my_content">
		<div class="card" style="width: 60rem;">
			<img src="../public/img/<?php echo $val['id']; ?>.jpg" class="card-img-top" style="max-height: 340px";>
			<div class="card-body">
				<h5 class="card-title text-center"><?php echo $val['name'];  ?></h5>
				<p class="card-text"><?php echo $val['description'];  ?></p>
				<p class="card-text"><?php echo $val['text'];  ?></p>
				
				<div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 2vw;">

				<form action="/like" method="post" id="">
					<button class="btn btn-info btn-sm" name="like" 
					value="<?php echo $val['id']; ?>">&#128150: <?php echo $val['goodlike'];  ?>
					</button>
					<button class="btn btn-info btn-sm" name="dislike" 
					value="<?php echo $val['id']; ?>">&#128148: <?php echo $val['dislike']; ?>
					</button>
				</form>

   				<div class="author" style="margin-left: 30vw;">
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
					<form action="/admin/deleteComment" method="post">
						<button class="btn btn-danger btn-sm" name="id" value="<?php echo $el['id']; ?>">Delete</button>
					</form>
				<?php endforeach ?>
			
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
			</div>
			
		</div>
	</div>
<?php endforeach ?>
<div style="margin-top: 10vh;"></div>