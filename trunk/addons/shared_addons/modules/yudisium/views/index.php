<script>
        $(document) .ready(function(){
	$("#nim").change(function(){
            var nim = $("#nim").val();
		$.ajax({
		   type : "POST",
		   url  : "<?php echo base_url(); ?>index.php/yudisium/prodi",
		   data : "nim=" + nim,
		   success: function(data){
		       $("#profile").html(data);
		   }
		});
		});
	});
</script>

<?php
$now = date('Y-m-d H:m:s');
$time_now = strtotime($now);
$time_expired = strtotime($expired);
if ($time_now >= $time_expired){
	?>
	<h2 id="page_title" class="page-title">PENDAFTARAN YUDISIUM TELAH DITUTUP</h2>
	<?php
}else{
?>
	<?php echo $now."<br>".$expired."<br>".$time_now."<br>".$time_expired; ?>
	<h2 id="page_title" class="page-title"><?php echo lang('yudisium_add') ?></h2>
<div>
	<?php if(validation_errors()):?>
	<div class="error-box">
		<?php echo validation_errors();?>
	</div>
	<?php endif;?>
	<?php echo form_open('yudisium/create', array('id'=>'user_edit'));?>

	<fieldset id="user_names">
		<legend><?php echo lang('yudisium_profile') ?></legend>
		<ul>
			<li class="float-left spacer-right">
				<label for="name"><?php echo lang('yudisium_nim') ?></label>
				<?php echo form_input('nim','','id="nim"'); ?>
				
			</li>

			<li class="multiple_fields">
				<div class="fields2" id="profile">
					<!--
					<div>
						<label for="nim"><?php echo lang('yudisium_nim') ?></label>
						<?php echo form_input('nim'); ?>
					</div>
					<div>
						<label for="department"><?php echo lang('yudisium_department') ?></label>
						<?php echo form_dropdown('department', $prodies,'','class="department"'); ?>
					</div>
					<div>
						<label for="lecture"><?php echo lang('yudisium_pa')?></label>
						<?php echo form_dropdown('pa',$lectures); ?>
					</div>
					-->
				</div>
			</li>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="religion"><?php echo lang('yudisium_religion')?></label>
						<?php echo form_dropdown('religion',$religions); ?>
					</div>
					<div>
						<label for="gender"><?php echo lang('yudisium_gender')?></label>
						<?php echo form_dropdown('gender',array('0'=>'Jenis Kelamin','L'=>'L','P'=>'P')); ?>
					</div>
					<div>
						<label for="merriage"><?php echo lang('yudisium_merriage')?></label>
						<?php echo form_dropdown('merriage',array('Kawin'=>'Kawin','Belum Kawin'=>'Belum Kawin')); ?>
					</div>
				</div>
			</li>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="pob"><?php echo lang('yudisium_pob') ?>:</label>
						<?php echo form_input('pob'); ?>
					</div>
					<div>
						<label for="dob"><?php echo lang('yudisium_dob') ?>:</label>
						<?php echo form_input('dob','','id="datepicker"'); ?>
					</div>
					
				</div>
			</li>
			<li>
				<label for="address"><?php echo lang('yudisium_address')?></label>
				<?php echo form_textarea('address'); ?>
			</li>
			<li>
				<label for="parrent"><?php echo lang('yudisium_parrent')?></label>
				<?php echo form_input('parrent'); ?>
			</li>
			<li>
				<label for="parrent-address"><?php echo lang('yudisium_parrent_address')?></label>
				<?php echo form_textarea('parrent_address'); ?>
			</li>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="parrental"><?php echo lang('yudisium_parental')?></label>
						<?php echo form_dropdown('parrental',array('0'=>'-PBU/UTUL/PKS-','PBU'=>'PBU','UTUL'=>'UTUL','PKS'=>'PKS')); ?>
					</div>
					<div>
						<label for="school">Asal Sekolah</label>
						<?php echo form_dropdown('school',array('SMA'=>'SMA','SMK'=>'SMK','DIII'=>'DIII','MAN DLL' => 'MAN DLL')); ?>
					</div>
					<div>
						<label for="soo">Nama Sekolah</label>
						<?php echo form_input('soo'); ?>
					</div>
				</div>
			</li>
			<li>
				<label for="sma">Jika SMA</label>
				<?php echo form_dropdown('sma',array('0'=>'-IPA/IPS-','IPA'=>'SMA IPA','IPS'=>'SMA IPS')); ?>
			</li>
			
			<li>
				<label for="school-address"><?php echo lang('yudisium_school_address')?></label>
				<?php echo form_textarea('school_address'); ?>
			</li>
		</ul>
	</fieldset>
	<fieldset id="graduate">
		<legend>Diisi Sesuai DHS</legend>
		<ul>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="graduation"><?php echo lang('yudisium_graduation')?></label>
						<?php echo form_input('graduation','','id="graduation"'); ?>
					</div>
					<div>
						<label for="ipk"><?php echo lang('yudisium_ipk')?><i>Gunakan titik (3 titik 75)</i></label>
						<?php echo form_input('ipk'); ?>
					</div>
					<div>
						<label for="sks"><?php echo lang('yudisium_sks')?></label>
						<?php echo form_input('sks'); ?>
					</div>
				
				</div>
			</li>	
		</ul>
	</fieldset>
	<fieldset>
		<legend>Data Tugas Akhir</legend>
		<ul>
			
			<li>
				<label for="thesis"><?php echo lang('yudisium_thesis')?></label>
				<?php echo form_dropdown('thesis',array('0'=>'-Tugas Akhir-','Skripsi'=>'Skripsi','Bukan Skripsi'=>'Bukan Skripsi','D3'=>'D3')); ?>
			</li>
			<li>
				<label for="thesis_title"><?php echo lang('yudisium_thesis_title')?></label>
				<?php echo form_textarea('thesis_title'); ?>
			</li>
			<li>
				<label for="lecture"><?php echo lang('yudisium_lecture')?></label>
				<?php echo form_dropdown('lecture',$lectures); ?>
			</li>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="start"><?php echo lang('yudisium_start')?></label>
						<?php echo form_input('start','','id="start"'); ?>
					</div>
					<div>
						<label for="finish"><?php echo lang('yudisium_finish')?> (ACC Laporan)</label>
						<?php echo form_input('finish','','id="finish"'); ?>
					</div>
					<div>
						<label for="yudisium_date"><?php echo lang('yudisium_date')?></label>
						<?php echo form_input('yudisium_date','','id="date"'); ?>
					</div>
				
				</div>
			</li>
			<li>
				<label for="vacation"><?php echo lang('yudisium_vacation')?></label>
				<?php echo form_dropdown('vacation',$vacations); ?>
			</li>
			<li>
				<label for="antidatir"><?php echo "Habis Masa Studi /Antidatir"?></label>
				<?php echo form_dropdown('antidatir',array('N'=>'Tidak','1'=>'Antidatir Bulan pertama','2'=>'Antidatir Bulan kedua','3'=>'Antidatir Bulan ketiga','4' => 'Antidatir Bulan keempat')); ?>
			</li>
		</ul>
	</fieldset>
	<fieldset>
		<legend>Kontak</legend>
		<ul>
			<li class="multiple_fields">
				<div class="fields2">
					<div>
						<label for="phone"><?php echo lang('yudisium_phone')?></label>
						<?php echo form_input('phone'); ?>
					</div>
					<div>
						<label for="email"><?php echo lang('yudisium_email')?></label>
						<?php echo form_input('email'); ?>
					</div>
				</div>
			</li>
		</ul>
	</fieldset>
	<?php echo form_submit('submit', 'Simpan'); ?>
	<?php echo form_close(); ?>
</div>
<?php
}
?>
