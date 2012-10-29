<div>
	<p><a href="admin/bebas/create/"><img src="<?php echo base_url().$this->module_details['path'];?>/img/add.png"> <b>Tambah data Surat Keputusan</b></a></p>
</div>
<table>
    <thead>
        <tr>
            <th class="collapse">No. Surat</th>
            <th class="collapse">Tanggal</th>
            <th class="collapse">NIM</th>
            <th class="collapse">Nama</th>
            <th class="collapse">Prodi</th>
            <th class="collapse">Pilihan</th>
        </tr>
    </thead>
    <tfoot>
        
    </tfoot>
    <tbody>
        <?php foreach ($bebas as $item) : ?>
        <tr>
            <td><?php echo $item->no; ?></td>
            <td><?php echo tanggal($item->tanggal_surat); ?></td>
            <td><?php echo $item->nim; ?></td>
            <td><a href="#" title="<?php print_r(get_printed($item->id)); ?>"><?php echo $item->nama; ?></a></td>
            <td><?php echo get_prodi($item->prodi); ?></td>
            <td>
                <a href="admin/bebas/prints/<?php echo $item->id; ?>" title="Cetak data Bebas Teori"><img src="<?php echo base_url().$this->module_details['path'];?>/img/print.png"></a>
                <a href="admin/bebas/edit/<?php echo $item->id; ?>" title="Edit data Bebas Teori"><img src="<?php echo base_url().$this->module_details['path'];?>/img/edit.png"></a>
		<a href="admin/bebas/delete/<?php echo $item->id; ?>" title="Hapus data Bebas Teori"><img src="<?php echo base_url().$this->module_details['path'];?>/img/delete.png"></a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>