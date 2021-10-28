
<?php foreach ($posts as $val): ?>
    <div class="my_content" style="margin-right: 22vw;">
        <div class="card" style="width: 60rem;">
          <img src="../public/img/<?php echo $val['id']; ?>.jpg" class="card-img-top" style="max-height: 340px";>
          <div class="card-body">
            <h5 class="card-title text-center"><?php echo $val['name'];  ?></h5>
            <p class="card-text"><?php echo $val['description'];  ?></p>

            <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 2vw;">

              <form action="/like" method="post" id="">
                <button class="btn btn-info btn-sm" name="like" 
                        value="<?php echo $val['id']; ?>">&#128150: <?php echo $val['goodlike'];  ?>
                </button>
                <button class="btn btn-info btn-sm" name="dislike" 
                        value="<?php echo $val['id']; ?>">&#128148: <?php echo $val['dislike']; ?>
                </button>
              </form>

                <form action="../admin/text_post" method="post" style="margin-left: 10vw">
                   <button class="btn btn-primary" name="idpost" value="<?php echo $val['id']; ?>">Check Post</button>
               </form>
               <form action="../admin/button_enter_edit" method="post" style="margin-left: 1vw">
                   <button class="btn btn-warning" name="id" value="<?php echo $val['id']; ?>">Edit Post</button>
               </form>
               <form action="../admin/delete_button" method="post" style="margin-left: 1vw">
                   <button class="btn btn-danger" name="id" value="<?php echo $val['id']; ?>">Delete Post</button>
               </form>
                
                <div class="author">
                  <p>Author: <?php echo $val['author'];  ?></p>
                </div>
                
           </div>

       </div>
   </div>
</div>
<?php endforeach ?>
<div style="margin-top: 10vh;"></div>