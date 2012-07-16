<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
</script>
<section class="title">
	<h4><?php echo lang('yudisium_graduate'); ?></h4>
</section>
<section class="item">
<fieldset id="filters">
	<?php echo form_open('/admin/yudisium/print_graduate', 'class="crud"'); ?>
	<ul>
	  <li><?php echo form_dropdown('prodi',array(0=>'Pilih Program Studi','D3' => 'Diploma 3 /D3','Skripsi'=>'Sarjana Strata 1 /S1')); ?></li>
	  <li><?php echo form_dropdown('d_start',$data); ?>  </li> 
	  <li><?php echo form_dropdown('d_finish',$data); ?>  </li>
	  <li><?php $this->load->view('admin/partials/buttons', array('buttons' => array('save'))); ?></li>
	</ul>
	<?php echo form_close(); ?>
</fieldset>
</section>
