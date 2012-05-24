
<script>  
  $(document).ready(function() {
    $("#cetak").printPage();
  });
  </script>
<section class="title"><h4><?php echo lang('prakerin_title'); ?> - Status</h4></section>
<section class="item">
 <table class="table-list">
		<tbody>
			<tr>
                <td>Jumlah Mahasiswa PI</td>
                <td><?php echo $mhs_num; ?> Mahasiswa</td>
                <td>Jumlah Surat Tugas Belum dicetak</td>
                <td><?php echo $tp_no_num; ?> Berkas</td>
            </tr>
            <tr>
                <td>Jumlah Surat </td>
                <td><?php echo $cp_num; ?> Industri</td>
                <td>Jumlah Surat Tugas Sudah dicetak</td>
                <td><?php echo $tp_yes_num; ?> Berkas</td>
            </tr>
            <tr>
                <td>Jumlah Surat Ijin Belum dicetak</td>
                <td><?php echo $lp_no_num; ?> Berkas</td>
                <td>Jumlah Surat Ucapan Terimakasih Belum dicetak</td>
                <td><?php echo $thanks_no; ?> Berkas</td>
            </tr>
            <tr>
                <td>Jumlah Surat Ijin Sudah dicetak</td>
                <td><?php echo $lp_yes_num; ?> Berkas</td>
                <td>Jumlah Surat Ucapan Terimakasih Sudah Dicetak</td>
                <td><?php echo $thanks_yes; ?> Berkas</td>
            </tr>
            <tr>
                <td>Jumlah Total Surat Ijin masuk</td>
                <td><?php echo $lp_num; ?> Berkas</td>
                <td>Jumlah Surat Masuk Bulan ini</td>
                <td>10 Berkas</td>
            </tr>
        </tbody>
 </table>
</section>
<section class="title">
	<h4><?php echo lang('prakerin_title'); ?></h4>
</section>

<section class="item">
<?php if ($data) : ?>

<?php echo $this->load->view('admin/partials/filters'); ?>

<div id="filter-stage">

	<?php echo form_open('admin/prakerin/action'); ?>

		<?php echo $this->load->view('admin/tables/prakerin'); ?>

	<?php echo form_close(); ?>

</div>

<?php else : ?>
	<div class="no_data"><?php echo lang('prakerin_currently_no_posts'); ?></div>
<?php endif; ?>

</section>
