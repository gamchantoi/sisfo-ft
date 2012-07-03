$style  = "
			<title>Penyerahan CD</title>
			<style type=\"text/css\" >
			body {
			height: 842px;
			width: 595px;
			margin-left: auto;
			margin-right: auto;
			}
			</style>";
		$table  = "<table style=\"font-size:15px;\">";
		$table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\" width=\"475px\"><b>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br> UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
		$table .= "</tabel>";
		$table .= "<table style=\"font-size:15px;\">";
		$table .= "<tr><td colspan=3><hr style=\"border: 1px double #000;\" /></td></tr>";
		$table .= "<tr><td colspan=3 align=\"center\"><b>SURAT PERNYATAAN</b></td></tr>";
		$table .= "<tr><td colspan=3>Saya yang bertanda tangan dibawah ini: </td></tr>";
		$table .= "<tr><td>Nama </td><td>: ".$item->name."</td><td> </td></tr>";
		$table .= "<tr><td>NIM  </td><td>: ".$item->nim."</td><td> </td></tr>";
		$table .= "<tr><td>Jurusan </td><td colspan=2>: ".$this->get_major($item->department)."</td></tr>";
		$table .= "<tr><td>No.Telp </td><td>: ".$item->phone."</td><td> </td></tr>";
		$table .= "<tr><td valign=\"top\">Judul   </td><td colspan=2 valign=\"top\">: ".$item->thesis_title."</td></tr>";
		$table .= "<tr><td colspan=3>Dengan ini menyatakan dengan sesungguhnya, bahwa saya bersedia menyerahkan hasil skripsi /
		tugas akhir saya dan memberikan wewenang sepenuhnya kepada pihak fakultas dalam penggunaan hasil karya saya</td></tr>";
		$table .= "<tr><td colspan=3 align=\"right\">Yogyakarta ". tanggal(date('Y-m-d'))."<td></tr>";
		$table .= "<tr><td align=\"center\">Mengetahui,<br /> KaSubbag Pendidikan</td><td align=\"center\">Yang Menyerahkan</td><td align=\"center\">Yang Menerima</td><tr>";
		$table .= "<tr><td align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sari.jpg\" height=\"50px\"><td><td></td><td></td></tr>";
		$table .= "<tr><td align=\"center\" width=\"190px\">Dra. Sari Puspita<br /> Nip. 19630912 198812 2 001</td><td align=\"center\" >".$item->name."</td><td align=\"center\" width=\"190px\">Haryo Aji Pambudi, S.Pd</td><tr>";
		$table .= "</table>";
		$table .= "<tr><td colspan=3><hr style=\"border: 1px dashed #000;\" /></td></tr>";
		$table .= "<table style=\"font-size:15px;\">";
		$table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\" width=\"475px\"><b>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br> UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
		$table .= "</tabel>";
		$table .= "<table style=\"font-size:15px;\">";
		$table .= "<tr><td colspan=3><hr style=\"border: 1px double #000;\" /></td></tr>";
		$table .= "<tr><td colspan=3 align=\"center\"><b>SURAT PERNYATAAN</b></td></tr>";
		$table .= "<tr><td colspan=3>Saya yang bertanda tangan dibawah ini: </td></tr>";
		$table .= "<tr><td>Nama </td><td>: ".$item->name."</td><td> </td></tr>";
		$table .= "<tr><td>NIM  </td><td>: ".$item->nim."</td><td> </td></tr>";
		$table .= "<tr><td>Jurusan </td><td colspan=2>: ".$this->get_major($item->department)."</td></tr>";
		$table .= "<tr><td>No.Telp </td><td>: ".$item->phone."</td><td> </td></tr>";
		$table .= "<tr><td>Judul   </td><td colspan=2>: ".$item->thesis_title."</td></tr>";
		$table .= "<tr><td colspan=3>Dengan ini menyatakan dengan sesungguhnya, bahwa saya bersedia menyerahkan hasil skripsi /
		tugas akhir saya dan memberikan wewenang sepenuhnya kepada pihak fakultas dalam penggunaan hasil karya saya</td></tr>";
		$table .= "<tr><td colspan=3 align=\"right\">Yogyakarta ". tanggal(date('Y-m-d'))."<td></tr>";
		$table .= "<tr><td align=\"center\">Mengetahui,<br /> KaSubbag Pendidikan</td><td align=\"center\">Yang Menyerahkan</td><td align=\"center\">Yang Menerima</td><tr>";
		$table .= "<tr><td align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sari.jpg\" height=\"50px\"><td><td></td><td></td></tr>";
		$table .= "<tr><td align=\"center\" width=\"190px\">Dra. Sari Puspita<br />Nip. 19630912 198812 2 001</td><td align=\"center\" >".$item->name."</td><td align=\"center\" width=\"190px\">Haryo Aji Pambudi, S.Pd</td><tr>";
		$table .= "</table>";
		echo $style;
		echo $table;
		