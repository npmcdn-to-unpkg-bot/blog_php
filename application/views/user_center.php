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
        <div class="ui container">
            <h2 class="ui center aligned icon header">
                <i class="circular users icon"></i>
                <?php echo $session['name'] ?>
            </h2>
            <div class="ui icon menu">
                <a class="item" data-content="Create Article" href="<?php echo site_url('media/create'); ?>">
                    <i class="write icon"></i>
                </a>
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<script src="/public/lib/bower_components/jquery/jquery.min.js"></script>
<script src="/public/build/home.js"></script>
</html>