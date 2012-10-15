<fieldset id="filters">
	
	<legend>Cari Surat Keputusan Dekan</legend>
	
	<?php echo form_open('admin/yudisium/decrees/ajax_filter'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
			<li><label for="f_date">Tanggal</label><?php echo form_input('f_date'); ?></li>
			<li><label for="f_number">Nomor</label><?php echo form_input('f_number'); ?></li>
			<li><?php echo anchor(current_url() . '#', lang('buttons.cancel'), 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>