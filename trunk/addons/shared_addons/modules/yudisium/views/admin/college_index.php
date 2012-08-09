<section class="title">
	<h4>Data Mahasiswa</h4>
</section>
<section class="item">
<?php if ($data) : ?>

<?php echo $this->load->view('admin/partials/filter_college'); ?>

<div id="filter-stage">

	<?php echo form_open('admin/yudisium/mahasiswa/action'); ?>

		<?php echo $this->load->view('admin/tables/college'); ?>
      

	<?php echo form_close(); ?>
	
</div>

<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>

</section>
