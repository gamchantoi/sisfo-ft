<fieldset id="filters">
	
	<legend>Cari Data Mahasiswa</legend>
	
	<?php echo form_open('admin/yudisium/college/ajax_filter'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
			<li><?php echo lang('yudisium_nim', 'f_nim'); ?><?php echo form_input('f_nim'); ?></li>
			<li><?php echo lang('yudisium_name', 'f_keywords'); ?><?php echo form_input('f_keywords'); ?></li>
			<li><?php echo anchor(current_url() . '#', 'Cari', 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>