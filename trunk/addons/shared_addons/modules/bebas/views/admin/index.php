<section class="title">
    <h4><?php echo lang('bt_label');?></h4>
</section>
<section class="item">
<?php print_r(get_printed('4')); ?>
</section>
<section class="item">
    <?php if ($bebas) : ?>
    <?php echo $this->load->view('admin/partials/filter'); ?>
    <?php echo form_open('admin/bebas/action'); ?>
    <div id="filter-stage">
        <?php echo $this->load->view('admin/tables/bebas')?>
    </div>
    <?php echo form_close(); ?>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('bt_currently_no_data'); ?></div>
<?php endif; ?>
</section>