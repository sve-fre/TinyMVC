<!DOCTYPE html>
<html>
<head>
    <meta charset="ISO-8859-1">
    <title><?php echo $title; ?></title>
    <link rel="stylesheet" type="text/css" href="<?php echo Config::get('app.base_url'); ?>public/css/TinyMVC.css">
</head>
<body>
    <div id="wrapper">
        {{header}}

        <div id="content">
            {{content}}
        </div>
    </div><!-- /#wrapper -->
</body>
</html>
