<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>public/css/TinyMVC.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo url(); ?>public/js/TinyMVC.js"></script>
    <?php echo $meta_keywords; ?>
    <?php echo $meta_description; ?>
</head>
<body>
    <div id="wrapper">
        <header>
            <?php echo $header; ?>
        </header>

        <div id="content">
            <?php if (isset($form_msg)) echo $form_msg; ?>
            <?php echo $content; ?>
        </div><!-- /#content -->

        <footer>
            <?php echo $footer; ?>
        </footer>
    </div><!-- /#wrapper -->
</body>
</html>
