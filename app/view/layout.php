<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="author" content="Dixi KIYINDOU">
        <title><?php echo $controllerName . ' : ' . $actionName; ?></title>
        <link rel="stylesheet" href="/css/bootstrap.css" />
        <script src="/js/bootstrap.js" type="application/javascript"></script>
        <script src="https://code.jquery.com/jquery-git.min.js" type="application/javascript" ></script>
        <script src='https://cloud.tinymce.com/stable/tinymce.min.js' ></script>
        <script type="application/javascript" >
            tinymce.init({
                selector: '.textarea'
            });
        </script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php if (isset($currentUser)) : ?>
                    Current user : <?php echo $currentUser->getUserName(); ?>
                    &nbsp;<a href="index.php?controller=auth&action=logout">(Logout)</a>
                <?php endif; ?>
            </div>
        <?php
        require_once $this->displayActionView($actionName);
        ?>
        </div>
    </body>
</html>