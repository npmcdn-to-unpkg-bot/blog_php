<!DOCTYPE html>
<html lang="en">
<head><?php include APPPATH . '/views/templates/meta.php' ?>
    <link rel="stylesheet" href="/public/build/home.css">
</head>
<body>
<?php include APPPATH . '/views/templates/left-sidebar.php' ?>
<div class="pusher">
    <?php include APPPATH . '/views/templates/header.php' ?>
    <section>
        <div class="ui container">
            <div class="ui red message">请登陆后再操作</div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<script src="/public/lib/bower_components/jquery/jquery.min.js"></script>
<script src="/public/build/home.js"></script>
</html>