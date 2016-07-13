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
            <?php echo form_open('', array('class' => 'ui form error')); ?>
            <div class="field <?php echo form_error('title') == NULL ? '' : 'error' ?>">
                <label for="title">标题</label>
                <input type="text" name="title" id="title" value="<?php echo set_value('title', $article_title); ?>"/>
            </div>
            <?php echo form_error('title'); ?>
            <div class="field <?php echo form_error('sort[]') == NULL ? '' : 'error' ?>">
                <label>分类</label>
                <div class="inline fields">
                    <?php foreach ($sorts as $sort_item) { ?>
                        <div class="field">
                            <div class="ui checkbox">
                                <input type="checkbox" id="<?php echo $sort_item['sort'] ?>" name="sort[]"
                                       value="<?php echo $sort_item['sort'] ?>"
                                    <?php
                                    $sort_count = count($sort);
                                    for ($i = 0; $i < $sort_count; $i++) {
                                        if ($sort[$i] == $sort_item['sort']) {
                                            echo 'checked';
                                            break;
                                        }
                                    }
                                    ?>>
                                <label for="<?php echo $sort_item['sort'] ?>"><?php echo $sort_item['sort'] ?></label>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
            <?php echo form_error('sort[]'); ?>
            <input type="hidden" id="description" name="description" value="<?php echo set_value('description'); ?>">
            <div class="field <?php echo form_error('content') == NULL ? '' : 'error' ?>">
                <label for="content">内容</label>
                <script id="content" name="content" type="text/plain">
                </script>
            </div>
            <?php echo form_error('content'); ?>
            <?php if (isset($result) && $result === FALSE) { ?>
                <div class="ui error message">
                    <p>error</p>
                </div>
            <?php } else if (isset($result) && $result === TRUE) { ?>
                <div class="ui blue message">
                    <p>seccess</p>
                </div>
            <?php } ?>
            <button class="ui blue button" type="submit">提交</button>
        </div>
</div>
</section>
<?php include APPPATH . '/views/templates/footer.php' ?>
</div>
<script src="/public/lib/bower_components/jquery/jquery.min.js"></script>
<script src="/public/ueditor/ueditor.config.js"></script>
<script src="/public/ueditor/ueditor.all.min.js"></script>
<script src="/public/build/home.js"></script>
<script>
    var editor = UE.getEditor('content');
    editor.ready(function () {
        editor.setContent('<?php echo set_value('content', $article_content, FALSE); ?>');
    });
    $(".ui.blue.button").click(function () {
        $("#description").val(editor.getContentTxt().substring(0, 110));
    });
</script>
</body>
</html>