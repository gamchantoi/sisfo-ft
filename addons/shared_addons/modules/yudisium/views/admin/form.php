<section class="title">
<?php if ($this->method == 'create'): ?>
	<h4><?php echo lang('yudisium_create_title'); ?></h4>
<?php else: ?>
	<h4><?php echo sprintf(lang('yudisium_edit_title'), $data->name); ?></h4>
<?php endif; ?>
</section>

<section class="item">
	
<?php echo form_open(uri_string(), 'class="crud"'); ?>

<div class="tabs">
	<ul class="tab-menu">
		<li><a href="#tab1"><span>Profile</span></a></li>
		<li><a href="#tab2"><span>Data Sekolah</span></a></li>
		<li><a href="#tab3"><span>Tugas Akhir</span></a></li>
	</ul>
	
	<!-- Content tab -->
	<div class="form_inputs" id="tab1">
		
		<fieldset>
	
		<ul>
			<?php if($this->method == 'edit'): ?>
			<li class="even">
				<label for="name"><?php echo lang('yudisium_date_in'); ?></label>
				<div class="input"><?php echo form_input('date',$data->date,'id="d_input"');  ?></div>			
			</li>
			<li class="even">
				<label for="name"><?php echo lang('yudisium_name'); ?></label>
				<div class="input"><?php echo form_input('name',htmlspecialchars_decode($data->name), 'maxlength="100" id="name"'); ?></div>			
			</li>
			<?php else : ?>
			<li class="even">
				<label for="name"><?php echo lang('yudisium_name'); ?></label>
				<div class="input"><?php echo form_input('name',htmlspecialchars_decode($data->name), 'maxlength="100" id="name"'); ?></div>			
			</li>	
			<?php endif; ?>
			<li>
				<label for="nim"><?php echo lang('yudisium_nim'); ?></label>
				<div class="input"><?php echo form_input('nim',$data->nim, 'maxlength="100" class="width-20"'); ?></div>
			</li>
			
			<li class="even">
				<label for="department"><?php echo lang('yudisium_department'); ?></label>	
				<div class="input"><?php echo form_dropdown('department', $prodies,$data->department,'class="department"'); ?></div>
			</li>
			<?php if($this->method == 'edit'): ?>
			<li>
				<label for="pa"><?php echo lang('yudisium_pa')?></label>
				<div class="input"><?php echo form_dropdown('pa',$lectures,$data->pa); ?></div>
			</li>
			<?php else : ?>
			<li>
				<label for="pa"><?php echo lang('yudisium_pa')?></label>
				<div class="input"><?php echo form_dropdown('pa',$lectures,$data->lecture); ?></div>
			</li>
			<?php endif; ?>
			<li class="even">
				<label for="religion"><?php echo lang('yudisium_religion')?></label>
				<div class="input"><?php echo form_dropdown('religion',$religions,$data->religion); ?></div>
			</li>
			<li>
				<label for="gender"><?php echo lang('yudisium_gender')?></label>
				<div class="input"><?php echo form_dropdown('sex',array('0'=>'Jenis Kelamin','L'=>'Laki-laki','P'=>'Perempuan'),$data->sex); ?></div>
			</li>
			<li class="even">
				<label for="merriage"><?php echo lang('yudisium_merriage')?></label>
				<div class="input"><?php echo form_dropdown('meriage',array('0'=>'-Status-','Kawin'=>'Kawin','Belum Kawin'=>'Belum Kawin'),$data->meriage); ?></div>
			</li>
			<li>
				<label for="place_of_birth"><?php echo lang('yudisium_pob') ?>/<?php echo lang('yudisium_dob') ?>:</label>
				<div class="input datetime_input"><?php echo form_input('place_of_birth',$data->place_of_birth); ?> : <?php echo form_input('date_of_birth',$data->date_of_birth,'id="d_dob"'); ?></div>
			</li>
			<li class="even">
				<label for="address"><?php echo lang('yudisium_address')?></label>
				<br style="clear: both;" />
				<?php echo form_textarea(array('id' => 'address', 'name' => 'address', 'value' => $data->address, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
			</li>
			<li>
				<label for="parrent"><?php echo lang('yudisium_parrent')?></label>
				<div class="input"><?php echo form_input('parrent',$data->parrent); ?></div>
			</li>
			<li class="even">
				<label for="parrent-address"><?php echo lang('yudisium_parrent_address')?></label>
				<br style="clear:both"/>
				<?php echo form_textarea(array('id' => 'parrent_address', 'name' => 'parrent_address', 'value' => $data->parrent_address, 'rows' => 5, 'class' => 'wysiwyg-simple')); ?>
			</li>
		</ul>
		
		</fieldset>
	</div>
	<div class="form_inputs" id="tab2">
		<fieldset>
		<ul>
			<li>
				<label for="parrental"><?php echo lang('yudisium_parental')?></label>
				<div class="input"><?php echo form_dropdown('parrental',array('0'=>'-PBU/UTUL/PKS-','PBU'=>'PBU','UTUL'=>'UTUL','PKS'=>'PKS'),$data->parrental); ?></div>
			</li>
			<li class="even">
				<label for="soo"><?php echo lang('yudisium_soo')?></label>
				<div class="input"><?php echo form_input('soo',$data->soo); ?></div>
			</li>
			<li>
				<label for="sma">Jika SMA</label>
				<div class="input"><?php echo form_dropdown('sma',array('0'=>'-IPA/IPS-','IPA'=>'SMA IPA','IPS'=>'SMA IPS'),$data->sma); ?></div>
			</li>
			<li>
				<label for="school-address"><?php echo lang('yudisium_school_address')?></label>
				<?php echo form_textarea('school_address',$data->school_address); ?>
			</li>
		</ul>
		</fieldset>
	</div>
	<div class="form_inputs" id="tab3">
		<fieldset>
		<ul>
			<li>
				<label for="graduation"><?php echo lang('yudisium_graduation')?></label>
				<div class="input datetime_input">
				<?php echo form_input('graduation',$data->graduation,'id="graduation"'); ?>
				<label for="ipk"><?php echo lang('yudisium_ipk')?></label>
				<?php echo form_input('ipk',$data->ipk); ?>
				<label for="sks"><?php echo lang('yudisium_sks')?></label>
				<?php echo form_input('sks',$data->sks); ?>
				</div>
				
			</li>
			<li>
				<label for="thesis"><?php echo lang('yudisium_thesis')?></label>
				<?php echo form_dropdown('thesis',array('0'=>'-Tugas Akhir-','Skripsi'=>'Skripsi','Bukan Skripsi'=>'Bukan Skripsi','D3'=>'D3'),$data->thesis); ?>
			</li>
			<li>
				<label for="thesis_title"><?php echo lang('yudisium_thesis_title')?></label>
				<?php echo form_textarea('thesis_title',$data->thesis_title); ?>
			</li>
			<li>
				<label for="lecture"><?php echo lang('yudisium_lecture')?></label>
				<?php echo form_dropdown('lecture',$lectures,$data->lecture); ?>
			</li>
			
			<li>
				<label for="start"><?php echo lang('yudisium_start')?></label>
				<div class="input datetime_input">
				<?php echo form_input('start',$data->start,'id="d_start"'); ?>
				<label for="finish"><?php echo lang('yudisium_finish')?></label>
				<?php echo form_input('finish',$data->finish,'id="d_finish"'); ?>
				</div>
			</li>
			<li>
				<label for="yudisium_date"><?php echo lang('yudisium_date')?></label>
				<div class="input dateime_input">
				<?php echo form_input('yudisium_date',$data->yudisium_date,'id="d_yudis"'); ?>
				</div>
			</li>
			<li>
				<label for="email_phone"><?php echo lang('yudisium_phone')?> & <?php echo lang('yudisium_email')?></label>
				<div class="input">
				<?php echo form_input('phone',$data->phone); ?>
				<?php echo form_input('email',$data->email); ?>
				</div>
						
			</li>
				
		</ul>
		</fieldset>
	</div>

</div>

<div class="buttons float-right padding-top">
	<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save', 'save_exit', 'cancel'))); ?>
</div>

<?php echo form_close(); ?>

</section>

<style type="text/css">
form.crudli.date-meta div.selector {
    float: left;
    width: 30px;
}
form.crud li.date-meta div input#datepicker { width: 8em; }
form.crud li.date-meta div.selector { width: 5em; }
form.crud li.date-meta div.selector span { width: 1em; }
form.crud li.date-meta label.time-meta { min-width: 4em; width:4em; }
</style>