<!DOCTYPE html>
<html lang="en">
<head>
    <?php include APPPATH . '/views/templates/meta.php' ?>
    <link rel="stylesheet" href="/public/build/home.css">
</head>
<body>
<?php include APPPATH . '/views/templates/left-sidebar.php' ?>
<div class="pusher">
    <?php include APPPATH . '/views/templates/header.php' ?>
    <section>
        <div class="ui container article-info">
            <?php include APPPATH . '/views/templates/breadcrumb.php' ?>
            <div class="ui piled segment">
                <h3 class="ui header"><?php echo $news_item['title']; ?></h3>
                <div class="article-info-header">
                    <div class="ui mini horizontal divided list">
                        <div class="item">
                            <div class="content">
                                <i class="user icon"></i>
                                <?php echo $news_item['name']; ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="content">
                                <i class="unhide icon"></i>
                                <?php echo $news_visit; ?>
                            </div>
                        </div>
                        <div class="item">
                            <div class="content">
                                <i class="wait icon"></i>
                                <?php echo $news_item['date']; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="ui divider"></div>
                <div class="article-content">
                    <?php echo $news_item['content']; ?>
                </div>
            </div>
            <div class="ui icon menu">
                <a class="item" data-content="Create Article" href="<?php echo site_url('media/create'); ?>">
                    <i class="write icon"></i>
                </a>
                <a class="item" data-content="Update Article"
                   href="<?php echo site_url('media/update/' . $news_item['id']); ?>">
                    <i class="write square icon"></i>
                </a>
                <a class="item" data-content="Delete Article"
                   href="<?php echo site_url('media/delete/' . $news_item['id']); ?>">
                    <i class="trash icon"></i>
                </a>
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<?php include APPPATH . '/views/templates/script.php' ?>
<script src="/public/build/home.js"></script>
</html>