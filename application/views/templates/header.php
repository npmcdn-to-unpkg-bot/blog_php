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
                    <div class="ui item dropdown">
                        <i class="world icon"></i>
                        <div class="menu">
                            <div class="item"><i class="cn flag"></i>Chinese</div>
                            <div class="item"><i class="us flag"></i>English</div>
                        </div>
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
                <?php //echo anchor('/opus', 'OPUS', array('class' => 'item')); ?>
                <?php //echo anchor('/about', 'ABOUT', array('class' => 'item')); ?>
                <div class="right menu">
                    <a class="ui item" href="<?php if (isset($session)) {
                        echo site_url('account/center');
                    } else {
                        echo site_url('account/sign_in');
                    } ?>"><i class="user icon"></i></a>
                    <div class="ui item dropdown"><i class="world icon"></i>
                        <div class="menu">
                            <div class="item"><i class="cn flag"></i>Chinese</div>
                            <div class="item"><i class="us flag"></i>English</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>