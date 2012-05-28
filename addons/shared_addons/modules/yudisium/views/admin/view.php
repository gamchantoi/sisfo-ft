 <style type="text/css" >
.course_accordion {
	width:721px;
	float:left;
	margin-bottom:5px;
}
.course_box {
	width:721px;
	float:left;
}
.accor_heading {
	width:721px;
}
.accor_heading h5:hover {
	background: url(../img/bg-accor2.png) no-repeat 8px 7px #004a72;
	color:#fff;
}
.accor_heading h5 {
	width:679px;
	float:left;
	background: url(../img/bg-accor1.png) no-repeat 8px 7px #eee;
	border:1px solid #cecece;
	padding:5px 5px;
	padding-left:30px;
	cursor:pointer;
	color:#000;
	font-size:14px;
	font-weight:bold;
	line-height:16px;
}
.downToggle h5 {
	background: url(../img/bg-accor3.png) no-repeat 8px 7px #004a72;
	color:#fff;
}
.accor_content {
	/**float:left;**/
	width:701px;
	padding-top:2px;
	padding-bottom:2px;
}
.accor_content li {
	float:left;
	width:701px;
	border-bottom:1px solid #e1f2fa;
	background:#f8f8f8;
	font-size:14px;
}
.accor_content li.hd {
	background:#006fab;
	color:#fff;
	font-weight:bold;
	font-size:12px;
}
.accor_content li.hd span.box1, .accor_content li.hd span.box3 {
	background:#005d8f;
}
.accor_content li span {
	display:block;
	float:left;
	text-align:center;
	line-height:30px;
}
/**
.accor_content li span.box1 {
	width:42px;
	background:#fff;
}
**/
.accor_content li span.box2 {
	width:531px;
	padding-left:16px;
	text-align:left;
}
.accor_content li span.box3 {
	width:154px;
	background:#fff;
}
/**
.accor_content li span.box4 {
	width:154px;
}
**/
.accor_content .note {
	width:691px;
	float:left;
	margin-top:12px;
	background:#f4ffd0;
	padding:8px 15px;
}
.accor_content .note p {
	padding-bottom:0;
	line-height:18px;
	font-family:tahoma, arial, sans-serif;
	color:#000;
}
.accor_content .note p strong {
	color:#ff0000;
}
 </style>
<div class="course_accordion">
            <div class="course_box">
              <div class="accor_heading">
                <h5>Daftar Peserta Yudisium</h5>
              </div>
              <div class="accor_content">
                <ul>                    
                    <li class="hd"><span class="box3">Nama</span><span class="box2"><?php echo $item->name;?></span></li>
                    <li class="hd"><span class="box3">Nim</span><span class="box2"><?php echo $item->nim;?></span></li>
                    <li class="hd"><span class="box3">Program Studi</span><span class="box2"><?php echo lang('yudisium_dp_'.$item->department);?></span></li>
                    <li class="hd"><span class="box3">Tempat, Tanggal Lahir</span><span class="box2"><?php echo $item->place_of_birth.", ".tanggal($item->date_of_birth);?></span></li>
                    <li class="hd"><span class="box3">Agama</span><span class="box2"><?php echo $religion;?></span></li>
                    <li class="hd"><span class="box3">Status</span><span class="box2"><?php echo $item->meriage;?></span></li>
                    <li class="hd"><span class="box3">Alamat</span><span class="box2"><?php echo $item->address;?></span></li>
                    <li class="hd"><span class="box3">Nama Orang Tua</span><span class="box2"><?php echo $item->parrent;?></span></li>
                    <li class="hd"><span class="box3">Alamat Orang Tua</span><span class="box2"><?php echo $item->parrent_address;?></span></li>
                    <li class="hd"><span class="box3">Sekolah Asal</span><span class="box2"><?php echo $item->soo;?></span></li>
                    <li class="hd"><span class="box3">Alamat Sekolah</span><span class="box2"><?php echo $item->school_address;?></span></li>
                    <li class="hd"><span class="box3">Tugas Akhir</span><span class="box2"><?php echo $item->thesis;?></span></li>
                    <li class="hd"><span class="box3">Judul</span><span class="box2"><?php echo $item->thesis_title;?></span></li>
                    <li class="hd"><span class="box3">Dosen Pembimbing</span><span class="box2"><?php echo $lecture ;?></span></li>
                    <li class="hd"><span class="box3">Lulus Tugas Akhir</span><span class="box2"><?php echo tanggal($item->graduation);?></span></li>
                    <li class="hd"><span class="box3">IPK</span><span class="box2"><?php echo $item->ipk;?></span></li>
                    <li class="hd"><span class="box3">Total SKS</span><span class="box2"><?php echo $item->sks;?></span></li>
                    <li class="hd"><span class="box3">Lama Penulisan</span><span class="box2"> dari tanggal <?php echo $item->start;?> s/d tanggal <?php echo $item->finish;?></span></li>
                    <li class="hd"><span class="box3">Cuti</span><span class="box2"><?php echo $item->name;?></span></li>
                    <li class="hd"><span class="box3">Tanggal Yudisium</span><span class="box2"><?php echo tanggal($item->yudisium_date);?></span></li>
                </ul>
                
                <div class="note">
                <?php if(!$printed):?>
                <p><strong>NOTE</strong>: Dokumant Belum dicetak:</p>
                <?php else: ?>
                <p><strong>NOTE</strong>: Dokumant Telah Tercetak. Tanggal cetak:</p>
                  <?php foreach ($printed as $row):?>
                    <?php   $date= explode(' ',$row->date);$tgl = $date[0];$time=$date[1];?>
                    <li>tanggal <?php echo tanggal($tgl); ?> waktu: <?php echo $time; ?></li>
                  <?php endforeach; ?>
                <?php endif?>
                </div>
              </div>
            </div>
</div>
