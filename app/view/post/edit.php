<div class="row">
    <div class="login-form">
        <div class="main-div">
            <div class="panel">
                <h2>Create/Edit post</h2>
            </div>
            <form id="post" method="post" action="/index.php?controller=post&action=edit">
                <input type="hidden" name="id" value="<?php echo $currentPost->getId();?>"/>
                <div class="form-group">
                    <input type="text" name="title" placeholder="Post title" size="80"
                           value="<?php echo $currentPost->getTitle(); ?>"/>
                </div>
                <div class="form-group">
                    <textarea class="textarea" name="content"><?php echo $currentPost->getContent(); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
</div>