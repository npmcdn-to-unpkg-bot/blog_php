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
        <div class="ui container article-list">
            <div class="side-container clearfix">
                <div class="left-side">
                    <?php include APPPATH . '/views/templates/vertical.php' ?>
                </div>
                <div class="right-side">

                    <?php foreach ($news as $news_item) { ?>
                        <a class="ui link card" href="<?php echo site_url('/media/article/' . $news_item['id']); ?>">
                            <div class="content">
                                <div class="header"><?php echo $news_item['title']; ?></div>
                                <div class="description">
                                    <p>
                                        <?php echo $news_item['description'] . '...' ?>
                                    </p>
                                </div>
                            </div>
                            <div class="extra content">
                            <span class="left floated">
                                <i class="wait icon"></i><?php echo $news_item['date']; ?></span>
                            <span class="right floated">
                                <div class="ui heart rating" data-rating="4" data-max-rating="5"></div>
                            </span>
                            </div>
                        </a>
                    <?php }
                    if (empty($news)) { ?>
                        <div class="ui message">
                            无数据
                        </div>
                    <?php }
                    echo $page ?>
                </div>
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<script src="/public/lib/bower_components/jquery/jquery.min.js"></script>
<script src="/public/build/home.js"></script>
</html>