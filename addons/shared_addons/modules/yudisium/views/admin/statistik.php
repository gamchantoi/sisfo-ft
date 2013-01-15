<section class="title">
	<h4>Statistik Lulusan</h4>
</section>
<section class="item">
<fieldset id="filters">
        <legend>Statistik Tahunan</legend>
	<?php echo form_open('/admin/yudisium/statistik', 'class="crud"'); ?>
	<ul>
	  <li><?php echo form_dropdown('tahun',$tahun); ?></li>
	  <li><?php $this->load->view('admin/partials/buttons', array('buttons' => array('publish'))); ?></li>
	</ul>
	<?php echo form_close(); ?>
</fieldset>
<fieldset id="filters">
        <legend>Statistik Bulanan</legend>
	<?php echo form_open('/admin/yudisium/stat_bulanan', 'class="crud"'); ?>
	<ul>
	  <li><?php echo form_dropdown('bulan',$bulan); ?></li>
          <li><?php echo form_dropdown('tahun',$tahun); ?></li>
	  <li><?php $this->load->view('admin/partials/buttons', array('buttons' => array('publish'))); ?></li>
	</ul>
	<?php echo form_close(); ?>
</fieldset>
</section>