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
            <div class="img-container"><img id="image" src="public/imgs/cat.jpeg"></div>
            <div class="docs-preview clearfix">
                <div class="img-preview preview-lg"></div>
                <div class="img-preview preview-md"></div>
                <div class="img-preview preview-sm"></div>
                <div class="img-preview preview-xs"></div>
            </div>
            <div class="ui form">
                <div class="ui button" type="button" data-method="reset" title="Reset"><i class="refresh icon"></i>
                </div>
                <input class="sr-only" id="inputImage" type="file" name="file" accept="image/*">
                <div class="ui button" type="button" data-method="getCroppedCanvas"><i class="upload icon"></i></div>
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<?php include APPPATH . '/views/templates/script.php' ?>
<script src="/public/build/home.js"></script>
</html>