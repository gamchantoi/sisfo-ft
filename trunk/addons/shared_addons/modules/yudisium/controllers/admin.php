<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Yudisium
 * @category  	Module
 * @author		mrcoco@cempakaweb.com
 */

class Admin extends Admin_Controller {
    
    protected $section = 'yudisium';
    
    protected $v_rules = array(
		    array(
			    'field' => 'name',
			    'label' => 'lang:yudisium_name',
			    'rules' => 'trim|htmlspecialchars|required|max_length[100]'
			  ),
		    array(
			    'field' => 'nim',
			    'label' => 'lang:yudisium_nim',
			    'rules' => 'trim|numeric|required|max_length[100]|callback__check_nim'
			  ),
		    array(
			    'field' => 'department',
			    'label' => 'lang:yudisium_department',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'pa',
			    'label' => 'lang:yudisium_pa',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'religion',
			    'label' => 'lang:yudisium_religion',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'sex',
			    'label' => 'lang:yudisium_gender',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'meriage',
			    'label' => 'lang:yudisium_merriage',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'place_of_birth',
			    'label' => 'lang:yudisium_pob',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'date_of_birth',
			    'label' => 'lang:yudisium_dob',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'address',
			    'label' => 'lang:yudisium_address',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'parrent',
			    'label' => 'lang:yudisium_parrent',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'parrent_address',
			    'label' => 'lang:yudisium_parrent_address',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'parrental',
			    'label' => 'lang:yudisium_parental',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'soo',
			    'label' => 'lang:yudisium_soo',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'school_address',
			    'label' => 'lang:yudisium_school_address',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'graduation',
			    'label' => 'lang:yudisium_graduation',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'sks',
			    'label' => 'lang:yudisium_sks',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'ipk',
			    'label' => 'lang:yudisium_ipk',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'thesis',
			    'label' => 'lang:yudisium_thesis',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'thesis_title',
			    'label' => 'lang:yudisium_thesis_title',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'lecture',
			    'label' => 'lang:yudisium_lecture',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'start',
			    'label' => 'lang:yudisium_start',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'finish',
			    'label' => 'lang:yudisium_finish',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'yudisium_date',
			    'label' => 'lang:yudisium_date',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'sma',
			    'label' => 'lang:yudisium_sma',
			    'rules' => 'trim'
		    ),
		    array(
			    'field' => 'phone',
			    'label' => 'lang:yudisium_phone',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'email',
			    'label' => 'lang:yudisium_email',
			    'rules' => 'trim|required'
		    )
		);
    
    public function __construct()
	{
		parent::__construct();

		$this->lang->load('yudisium');
		$this->load->model('yudisium_m','ym');
		$this->data->prodies  = $this->prodies();
		$this->data->lectures = $this->lectures();
		$this->load->library('form_validation');
		$this->load->helper('tanggal');
		$this->load->helper('printed');
		$this->data->religions= $this->ym->get_religions();
	}
    
    public function index() {
		$base_where = array('printed' => 'all');

		//add post values to base_where if f_module is posted
		$base_where = $this->input->post('f_category') ? $base_where + array('category' => $this->input->post('f_category')) : $base_where;

		$base_where['printed'] = $this->input->post('f_printed') ? $this->input->post('f_printed') : $base_where['printed'];

		//$base_where = $this->input->post('f_datein') ? $base_where + array('date' => $this->input->post('f_datein')) : $base_where;
		$base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;
	    
		// Create pagination links
		$total_rows = $this->ym->count_by($base_where);
		$pagination = create_pagination('admin/yudisium/index', $total_rows);
		

		// Using this data, get the relevant results
		$data = $this->ym->limit($pagination['limit'])->get_many_by($base_where);
		//do we need to unset the layout because the request is ajax?
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
		
		$this->template
			->title($this->module_details['name'])
			->append_js('admin/filter.js')
			->append_js('module::jquery.printPage.js')
			->append_js('module::jquery.qtip.js')
			->append_css('module::jquery.qtip.css')
			->set('base_where',$base_where)
			->set('pagination', $pagination)
			->set('data', $data);

		$this->input->is_ajax_request() ? $this->template->build('admin/tables/yudis', $this->data) : $this->template->build('admin/index', $this->data);
    }
    
