<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mx-auto mt-5">
            <div class="card-header">
                <h5 style="margin-left: 35vw;">Here you can edit of post</h5>
            </div>
            <div class="card-body" style="margin-left: 20vw;" >

               <form action="" method="post"  id="ajax">

                    <?php foreach ($posts as $val): ?>

                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" type="text" value="<?php echo $val['name'];  ?>" name="name">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" type="text"name="description" 
                            style="height: 8vw;"><?php echo $val['description']; ?>
                        </textarea> 
                    </div>
                    <div class="form-group">
                        <label>Text</label>
                        <textarea class="form-control" type="text" name="text" 
                            style="height: 17vw;"><?php echo $val['text']; ?>
                        </textarea>
                    </div>
                    <div class="form-group">
                        <label>Like</label>
                        <input class="form-control" type="text" value="<?php echo $val['goodlike'];  ?>" name="goodlike">
                    </div>
                    <div class="form-group">
                        <label>Dislike</label>
                        <input class="form-control" type="text" value="<?php echo $val['dislike'];  ?>" name="dislike">
                    </div>
                    <div class="form-group">
                        <label>Author</label>
                        <input class="form-control" type="text" value="<?php echo $val['author'];  ?>" name="author">
                    </div>
                    <button type="submit" class="btn btn-primary btn-block mt-3">
                        Edit Post
                    </button>

                    <?php endforeach; ?>

                </form>

            </div>
        </div>
    </div>
</div>

