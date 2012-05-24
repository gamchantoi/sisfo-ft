<script type="text/javascript" class="example">
$(document).ready(function()
{
	$('.tips').qtip();
});
</script>
	<table>
		<thead>
			<tr>
				<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
				<th><?php echo lang('prakerin_company'); ?></th>
				<th class="collapse"><?php echo lang('prakerin_address'); ?></th>
				<th class="collapse"><?php echo lang('prakerin_district'); ?></th>
				<th class="collapse"><?php echo lang('prakerin_dpt'); ?></th>
				<th><?php echo lang('prakerin_p_status_label'); ?></th>
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
				<td><?php echo $item->company; ?></td>
				<td><?php echo $item->address; ?></td>
				<td><?php echo $item->district; ?></td>
				<td><?php echo lang('prakerin_dp_'.$item->department); ?></td>
				<td >
					<?php if($item->l_printed == '2')
					{
						?>
						<a id="bufferdie" class="tips" href="#" title="Surat Ijin PI belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar printer"><img src="<?php echo base_url().$this->module_details['path'];?>/img/no_print.png"></a>
						<?php
					}else{
						?>
						<a id="bufferdie" class="tips" href="admin/prakerin/l_printed/<?php echo $item->number; ?>" rel="modal" target="_blank" title="Surat Ucapan Terimakasih telah dicetak, klik disini untuk melihat Riwayat cetak"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print_yes.png"></a>
						<?php
					}
					?> ||
					<?php if($item->t_printed == '2')
					{
						?>
						<a id="bufferdie" class="tips" href="#" title="Surat Ucapan Terimakasih belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar amplop"><img src="<?php echo base_url().$this->module_details['path'];?>/img/no_print.png"></a>
						<?php
					}else{
						?>
						<a id="bufferdie" class="tips" href="admin/prakerin/t_printed/<?php echo $item->number; ?>" rel="modal-large" target="_blank" title="Surat Ucapan Terimakasih telah dicetak, klik disini untuk melihat Riwayat cetak"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print_yes.png"></a>
						<?php
					}
					?>
				</td>
				<td>
						<a href="admin/prakerin/preview/<?php echo $item->number; ?>" class="tips" rel="modal-large" target="_blank" title="Tampilkan Detai Praktik Industri"><img src="<?php echo base_url().$this->module_details['path'];?>/img/zoom.png"></a>
						<a href="admin/prakerin/lisence/<?php echo $item->number; ?>" class="tips" id="cetak" title="cetak Surat Ijin Praktik Industri"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a>
						<a href="admin/prakerin/thanks/<?php echo $item->number; ?>" class="tips" id="cetak" title="cetak Surat Ucapan terimakasih"><img src="<?php echo base_url().$this->module_details['path'];?>/img/send.png"></a>
						<a href="admin/prakerin/edit/<?php echo $item->id; ?>" class="tips" title="Edit data Peserta Praktik Industri"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
						<a href="admin/prakerin/delete/<?php echo $item->id; ?>" class="tips" title="Hapus data Peserta Praktik Industri"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>
				</td>
			</tr>

			<?php endforeach; ?>
		</tbody>
	</table>

	<div class="table_action_buttons">
		<?php $this->load->view('admin/partials/buttons', array('buttons' => array('delete'))); ?>
	</div>