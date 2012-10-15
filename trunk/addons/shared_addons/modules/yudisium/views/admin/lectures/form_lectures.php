<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('yudisium_lectures_create'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('yudisium_lectures_edit'), $data->name); ?></h4>
<?php endif; ?>
</section>

<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
    <div class="form_inputs">
        <fieldset>
            <ul>
                <li class="even">
		    <label for="name">NIP</label>
		    <div class="input"><?php echo form_input('nip',$data->nip, 'maxlength="100" '); ?></div>			
		</li>
                <li class="even">        
		    <label for="nim"><?php echo lang('yudisium_name'); ?></label>
		    <div class="input"><?php echo form_input('name',$data->name, 'id="date"'); ?></div>			
                </li>
                <li class="even">
		    <label for="department"><?php echo lang('yudisium_major'); ?></label>	
		    <div class="input"><?php echo form_dropdown('major',$jurusan,$data->major); ?></div>
		</li>
            </ul>
        </fieldset>
    </div>
    <div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>
<?php echo form_close(); ?>
</section>
