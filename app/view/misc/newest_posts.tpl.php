<div style="display: table; width: 100%;">
    <?php foreach ($data['newest_posts'] AS $post): ?>

    <div style="display: table-row; margin: 5px 0;">
        <div style="display: table-cell; padding: 0 10px;">
            <a href="<?php echo url('forum/' . slug($post['forum_name'])); ?>"><?php echo $post['forum_name']; ?></a>
        </div>
        <div style="display: table-cell; padding: 0 10px;">
            <a href="<?php echo url('forum/' . slug($post['forum_name']) . '/' . $post['id'] . '/' . slug($post['thema'])); ?>"><?php echo $post['thema']; ?></a>
        </div>
        <div style="display: table-cell; padding: 0 10px;">
            <?php echo $post['name']; ?>
        </div>
    </div>

    <?php endforeach; ?>
</div>
