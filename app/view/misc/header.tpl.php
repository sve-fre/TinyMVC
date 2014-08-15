<header>
    <h1>
        <a href="<?php echo url(); ?>"><?php echo Config::get('app.title'); ?></a>
    </h1>
    <nav>
        <ul>
            <li><a href="<?php echo url('home/about'); ?>">About</a></li>
            <li><a href="<?php echo url('migration/make'); ?>">Migration/make</a></li>
            <li><a href="<?php echo url('migration/rollback'); ?>">Migration/rollback</a></li>
            <?php if (Session::get('user_data') !== null): ?>
                <li class="logout"><a href="<?php echo url('logout'); ?>">Logout</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
