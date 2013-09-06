<h2><?php echo $sub_headline; ?></h2>

<?php if (isset($model)) echo $model; ?>
<?php if (isset($breadcrumb)) echo $breadcrumb; ?>

<?php echo View::render('footer', null, array('sub_dir' => 'misc')); ?>
