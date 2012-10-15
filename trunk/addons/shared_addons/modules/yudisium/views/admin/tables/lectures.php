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
                            <a href="admin/yudisium/lectures/edit/<?php echo $data->id; ?>" title="Edit data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
                            <a href="admin/yudisium/lectures/delete/<?php echo $data->id; ?>" title="Hapus data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
            </tbody>
</table>