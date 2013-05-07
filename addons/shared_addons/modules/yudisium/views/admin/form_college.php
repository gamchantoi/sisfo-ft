<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('yudisium_college_create'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('yudisium_college_edit'), $data->name); ?></h4>
<?php endif; ?>
</section>

<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
    <div class="form_inputs">
        <fieldset>
            <ul>
                <li class="even">
		    <label for="name">Nama Mahasiswa</label>
		    <div class="input"><?php echo form_input('name',htmlspecialchars_decode($data->name), 'maxlength="100" id="name"'); ?></div>			
		</li>
                <li class="even">        
		    <label for="nim"><?php echo lang('yudisium_nim'); ?></label>
		    <div class="input"><?php echo form_input('nim',$data->nim, 'maxlength="100" class="width-20"'); ?></div>			
                </li>
                <li class="even">
		    <label for="department"><?php echo lang('yudisium_department'); ?></label>	
		    <div class="input"><?php echo form_dropdown('department', $prodies,$data->department,'class="department"'); ?></div>
		</li>
            </ul>
        </fieldset>
    </div>
    <div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save_exit', 'cancel'))); ?>
</div>
<?php echo form_close(); ?>
</section>
