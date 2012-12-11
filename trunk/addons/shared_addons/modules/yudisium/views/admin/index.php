
<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
</script>
<script type="text/javascript" class="example">
$(document).ready(function()
{
	$('h1[title]').qtip();
});
</script>
<section class="title">
	<h4>Pendaftaran Yudisium </h4>
</section>
<section class="item">
	<div>
	  <table>
	    <thead>
	      <tr>
		<th>Jumlah pendaftar bulan ini</th>
		<th>Jumlah Pendaftar D3 Bulan ini</th>
		<th>Jumlah Pendaftar S1 Bulan ini</th>
		<th>Jumlah pendaftar hari ini</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
		<td><h1><a href="#" title="<?php foreach ($anti_periode as $ap) { echo "Yudisium tanggal " .tanggal($ap->yudisium_date)."<br>Jumlah Peserta: ".yudis_date_n_datein($ap->yudisium_date)."<br>" ; }; ?>"><?php echo $this_month; ?></a></h1></td>
		<td>
		    <h1>
		      <a href="#" title=" RERATA LAMA PENULISAN TA : <b><?php echo $write_ta['ta_avg_d3']; ?></b> <br>
		      LAMA MINIMUM PENULISAN TA: <b><?php echo $write_ta['ta_min_d3']; ?></b> <br>
		      LAMA MAKSIMUM PENULISAN TA : <b><?php echo $write_ta['ta_max_d3']; ?></b> <br>
		      <b>MASA STUDI</b><br>
		      RERATA Masa Studi  : <b><?php echo $semester['sem_avg_d3']; ?></b> <br>
		      Masa Studi MINIMUM : <b><?php echo $semester['sem_min_d3']; ?></b> <br>
		      Masa Studi MAKSIMUM: <b><?php echo $semester['sem_max_d3']; ?></b> <br>
		      <b>IPK</b><br>
		      RERATA IPK	 : <b><?php echo $ipk['ipk_avg_d3']; ?></b> <br>
		      IPK MINIMUM	 : <b><?php echo $ipk['ipk_min_d3']; ?></b> <br>
		      IPK MAKSIMUM	 : <b><?php echo $ipk['ipk_max_d3']; ?></b> <br>
		      <b>PREDIKAT</b><br>
		      DENGAN PUJIAN	 : <b><?php echo $predicate['cum_d3']; ?></b> <br>
		      <?php if ($predicate['cum_d3'] > 0) :?>
		      <?php $verygood= $predicate['vg_d3'] - $predicate['cum_d3'];?>
		      SANGAT MEMUASKAN	 : <b><?php echo $verygood; ?></b> <br>
		      <?php else : ?>
		      SANGAT MEMUASKAN	 : <b><?php echo $predicate['vg_d3']; ?></b> <br>
		      <?php endif; ?>		      
		      MEMUASKAN		 : <b><?php echo $predicate['good_d3']; ?></b> <br>
		      <b>MASUK FT MELALUI</b><br>
		      PBU		 : <b><?php echo $ft_in['PBU_d3']; ?></b> <br>
		      UTUL		 : <b><?php echo $ft_in['UTUL_d3']; ?></b> <br>
		      PKS		 : <b><?php echo $ft_in['PKS_d3']; ?></b> <br>
		      <b>ASAL SEKOLAH</b><br>
		      SMA		 : <b><?php echo $askol['SMA_d3']; ?></b> <br>
		      SMK		 : <b><?php echo $askol['SMK_d3']; ?></b> <br>
		      DIII		 : <b><?php echo $askol['DIII_d3']; ?></b> <br>
		      MAN DLL		 : <b><?php echo $askol['MAN_d3']; ?></b> <br>
		      "><?php echo $D3_datein; ?></a>
		    </h1>
		</td>
		<td>
		  <h1>
		    <a href="#" title="RERATA LAMA PENULISAN TA : <b><?php echo $write_ta['ta_avg_s1']; ?></b> <br>
		      LAMA MINIMUM PENULISAN TA: <b><?php echo $write_ta['ta_min_s1']; ?></b> <br>
		      LAMA MAKSIMUM PENULISAN TA : <b><?php echo $write_ta['ta_max_s1']; ?></b> <br>
		      <b>MASA STUDI</b><br>
		      RERATA Masa Studi  : <b><?php echo $semester['sem_avg_s1']; ?></b> <br>
		      Masa Studi MINIMUM : <b><?php echo $semester['sem_min_s1']; ?></b> <br>
		      Masa Studi MAKSIMUM: <b><?php echo $semester['sem_max_s1']; ?></b> <br>
		      <b>IPK</b><br>
		      RERATA IPK	 : <b><?php echo $ipk['ipk_avg_s1']; ?></b> <br>
		      IPK MINIMUM	 : <b><?php echo $ipk['ipk_min_s1']; ?></b> <br>
		      IPK MAKSIMUM	 : <b><?php echo $ipk['ipk_max_s1']; ?></b> <br>
		      <b>PREDIKAT</b><br>
		      DENGAN PUJIAN	 : <b><?php echo $predicate['cum_s1']; ?></b> <br>
		      <?php if ($predicate['cum_s1'] > 0) :?>
		      <?php $vg_s1= $predicate['vg_s1'] - $predicate['cum_s1'];?>
		      SANGAT MEMUASKAN	 : <b><?php echo $vg_s1; ?></b> <br>
		      <?php else : ?>
		      SANGAT MEMUASKAN	 : <b><?php echo $predicate['vg_s1']; ?></b> <br>
		      <?php endif; ?>		      
		      MEMUASKAN		 : <b><?php echo $predicate['good_s1']; ?></b> <br>
		      <b>MASUK FT MELALUI</b><br>
		      PBU		 : <b><?php echo $ft_in['PBU_s1']; ?></b> <br>
		      UTUL		 : <b><?php echo $ft_in['UTUL_s1']; ?></b> <br>
		      PKS		 : <b><?php echo $ft_in['PKS_s1']; ?></b> <br>
		      <b>ASAL SEKOLAH</b><br>
		      SMA		 : <b><?php echo $askol['SMA_s1']; ?></b> <br>
		      SMK		 : <b><?php echo $askol['SMK_s1']; ?></b> <br>
		      DIII		 : <b><?php echo $askol['DIII_s1']; ?></b> <br>
		      MAN DLL		 : <b><?php echo $askol['MAN_s1']; ?></b> <br>
		      "><?php echo $S1_datein; ?></a>
		  </h1></td>
		<td><h1><?php echo $this_date; ?></h1></td>
	      </tr>
	    </tbody>
	    <tfoot>
	      <tr>
		<?php echo form_open('admin/yudisium/expired'); ?>
		<div class="form_inputs">
		  <fieldset>
		      <ul>
			  <li class="even">
			      <label for="expired">Yudisium Ditutup Tanggal ("tahun-bulan-tanggal jam:menit:detik")</label>
			      <div class="input"><?php echo form_input('expired',$expired); ?></div>			
			  </li>
			  <li>
			    <div class="buttons float-right padding-top">
				<?php $this->load->view('admin/partials/buttons', array('buttons' => array('save','cancel'))); ?>
			    </div>
			  </li>
		      </ul>
		  </fieldset>
		</div>
		<?php echo form_close(); ?>
	      </tr>
	    </tfoot>
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
	  <th>Tgl Yudisium</th>
	  <th>Jml Antidatir A</th>
	  <th>Jml Antidatir B</th>
	  <th>Jml Antidatir C</th>
	  <th>Jml Antidatir D</th>
	  <th>Jml Normal</th>
	  <th>Download</th>
	  <th></th>
	</tr>
      </thead>
      <tbody>
	<?php
	$img_arc = img(array("src" => base_url($this->module_details['path']."/img/archive.png"), "width" => "30px","align"=>"center"));
	$img_xls = img(array("src" => base_url($this->module_details['path']."/img/excel.png"), "width" => "30px","align"=>"center"));
	  foreach ($yudisium as $yudi)
	  {
	    ?>
	    <tr><td><?php echo tanggal($yudi->yudisium_date); ?></td><td><?php echo get_antidatir_a($yudi->yudisium_date);?></td><td><?php echo get_antidatir_b($yudi->yudisium_date);?></td><td><?php echo get_antidatir_c($yudi->yudisium_date);?></td><td><?php echo get_antidatir_d($yudi->yudisium_date);?></td><td><?php echo get_yudis_normal($yudi->yudisium_date); ?></td><td><?php echo anchor("admin/yudisium/export_all_data/".$yudi->yudisium_date,$img_xls,array('title' => 'Download Lampiran SK Yudisium Mahasiswa D3'));?></td><td><?php echo anchor("admin/yudisium/archive/".$yudi->yudisium_date, $img_arc);?></td></tr>
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