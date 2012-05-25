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
	$table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"80px\"><td  align=\"center\" width=\"435px\"><b>UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK<br><br>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM SARJANA/DIPLOMA 3</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"80px\" align=\"right\"></td></tr>";
	//$table .= "<tr><td width=\"80px\"><td  align=\"center\" width=\"435px\"><b>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM SARJANA/DIPLOMA 3</b></td><td  width=\"80px\"></td></tr>";
    $table .= "<tr><td colspan=3 align=\"right\">FRM/TKF/21-00 <br>02 Juli 2007</td></tr>";
    //$table .= "<tr><td colspan=3><hr></td></tr>";
	$table .= "</table><table>";
	$table .= "<tr><td>Nama</td><td colspan=2>: ".$item->name."</td></tr>";
	$table .= "<tr><td>No. Mahasiswa</td><td colspan=2>: ".$item->nim."</td></tr>";
	$table .= "<tr><td>Program Studi</td><td colspan=2>: ".lang('yudisium_dp_'.$item->department)."</td></tr>";
	$table .= "<tr><td width=\"160px\">Tempat, Tanggal Lahir</td><td colspan=2>: ".$item->place_of_birth.",  ".tanggal($item->date_of_birth)."</td></tr>";
	$table .= "<tr><td>Agama</td><td colspan=2>: ".$this->get_religion($item->religion)."</td></tr>";
	$table .= "<tr><td>Status</td><td colspan=2>: ".$item->meriage."</td></tr>";
	$table .= "<tr><td>Alamat Sekarang</td><td colspan=2>: ".$item->address."</td></tr>";
	$table .= "<tr><td>Nama Orang Tua</td><td colspan=2>: ".$item->parrent."</td></tr>";
	$table .= "<tr><td>Alamat Orang Tua</td><td colspan=2>: ".$item->parrent_address."</td></tr>";
	$table .= "<tr><td>Sekolah Asal</td><td colspan=2>: ".$item->soo."</td></tr>";
	$table .= "<tr><td>Alamat Sekolah</td><td colspan=2>: ".$item->school_address."</td></tr>";
	$table .= "<tr><td>Tugas Akhir</td><td colspan=2>: ".$item->thesis."</td></tr>";
	$table .= "<tr><td>judul</td><td colspan=2>: ".$item->thesis_title."</td></tr>";
	$table .= "<tr><td>Dosen Pembimbing</td><td colspan=2>: ".$item->lecture."</td></tr>";
	$table .= "<tr><td width=\"170px\">Lulus Tugas Akhir</td><td colspan=2 width=\"200px\">: ".tanggal($item->finish)." &nbsp;&nbsp; IPK: ".$item->ipk." &nbsp;&nbsp; Total SKS: ".$item->sks."</td></tr>";
	$table .= "<tr><td>Lama Penulisan TA</td><td>dari  ".tanggal($item->start)."</td><td>s.d. ".tanggal($item->finish)."</td></tr>";
	$table .= "<tr><td>Cuti Kuliah</td><td colspan=2>: </td></tr>";
	$table .= "<tr><td>Tanggal Yudisium</td><td colspan=2>: ".tanggal($item->yudisium_date)."</td></tr>";
	$table .= "<tr><td align=\"center\">Mengetahui</td><td colspan=2 align=\"right\">Yogyakarta ".tanggal(date('Y-m-d'))."</td></tr>";
	$table .= "<tr><td align=\"center\">Dosen PA</td><td></td><td width=\"150px\" align=\"center\">Mahasiswa yang <br>Bersangkutan</td></tr>";
	$table .= "<tr><td colspan=3><br /><br /></td></tr>";
	$table .= "<tr><td align=\"center\">".$this->get_name($item->pa)."</td><td></td><td align=\"center\">".$item->name."</td></tr>";
	$table .= "<tr><td align=\"center\">".$this->get_nip($item->pa)."</td><td></td><td align=\"center\">".$item->nim."</td></tr>";
	$table .= "<tr><td colspan=3 align=\"center\">Mengetahui, <br />Pembentu Dekan I</td></tr>";
	$table .= "<tr><td colspan=3 align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sunar-ttd.png\" width=\"100\"></td></tr>";
	$table .= "<tr><td colspan=3 align=\"center\">Dr. Soenaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
	$table .= "</table>";
	echo $style;
	echo $table;
	echo "<hr>";
	echo "<p align=\"center\"  style=\"font-size : x-small;\">Setelah ditandatangani PD I, agar digandakan sebanyak 5 (lima) lembar, dengan warna BIRU UNTUK EKO/EKA, HIJAU UNTUK MES/OTO, KUNING UNTUK SIP, MERAH MUDA UNTUK PTBB dan distempel</p>";
	echo "<p align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</p>";
	$this->ym->update($id,array('printed' => '1'));
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
	    $table .= "<tr><td colspan=3><hr style=\"border: 1px solid #000;\" /></td></tr>";
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
	    $table .= "<tr><td colspan=3><hr style=\"border: 1px dashed #000;\" /></td></tr>";
	    $table .= "<table style=\"font-size:15px;\">";
	    $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\" width=\"475px\"><b>KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN <br> UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "</tabel>";
	    $table .= "<table style=\"font-size:15px;\">";
	    $table .= "<tr><td colspan=3><hr style=\"border: 1px solid #000;\" /></td></tr>";
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
    

   public function get_printed($id=0)
    {
	$result=$this->ym->get_print($id);
	return $result;
    }
   public function get_religion($id)
   {
	$result = $this->ym->get_religion($id);
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