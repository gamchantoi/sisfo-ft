<fieldset id="filters">
	
	<legend>Cari Dosen</legend>
	
	<?php echo form_open('admin/yudisium/lecturez/ajax_filter'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
			<li><label for="f_nip">NIP</label><?php echo form_input('f_nip'); ?></li>
			<li><label for="f_name">Nama Dosen</label><?php echo form_input('f_name'); ?></li>
			<li><?php echo anchor(current_url() . '#', lang('buttons.cancel'), 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>