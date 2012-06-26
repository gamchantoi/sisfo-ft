<script>  
  $(document).ready(function() {
    $(".cetak").printPage();
  });
</script>
<section class="title">
	<h4><?php echo lang('yudisium_decree'); ?></h4>
</section>
<section class="item">
	<?php if ($data) : ?>
	<div id="filter-stage">
		<table>
			<thead>
			<tr>
				
				<th class="collapse"><?php echo lang('yudisium_date'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_print_sk'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_count_d3'); ?></th>	  
				<th class="collapse"><?php echo lang('yudisium_print_d3'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_export_d3'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_count_s1'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_print_s1'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_export_s1'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_count_all'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_export_all'); ?></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<!--<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>-->
				</td>
			</tr>
		</tfoot>
		<tbody>
		</tbody>
		<?php foreach ($data as $item) : ?>
				<tr>
					<td><?php echo tanggal($item->yudisium_date); ?></td>
					<td><a href="admin/yudisium/cetak_sk/<?php echo $item->yudisium_date; ?>" class="cetak" title="cetak Surat Keputusan Dekan"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a></td>
					<td><b><?php echo count_yudisium_by($item->yudisium_date,'D3'); ?></b>  <img src="<?php echo base_url().$this->module_details['path'];?>/img/graduate.png" width="20px" align="center"></td>
					<td><a href="admin/yudisium/report_d3/<?php echo $item->yudisium_date; ?>" class="cetak" title="cetak Urutan Yudisium Mahasiswa D3"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a></td>
					<td><a href="admin/yudisium/export_d3/<?php echo $item->yudisium_date; ?>"><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td>
					<td><b><?php echo count_yudisium_by($item->yudisium_date,'Skripsi'); ?></b>  <img src="<?php echo base_url().$this->module_details['path'];?>/img/graduate.png" width="20px" align="center"></td>
					<td><a href="admin/yudisium/report_s1/<?php echo $item->yudisium_date; ?>" class="cetak" title="cetak Urutan Yudisium Mahasiswa S1"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a></td>
					<td><a href="admin/yudisium/export_s1/<?php echo $item->yudisium_date; ?>"><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td>
					<td><b><?php echo count_yudisium_all($item->yudisium_date); ?></b>  <img src="<?php echo base_url().$this->module_details['path'];?>/img/graduate.png" width="20px" align="center"></td>
					<td><a href="admin/yudisium/export_all/<?php echo $item->yudisium_date; ?>"></?php><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td>
				</tr>
		<?php endforeach ; ?>
		</table>
	</div>
	<?php else : ?>
		<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
	<?php endif; ?>
</section>