<style type=\"text/css\" >
div.centered 
{
text-align: center;
}
div.centered table 
{
height: 842px;
    width: 595px;
    margin-left: auto;
    margin-right: auto;

}
</style>
<body>
    <div class="centered">
<table>
<tr><td><img src="<?php echo base_url().$this->module_details['path']; ?>/img/Logo_uny.gif" width="80px"><td  align="center" width="360px"><b>UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK</b></td><td><img src="<? echo base_url().$this->module_details['path']; ?>/img/iso.png" width="80px"></td></tr>
<tr><td width="80px"><td  align="center" width="360px"><b>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM SARJANA/DIPLOMA 3</b></td><td  width="80px"></td></tr>
<tr><td colspan=3 align="right">FRM/TKF/21-00 <br>02 Juli 2007</td></tr>
<tr><td>Nama</td><td colspan=2>: <?php echo $item->name; ?></td></tr>
<tr><td>No. Mahasiswa</td><td colspan=2>: <?php echo $item->nim; ?></td></tr>
<tr><td>Program Studi</td><td colspan=2>: <?php echo $item->department; ?></td></tr>
<tr><td width="160px">Tempat, Tanggal Lahir</td><td colspan=2>: <?php echo $item->place_of_birth.",  ".$item->date_of_birth ;?></td></tr>
<tr><td>Agama</td><td colspan=2>: <?php echo $item->religion; ?></td></tr>
<tr><td>Status</td><td colspan=2>: <?php echo $item->meriage; ?></td></tr>
<tr><td>Alamat Sekarang</td><td colspan=2>: <?php echo $item->address; ?></td></tr>
<tr><td>Nama Orang Tua</td><td colspan=2>: <?php echo $item->parrent; ?></td>
<tr><td>Alamat Orang Tua</td><td colspan=2>: <?php echo $item->parrent_address; ?></td></tr>
<tr><td>Diterima di FT Melalui</td><td colspan=2>: <?php echo $item->parrental; ?></td></tr>
<tr><td>Sekolah Asal</td><td colspan=2>: <?php echo $item->soo; ?></td></tr>
<tr><td>Alamat Sekolah</td><td colspan=2>: <?php echo $item->school_address; ?></td></tr>
</table>
    </div>
</body>