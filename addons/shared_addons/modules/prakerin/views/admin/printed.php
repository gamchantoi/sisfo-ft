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
	width:175px;
	background:#fff;
}
.accor_content li span.box2 {
	width:175px;
	padding-left:16px;
	text-align:left;
}
.accor_content li span.box3 {
	width:175px;
	background:#fff;
        padding-left:16px;
        text-align:left;
}
.accor_content li span.box4 {
	width:75px;
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
                <h5>Riwayat Cetak </h5>
              </div>
              <div class="accor_content">
                <ul>
                    <?php foreach ($result as $r) {
                        $date= explode(' ',$r->date);$tgl = $date[0];$time=$date[1];
                    ?>
                    <li class="hd"><span class="box1"> Tanggal: </span><span class="box2"><?php echo tanggal($tgl); ?></span><span class="box3">Pukul:</span><span class="box4"><?php echo $time;?></span></li>
                    <?php } ?>
                </ul>
              </div>
            </div>
</div>
