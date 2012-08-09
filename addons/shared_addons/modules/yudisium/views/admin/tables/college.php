<table>
    <thead>
        <tr>
		<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
		<th><?php echo lang('yudisium_name'); ?></th>
		<th class="collapse"><?php echo lang('yudisium_nim'); ?></th>
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
                <td class="collapse"><?php echo $item->x; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>