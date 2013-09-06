<header>
    <h1>
        <a href="<?php echo url(); ?>"><?php echo Config::get('app.title'); ?></a>
    </h1>
    <nav>
        <ul>
            <li><a href="<?php echo url('home/about'); ?>">About</a></li>
            <li><a href="<?php echo url('home/about/lala'); ?>">Lala</a></li>
            <li><a href="<?php echo url('registered-route'); ?>">Registered route</a></li>
            <li><a href="<?php echo url('no-controller'); ?>">No controller</a></li>
        </ul>
    </nav>
</header>
