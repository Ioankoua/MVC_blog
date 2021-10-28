<?php foreach ($posts as $val): ?>
<div class="my_content">
<div class="card" style="width: 60rem; border: solid 2px;">
  <img src="../public/img/<?php echo $val['id']; ?>.jpg" class="card-img-top" style="max-height: 340px";>
  
  <div class="card-body">
    <h5 class="card-title text-center"><?php echo $val['name'];  ?></h5>
    <p class="card-text"><?php echo $val['description'];  ?></p>

    <div class="btn-group" role="group" aria-label="Basic example" style="margin-left: 2vw;">
      <?php if (isset($_SESSION['auth'])): ?>
        <form action="/like" method="post" id="back">
          <button class="btn btn-info btn-sm" name="like" id="kek" 
            value="<?php echo $val['id']; ?>">&#128150: <?php echo $val['goodlike'];  ?>
          </button>
          <button class="btn btn-info btn-sm" name="dislike" id="kek"
            value="<?php echo $val['id']; ?>">&#128148: <?php echo $val['dislike']; ?>
          </button>
        </form>

        <form action="../fullpost" method="post" style="margin-left: 15vw";>
          <button class="btn btn-primary" name="idpost" value="<?php echo $val['id']; ?>">Check Post</button>
        </form>

      <?php else: ?>
          &#128150: <?php echo $val['goodlike'];  ?>
          &#128148: <?php echo $val['dislike']; ?>
          <div class="mytext";>
            <p>  If you want to post like, register.</p>
          </div>
          <form action="../fullpost" method="post" style="margin-left: 4vw";>
            <button class="btn btn-primary" name="idpost" value="<?php echo $val['id']; ?>">Check Post</button>
          </form>
      <?php endif?>

      <div class="author" style="margin-left: 12vw";>
        <p>Author: <?php echo $val['author'];  ?></p>
      </div>
  </div>

  </div>
</div>
</div>
<?php endforeach ?>
<div style="margin-top: 4vh; height: 4vh; background-color: #FEF6F6;"></div>