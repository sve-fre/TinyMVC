<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>public/css/TinyMVC.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo url(); ?>public/js/TinyMVC.js"></script>
    <?php echo $meta_keywords; ?>
    <?php echo $meta_description; ?>
</head>
<body>
    <div id="wrapper">
        <?php echo $header; ?>
        <?php if (isset($form_msg)) echo $form_msg; ?>
        <?php echo $content; ?>
        <?php echo $footer; ?>
    </div><!-- /#wrapper -->
</body>
</html>
