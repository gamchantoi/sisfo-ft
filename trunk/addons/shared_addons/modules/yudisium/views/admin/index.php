
<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
</script>

<section class="title">
	<h4>Antidatir</h4>
</section>
<section class="item">
  <div>
    <table>
      <thead>
	<tr>
	  <th>Periode</th>
	  <th>Jumlah</th>
	</tr>
      </thead>
      <tbody>
	<?php
	  foreach ($yudisium as $yudi)
	  {
	    ?>
	    <tr><td><?php echo tanggal($yudi->yudisium_date); ?></td><td><?php echo get_antidatir($yudi->yudisium_date);?></td></tr>
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

<div id="filter-stage">

	<?php echo form_open('admin/yudisium/action'); ?>

		<?php echo $this->load->view('admin/tables/yudis'); ?>
      

	<?php echo form_close(); ?>
	
</div>

<?php else : ?>
	<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
<?php endif; ?>

</section>
