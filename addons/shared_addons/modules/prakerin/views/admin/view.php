 <style type="text/css" >
.course_accordion {
	width:701px;
	float:left;
	margin-bottom:5px;
}
.course_box {
	width:701px;
	float:left;
}
.accor_heading {
	width:701px;
}
.accor_heading h5:hover {
	background: url(../img/bg-accor2.png) no-repeat 8px 7px #004a72;
	color:#fff;
}
.accor_heading h5 {
	width:670px;
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
.accor_content ul {
        padding-left: 0px;
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
.accor_content li span.box1 {
	width:42px;
	background:#fff;
}
.accor_content li span.box2 {
	width:351px;
	padding-left:16px;
	text-align:left;
}
.accor_content li span.box3 {
	width:139px;
	background:#fff;
        padding-left:16px;
        text-align:left;
}
.accor_content li span.box4 {
	width:154px;
}
.accor_content .note {
	width:686px;
	float:left;
	margin-top:12px;
	background:#f4ffd0;
	padding:4px 4px;
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
                <h5>Daftar Mahasiswa Praktik Industri</h5>
              </div>
              <div class="accor_content">
                <ul>
                    <li class="hd"><span class="box3">Nama Perusahaan</span><span class="box2"><?php echo $company['company'];?></span></li>
                    <li class="hd"><span class="box3">Alamat Perusahaan</span><span class="box2"><?php echo $company['address'];?></span></li>
                    <li class="hd"><span class="box3">Kota / Kabupaten</span><span class="box2"><?php echo $company['district'];?></span></li>
                    <li class="hd"><span class="box3">Program Studi</span><span class="box2"><?php echo $company['dpt'];?></span></li>
                    <li class="hd"><span class="box3">Surat Masuk</span><span class="box2"><?php echo $company['date'];?></span></li>
                    <li class="hd"><span class="box3">Tanggal Dimulai</span><span class="box2"><?php echo $company['start'];?></span></li>
                    <li class="hd"><span class="box3">Tanggal Selesai</span><span class="box2"><?php echo $company['finish'];?></span></li>
                </ul>
                <ul>
                  <li class="hd"><span class="box4">No</span><span class="box3">Nim</span><span class="box2">Nama</span></li>
                  <?php $i=1; foreach($mhs as $item): ?>
                  <?php if($item->name == NULL)
                  { ?>
                   <li><span class="box4">Data</span><span class="box3">Belum</span><span class="box2">Lengkap</span></li>
                    <?php }else{  ?>
                   <li><span class="box4"><?php echo $i?></span><span class="box3"><?php echo $item->nim; ?></span><span class="box2"><?php echo $item->name ?></span></li>
                    <?php }?>
                  <?php $i++; endforeach; ?>
                </ul>
                <div class="note">
                    <?php if($lisence):?>
                        <p><strong>NOTE</strong>: Surat Ijin Praktik Industri Sudah dicetak <br> Riwayat Cetak:.</p>
                        
                        <?php
                            foreach($lisence as $l){
                                $data = explode(' ',$l->date);$tgl=$data[0];$time=$data[1];
                                echo "<li>Tanggal: ".tanggal($tgl)." Pukul: ".$time."</li>";
                            }
                        ?>
                        
                    <?php else: ?>
                        <p><strong>NOTE</strong>: Dokumant Belum dicetak.</p>
                    <?php endif; ?>
                </div>
              </div>
            </div>
</div>
