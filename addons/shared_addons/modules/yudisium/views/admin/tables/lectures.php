<table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIP</th>
                    <th>Nama Dosen</th>
                    <th>Jurusan</th>
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
                    <?php $i=1; foreach($lectures as $data) : ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo $data->nip; ?></td>
                        <td><?php echo $data->name;?></td>
                        <td><?php echo $data->major?></td>
                        <td>
	    <?php
	    $img_edit = img(array("src" => base_url($this->module_details['path']."/img/edit.png"), "title" => "Edit data Dosen", "alt" => "Edit data Dosen", "class" => "edit"));
	    $img_del  = img(array("src" => base_url($this->module_details['path']."/img/delete.png"), "title" => "Hapus data Dosen", "alt" => "Hapus data Dosen", "class" => "delete"));
            echo anchor("admin/yudisium/lecturez/edit/".$data->id, $img_edit);
	    echo anchor("admin/yudisium/lecturez/delete/".$data->id, $img_del);
	    ?>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
            </tbody>
</table>