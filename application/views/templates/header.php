<header>
    <div class="nav-bar-min">
        <div class="ui fixed inverted main menu">
            <div class="ui container">
                <a class="icon item" id="sidebar" href="javascript:void(0);"><i class="content icon"></i></a>
                <div class="right menu">
                    <div class="vertically fitted borderless item">
                        <a href="
                        <?php if (isset($session)) {
                            echo site_url('account/center');
                        } else {
                            echo site_url('account/sign_in');
                        } ?>">
                            <i class="user icon"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="nav-bar-max">
        <div class="ui inverted menu">
            <div class="ui container">
                <?php //echo anchor('/home', 'HOME', array('class' => 'item')); ?>
                <?php echo anchor('/media', 'MEDIA', array('class' => 'item')); ?>
                <?php echo anchor('/account/waterfall', 'FALL', array('class' => 'item')); ?>
                <?php //echo anchor('/about', 'ABOUT', array('class' => 'item')); ?>
                <div class="right menu">
                    <a class="ui item" href="<?php if (isset($session)) {
                        echo site_url('account/center');
                    } else {
                        echo site_url('account/sign_in');
                    } ?>"><i class="user icon"></i></a>
                </div>
            </div>
        </div>
    </div>
</header>