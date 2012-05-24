<fieldset id="filters">
	
	<legend><?php echo lang('global:filters'); ?></legend>
	
	<?php echo form_open('admin/prakerin/ajax_search'); ?>

	<?php echo form_hidden('f_module', $module_details['slug']); ?>
		<ul>  
		<li>
        		<?php echo lang('prakerin_p_status_label', 'f_printed'); ?>
        		<?php echo form_dropdown('f_printed', array('all' =>lang('prakerin_all_label'), '2'=>lang('prakerin_no_printed_label'), '1'=>lang('prakerin_printed_label'))); ?>
    		</li>
		<li>
        		<?php echo lang('prakerin_name', 'f_name'); ?>
        		<?php echo form_input('f_name'); ?>
		</li>
			
			<li><?php echo lang('prakerin_nim', 'f_nim'); ?><?php echo form_input('f_nim'); ?></li>
			<li><?php echo anchor(current_url() . '#', lang('buttons.cancel'), 'class="cancel"'); ?></li>
		</ul>
	<?php echo form_close(); ?>
</fieldset>