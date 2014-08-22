<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php echo $title; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="<?php echo url(); ?>public/css/TinyMVC.css">
    <link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
    <script type="text/javascript" src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo url(); ?>public/js/TinyMVC.js"></script>
    <?php echo $meta_keywords; ?>
    <?php echo $meta_description; ?>
</head>
<body>
    <div id="wrapper" class="container">
        <?php echo $header; ?>

        <div class="row">
            <div class="col-md-12">
                <?php if (isset($form_msg)) echo $form_msg; ?>
                <?php echo $content; ?>
            </div>
        </div>

        <div class="row" id="footer">
            <div class="col-md-12">
                <?php echo $footer; ?>
            </div>
        </div>
    </div><!-- /#wrapper -->
</body>
</html>
