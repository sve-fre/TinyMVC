<header>
    <h1>
        <a href="<?php echo url(); ?>"><?php echo Config::get('app.title'); ?></a>
    </h1>
    <nav>
        <ul>
            <li><a href="<?php echo url('home/about'); ?>">About</a></li>
            <li><a href="<?php echo url('home/error'); ?>">Missing method</a></li>
            <li><a href="<?php echo url('missing'); ?>">Missing controller</a></li>
        </ul>
    </nav>
</header>
