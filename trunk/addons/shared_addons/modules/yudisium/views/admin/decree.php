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
				<th class="collapse"><?php echo lang('yudisium_attch_d3'); ?></th>			  
				<th class="collapse"><?php echo lang('yudisium_attch_s1'); ?></th>					    
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
					<?php $decree = get_decree_num($item->yudisium_date);?>
					
					<td><a href="admin/yudisium/cetak_sk/<?php echo $item->yudisium_date; ?>" class="cetak" title="cetak Surat Keputusan Dekan"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a></td>
					<td>
					  <?php foreach ($decree as $dc ):?>
					  <a href="admin/yudisium/pattch_d3/<?php echo $dc->date;?>-<?php echo $dc->ant;?>"><?php echo $dc->number; ?></a> |
					  <?php endforeach;?>
					</td>
					<td></td>
					<!--<td><a href="admin/yudisium/pattch_d3/<?php echo $item->yudisium_date; ?>" class="cetak" title="Cetak Lampiran SK Yudisium Mahasiswa D3"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png" width="30px" align="center"></a> | <a href="admin/yudisium/attch_d3/<?php echo $item->yudisium_date; ?>" title="Download Lampiran SK Yudisium Mahasiswa D3"><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td>
					<td><a href="admin/yudisium/pattch_s1/<?php echo $item->yudisium_date; ?>" class="cetak" title="Cetak Lampiran SK Yudisium Mahasiswa S1"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png" width="30px" align="center"></a> | <a href="admin/yudisium/attch_s1/<?php echo $item->yudisium_date; ?>" title="Download Lampiran SK Yudisium Mahasiswa D3"><img src="<?php echo base_url().$this->module_details['path'];?>/img/excel.png" width="30px" align="center"></a></td>-->					
				</tr>
		<?php endforeach ; ?>
		</table>
	</div>
	<?php else : ?>
		<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
	<?php endif; ?>
</section>