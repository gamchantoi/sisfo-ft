<fieldset id="filters">
	
	<legend><?php echo lang('global:filters'); ?></legend>
	
	<?php echo form_open('admin/yudisium/ajax_filter'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
			<li>
        		<?php echo lang('yudisium_p_status_label', 'f_printed'); ?>
        		<?php echo form_dropdown('f_printed', array('all' =>lang('yudisium_all_label'), '2'=>lang('yudisium_no_printed_label'), '1'=>lang('yudisium_printed_label'))); ?>
    		</li>
		
		<!--<li>
        		<?php echo lang('yudisium_date_in', 'f_datein'); ?>
        		<?php echo form_input('f_datein', '', 'maxlength="10" id="datepicker" class="text width-20"'); ?>
			</li>
		-->	
			<li><?php echo lang('yudisium_nim', 'f_nim'); ?><?php echo form_input('f_nim'); ?></li>
			<li><?php echo lang('yudisium_name', 'f_name'); ?><?php echo form_input('f_name'); ?></li>
			<li><?php echo anchor(current_url() . '#', lang('buttons.cancel'), 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>