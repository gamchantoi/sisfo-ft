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
				<th class="collapse"><?php echo lang('yudisium_print'); ?></th>
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
					<td><?php echo $item->yudisium_date; ?></td>
					<td><a href="admin/yudisium/cetak_sk/<?php echo $item->yudisium_date; ?>" class="cetak" title="cetak Surat Keputusan Dekan"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a></td>
				</tr>
		<?php endforeach ; ?>
		</table>
	</div>
	<?php else : ?>
		<div class="no_data"><?php echo lang('blog_currently_no_posts'); ?></div>
	<?php endif; ?>
</section>