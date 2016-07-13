<div class="ui vertical pointing menu">
    <a class="item <?php echo $sort == 'all' ? 'active' : '' ?>" href="<?php echo site_url('media/articles/all') ?>">
        ALL
        <div class="ui black label"><?php echo $count; ?></div>
    </a>
    <?php foreach ($sorts as $sort_item) { ?>
        <a class="item <?php echo urldecode($sort) == strtolower($sort_item['sort']) ? 'active' : '' ?>"
           href="<?php echo site_url('media/articles/' . strtolower($sort_item['sort'])) ?>">
            <?php echo $sort_item['sort']; ?>
            <div class="ui black label"><?php echo $sort_item['count']; ?></div>
        </a>
    <?php } ?>
    <a class="item <?php echo $sort == 'search' ? 'active' : '' ?>">
        <?php echo form_open('/media/search_f', array('class' => 'ui transparent icon input')); ?>
        <input type="text" name="searchKey" value="<?php if (isset($keywords)) {
            echo $keywords;
        } ?>" placeholder="Search ..." size="20"><i class="search icon"></i>
        </form>
    </a>
</div>