    public function create() {
	$this->form_validation->set_rules($this->v_rules);
	if($this->form_validation->run())
	{
	    
	    $id=$this->ym->insert(array(
			'name'	            => $this->input->post('name'),
                        'date'              => date('Y-m-d H:i:s'),
			'nim'	            => $this->input->post('nim'),
			'department'        => $this->input->post('department'),
			'pa'	            => $this->input->post('pa'),
			'place_of_birth'    => $this->input->post('pob'),
                        'date_of_birth'     => $this->input->post('dob'),
                        'religion'          => $this->input->post('religion'),
                        'sex'               => $this->input->post('sex'),
                        'meriage'           => $this->input->post('meriage'),
                        'address'           => $this->input->post('address'),
			'parrent'   	    => $this->input->post('parrent'),
			'parrent_address'   => $this->input->post('parrent_address'),
                        'parrental'         => $this->input->post('parrental'),
                        'soo'               => $this->input->post('soo'),
                        'school_address'    => $this->input->post('school_address'),
                        'sma'               => $this->input->post('sma'),
                        'graduation'        => $this->input->post('graduation'),
                        'ipk'               => $this->input->post('ipk'),
                        'sks'               => $this->input->post('sks'),
                        'thesis'            => $this->input->post('thesis'),
                        'thesis_title'      => $this->input->post('thesis_title'),
                        'lecture'           => $this->input->post('lecture'),
                        'start'             => $this->input->post('start'),
                        'finish'            => $this->input->post('finish'),
                        'yudisium_date'     => $this->input->post('yudisium_date'),
                        'phone'             => $this->input->post('phone'),
                        'email'             => $this->input->post('email')
						    ));
                                                    
	    if ($id)
	    {
		$this->pyrocache->delete_all('ym');
		$this->session->set_flashdata(array('success' => sprintf(lang('yudisium_add_success'), $this->input->post('title'))));
			
	    }
	    else
	    {
		$this->session->set_flashdata('error', $this->lang->line('yudisium_add_error'));
	    }
	    
	    $this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium') : redirect('admin/yudisium/edit/' . $id);
	}else{
	    foreach ($this->v_rules as $key => $field)
			{
				$data->$field['field'] = set_value($field['field']);
			}
	}
    	$this->template
			->title($this->module_details['name'], lang('yudisium_create_title'))
			->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
			->append_js('module::jquery.tagsinput.min.js')
			->append_js('module::blog_form.js')
			->append_css('module::jquery.tagsinput.css')
			->set('data', $data)
			->build('admin/form');
    }

