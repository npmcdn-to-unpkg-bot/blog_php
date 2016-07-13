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
            <div class="ui grid">
                <div class="four wide column">
                    <div class="ui vertical fluid tabular menu"><a class="active item">Bio</a><a class="item">Pics</a><a
                            class="item">Companies</a><a class="item">Links</a></div>
                </div>
                <div class="twelve wide stretched column">
                    <div class="ui segment">
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                        This is an stretched grid column. This segment will always match the tab height
                    </div>
                </div>
            </div>
            <table class="ui grey table">
                <thead>
                <tr>
                    <th>name</th>
                    <th>status</th>
                    <th>notes</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>John</td>
                    <td>Approved</td>
                    <td>None</td>
                </tr>
                <tr>
                    <td>Jamie</td>
                    <td>Approved</td>
                    <td>Requires call</td>
                </tr>
                <tr>
                    <td>Jill</td>
                    <td>Denied</td>
                    <td>None</td>
                </tr>
                </tbody>
            </table>
            <div class="ui styled fluid accordion">
                <div class="title active"><i class="dropdown icon"></i>What is a dog?</div>
                <div class="content active">
                    <p class="transition visible" style="display: block !important">A dog is a type of domesticated
                        animal. Known for its loyalty and faithfulness, it can be found as a welcome guest in many
                        households across the world.</p></p>
                </div>
                <div class="title"><i class="dropdown icon"></i>What kinds of dogs are there?</div>
                <div class="content">
                    <p class="transition hidden">There are many breeds of dogs. Each breed varies in size and
                        temperament. Owners often select a breed of dog that they find to be compatible with their own
                        lifestyle and desires from a companion.</p></p>
                </div>
                <div class="title"><i class="dropdown icon"></i>How do you acquire a dog?</div>
                <div class="content">
                    <p class="transition hidden">Three common ways for a prospective owner to acquire a dog is from pet
                        shops, private owners, or shelters.</p></p>
                    <p class="transition hidden">A pet shop may be the most convenient way to buy a dog. Buying a dog
                        from a private owner allows you to assess the pedigree and upbringing of your dog before
                        choosing to take it home. Lastly, finding your dog from a shelter, helps give a good home to a
                        dog who may not find one so readily.</p></p>
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