
<div class="row">
    <div class="col-4">
        <h2>All connected users</h2>
        <ol>
            <?php
            /** @var \Works\Entity\Post $currentPost */
            foreach ($allUsers as $user) {
                /** @var \Works\Entity\User $user */
                ?>
                <li><?php echo $user->getUserName(); ?></li>
                <?php
            }
            ?>
        </ol>
    </div>
    <div class="col-8">
        <h2>All posts</h2>

        <?php
        foreach ($allPosts as $post) {
            /** @var \Works\Entity\Post $post */
        ?>
            <div class="row">
                <div class="col-12">
                    <h6><?php echo $post->getTitle(); ?></h6>
                </div>
            </div>
            <div class="row">
                <div class="col-12"><?php echo $post->getContent(); ?></div>
            </div>
            <div class="row">
                <div class="col-12">
                    <a href="index.php?controller=post&action=edit">
                        Edit post
                    </a>
                </div>
            </div>
        <?php
        }

        require 'edit.php';
        ?>
    </div>
</div>