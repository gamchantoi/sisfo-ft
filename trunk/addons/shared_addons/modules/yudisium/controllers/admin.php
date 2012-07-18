<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Yudisium
 * @category  	Module
 * @author	mrcoco@cempakaweb.com
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
		$this->load->library('ExportToExcel');
		$this->load->helper('tanggal');
		$this->load->helper('printed');
		$this->load->helper('yudisium');
		$this->data->religions= $this->ym->get_religions();
	}
    
    public function index()
	{
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
    
    public function create()
	{
	    $this->form_validation->set_rules($this->v_rules);
	    if($this->form_validation->run())
	    {
		
		$id=$this->ym->insert(array(
			    'name'	        => $this->input->post('name'),
			    'date'              => date('Y-m-d H:i:s'),
			    'nim'	        => $this->input->post('nim'),
			    'department'        => $this->input->post('department'),
			    'pa'	        => $this->input->post('pa'),
			    'place_of_birth'    => $this->input->post('place_of_birth'),
			    'date_of_birth'     => $this->input->post('date_of_birth'),
			    'religion'          => $this->input->post('religion'),
			    'sex'               => $this->input->post('sex'),
			    'meriage'           => $this->input->post('meriage'),
			    'address'           => $this->input->post('address'),
			    'parrent'   	=> $this->input->post('parrent'),
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
			    'name'	        => $this->input->post('name'),
			    'date'              => $this->input->post('date'),
			    'nim'	        => $this->input->post('nim'),
			    'department'        => $this->input->post('department'),
			    'pa'	        => $this->input->post('pa'),
			    'place_of_birth'    => $this->input->post('place_of_birth'),
			    'date_of_birth'     => $this->input->post('date_of_birth'),
			    'religion'          => $this->input->post('religion'),
			    'sex'               => $this->input->post('sex'),
			    'meriage'           => $this->input->post('meriage'),
			    'address'           => $this->input->post('address'),
			    'parrent'	    	=> $this->input->post('parrent'),
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
					      $( "#d_input" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					      $( "#d_yudis" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					      $( "#d_start" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					      $( "#d_finish" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					      $( "#d_dob" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					      });</script>')
			    ->append_js('module::jquery.tagsinput.min.js')
			    ->append_js('module::blog_form.js')
			    ->append_css('module::jquery.tagsinput.css')
			    ->set('data', $data)
			    ->build('admin/form');
	}

    public function preview($id=0)
	{
	    $this->data->item		= $this->ym->get($id);
	    $this->data->printed	= $this->get_printed($id);
	    $this->data->lecture    	= $this->get_name($this->data->item->lecture);
	    $this->data->religion	= $this->get_religion($this->data->item->religion);
	    $this->data->printed 	= $this->get_printed($id);
	    $this->load->view('admin/view',$this->data);
	}
	
    //fungsi rekap data peserta yudisium
    public function report(){
	    $data= $this->ym->get_yudisium();
	    $this->template
			->title($this->module_details['name'], lang('yudisium_decree'))
			->append_js('module::jquery.printPage.js')
			->set('data', $data)
			->build('admin/report');
	}
	
	//fungsi tampil data Surat keputusan Dekan
    public function decree()
	{
	    $data	= $this->ym->get_yudisium();
	    
	    $this->template
			->title($this->module_details['name'], lang('yudisium_decree'))
			->append_js('module::jquery.printPage.js')
			->set('data', $data)
			->build('admin/decree');
	}
    
    public function style_print($title)
	{
	    $style  = "<title>".$title."</title>
			<style type=\"text/css\" >
			body {
			height: 842px;
			width: 595px;
			margin-left: auto;
			margin-right: auto;
			}
			</style>";
	    return $style;
	}
	
    public function style_report($bln,$thn)
	{
	    $style		="<title>Daftar Peserta Yudisium ".$bln." ".$thn."</title>
		<style type=\"text/css\" >
		    body {
			width: 842px;
			height: 595px;
			margin-left: auto;
			margin-right: auto;
			}
		    table.gridtable {
			font-family: verdana,arial,sans-serif;
			font-size:7px;
			color:#333333;
			border-width: 1px;
			border-color: #666666;
			border-collapse: collapse;
			width: 842px;			
			}
		    table.gridtable th {
			border-width: 1px;
			padding: 6px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
			}
		    table.gridtable td {
			border-width: 1px;
			padding: 5px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
					}
		</style>";
	    return $style;
	}
	
    //style css table
    public function style_table($title,$bln,$thn)
	{
	    $style		="<title>".$title." ".$bln." ".$thn."</title>
		<style type=\"text/css\" >
		    body {
			width: 595px;
			height:842px;
			margin-left: auto;
			margin-right: auto;
			}
		    table.header{
			width: 595px;			
		    }
		    table.header th{
			font-size:15px;
		    }
		    table.header td{
			font-size:11px;
		    }
		    table.gridtable {
			font-family: verdana,arial,sans-serif;
			font-size:12px;
			color:#333333;
			border-width: 1px;
			border-color: #666666;
			border-collapse: collapse;
			width: 595px;			
			}
		    table.gridtable th {
			border-width: 1px;
			padding: 6px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
			}
		    table.gridtable td {
			border-width: 1px;
			padding: 5px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
			}
		</style>";
		return $style;
	}
	
	//fungsi cetak Isian Kelulusan
    public function cetak($id=0)
	{
	    $id OR redirect('admin/yudisium');
	    $item= $this->ym->get($id);
	    $d3= array('1','2','3','4','5','6','7','8');
	    $s1= array('9','10','11','12','13','14','15','16','17','18');
	    $style  = $this->style_print('Cetak Isian Kelulusan');
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
	    $table .= "<tr><td valign=\"top\">15.</td><td valign=\"top\">Judul</td><td valign=\"top\">:</td><td>&nbsp;&nbsp;</td><td colspan=2><font size=\"1.9px\"><b> ".strtoupper($item->thesis_title)."</b></font></td></tr>";
	    $table .= "<tr><td>16.</td><td>Dosen Pembimbing</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$this->get_name($item->lecture)."</td></tr>";
	    $table .= "<tr><td>17.</td><td width=\"170px\">Lulus Tugas Akhir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".tanggal($item->finish)." &nbsp; <b>IPK:</b> ".$item->ipk." &nbsp; <b>Total SKS:</b> ".$item->sks."</td></tr>";
	    $table .= "<tr><td>18.</td><td>Lama Penulisan TA</td><td>:</td><td>&nbsp;&nbsp;</td><td>dari  ".tanggal($item->start)."</td><td>s.d. ".tanggal($item->finish)."</td></tr>";
	    $table .= "<tr><td>19.</td><td>Cuti Kuliah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->vacation." kali</td></tr>";
	    $table .= "<tr><td>20.</td><td>Tanggal Yudisium</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> <b>".tanggal($item->yudisium_date)."</b></td></tr>";
	    $table .= "</table>";
	    $table .= "<table>";
	    $table .= "<tr><td align=\"center\">Mengetahui</td><td width=\"350px\" align=\"right\">Yogyakarta ".tanggal($item->date)."</td></tr>";
	    $table .= "<tr><td align=\"center\">Dosen PA</td><td width=\"350px\" align=\"right\">Mahasiswa yang Bersangkutan</td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td align=\"center\">".$this->get_name($item->pa)."</td><td align=\"center\"  style=\"padding-left: 100px; \">".$item->name."</td></tr>";
	    $table .= "<tr><td align=\"center\">NIP ".$this->get_nip($item->pa)."</td><td align=\"center\"  style=\"padding-left: 100px; \">NIM ".$item->nim."</td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\">Mengetahui, <br />Wakil Dekan I</td></tr>";
	    //$table .= "<tr><td colspan=4 align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sunar-ttd.png\" width=\"100\"></td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\"><br /></td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\">Dr. Sunaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	    echo "<hr>";
	    echo "<p align=\"center\"  style=\"font-size : x-small;\">Setelah ditandatangani Wakil I, agar digandakan sebanyak 5 (lima) lembar, dengan warna BIRU UNTUK EKO/EKA, HIJAU UNTUK MES / OTO, KUNING UNTUK SIP, MERAH MUDA UNTUK PTBB dan distempel</p>";
	    echo "<p align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</p>";
	    $this->ym->update($id,array('printed' => '1'));
	    $this->ym->add_print($id,'4');
	}
	
	//fungsi cetak tanda terima Penyerahan CD Tugas Akhir
    public function repo($id=0)
	{
	    $id OR redirect('admin/yudisium');
	    $item= $this->ym->get($id);
		$style  = $this->style_print('Tanda Terima Penyerahan CD');
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
		$this->ym->update($id,array('printed_repo' => '1'));
		$this->ym->add_print($id,'8');
		
	}
    
	//fungsi cetak rekap peserta yudisium D3
    public function report_d3($date)
	{
	    $_tanggal 		= tanggal($date);
	    list($tgl,$bln,$thn)= explode(" ",$_tanggal);
	    $basewhere		= array('thesis' => 'D3','yudisium_date'=>$date,'order' => 'ipk','group'=>'department');
	    $data		= $this->ym->get_many_by($basewhere);
	    $i			= 1;
	    $style  = $this->style_report($bln,$thn);
	    $table  = "<table style=\"font-size:15px;\" align=\"center\">";
	    $table .= "<tr><td align=\"right\"><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td align=\"left\"><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=3><b>DAFTAR URUTAN IPK MAHASISWA D3<br>YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</td></tr>";
	    $table .= "<tr><td colspan=3><br></td></tr>";
	    $table .= "</tabel>";
	    $table .= "<table  class='gridtable' >";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th</td></tr>";
	    foreach ($data as $d)
	    {
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".$d->start."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$this->get_semester($d->nim,$d->yudisium_date)."</td><td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td><td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".$d->date_of_birth."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	}
	
	//fungsi cetak rekap peserta yudisium S1
    public function report_s1($date)
	{
	    $_tanggal 		= tanggal($date);
	    list($tgl,$bln,$thn)= explode(" ",$_tanggal);
	    $basewhere		= array('thesis' => 'Skripsi','yudisium_date'=>$date,'orderdesc' =>'ipk');
	    //$basewhere		= array('thesis' => 'Skripsi','yudisium_date'=>$date);
	    $data		= $this->ym->get_many_by($basewhere);
	    $i			= 1;
	    $style  = $this->style_report($bln,$thn);
	    $table  = "<table style=\"font-size:15px;\" align=\"center\" cellpadding=4>";
	    $table .= "<tr><td align=\"right\"><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td align=\"left\"><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=3><b>DAFTAR URUTAN IPK MAHASISWA S1<br>YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</td></tr>";
	    $table .= "<tr><td colspan=3><br></td></tr>";
	    $table .= "</tabel>";
	    $table .= "<table  class='gridtable' >";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th</td></tr>";
	    foreach ($data as $d)
	    {
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".tanggal($d->start)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$this->get_semester($d->nim,$d->yudisium_date)."</td><td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td><td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".tanggal($d->date_of_birth)."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }
	    
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	}
	
    public function attch_header($tgl,$bln,$thn,$thesis,$logo)
	{
	    $header  = "<table class=\"header\" align=\"center\">";
	    if($logo == 'yes')
	    {
		$header .= "<tr><th><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"></th><th align=\"center\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></th><th align=\"left\"><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></th></tr>";
	    }else{
		$header .= "<tr><th align=\"center\" colspan=3><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></th></tr>";
	    }
	    switch ($thesis)
		{
		    case	'D3'	:
			$stage	= "D3";
			$lamp	= 1;
			break;
		    case	'Skripsi':
			$stage	= "S1";
			$lamp	= 2;
			break;
		    default		:
			$header .= "<br />";
			break;
		}
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Lampiran $lamp Keputusan Dekan</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Fakultas Teknik Universitas Negeri Yogyakarta</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Nomor:         Tahun $thn</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Tanggal</td></tr>";
	    $header .= "<tr><td colspan=3><br /></td></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><b>DAFTAR NAMA MAHASISWA $stage FAKULTAS TEKNIK UNIVERSITAS NEGERI YOGYAKARTA</b></th></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><b> PESERTA YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</b></th></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><br /></th></tr>";
	    $header .= "</tabel>";
	    
	    return $header;    
	}
	
	//function view attch table
    public function attach_table($date,$thesis,$logo)
	{
	    //$parrams = array('yudisium_date'=>$date , 'thesis' => $thesis,'order' => 'ipk','group' => 'department');
	    $parrams = array('yudisium_date'=>$date , 'thesis' => $thesis);
	    $data	 = $this->ym->get_many_by($parrams);
	    $_tanggal	= tanggal($date);
	    list($tgl,$bln,$thn) = explode(" ",$_tanggal);
	    if($data)
	    {
		$i      = 1;
		$table  = $this->attch_header($tgl,$bln,$thn,$thesis,$logo);
		$table .= "<table class='gridtable' border=\"1px\">";
		$table .= "<tr><th>NO</th><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th>SKS</th><th>IPK</th><th>PREDIKAT</th></tr>";
		foreach ($data as $d)
		{
		    $table .= "<tr><td>$i</td><td>".(string)$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td></tr>";
		    $i++;
		}    
		$table .= "</table>";
	    }else{
		$table =  "Data Tidak tersedia";
	    }
	    return $table;
	}
	
	// function view export table
    public function export_table($date,$thesis)
	{
	    if($thesis   == 'all')
	    {
		$parrams = array('yudisium_date'=>$date);
	    }else{
		//$parrams = array('yudisium_date'=>$date , 'thesis' => $thesis);
		$parrams = array('yudisium_date'=>$date , 'thesis' => $thesis);
	    }
	    $data	 = $this->ym->get_many_by($parrams);
	    $_tanggal 		= tanggal($date);
	    list($tgl,$bln,$thn)= explode(" ",$_tanggal);
	    if($data){
	    $i      = 1;
	    $table  = "<table style=\"font-size:15px;\" align=\"center\">";
	    $table .= "<tr><td align=\"center\" colspan=17><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=17><b>DAFTAR URUTAN IPK MAHASISWA ";
	    switch ($thesis)
	    {
		case	'D3'	:
		    $table .= "D3<br>";
		    break;
		case	'Skripsi':
		    $table .= "S1<br>";
		    break;
		default		:
		    $table .= "<br />";
		    break;
	    }
	    $table .= "YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</td></tr>";
	    $table .= "<tr><td colspan=3><br></td></tr>";
	    $table .= "</tabel>";
	    $table .= "<table  class='gridtable' border=\"1px\">";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th</td></tr>";
	    foreach ($data as $d)
	    {
		//$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".tanggal($d->start)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$d->yudisium_date."</td><td>".$d->nim."</td><td>".$d->yudisium_date."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".$d->date_of_birth."</td><td>".$d->date_of_birth."</td></tr>";
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".tanggal($d->start)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$this->get_semester($d->nim,$d->yudisium_date)."</td><td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td><td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".tanggal($d->date_of_birth)."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }    
	    $table .= "</table>";
	    }else{
		$table = 'Maaf Data Tidak tersedia';
	    }
	    
	    return $table;
	}
	
	//function export lampiran SK dekan
    public function attch_xls($date,$thesis)
	{
	    $table	= $this->attach_table($date,$thesis,'no');
	    $excel	= new ExportToExcel();
	    if ($thesis == 'Skripsi')
	    {
		$excel->exportWithPage($table,"Lampiran2-SK-dekan-yudisium-s1-".$date.".xls");
	    }else{
		$excel->exportWithPage($table,"Lampiran1-SK-dekan-yudisium-d3-".$date.".xls");
	    }
	}
    
	//fungsi export excel data peserta yudisium    
    public function export_xls($date,$thesis)
	{
	    $table = $this->export_table($date,$thesis);
	    $excel= new ExportToExcel();
	    switch ($thesis)
	    {
		case	'D3'	:
		    $excel->exportWithPage($table,"Rekap-data-yudisium-d3-".$date.".xls");
		    break;
		case	'Skripsi':
		    $excel->exportWithPage($table,"Rekap-data-yudisium-s1-".$date.".xls");
		    break;
		default		:
		    $excel->exportWithPage($table,"Rekap-data-yudisium-all-".$date.".xls");
		    break;
	    }  
	}
	
	//fungsi cetak lampiran sk dekan
    public function print_attch($date,$thesis)
	{
	    list($thn,$bln,$tgl) = explode("-",$date);
	    $table = $this->attach_table($date,$thesis,'yes');
	    $style = $this->style_table('Cetak Lampiran SK Dekan Yudisium',$bln,$thn);
	    echo $style;
	    echo $table;
	}
	
	//fungsi cetak lampiran sk dekan mahasiswa d3
    public function pattch_d3($date)
	{
	    return $this->print_attch($date,'D3');
	}
	
	//fungsi cetak lampiran sk dekan mahasiswa s1
    public function pattch_s1($date)
	{
	    return $this->print_attch($date,'Skripsi');
	}
	
	//fungsi export excel lampiran sk dekan mahasiswa D3   
    public function attch_d3($date)
	{
	    return $this->attch_xls($date,'D3');
	}
	
	//fungsi export excel lampiran sk dekan mahasiswa S1
    public function attch_s1($date)
	{
	    return $this->attch_xls($date,'Skripsi');
	}
	
	//fungsi export excel data peserta Yudisium D3
    public function export_d3($date)
	{
	    return $this->export_xls($date,'D3');
	}
	
	//fungsi export excel data peserta Yudisium S1
    public function export_s1($date)
	{
	    return $this->export_xls($date,'Skripsi');
	}
	
	//fungsi export excel data peserta Yudisium S1-D3
    public function export_all($date)
	{
	    return $this->export_xls($date,'all');
	}
	
    public function header_logo()
	{
	    $header = "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"></td><td align=\"center\"><b>FAKULTAS TEKNIK <br /> UNIVERSITAS NEGERI YOGYAKARTA<br/></b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    return $header;
	}
	
    public function present_header($tgl,$bln,$thn,$thesis,$logo)
	{
	    $header	= "<table align=\"center\">";
	    $header    .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"></td><td align=\"center\"><b>FAKULTAS TEKNIK <br /> UNIVERSITAS NEGERI YOGYAKARTA<br/></b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $header    .= "<tr><td align=\"center\" colspan=3></td></tr>";
	    if($thesis == 'Skripsi')
	    {
		$header    .= "<tr><td align=\"center\" colspan=3><b>DAFTAR HADIR MAHASISWA S1 PESERTA YUDISIUM</b></td></tr>";
	    }else{
		$header    .= "<tr><td align=\"center\" colspan=3><b>DAFTAR HADIR MAHASISWA D3 PESERTA YUDISIUM</b></td></tr>";
	    }
	    $header    .= "<tr><td align=\"center\" colspan=3><b>PERIODE ".strtoupper($bln)." ".$thn."</b></td></tr>";
	    $header    .= "<tr><td align=\"center\" colspan=3></td></tr>";
	    $header    .= "</table>";
	    return $header;
	}
	
    public function odd_even($i)
	{
	    if($i % 2 == 0)
	    {
		//$res = "even";
		$res = "<td></td><td>".$i.")..........</td>";
	    }else{
		//$res = "odd";
		$res = "<td>".$i.")..........</td><td></td>";
	    }
	    return $res;
	}
	
    public function style_present($title,$bln,$thn)
	{
	    $style              ="<title>".$title." ".$bln." ".$thn."</title>
                <style type=\"text/css\">
                    body {
                        width: 595px;
                        height:842px;
                        margin-left: auto;
                        margin-right: auto;
                        }
                    table.header{
                        width: 595px;                   
                    }
                    table.header th{
                        font-size:15px;
                    }
                    table.header td{
                        font-size:11px;
                    }
                    table.gridtable {
                        font-family: verdana,arial,sans-serif;
                        font-size:12px;
                        color:#333333;
                        border-width: 1px;
                        border-color: #666666;
                        border-collapse: collapse;
                        width: 595px;                   
                        }
                    table.gridtable th {
                        border-width: 1px;
                        padding: 6px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #dedede;
                        }
                    table.gridtable td {
                        border-width: 1px;
                        padding: 5px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #ffffff;
			font-size:11px;
                        }
		    table.legend{
			font-family: verdana,arial,sans-serif;
                        font-size:9px;
                        color:#333333;
                        border-width: 1px;
                        border-color: #666666;
                        border-collapse: collapse;
                        width: 595px; 
		    }
		    table.legend td {
                        border-width: 1px;
                        padding: 3px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #ffffff;
			font-size:9px;
                        }
		    #even{
			background-color: #dddd;
			padding-left:50px;
		    }
		    #odd{
			background-color: #cccccc;
			padding-right:50px;
		    }
                </style>";
                return $style;
	}
    public function present_table($date,$thesis)
	{
	    $parrams 	= array('yudisium_date'=>$date , 'thesis' => $thesis,'order' => 'ipk','group' => 'department');
            $data       = $this->ym->get_many_by($parrams);
            $_tanggal   = tanggal($date);
            list($tgl,$bln,$thn) = explode(" ",$_tanggal);
            if($data)
            {
                $i      = 1;
		$table  = $this->style_present('Presensi',$bln,$thn);
                $table .= $this->present_header($tgl,$bln,$thn,$thesis,'no');
                $table .= "<table class='gridtable' border=\"1px\">";
                $table .= "<tr><th>NO</th><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th colspan=2>TANDA TANGAN</th></tr>";
                foreach ($data as $d)
                {
                    $table .= "<tr><td>$i</td><td>".(string)$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td>".$this->odd_even($i)."</tr>";
                    $i++;
                }    
                $table .= "</table>";
            }else{
                $table =  "Data Tidak tersedia";
            }
            return $table;
	}
    
    public function present_xls($date,$thesis)
	{
	    $present= $this->present_table($date,$thesis);
	    echo $present;
	    /**
	    $excel= new ExportToExcel();
	    switch ($thesis)
	    {
		case	'D3'	:
		    $excel->exportWithPage($present,"Presensi-Mahasiswa-D3-yudisium-".$date.".xls");
		    break;
		case	'Skripsi':
		    $excel->exportWithPage($present,"Presensi-Mahasiswa-S1-yudisium-".$date.".xls");
		    break;
		default		:
		    $excel->exportWithPage($present,"Presensi-Mahasiswa-yudisium-".$date.".xls");
		    break;
	    }
	    **/
	}
	
    public function present_s1($date)
	{
	    return $this->present_xls($date,'Skripsi');
	}
	
    public function present_d3($date)
	{
	    return $this->present_xls($date,'D3');
	}
	
    public function data_yudisium()
	{
	    $data	= $this->ym->get_yudisium();
	    $result	= array(0=>'Pilih Tanggal Yudisium');
	    foreach($data as $d)
	    {
		$result[$d->yudisium_date] = $d->yudisium_date;
	    }
	    return $result;
	}
	
    public function search()
	{
	   print_r($_POST);
	}
	//data lulusan    
    public function graduate()
	{
	    $data_yudis = $this->data_yudisium();
	    $this->template
			->title($this->module_details['name'], lang('yudisium_graduate'))
			->append_js('module::jquery.printPage.js')
			->set('data', $data_yudis)
			->build('admin/graduate');   
	}
	
    public function get_graduate()
	{
	   if(isset($_POST))
	    {
		$start	= $_POST['d_start'];
		$finish	= $_POST['d_finish'];
		$thesis = $_POST['prodi'];
		//$start  = '2012-06-28';
		//$finish = '2012-07-26';
		list($tgl1,$bln1,$thn1) = explode(" ",tanggal($start));
		list($tgl2,$bln2,$thn2) = explode(" ",tanggal($finish));
		
		if($thesis == 'Skripsi')
		{
		    $prodi = "S1";
		}else{
		    $prodi = "D3";
		}
		$style 	 = $this->style_present("Data Lulusan","","");
		$header  = "<table align=\"center\">";
		$header	.= $this->header_logo();
		$header .= "<tr><td colspan=\"3\"></td></tr>";
		$header .= "<tr><td colspan=\"3\" align=\"center\">DATA LULUSAN MAHASISWA ".$prodi." FAKULTAS TEKNIK <br> BULAN ".strtoupper($bln1)." ".$thn1." DAN ".strtoupper($bln2)." ".$thn2."</td></tr>";
		$header	.= "<tr><td colspan=\"3\"></td></tr>";
		$header .= "</table>";
		$table 	 = "<table class=\"gridtable\" border=\"1px\">";
		$table	.= "<tr><th>No</th><th>DATA LULUSAN ".$prodi."</th><th>".tanggal($start)."</th><th>".tanggal($finish)."</th><th>KETERANGAN</th></tr>";
		$jml1	 = $this->ym->count_yudis_by(array('date'=>$start,'thesis' => $thesis));
		$jml2	 = $this->ym->count_yudis_by(array('date'=>$finish,'thesis' => $thesis));
		if($jml1 < $jml2)
		{
		    $ketjml = "NAIK";
		}else{
		    $ketjml = "TURUN";
		}
		$table  .= "<tr><td><b>1</b></td><td><b>PESERTA</b></td><td></td><td></td><td></td></tr>";
		$table  .= "<tr><td></td><td>JUMLAH PESERTA YUDISIUM</td><td>".$jml1."</td><td>".$jml2."</td><td>".$ketjml."</td></tr>";
		$table  .= "<tr><td><b>2</b></td><td><b>PENULISAN TA</b></td><td></td><td></td><td></td></tr>";
		$avg1	 = round($this->ym->get_write_avg($start,$thesis),2);
		$avg2    = round($this->ym->get_write_avg($finish,$thesis),2);
		if($avg1 < $avg2) : $ketavg ="LEBIH LAMA"; else : $ketavg = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>RERATA LAMA PENULISAN TA</td><td>".$avg1."</td><td>".$avg2."</td><td>$ketavg</td></tr>";
		$max1	 = round($this->ym->get_write_max($start,$thesis),2);
		$max2	 = round($this->ym->get_write_max($finish,$thesis),2);
		if($max1 < $max2) : $ketmax = "LEBIH LAMA"; else : $ketmax = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>LAMA MAKSIMUM PENULISAN TA</td><td>".$max1."</td><td>".$max2."</td><td>$ketmax</td></tr>";
		$min1	 = round($this->ym->get_write_min($start,$thesis),2);
		$min2	 = round($this->ym->get_write_min($finish,$thesis),2);
		if($min1 < $min2) : $ketmin = "LEBIH LAMA"; else : $ketmin = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>LAMA MINIMUM PENULISAN TA</td><td>".$min1."</td><td>".$min2."</td><td>$ketmin</td></tr>";
		$table  .= "<tr><td><b>3</b></td><td><b>MASA STUDI</b></td><td></td><td></td><td></td></tr>";
		$avgsem1 = ceil ($this->ym->get_sem_avg($start,$thesis));
		$avgsem2 = ceil ($this->ym->get_sem_avg($finish,$thesis));
		if($avgsem1 < $avgsem2) : $ketavgsem = "LEBIH LAMA"; else : $ketavgsem = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>RERATA MASA STUDI</td><td>$avgsem1</td><td>$avgsem2</td><td>$ketavgsem</td></tr>";
		$semmax1 = round ($this->ym->get_sem_max($start,$thesis),2);
		$semmax2 = round ($this->ym->get_sem_max($finish,$thesis),2);
		if($semmax1 < $semmax2) : $ketsemmax = "LEBIH LAMA"; else : $ketsemmax = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>MASA STUDI MAKSIMUM</td><td>$semmax1</td><td>$semmax2</td><td>$ketsemmax</td></tr>";
		$semmin1 = round ($this->ym->get_sem_min($start,$thesis),2);
		$semmin2 = round ($this->ym->get_sem_min($finish,$thesis),2);
		if($semmin1 < $semmin2) : $ketsemmin = "LEBIH LAMA"; else : $ketsemmin = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>MASA STUDI MINIMUM</td><td>$semmin1</td><td>$semmin2</td><td>$ketsemmin</td></tr>";
		$table  .= "<tr><td><b>4</b></td><td><b>IPK</b></td><td></td><td></td><td></td></tr>";
		$avgipk1 = round ($this->ym->get_avg_ipk($start,$thesis),2);
		$avgipk2 = round ($this->ym->get_avg_ipk($finish,$thesis),2);
		if($avgipk1 < $avgipk2) : $ketavgipk = "NAIK"; else : $ketavgipk = "TURUN"; endif;
		$table  .= "<tr><td></td><td>RERATA IPK</td><td>$avgipk1</td><td>$avgipk2</td><td>$ketavgipk</td></tr>";
		$ipkmax1 = round ($this->ym->get_max_ipk($start,$thesis),2);
		$ipkmax2 = round ($this->ym->get_max_ipk($finish,$thesis),2);
		if($ipkmax1 < $ipkmax2) : $ketipkmax = "NAIK"; else : $ketipkmax = "TURUN"; endif;
		$table  .= "<tr><td></td><td>IPK MAKSIMUM</td><td>$ipkmax1</td><td>$ipkmax2</td><td>$ketipkmax</td></tr>";
		$ipkmin1 = round ($this->ym->get_min_ipk($start,$thesis),2);
		$ipkmin2 = round ($this->ym->get_min_ipk($finish,$thesis),2);
		if($ipkmin1 < $ipkmin2) : $ketipkmin = "NAIK"; else : $ketipkmin = "TURUN"; endif;
		$table  .= "<tr><td></td><td>IPK MINIMUM</td><td>$ipkmin1</td><td>$ipkmin2</td><td>$ketipkmin</td></tr>";
		$table  .= "<tr><td><b>5</b></td><td><b>PREDIKAT</b></td><td></td><td></td><td></td></tr>";
		$cum1	 = $this->ym->count_cum($start,$thesis);
		$cum2	 = $this->ym->count_cum($finish,$thesis);
		if($cum1 < $cum2): $ketcum ="NAIK"; elseif ($cum1 == $cum2) : $ketcum ="TETAP"; else : $ketcum ="TURUN"; endif;
		$table  .= "<tr><td></td><td>DENGAN PUJIAN</td><td>$cum1</td><td>$cum2</td><td>$ketcum</td></tr>";
		$v_good1 = $this->ym->count_verygood($start,$thesis);
		$v_good2 = $this->ym->count_verygood($finish,$thesis);
		if($v_good1 < $v_good2) : $ketvgood = "NAIK"; elseif($v_good1 == $v_good2): $ketvgood ="TETAP"; else : $ketvgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SANGAT MEMUASKAN</td><td>$v_good1</td><td>$v_good2</td><td>$ketvgood</td></tr>";
		$good1	 = $this->ym->count_good($start,$thesis);
		$good2   = $this->ym->count_good($finish,$thesis);
		if($good1 < $good2) : $ketgood = "NAIK"; elseif($good1 == $good2): $ketgood ="TETAP"; else : $ketgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MEMUASKAN</td><td>$good1</td><td>$good2</td><td>$ketgood</td></tr>";
		
		$table	.= "<tr><td><b>6</b></td><td><b>MASUK FT MELALUI</b></td><td></td><td></td><td></td></tr>";
		$pbu1	 = $this->ym->count_by(array('yudisium_date'=>$start,'parrental' => 'PBU'));
		$pbu2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'parrental' => 'PBU'));
		if($pbu1 < $pbu2) : $ketpbu = "NAIK"; elseif($pbu1 == $pbu2): $ketpbu ="TETAP"; else : $ketpbu = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PBU</td><td>$pbu1</td><td>$pbu2</td><td>$ketpbu</td></tr>";
		$utul1	 = $this->ym->count_by(array('yudisium_date'=>$start,'parrental' => 'UTUL'));
		$utul2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'parrental' => 'UTUL'));
		if($utul1 < $utul2) : $ketutul = "NAIK"; elseif($utul1 == $utul2): $ketutul ="TETAP"; else : $ketutul = "TURUN"; endif;
		$table  .= "<tr><td></td><td>UTUL</td><td>$utul1</td><td>$utul2</td><td>$ketutul</td></tr>";
		$pks1	 = $this->ym->count_by(array('yudisium_date'=>$start,'parrental' => 'PKS'));
		$pks2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'parrental' => 'PKS'));
		if($pks1 < $pks2) : $ketpks = "NAIK"; elseif($pks1 == $pks2): $ketpks ="TETAP"; else : $ketpks = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PKS</td><td>$pks1</td><td>$pks2</td><td>$ketpks</td></tr>";
		
		$table	.= "<tr><td><b>7</b></td><td><b>ASAL SEKOLAH</b></td><td></td><td></td><td></td></tr>";
		$sma1	 = $this->ym->count_by(array('yudisium_date'=>$start,'school' => 'SMA'));
		$sma2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'school' => 'SMA'));
		if($sma1 < $sma2) : $ketsma = "NAIK"; elseif($sma1 == $sma2): $ketsma ="TETAP"; else : $ketsma = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMA</td><td>$sma1</td><td>$sma2</td><td>$ketsma</td></tr>";
		$smk1	 = $this->ym->count_by(array('yudisium_date'=>$start,'school' => 'SMK'));
		$smk2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'school' => 'SMK'));
		if($smk1 < $smk2) : $ketsmk = "NAIK"; elseif($smk1 == $smk2): $ketsmk ="TETAP"; else : $ketsmk = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMK</td><td>$smk1</td><td>$smk2</td><td>$ketsmk</td></tr>";
		$d31	 = $this->ym->count_by(array('yudisium_date'=>$start,'school' => 'D3'));
		$d32	 = $this->ym->count_by(array('yudisium_date'=>$finish,'school' => 'D3'));
		if($d31 < $d32) : $ketd3 = "NAIK"; elseif($d31 == $d32): $ketd3 ="TETAP"; else : $ketd3 = "TURUN"; endif;
		$table  .= "<tr><td></td><td>DIII</td><td>$d31</td><td>$d32</td><td>$ketd3</td></tr>";
		$man1	 = $this->ym->count_by(array('yudisium_date'=>$start,'school' => 'MAN DLL'));
		$man2	 = $this->ym->count_by(array('yudisium_date'=>$finish,'school' => 'MAN DLL'));
		if($man1 < $man2) : $ketman = "NAIK"; elseif($man1 == $man2): $ketman ="TETAP"; else : $ketman = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MAN DLL</td><td>$man1</td><td>$man2</td><td>$ketman</td></tr>";
		$table 	.= "</table>";
		$sign 	 = "<table  align=\"center\">";
		$sign	.= "<tr><td align=\"center\"><br>Wakil Dekan I</td></tr>";
		$sign	.= "<tr><td><br></td></tr>";
		//$sign	.= "<tr><td></td></tr>";
		$sign	.= "<tr><td align=\"center\">Dr. Sunaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
		$sign	.= "</table>";
		$legend  = $this->legend();
		
		echo $style.$header.$table.$sign."<br>".$legend;
	    }else{
		echo "No Data";
	    }
	}
	
    public function legend ()
	{
	    $legend  = "<table class=\"legend\" >";
	    $legend .= "<tr><td width=\"80px\" valign=\"top\">Dibuat Oleh</td><td  align=\"center\" >Dilarang memperbanyak sebagian atau seluruh isi dokumen tanpa ijin tertulis dari Fakultas Teknik Universitas Negeri Yogyakarta</td><td width=\"80px\" valign=\"top\">Diperiksa Oleh</td></tr>";
	    $legend .= "</table>";
	    return $legend;
	}
    public function print_graduate()
	{
	    if($_POST){
		$start = $_POST['d_start'];
		$finish= $_POST['d_finish'];
		//$date_dis = $this->ym->get_yudis_date($start,$finish);
		
		//$array_bulan	 = $this->ym->get_yudisium();
		$array_bulan = $this->ym->get_yudis_date($start,$finish);
		$style  = $this->style_present("Data Lulusan","","");
		//print_r($array_bulan);
		$table  = "<table class=\"gridtable\" border=\"1px\">";
		$table .= "<tr><th>NO</th><th>DATA LULUSAN S1</th>";
		foreach ($array_bulan as $thb)
		{
		    $table .="<th>".tanggal($thb->yudisium_date)."</th>";
		}
		//$count  = count($array_bulan);
		$table .= "</tr>";
		$table .= "<tr><td>1</td><td><b>PESERTA</b></td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		} 
		$table .= "</tr>";
		$table .= "<tr><td></td><td>Jumlah Peserta Yudisium</td>";
		foreach($array_bulan as $thb)
		{
		    
		    $bulan	= array('date' => $thb->yudisium_date);
		    $table .="<td>".$this->ym->count_yudis_by($bulan)."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>2</td><td><b>PENULISAN TA</b></td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>Rerata Lama Penulisan TA</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".round($this->get_avg_studi($thb->yudisium_date),2)." bln</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>LAMA MINIMAL PENULISAN TA</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".round($this->ym->get_write_min($thb->yudisium_date),2)." bln</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>LAMA MIKSIMAL PENULISAN TA</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".round($this->ym->get_write_max($thb->yudisium_date),2)." bln</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>3</td><td><b>MASA STUDI</b></td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>RERATA MASA STUDI</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".ceil($this->ym->get_sem_avg($thb->yudisium_date))." sm</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>MASA STUDI MINIMUM</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".ceil($this->ym->get_sem_min($thb->yudisium_date))." sm</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>MASA STUDI MAKSIMUM</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".ceil($this->ym->get_sem_max($thb->yudisium_date))." sm</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>4</td><td><b>IPK</b></td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>RERATA IPK</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".round($this->ym->get_avg_ipk($thb->yudisium_date),2)."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>IPK MAKSIMUM</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->get_max_ipk($thb->yudisium_date)."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>IPK MINIMUM</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->get_min_ipk($thb->yudisium_date)."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>5</td><td><b>PREDIKAT</b></td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
	    
		$table .= "<tr><td></td><td>DENGAN PUJIAN</td>";
		foreach ($array_bulan as $thb)
		{
		    
		    $cumloude =$this->ym->count_cum_s1($thb->yudisium_date);
		    $table .= "<td>".$cumloude;
		    //print_r($cumloude);
		    $table .="</td>";
		    //$table .= "<td>$jml</td>";
		    //$table .= "<td>".$thb."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>SANGAT MEMUASKAN</td>";
		foreach ($array_bulan as $thb)
		{
		    
		    $verygood =$this->ym->count_verygood_s1($thb->yudisium_date);
		    $table .= "<td>".$verygood;
		    $table .="</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>MEMUASKAN</td>";
		foreach ($array_bulan as $thb)
		{
		    $good 	=$this->ym->count_good_s1($thb->yudisium_date);
		    $table .= "<td>".$good;
		    $table .="</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>6</td><td><b>MASUK FT MELALUI</td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>PBU</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'parrental' => 'PBU'))."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>UTUL</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'parrental' => 'UTUL'))."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>PKS</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'parrental' => 'PKS'))."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td>7</td><td>ASAL SEKOLAH</td>";
		for($i=0;$i<count($array_bulan);$i++) 
		{ 
		   $table .= "<td></td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>SMA</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'school' => 'SMA'))."</td>";
		}
		$table .= "</tr>";
		
		$table .= "<tr><td></td><td>SMK</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'school' => 'SMK'))."</td>";
		}
		$table .= "</tr>";
		
		$table .= "<tr><td></td><td>DIII</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'school' => 'DIII'))."</td>";
		}
		$table .= "</tr>";
		$table .= "</tr>";
		$table .= "<tr><td></td><td>MAN, DLL</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_by(array('yudisium_date' => $thb->yudisium_date,'school' => 'MAN DLL'))."</td>";
		}
		$table .= "</tr>";
		$table .= "</table>";
		echo $style;
		echo $table;
	    }else{
		echo "Erorrrrrrrrrrrrrrrrrrr";
	    }
	    
	}
	//fungsi pengecekan dokumen telah tercetak
    public function get_printed($id=0)
	{
	    $result=$this->ym->get_print($id);
	    return $result;
	}
    
	//fungsi penampil Agama
    public function get_religion($id)
	{
	    $result = $this->ym->get_religion($id);
	    return $result;
	}
	
	//fungsi penampil Jurusan
   public function get_major($id=0)
	{
	  $result=$this->ym->get_major($id);
	  return $result;
	}
	
	//fungsi pencari Nama Dosen
   public function get_name($id=0)
	{
	     $result=$this->ym->get_lecture_by('id',$id);
	     return $result->name;
	}
   
	//fungsi pencari nim dosen
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
    
	//filter ajax pd select box
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
	
	//fungsi pengecek NIM
    public function _check_nim($nim, $id = null)
	{
	    $this->form_validation->set_message('_check_nim', sprintf(lang('yudisium_already_exist_error'), lang('yudisium_nim_label')));
	    return $this->ym->check_exists('nim', $nim, $id);			
	}
	
	//fungsi penghitung usia
    public function get_age($umur)
	{
	    list($hari,$bulan, $tahun) = explode('-', $umur);
	    $thn = date('y') - $tahun;
	    $bln = date('m') - $bulan;
	    $hri = date('d') - $hari;
	    
	    if($hri < 0 || $bln < 0){
	    $thn�;
	    }
	    return $thn;
	}
	
	//fungsi pencari tahun Angkatan
    public function get_year($nim)
	{
	    $first	= substr($nim,0,1);
	    $year 	= substr($nim,0 ,2);
	    $res	= '20'.$year;
	    return $res;
	}
	
	//fungsi penghitung Usia
    public function cal_age($dob)
	{
	    $dob = date("Y-m-d",strtotime($dob));
	    $dobObject = new DateTime($dob);
	    $nowObject = new DateTime();
	
	    $diff = $dobObject->diff($nowObject);
	
	    return $diff->y;
	}
    
	//fungsi mencari jumlah semester yg telah ditempuh
    public function get_semester($nim,$date)
	{
	    $year 	= substr($nim,0,2);
	    $start	= '20'.$year;
	    $finish	= substr($date,0,4);
	    $diff	= intval($finish) - intval($start);
	    $result 	= $diff * 2;
	    return $result;
	}
	
   public function get_avg_studi($date)
	{
	    $avg= $this->ym->get_write_avg($date);
	    return $avg;
	}
	
    public function get_mountdiff($d1,$d2)
	{
	    $date1 = new DateTime($d1);
	    $date2 = new DateTime($d2);
	    $interval = $date1->diff($date2);
	    $diff     = $interval->format('%m');
	    return $diff;
	}
	//fungsi penghitung selisih waktu antara dua tanggal
    public function get_datediff($d1,$d2)
	{
	    $date1 = new DateTime($d1); 
	    $date2 = new DateTime($d2); 
	    $interval = $date1->diff($date2); 
	    $diff = $interval->format('%y/%m/%d'); 
	    return $diff;
	}
	
	//fungsi penampil Program Studi Mahasiswa
    public function get_dpt($nim)
	{
	    $prodies = $this->ym->get_prodies($nim);
	    $split = explode ('-',$prodies->x);
	    $nama  = $split[0];
	    $stage = $split[1];
	    return $stage;
	}
	
	//fungsi penghitung/penampil predikat mahasiswa
    public function predicate($nim,$date,$ipk,$parrental)
	{
	    $stage 	= trim($this->get_dpt($nim));
	    $smster	= trim($this->get_semester($nim,$date));
	    if($stage == "D3")
	    {
		if($smster <= 8)
		{
		    if($ipk <= 4.0 && $ipk >= 3.51)
		    {
			$predicate = 'Cumlaude';
		    }
		    if($ipk >= 2.76  && $ipk <= 3.50)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.00 && $ipk <= 2.75)
		    {
			$predicate = 'Memuaskan';
		    }
		}else{
		    if($ipk <= 4.0 && $ipk >= 3.51)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.76  && $ipk <= 3.50)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.00 && $ipk <= 2.75)
		    {
			$predicate = 'Memuaskan';
		    }
		}
	    }else{
		if($smster <= 10)
		{
		    //$ok = "ok";
		    if($ipk <= 4.0 && $ipk >= 3.51)
		    {
			if($parrental == 'PKS')
			{
			    $predicate = 'Sangat Memuaskan';
			}else{
			    $predicate = 'Cumlaude';   
			}
		    }
		    if($ipk >= 2.76  && $ipk <= 3.50)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.00 && $ipk <= 2.75)
		    {
			$predicate = 'Memuaskan';
		    }
		}else{
		    //$ok = "ok";
		    if($ipk <= 4.0 && $ipk >= 3.51)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.76  && $ipk <= 3.50)
		    {
			$predicate = 'Sangat Memuaskan';
		    }
		    if($ipk >= 2.00 && $ipk <= 2.75)
		    {
			$predicate = 'Memuaskan';
		    }
		}
	    }
	return $predicate;
	}
}