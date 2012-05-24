
<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
  </script>
<section class="title">
	<h4><?php echo lang('yudisium_title'); ?></h4>
</section>

<section class="item">
<?php if ($data) : ?>

<?php echo $this->load->view('admin/partials/filters'); ?>

<div id="filter-stage">

	<?php echo form_open('admin/yudisium/action'); ?>

		<?php echo $this->load->view('admin/tables/yudis'); ?>

	<?php echo form_close(); ?>
	
</div>

<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>

</section>
