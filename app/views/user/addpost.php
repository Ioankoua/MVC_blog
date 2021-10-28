<div class="my_content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="card mx-auto mt-5">
                <div class="card-header">
                    <h5 style="margin-left: 25vw;">Here you can add new post <?php echo $_SESSION['auth'] ?></h5>
                </div>
                <div class="card-body" style="margin-left: 10vw;" >

                    <form action="/account/addpost" method="post" style="width: 50vw;" id="ajax">
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" type="text" name="name">
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" rows="5" type="text" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Text</label>
                            <textarea class="form-control" rows="9" name="text"></textarea>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input class="form-control" type="file" name="img">
                        </div>
                        <button type="submit" class="btn btn-primary btn-block mt-3">Add New Post</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
<div style="margin-top: 4vh; height: 4vh; background-color: #FEF6F6;"></div>