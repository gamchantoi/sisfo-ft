<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('yudisium_decrees_create'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('yudisium_decrees_edit'), $data->number); ?></h4>
<?php endif; ?>
</section>

<section class="item">
<?php echo form_open(uri_string(), 'class="crud"'); ?>
    <div class="form_inputs">
        <fieldset>
            <ul>
                <li class="even">
		    <label for="name">Nomor SK</label>
		    <div class="input"><?php echo form_input('number',$data->number, 'maxlength="100" '); ?></div>			
		</li>
                <li class="even">        
		    <label for="nim"><?php echo lang('yudisium_date'); ?></label>
		    <div class="input"><?php echo form_input('date',$data->date, 'id="date"'); ?></div>			
                </li>
                <li class="even">
		    <label for="department"><?php echo lang('yudisium_ant_code'); ?></label>	
		    <div class="input"><?php echo form_dropdown('ant', array('N' => 'N','a' =>'Bln pertama/ A','b' =>'Bln kedua/ B','c' => 'Bln ketiga/ C','d' => 'Bln keempat/ D'),$data->ant,'class="department"'); ?></div>
		</li>
            </ul>
        </fieldset>
    </div>
    <div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>
<?php echo form_close(); ?>
</section>
