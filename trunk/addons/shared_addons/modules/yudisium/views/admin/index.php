
<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
</script>
<section class="title">
	<h4>Pendaftaran Yudisium</h4>
</section>
<section class="item">
	<div>
	  <table>
	    <thead>
	      <tr>
		<th>Jumlah pendaftar bulan ini</th>
		<th>Jumlah pendaftar hari ini</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
		<td><h1><?php echo $this_month; ?></h1></td>
		<td><h1>1234</h1></td>
	      </tr>
	    </tbody>
	  </table>
	</div>
</section>
<section class="title">
	<h4>Lulusan</h4>
</section>
<section class="item">
  <div>
    <table>
      <thead>
	<tr>
	  <th>Antidatir Periode</th>
	  <th>Jumlah</th>
	  <th>Yudisium periode Normal</th>
	  <th>Jumlah</th>
	  <th>Download</th>
	</tr>
      </thead>
      <tbody>
	<?php
	  foreach ($yudisium as $yudi)
	  {
	    ?>
	    <tr><td><?php echo tanggal($yudi->yudisium_date); ?></td><td><?php echo get_antidatir($yudi->yudisium_date);?></td><td><?php echo tanggal($yudi->yudisium_date); ?></td><td><?php echo get_yudis_normal($yudi->yudisium_date); ?></td><td><a href="admin/yudisium/export_all_data/<?php echo $yudi->yudisium_date; ?>" title="Download Lampiran SK Yudisium Mahasiswa D3"><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td></tr>
	<?php
	  }
	?>
      </tbody>
    </table>
  </div>
</section>
<section class="title">
	<h4>Salah Entri</h4>
</section>
<section class="item">
  <div>
    <table>
      <thead>
	<tr>
	  <th>Nama</th>
	  <th>Nim</th>
	  <th>Tanggal Lulus</th>
	  <th>Tanggal Yudisium</th>
	</tr>
      </thead>
      <tbody>
	<?php
	  foreach ($error_d as $y)
	  {
	    ?>
	    <tr><td><?php echo $y->name; ?></td><td><?php echo $y->nim;?></td><td><?php echo tanggal($y->graduation); ?></td><td><?php echo tanggal($y->yudisium_date);?></td></tr>
	<?php
	  }
	?>
      </tbody>
    </table>
  </div>
</section>
<section class="title">
	<h4><?php echo lang('yudisium_title'); ?></h4>
</section>

<section class="item">
<?php if ($data) : ?>

<?php echo $this->load->view('admin/partials/filters'); ?>

<?php echo form_open('admin/yudisium/action'); ?>
<div id="filter-stage">
      <?php echo $this->load->view('admin/tables/yudis'); ?>
</div>
<?php echo form_close(); ?>
<div>
    <?php $this->load->view('admin/partials/pagination'); ?>  
</div>
<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>

</section>