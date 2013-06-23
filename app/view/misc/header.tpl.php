<header>
    <h1>
        <a href="<?php echo url(); ?>"><?php echo Config::get('app.title'); ?></a>
    </h1>
    <nav>
        <ul>
        <?php foreach ($forums as $forum): ?>
            <li>
                <a href="<?php echo url('forum/' . slug($forum['name'])); ?>">
                    <?php echo $forum['name']; ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>
</header>
