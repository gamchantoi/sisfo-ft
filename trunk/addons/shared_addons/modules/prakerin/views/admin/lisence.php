<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Surat Ijin Praktik Industri</title>
</head>
<style type="text/css">
	body {
	height: 842px;
	width: 595px;
	margin-left: auto;
	margin-right: auto;
	}
	
</style>

<body>
<table border="0"  width="595" cellpadding="3" cellspacing="3">
	<tr>
		<td align="left"><img src="<?php echo base_url().$this->module_details['path']; ?>/img/Logo_uny.gif" width="95px"></td>
		<td align="center" style="font-size: 15px;"><b>KEMENTERIAN  PENDIDIKAN DAN KEBUDAYAAN<br />UNIVERSITAS NEGERI YOGYAKARTA<br />FAKULTAS TEKNIK</b><br /><small>Alamat : Kampus  Karangmalang, Yogyakarta, 55281<br />Telp. (0274)  586168 psw. 276,289,292 (0274) 586734 Fax. (0274) 586734<br />website : http://ft.uny.ac.id  e-mail: ft@uny.ac.id ; teknik@uny.ac.id</small></td>
		<td align="right"><img src="<?php echo base_url().$this->module_details['path']; ?>/img/iso.png" width="95px"></td>
	</tr>
	<tr>
		<td colspan="3"><hr style="border: 4px double ;"></td>
	</tr>
</table>
<table style="background-color:#FFFFCO" width="595" cellspacing="3">
	<tr>
		<td>No</td><td colspan="4">: <?php echo $company['number'];?>/UN34.15/PP/2012</td><td align="right"><?php echo tanggal($date_in);?></td>
	</tr>
	<tr>
		<td valign="top">Lamp</td><td colspan="4">: -</td>
	</tr>
	<tr>
		<td valign="top">Hal</td><td colspan="4">: Permohonan Praktek Kerja<br> Mahasiswa FT UNY <br><br></td>
	</tr>
	<tr>
		<td colspan="6">Yth Direktur <?php echo $company['company'];?> <br /><?php echo $company['address'];?><br /><?php echo $company['district'];?></td>
	</tr>
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td colspan="6">Dengan hormat disampaikan permohonan untuk memperoleh kesempatan Praktek Industri yang merupakan salah satu program Fakultas Teknik (FT) Universitas Negeri Yogyakarta, bagi <?php echo $nums; ?> orang mahasiswa kami sebagai berikut :<br></td>
	</tr>
	<tr>
		<td colspan="6"><br></td>
	</tr>
</table>
<table border="1" cellspacing="0"  width="595" style="font-size: small; ">
  <tr>
    <td valign="top" align="center">No.</td>
    <td valign="top" align="center">Nama</td>
    <td valign="top" align="center">No.    Mhs.</td>
    <td valign="top" align="center">Pembimbing</td>
    <td valign="top" align="center">Program    Studi</td>
  </tr>
  <?php $i=1; foreach ($mhs as $m):?>
   <tr>
    <td valign="top" align="center"><?php echo $i;?></td>
    <td valign="top" align="center"><?php echo $m->name; ?></td>
    <td valign="top" align="center"><?php echo $m->nim; ?></td>
    <td valign="top" align="center"><?php echo $m->adviser; ?></td>
    <td valign="top" align="center"><?php echo $company['dpt']; ?></td>
  </tr>
  <?php $i++; endforeach; ?>
</table>
<table width="595">
	<tr>
		<td><br></td>
	</tr>
	<tr>
		<td colspan="6">di  Perusahaan/Industri yang Bapak/Ibu pimpin. Penempatan mahasiswa tersebut  diharapkan selama ? bulan ( ? Jam Praktik), bila mungkin dimulai tanggal <?php echo tanggal($company['start']);?> sampai dengan <?php echo tanggal($company['finish']);?> </td>
		
	</tr>
	<tr>
		<td colspan="6">Kemudian atas perhatian dan bantuan  Bapak/Ibu, kami ucapkan terimakasih.<br></td>
	</tr>
	<tr>
		<td colspan="6">&nbsp;<br></td>
	</tr>
	<tr>
		<td  colspan="5">&nbsp;</td><td align="center">a.n.Dekan<br />Wakil Dekan I,</td>
	</tr>
	<tr>
		<td  colspan="5">&nbsp;</td><td align="center"><img src="<?php echo base_url().$this->module_details['path']; ?>/img/sunar-ttd.png" width="170"></td>
	</tr>
	<tr>
		<td  colspan="5" width="300">&nbsp;</td><td align="center">Dr. Sunaryo  Soenarto<br />NIP. 19560630 198601 1 001</td>
	</tr>
</table>
</body>
</html>
