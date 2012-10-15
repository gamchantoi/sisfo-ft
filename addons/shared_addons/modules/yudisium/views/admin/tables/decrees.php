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
                            <a href="admin/yudisium/decrees/edit/<?php echo $data->id; ?>" title="Edit data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
                            <a href="admin/yudisium/decrees/delete/<?php echo $data->id; ?>" title="Hapus data Mahasiswa"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
            </tbody>
</table>