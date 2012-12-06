<table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nomor</th>
                    <th>Tanggal Yudisium</th>
                    <th>Kode Antidatir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tfoot>
		    <tr>
			<td colspan="7">
			    <div class="inner"><?php //$this->load->view('admin/partials/pagination'); ?></div>
			</td>
		    </tr>
	    </tfoot>
            <tbody>
                    <?php $i=1; foreach($decrees as $data) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->number; ?></td>
                        <td><?php echo tanggal($data->date);?></td>
                        <td><?php echo $data->ant?></td>
                        <td>
	    <?php
			$img_edit = img(array("src" => base_url($this->module_details['path']."/img/edit.png"), "title" => "Edit data SK", "alt" => "Edit data SK", "class" => "edit"));
			$img_del  = img(array("src" => base_url($this->module_details['path']."/img/delete.png"), "title" => "Hapus data SK", "alt" => "Hapus data SK", "class" => "delete"));
			echo anchor("admin/yudisium/decrees/edit/".$data->id, $img_edit);
			echo anchor("admin/yudisium/decrees/delete/".$data->id, $img_del);
	    ?>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
            </tbody>
</table>