<table>
    <thead>
        <tr>
		<th width="20"><?php echo form_checkbox(array('name' => 'action_to_all', 'class' => 'check-all')); ?></th>
		<th><?php echo lang('yudisium_name'); ?></th>
		<th class="collapse"><?php echo lang('yudisium_nim'); ?></th>
		<th class="collapse"><?php echo lang('yudisium_department'); ?></th>
		<th class="collapse"><?php echo lang('yudisium_major'); ?></th>
		<th class="collapse">Aksi</th>
		
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
		<td class="collapse"><?php echo get_major_name($item->department);?></td>
		<td>
		    <!--<a href="admin/yudisium/college/edit/<?php echo $item->id; ?>" title="Edit data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
		    <a href="admin/yudisium/college/delete/<?php echo $item->id; ?>" title="Hapus data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>-->
		    <?php
	    $img_edit = img(array("src" => base_url($this->module_details['path']."/img/edit.png"), "title" => "Edit data Mahasiswa", "alt" => "Edit data Mahasiswa", "class" => "edit"));
	    $img_del  = img(array("src" => base_url($this->module_details['path']."/img/delete.png"), "title" => "Hapus data Mahasiswa", "alt" => "Hapus data Mahasiswa", "class" => "delete"));
            echo anchor("admin/yudisium/college/".$data->id, $img_edit);
	    echo anchor("admin/yudisium/college/delete/".$data->id, $img_del);
	    ?>
		</td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>