<section class="title">
    <h4>Surat Keputusan Dekan</h4>
</section>
<section class="item">
    <?php if ($lectures) : ?>
    <?php echo $this->load->view('admin/partials/filter_lectures'); ?>
    <?php echo form_open('admin/yudisium/lectures/action'); ?>
    <div id="filter-stage">
        <?php echo $this->load->view('admin/tables/lectures')?>
    </div>
    <?php echo form_close(); ?>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>
</section>