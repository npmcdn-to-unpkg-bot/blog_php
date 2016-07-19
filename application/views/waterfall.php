<!DOCTYPE html>
<html lang="en">
<head>
    <?php include APPPATH . '/views/templates/meta.php' ?>
    <link rel="stylesheet" href="/public/build/home.css">
    <style>
        h3 {
            line-height: 3em;
            text-align: center;
            color: transparent;
            text-shadow: 0 0 1px rgba(0, 0, 0, .6);
        }

        .grid {
            margin: 0 auto;
        }

        .grid-item {
            width: 236px;
            padding: 14px 7px 0 7px;
            box-sizing: border-box;
        }

        @media only screen and (max-width: 748px) {
            .grid {
                width: 100%;
            }

            .grid-item {
                width: 50%;
            }
        }

        @media only screen and (min-width: 748px) {
            .grid {
                width: 708px;
            }
        }

        @media only screen and (min-width: 984px) {
            .grid {
                width: 944px;
            }
        }

        @media only screen and (min-width: 1220px) {
            .grid {
                width: 1180px;
            }
        }

        @media only screen and (min-width: 1456px) {
            .grid {
                width: 1416px;
            }
        }

        img {
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 10px 20px 0 rgba(0, 0, 0, .3);
        }
    </style>
</head>
<body>
<?php include APPPATH . '/views/templates/left-sidebar.php' ?>
<div class="pusher">
    <?php include APPPATH . '/views/templates/header.php' ?>
    <section>
        <h3>WATERFALL</h3>
        <div class="grid">
            <div class="grid-item">
                <img src="/public/imgs/model1.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model2.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model3.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model4.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model5.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model6.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model7.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model8.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model9.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model10.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model11.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model12.png">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model13.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model15.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model16.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model17.jpg">
            </div>
            <div class="grid-item">
                <img src="/public/imgs/model18.jpg">
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<?php include APPPATH . '/views/templates/script.php' ?>
<script src="/public/lib/bower_components/masonry/dist/masonry.pkgd.min.js"></script>
<script src="/public/build/home.js"></script>
<script>
    $(function () {
        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
        });
    })
</script>
</html>