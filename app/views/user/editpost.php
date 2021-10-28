<div class="my_content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card mx-auto mt-5">
                <div class="card-header">
                    <h5 style="margin-left: 25vw;">Here you can edit of post</h5>
                </div>
                <div class="card-body" style="margin-left: 10vw;" >

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
                        <button type="submit" class="btn btn-primary btn-block mt-3">
                            Edit Post
                        </button>

                     <?php endforeach; ?>

                </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-top: 4vh; height: 4vh; background-color: #FEF6F6;"></div>