    public function edit($id=0)
    {
	$id OR redirect('admin/yudisium');
	$data= $this->ym->get($id);
	$this->form_validation->set_rules(array_merge($this->v_rules, array(
			'title' => array(
				'field' => 'nim',
				'label' => 'lang:yudisium_nim_label',
				'rules' => 'trim|htmlspecialchars|required|max_length[100]|callback__check_nim['.$id.']'
			),
		)));
	if($this->form_validation->run()){
	    $result = $this->ym->update($id,array(
			'name'	            => $this->input->post('name'),
                        'date'              => $this->input->post('date'),
			'nim'	            => $this->input->post('nim'),
			'department'        => $this->input->post('department'),
			'pa'	            => $this->input->post('pa'),
			'place_of_birth'    => $this->input->post('pob'),
                        'date_of_birth'     => $this->input->post('dob'),
                        'religion'          => $this->input->post('religion'),
                        'sex'               => $this->input->post('sex'),
                        'meriage'           => $this->input->post('meriage'),
                        'address'           => $this->input->post('address'),
			'parrent'	    => $this->input->post('parrent'),
			'parrent_address'   => $this->input->post('parrent_address'),
                        'parrental'         => $this->input->post('parrental'),
                        'soo'               => $this->input->post('soo'),
                        'school_address'    => $this->input->post('school_address'),
                        'sma'               => $this->input->post('sma'),
                        'graduation'        => $this->input->post('graduation'),
                        'ipk'               => $this->input->post('ipk'),
                        'sks'               => $this->input->post('sks'),
                        'thesis'            => $this->input->post('thesis'),
                        'thesis_title'      => $this->input->post('thesis_title'),
                        'lecture'           => $this->input->post('lecture'),
                        'start'             => $this->input->post('start'),
                        'finish'            => $this->input->post('finish'),
                        'yudisium_date'     => $this->input->post('yudisium_date'),
                        'phone'             => $this->input->post('phone'),
                        'email'             => $this->input->post('email')
						    ));
	    if ($result)
		{
		    $this->session->set_flashdata(array('success' => sprintf(lang('yudisium_edit_success'), $this->input->post('name'))));
		}
		else
		    {
			$this->session->set_flashdata('error', $this->lang->line('yudisium_edit_error'));
		    }

			// Redirect back to the form or main page
			$this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium') : redirect('admin/yudisium/edit/' . $id);
	}
	// Go through all the known fields and get the post values
		foreach ($this->v_rules as $key => $field)
		{
			if (isset($_POST[$field['field']]))
			{
				$data->$field['field'] = set_value($field['field']);
			}
		}
		$this->template
			->title($this->module_details['name'], sprintf(lang('yudisium_edit_title'), $data->name))
			->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
			->append_metadata('<script type="text/javascript">
					  $(function() {
					  $( "#d_input" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true});
					  $( "#d_yudis" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#d_start" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#d_finish" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  });</script>')
			->append_js('module::jquery.tagsinput.min.js')
			->append_js('module::blog_form.js')
			->append_css('module::jquery.tagsinput.css')
			->set('data', $data)
			->build('admin/form');
    }

    public function preview($id=0)
    {
	$this->data->item	= $this->ym->get($id);
	$this->data->printed	= $this->get_printed($id);
	$this->data->lecture    = $this->get_name($this->data->item->lecture);
	$this->data->religion	= $this->get_religion($this->data->item->religion);
	$this->data->printed 	= $this->get_printed($id);
	$this->load->view('admin/view',$this->data);
    }
    
    public function cetak($id=0)
    {
	$id OR redirect('admin/yudisium');
	$item= $this->ym->get($id);
	$d3= array('1','2','3','4','5','6','7','8');
	$s1= array('9','10','11','12','13','14','15','16','17','18');
	
	$style  = "<title>Cetak Isian kelulusan</title>
		    <style type=\"text/css\" >
		    body {
		    height: 842px;
		    width: 595px;
		    margin-left: auto;
		    margin-right: auto;
		    }
		    </style>";
	$table  = "<table style=\"font-size:14px;\">";
	$table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"80px\"><td  align=\"center\" width=\"435px\"><b>UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK<br><br>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM ";
	if(in_array($item->department,$d3)) :
		$table .= "DIPLOMA III (DIII)";
	else :
		$table .= "STRATA 1 (S1)";
	endif;
		
	$table .= "</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"80px\" align=\"right\"></td></tr>";
	//$table .= "<tr><td width=\"80px\"><td  align=\"center\" width=\"435px\"><b>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM SARJANA/DIPLOMA 3</b></td><td  width=\"80px\"></td></tr>";
	$table .= "<tr><td colspan=3 align=\"right\" ><font size=1.5>FRM/TKF/21-00 <br>02 Juli 2007</font></td></tr>";
	$table .= "<tr><td colspan=3><hr></td></tr>";
	$table .= "</table><table>";
	$table .= "<tr><td>1.</td><td>Nama</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->name."</td></tr>";
	$table .= "<tr><td>2.</td><td>No. Mahasiswa</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->nim."</td></tr>";
	$table .= "<tr><td>3.</td><td>Program Studi</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".lang('yudisium_dp_'.$item->department)."</td></tr>";
	$table .= "<tr><td>4.</td><td width=\"160px\">Tempat, Tanggal Lahir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->place_of_birth.",  ".tanggal($item->date_of_birth)."</td></tr>";
	$table .= "<tr><td>5.</td><td>Agama</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$this->get_religion($item->religion)."</td></tr>";
	$table .= "<tr><td>6.</td><td>Jenis Kelamin</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".lang('yudisium_sex_'.$item->sex)."</td></tr>";
	$table .= "<tr><td>7.</td><td>Status</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->meriage."</td></tr>";
	$table .= "<tr><td>8.</td><td>Alamat Sekarang</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->address."</td></tr>";
	$table .= "<tr><td>9.</td><td>Nama Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrent."</td></tr>";
	$table .= "<tr><td>10.</td><td>Alamat Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrent_address."</td></tr>";
	$table .= "<tr><td>11.</td><td>Diterima di FT Melalui</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrental."</td></tr>";
	$table .= "<tr><td>12.</td><td>Sekolah Asal</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->soo."</td></tr>";
	$table .= "<tr><td>13.</td><td>Alamat Sekolah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->school_address."</td></tr>";
	$table .= "<tr><td>14.</td><td>Tugas Akhir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->thesis."</td></tr>";
	$table .= "<tr><td valign=\"top\">15.</td><td valign=\"top\">Judul</td><td valign=\"top\">:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->thesis_title."</td></tr>";
	$table .= "<tr><td>16.</td><td>Dosen Pembimbing</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$this->get_name($item->lecture)."</td></tr>";
	$table .= "<tr><td>17.</td><td width=\"170px\">Lulus Tugas Akhir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".tanggal($item->finish)." &nbsp; <b>IPK:</b> ".$item->ipk." &nbsp; <b>Total SKS:</b> ".$item->sks."</td></tr>";
	$table .= "<tr><td>18.</td><td>Lama Penulisan TA</td><td>:</td><td>&nbsp;&nbsp;</td><td>dari  ".tanggal($item->start)."</td><td>s.d. ".tanggal($item->finish)."</td></tr>";
	$table .= "<tr><td>19.</td><td>Cuti Kuliah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->vacation." kali</td></tr>";
	$table .= "<tr><td>20.</td><td>Tanggal Yudisium</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> <b>".tanggal($item->yudisium_date)."</b></td></tr>";
	$table .= "</table>";
	$table .= "<table>";
	$table .= "<tr><td align=\"center\">Mengetahui</td><td width=\"350px\" align=\"right\">Yogyakarta ".tanggal(date('Y-m-d'))."</td></tr>";
	$table .= "<tr><td align=\"center\">Dosen PA</td><td width=\"350px\" align=\"right\">Mahasiswa yang Bersangkutan</td></tr>";
	$table .= "<tr><td colspan=2><br /></td></tr>";
	$table .= "<tr><td align=\"center\">".$this->get_name($item->pa)."</td><td align=\"center\"  style=\"padding-left: 100px; \">".$item->name."</td></tr>";
	$table .= "<tr><td align=\"center\">NIP ".$this->get_nip($item->pa)."</td><td align=\"center\"  style=\"padding-left: 100px; \">NIM ".$item->nim."</td></tr>";
	$table .= "<tr><td colspan=2 align=\"center\">Mengetahui, <br />Pembentu Dekan I</td></tr>";
	//$table .= "<tr><td colspan=4 align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sunar-ttd.png\" width=\"100\"></td></tr>";
	$table .= "<tr><td colspan=2 align=\"center\"><br /></td></tr>";
	$table .= "<tr><td colspan=2 align=\"center\">Dr. Soenaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
	$table .= "</table>";
	echo $style;
	echo $table;
	echo "<hr>";
	echo "<p align=\"center\"  style=\"font-size : x-small;\">Setelah ditandatangani PD I, agar digandakan sebanyak 5 (lima) lembar, dengan warna BIRU UNTUK EKO/EKA, HIJAU UNTUK MES/OTO, KUNING UNTUK SIP, MERAH MUDA UNTUK PTBB dan distempel</p>";
	echo "<p align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</p>";
	$this->ym->update($id,array('printed' => '1'));
	$this->ym->add_print($id,'4');
    }
    
    public function repo($id=0)
    {
	$id OR redirect('admin/yudisium');
	$item= $this->ym->get($id);
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
	    $table .= "<tr><td align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/eko.jpg\" height=\"30px\"><td><td></td><td></td></tr>";
	    $table .= "<tr><td align=\"center\" width=\"190px\">Drs.Eka Purwana<br /> Nip. 19600905 198812 1 001</td><td align=\"center\" >".$item->name."</td><td align=\"center\" width=\"190px\">Haryo Aji Pambudi, S.Pd</td><tr>";
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
	    $table .= "<tr><td align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/eko.jpg\" height=\"30px\"><td><td></td><td></td></tr>";
	    $table .= "<tr><td align=\"center\" width=\"190px\">Drs.Eka Purwana<br /> Nip. 19600905 198812 1 001</td><td align=\"center\" >".$item->name."</td><td align=\"center\" width=\"190px\">Haryo Aji Pambudi, S.Pd</td><tr>";
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	    
    }
    
    public function report(){
		
	}
	
    public function decree(){
		$data= $this->ym->get_yudisium();
		$this->template
			->title($this->module_details['name'], lang('yudisium_decree'))
			->append_js('module::jquery.printPage.js')
			->set('data', $data)
			->build('admin/decree');
	}
   public function cetak_sk($date){
   	$style  = "
		    <title>Surat Keputusan Dekan</title>
		    <style type=\"text/css\" >
		    body {
		    height: 842px;
		    width: 595px;
		    margin-left: auto;
		    margin-right: auto;
		    }
		    tr.yellow td {
			border: 1px solid #FB7A31;
			font-size:60%;
			}
			tr.smaller td{
				font-size:70%;
				font-weight: bold;
			}
		    </style>";
	$table  = "<table style=\"font-size:15px;\">";
	$table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\" width=\"475px\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	$table .= "<tr><td align=\"center\" colspan=3><b>KEPUTUSAN DEKAN FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA <br> NOMOR :    TAHUN  <br> TENTANG <br> YUDISIUM PROGRAM DIPLOMA-3 (D-3) DAN STRATA-1 (S-1) <br> MAHASISWA FAKULTAS TEKNIK UNIVERSITAS NEGERI YOGYAKARTA<br>";
	$table .= "PERIODE <br><br> DEKAN FAKULTAS TEKNIK <br> UNIVERSITAS NEGERI YOGYAKARTA</b></td></tr>";    
	$table .= "</tabel>";
	$table .= "<table>";
	$table .= "<tr class='smaller'><td valign=\"top\">Menimbang</td><td valign=\"top\">:</td><td valign=\"top\">a.</td><td style=\"padding-left: 10px; \">bahwa sehubungan dengan telah selesainya studi beberapa mahasiswa Fakultas Teknik Universitas Negeri Yogyakarta Program Diploma-3 (D-3) dan Strata-1 (S-1) dipandang perlu untuk diyudisiumkan.</td></tr>";
	$table .= "<tr class='smaller'><td></td><td></td><td valign=\"top\">b.</td><td style=\"padding-left: 10px; \">bahwa untuk keperluan seperti tersebut di atas perlu ditetapkan dengan keputusan Dekan</td></tr>";
	$table .= "<tr class='smaller'><td valign=\"top\">Mengingat</td><td>:</td><td valign=\"top\">1.</td><td style=\"padding-left: 10px; \">Undang-undang RI Nomor 20 Tahun 2003;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>2.</td><td style=\"padding-left: 10px; \">Peraturan Pemerintah RI Nomor 60 Tahun 1999;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>3.</td><td style=\"padding-left: 10px; \">Keputusan Presiden RI : <br>a. Nomor 93 Tahun 1999<br>b. Nomor 240/M Tahun 2003;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>4.</td><td style=\"padding-left: 10px; \">Keputusan Menteri Pendidikan Nasional RI Nomor 23 Tahun 2011;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>5.</td><td style=\"padding-left: 10px; \">Keputusan Menteri Pendidikan Nasional RI Nomor 34 Tahun 2011;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>6.</td><td style=\"padding-left: 10px; \">Keputusan Rektor IKIP YOGYAKARTA Nomor 024 Tahun 1998;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right'>7.</td><td style=\"padding-left: 10px; \">Keputusan Rektor Nomor 01 Tahun 2011;</td></tr>";
	$table .= "<tr class='smaller'><td colspan=3 align='right' valign=\"top\">8.</td><td style=\"padding-left: 10px; \">Keputusan Rektor Universitas Negeri Yogyakarta : <br>a. Nomor 207 Tahun 2000; &nbsp;&nbsp;&nbsp;c. Nomor 297 Tahun 2006 <br>b. Nomor 303 Tahun 2000; &nbsp;&nbsp;&nbsp;d. Nomor: 1160/UN34/KP/2011</td></tr>";
	$table .= "</table>";
	$table .= "<table>";
	$table .= "<tr><td colspan=4 align='center'><b>MEMUTUSKAN</b></td></tr>";
	$table .= "<tr class='smaller'><td>Menetapkan</td><td>:</td><td colspan=4></td></tr>";
	$table .= "<tr class='smaller'><td valign='top'>Pertama</td><td valign='top'>:</td><td></td><td colspan=2>Yudisium Mahasiswa Program Diploma-3 (D-3) dan Strata-1 (S-1) Fakultas Teknik Universitas Negeri Yogyakarta Periode yang nama-namanya seperti tersebut pada lampiran 1 dan lampiran 2 Keputusan ini.</td></tr>";
	$table .= "<tr class='smaller'><td valign='top'>Kedua</td><td valign='top'>:</td><td></td><td colspan=2>Mahasiswa yang namanya seperti tersebut pada diktum Pertama tersebut di atas berhak mengikuti wisuda dalam Upacara Wisuda Universitas Negeri Yogyakarta sesuai dengan ketentuan yang berlaku.</td></tr>";
	$table .= "<tr class='smaller'><td valign='top'>Ketiga</td><td valign='top'>:</td><td></td><td colspan=2>Keputusan ini berlaku sejak ditetapkan.</td></tr>";
	$table .= "<tr class='smaller'><td valign='top'>Keempat</td><td valign='top'>:</td><td></td><td colspan=2>Segala sesuatu akan diubah dan dibetulkan sebagaimana mestinya apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini.</td></tr>";
	$table .= "</table>";
	$table .= "<table>";
	$table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \">Ditetapkan di :  Yogyakarta</td></tr>";
	$table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \"><u>Pada tanggal : ".tanggal($date)." </u></td></tr>";
	$table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \"><br>Dekan, <br><img src=\"".base_url().$this->module_details['path']."/img/brur.gif\" height=\"50px\"><br>Dr. Moch. Bruri Triyono<br>NIP 19560216 198603 1 003</td></tr>";
	$table .= "<tr class='smaller'><td colspan=2>Tembusan Yth. :</td></tr>";
	$table .= "<tr class='smaller'><td>1. Rektor  <br>2. Para Pembantu Rektor<br>3. Para Kepala Biro<br>4. Para Dekan<br>5. Kabag. Pend. dan Kerjasama;<br>6. Kabag. Kemahasiswaan</td><td style=\"padding-left: 190px; \">7.Kasubag Registrasi dan Statistik<br>8. Para Pembantu Dekan FT<br>9. Para Ketua Jurusan/Program Studi FT<br>10. Kasubag Pendidikan FT<br>11. Yang Bersangkutan; <br> Universitas Negeri Yogyakarta</td></tr>";
	$table .= "</table>";
	$table .= "<table>";
	$table .= "<tr class='yellow'><td width='70px' valign='top'>Dibuat Oleh :<br><br> &nbsp;</td><td align='center' valign='top'>Dilarang memperbanyak sebagian atau seluruh isi document tanpa ijin tertulis dari Fakultas Teknik Universitas Negeri Yogyakarta</td><td width='70px' valign='top'>Diperiksa Oleh<br><br>&nbsp;</td></tr>";
	//$table .= "<table>";
	$table .= "</table>";
	echo $style;
	echo $table;			
   }
   public function get_printed($id=0)
    {
	$result=$this->ym->get_print($id);
	return $result;
    }
   public function get_religion($id)
   {
	$result = $this->ym>get_religion($id);
	return $result;
   }

   public function get_major($id=0)
   {
     $result=$this->ym->get_major($id);
     return $result;
   }
   
   public function get_name($id=0)
   {
	$result=$this->ym->get_lecture_by('id',$id);
	return $result->name;
   }
   
  
   public function get_nip($id=0)
   {
     $result=$this->ym->get_lecture_by('id',$id);
     return $result->nip;
   }
    //tampil program studi
    public function prodies()
    {
        $result= array(0 => 'Pilih Program Studi');
	    if($prodies = $this->ym->get_dept())
	    {
		foreach($prodies as $dpt)
		{
		    $result[$dpt->id] = $dpt->name;
		}
	    }
        return $result;
    }
    
    // tampil dosen
    public function lectures()
    {
        $result= array(0 => 'Pilih Dosen');
	    if($lectures = $this->ym->get_lecture())
	    {
		foreach($lectures as $lec){
		    $result[$lec->id]= $lec->name;
		}
	    }
        return $result;
    }
    
    public function ajax_filter()
	{
		//$category = $this->input->post('f_category');
		$status = $this->input->post('f_printed');
		$keywords = $this->input->post('f_keywords');
		//$datein   = $this->input->post('f_datein');
		$post_data = array();

		if ($status == '1' OR $status == '2')
		{
			$post_data['printed'] = $status;
		}
		
		/**
		if($datein)
		{
		    $post_data['date'] = $datein;
		}
		**/
		
		//keywords, lets explode them out if they exist
		if ($keywords)
		{
			$post_data['keywords'] = $keywords;
		}
		$results = $this->ym->search($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('data', $results)
			->build('admin/tables/yudis');
	}
	
    public function _check_nim($nim, $id = null)
	{
		$this->form_validation->set_message('_check_nim', sprintf(lang('yudisium_already_exist_error'), lang('yudisium_nim_label')));
		return $this->ym->check_exists('nim', $nim, $id);			
	}
    
}