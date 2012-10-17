<fieldset id="filters">
	
	<legend>Cari SK Bebas Teori</legend>
	
	<?php echo form_open('admin/bebas/ajax_filter'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
			<li><?php echo lang('bt_nim_label', 'f_nim'); ?><?php echo form_input('f_nim'); ?></li>
			<li><?php echo lang('bt_nama_label', 'f_nama'); ?><?php echo form_input('f_nama'); ?></li>
			<li><?php echo anchor(current_url() . '#', lang('buttons.cancel'), 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>