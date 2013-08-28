<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>public/css/TinyMVC.css">
    <?php echo $meta_keywords; ?>
    <?php echo $meta_description; ?>
</head>
<body>
    <div id="wrapper">
        <?php echo $header; ?>

        <div id="content">
            <?php echo $content; ?>
        </div>
    </div><!-- /#wrapper -->
</body>
</html>
