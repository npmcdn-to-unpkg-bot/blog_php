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
            <div class="ui comments">
                <form class="ui reply form">
                    <div class="field">
                        <script id="content" name="content" type="text/plain"></script>
                    </div>
                    <div class="ui blue labeled submit icon button"><i class="edit icon"></i>add comment</div>
                </form>
                <h3 class="ui dividing header">COMMENTS</h3>
                <div class="comment-list">
                    <?php foreach ($article_comment as $comments) { ?>

                        <div class="comment">
                            <a class="avatar"><img src="/public/imgs/lena.png"></a>
                            <div class="content">
                                <a class="author"><?php echo $comments['name'] ?></a>
                                <div class="metadata"><span class="date"><?php echo $comments['date'] ?></span></div>
                                <div class="text"><?php echo $comments['comment'] ?></div>
                                <div class="actions" data-type="comments" data-id="<?php echo $comments['id'] ?>"
                                     data-owner="<?php echo $comments['user_id'] ?>">
                                    <a class="reply">Reply</a>
                                    <?php
                                    if ($session['id'] == $comments['user_id']) echo '<a class="reply delete">Delete</a>'
                                    ?>
                                </div>
                            </div>
                            <div class="comments">
                                <?php foreach ($comments['down_comment'] as $comments_down) { ?>
                                    <div class="comment">
                                        <a class="avatar"><img src="/public/imgs/lena.png"></a>
                                        <div class="content">
                                            <a class="author"><?php echo $comments_down['user'] ?></a> to
                                            <a class="author"><?php echo $comments_down['owner'] ?></a>
                                            <div class="metadata"><span
                                                    class="date"><?php echo $comments_down['date'] ?></span></div>
                                            <div class="text"><?php echo $comments_down['comment'] ?></div>
                                            <div class="actions" data-type="comment-down"
                                                 data-id="<?php echo $comments_down['id'] ?>"
                                                 data-owner="<?php echo $comments_down['user_id'] ?>">
                                                <a class="reply">Reply</a>
                                                <?php
                                                if ($session['id'] == $comments_down['user_id']) echo '<a class="reply delete">Delete</a>'
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
    <?php include APPPATH . '/views/templates/footer.php' ?>
</div>
</body>
<?php include APPPATH . '/views/templates/script.php' ?>
<script src="/public/ueditor/ueditor.config.js"></script>
<script src="/public/ueditor/ueditor.all.min.js"></script>
<script src="/public/build/home.js"></script>
<script>
    var editor = UE.getEditor('content', {
        toolbars: [
            ['bold', 'italic', 'emotion', 'insertcode']
        ],
        enableContextMenu: false,
        maximumWords: 1000,
        wordCountMsg: '{#count}/{#leave}',
        elementPathEnabled: false,
        initialFrameHeight: 180,
        scaleEnabled: false
    });
    $(function () {
        $(".ui.comments form .button").click(function () {
            $.ajax({
                type: "post",
                url: "<?php echo site_url('/media/comment/create_comment'); ?>",
                data: {
                    article_id: <?php echo $news_item['id'];?>,
                    comment: editor.getContent()
                },
                error: function () {
                    alert("error");
                },
                success: function (data) {
                    if (data === 'ture') {
                        var comment = '<div class="comment"><a class="avatar"><img src="/public/imgs/lena.png"></a>' +
                            '<div class="content"><a class="author"><?php echo $session['name']?></a>' +
                            '<div class="metadata"><span class="date">' + (new Date()).toTimeString() + '</span></div>' +
                            '<div class="text">' + editor.getContent() + '</div>' +
                            '</div>' +
                            '</div>';
                        $(comment).prependTo(".ui.comments .comment-list");
                    } else {
                        alert(data);
                    }
                }
            });
        });
        $(".ui.comments .comment .actions a.delete").click(function () {
            var $this = $(this);
            $.ajax({
                type: "post",
                url: "<?php echo site_url('/media/comment/delete_comment'); ?>",
                data: {
                    type: $this.parent().attr('data-type'),
                    id: $this.parent().attr('data-id')
                },
                error: function () {
                    alert("error");
                },
                success: function (data) {
                    if (data === 'ture') {
                        $this.parent().parent().parent().remove();
                    } else {
                        alert(data);
                    }
                }
            });
        })
    })
</script>
</html>
