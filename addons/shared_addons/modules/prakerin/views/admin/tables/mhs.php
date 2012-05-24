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
            <th><?php echo lang('prakerin_number'); ?></th>
            <th><?php echo lang('prakerin_company'); ?></th>
    	    <th class="collapse"><?php echo lang('prakerin_address'); ?></th>
    	    <th class="collapse"><?php echo lang('prakerin_district'); ?></th>
    	    <th class="collapse"><?php echo lang('prakerin_dpt'); ?></th>
            <th class="collapse"><?php echo lang('prakerin_nim'); ?></th>
            <th class="collapse"><?php echo lang('prakerin_name'); ?></th>
            <th class="collapse"><?php echo lang('prakerin_lecture');?></th>
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
        <?php foreach ($data as $data):?>
        <tr>

            <td><?php echo form_checkbox('action_to[]', $data->id); ?></td>
            <td><?php echo $data->id_prakerin; ?></td>
            <td><?php echo $data->company; ?></td>
            <td><?php echo $data->address; ?></td>
            <td><?php echo $data->district; ?></td>
            <td><?php echo $data->department; ?></td>
            <td><?php echo $data->nim; ?></td>
            <td><?php echo $data->name; ?></td>
            <td><?php echo $data->lecture; ?></td>
            <td>
            <?php if($data->printed == '1'): ?>
            <a id="bufferdie" class="tips" href="#" title="Surat Ijin PI belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar printer"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print_yes.png"></a>
            <?php else :?>
            <a id="bufferdie" class="tips" href="#" title="Surat Ucapan Terima Kasih belum pernah dicetak| <br> silahkan cetak dokument melalui tombol cetak  atau pd gambar printer"><img src="<?php echo base_url().$this->module_details['path'];?>/img/no_print.png"></a>
            <?php endif;?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>