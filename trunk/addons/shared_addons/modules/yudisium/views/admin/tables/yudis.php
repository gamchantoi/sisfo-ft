<script type="text/javascript" class="example">
$(document).ready(function()
{
	$('a[title]').qtip();
});
</script>
	
	
	<table>
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
				<th><?php echo lang('yudisium_name'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_nim'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_date_in'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_date'); ?></th>
				<th class="collapse"><?php echo lang('yudisium_department'); ?></th>
				<th><?php echo lang('yudisium_p_status_label'); ?></th>
				<th width="180"></th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<td colspan="7">
					<div class="inner"><?php $this->load->view('admin/partials/pagination'); ?></div>
				</td>
			</tr>
		</tfoot>
		<tbody>
			<?php foreach ($data as $item) : ?>
				<tr>
					<td><?php echo form_checkbox('action_to[]', $item->id); ?></td>
					<td><?php echo $item->name; ?></td>
					<td class="collapse"><?php echo $item->nim; ?></td>
					<td class="collapse"><?php echo tanggal($item->date); ?></td>
					<td class="collapse">
						<?php echo tanggal($item->yudisium_date); ?>
					</td>
					<td><?php echo lang('yudisium_d_'.$item->department); ?></td>
					<td id="tool">
					<?php if($item->printed == '2')
					{
						?>
						<a id="bufferdie" href="#" title="Dokumen ini belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar printer"><img src="<?php echo base_url().$this->module_details['path'];?>/img/no_print.png"></a>
						<?php
					}else{
						?>
						<a id="bufferdie" href="admin/yudisium/get_printed/<?php echo $item->nim; ?>" title="Dokument telah dicetak"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print_yes.png"></a>
						<?php
					}
					?>				
					<?php if($item->repo_printed == '2')
					{
						?>
						<a id="bufferdie" href="#" title="Surat Tanda terima Penyerahan CD belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar CD"><img src="<?php echo base_url().$this->module_details['path'];?>/img/no_print.png"></a>
						<?php
					}else{
						?>
						<a id="bufferdie" href="admin/yudisium/get_printed/<?php echo $item->nim; ?>" title="Dokument telah dicetak"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print_yes.png"></a>
						<?php
					}
					
					?>
					</td>
					<td>
						<a href="admin/yudisium/preview/<?php echo $item->id; ?>" rel="modal" target="_blank" title="Tampilkan Detai Peserta Yudisium"><img src="<?php echo base_url().$this->module_details['path'];?>/img/zoom.png"></a>
						<a href="admin/yudisium/repo/<?php echo $item->id; ?>" class="cetak" title="cetak tanda terima Penyerahan CD"><img src="<?php echo base_url().$this->module_details['path'];?>/img/cd.png"></a>
						<a href="admin/yudisium/cetak/<?php echo $item->id; ?>" class="cetak" title="cetak Isian Kelulusan"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a>
						<a href="admin/yudisium/edit/<?php echo $item->id; ?>" title="Edit data Peserta Yudisium"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
						<a href="admin/yudisium/delete/<?php echo $item->id; ?>" title="Hapus data Peserta Yudisium"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete', 'publish'))); ?>
	</div>