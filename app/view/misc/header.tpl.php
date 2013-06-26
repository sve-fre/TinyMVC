<header>
    <h1>
        <a href="<?php echo url(); ?>"><?php echo Config::get('app.title'); ?></a>
    </h1>
    <nav>
        <ul>
            <li><a href="<?php echo url('home/about'); ?>">About</a></li>
            <li><a href="<?php echo url('home/error'); ?>">Missing method</a></li>
            <li><a href="<?php echo url('missing'); ?>">Missing controller</a></li>
            <li><a href="<?php echo url('testroute'); ?>">Testroute</a></li>
            <li><a href="<?php echo url('testroute/asd'); ?>">Testroute ASD</a></li>
        </ul>
    </nav>
</header>
