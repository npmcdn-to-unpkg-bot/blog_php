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
            <div class="ui two column middle aligned very relaxed stackable grid">
                <div class="column">
                    <?php echo form_open('', array('class' => 'ui form error')); ?>
                    <div class="field <?php echo form_error('username') == NULL ? '' : 'error' ?>">
                        <label for="username">NAME</label>
                        <div class="ui left icon input">
                            <input id="username" type="text" name="username"
                                   value="<?php echo set_value('username'); ?>" placeholder="Your name">
                            <i class="user icon"></i>
                        </div>
                    </div>
                    <?php echo form_error('username'); ?>
                    <div class="field <?php echo form_error('password') == NULL ? '' : 'error' ?>">
                        <label for="password">PASSWORD</label>
                        <div class="ui left icon input">
                            <input id="password" type="password" name="password"
                                   value="<?php echo set_value('password'); ?>" placeholder="Your password">
                            <i class="lock icon"></i>
                        </div>
                    </div>
                    <?php echo form_error('password'); ?>
                    <?php if (isset($result) && $result === FALSE) { ?>
                        <div class="ui error message">
                            <p>Sign In error</p>
                        </div>
                    <?php } else if (isset($result) && $result === TRUE) { ?>
                        <div class="ui blue message">
                            <p>Sign In seccess</p>
                        </div>
                    <?php } ?>
                    <button class="ui blue button" type="submit">Sign in</button>
                    </form>
                </div>
                <div class="ui vertical divider">OR</div>
                <div class="center aligned column">
                    <a class="ui big green labeled icon button" href="<?php echo site_url('account/sign_up'); ?>">
                        <i class="signup icon"></i>Sign Up</a>
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