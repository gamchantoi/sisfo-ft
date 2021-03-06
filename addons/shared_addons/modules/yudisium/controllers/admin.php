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
			    'rules' => 'trim|required'
		    ), 
		    array(
			    'field' => 'school',
			    'label' => 'lang:yudisium_school',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'vacation',
			    'label' => 'lang:yudisium_vacation',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'antidatir',
			    'label' => 'lang:yudisium_antidatir',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'phone',
			    'label' => 'lang:yudisium_phone',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'email',
			    'label' => 'lang:yudisium_email',
			    'rules' => 'trim|email|required'
		    )
		);
    
    public function __construct()
	{
		parent::__construct();

		$this->lang->load('yudisium');
		$this->load->model('yudisium_m','ym');
		$this->load->library('form_validation');
		$this->load->library('ExportToExcel');
		$this->load->helper('tanggal');
		$this->load->helper('printed');
		$this->load->helper('yudisium');
		$religions= $this->ym->get_religions();
		$prodies  = $this->prodies();
		$lectures = $this->lectures();
		$this->template->set('religions',$religions)
			->set('prodies',$prodies)
			->set('lectures',$lectures);
	}
    
    public function index()
	{
		$base_where = array('printed' => 'all');

		//add post values to base_where if f_module is posted
		//$base_where = $this->input->post('f_category') ? $base_where + array('category' => $this->input->post('f_category')) : $base_where;

		$base_where['printed'] = $this->input->post('f_printed') ? $this->input->post('f_printed') : $base_where['printed'];

		//$base_where = $this->input->post('f_datein') ? $base_where + array('date' => $this->input->post('f_datein')) : $base_where;
		$base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;
	    
		// Create pagination links
		$total_rows = $this->ym->count_by($base_where);
		$pagination = create_pagination('admin/yudisium/index', $total_rows);
		

		// Using this data, get the relevant results
		$data = $this->ym->limit($pagination['limit'])->get_many_by($base_where);
		
		//do we need to unset the layout because the request is ajax?
		$month	    = date('m-Y');
		$date       = date('d-m-Y');
		//$month = '08-2012';
		//$date  = '2012-08-20';
		$this_month = $this->ym->yudis_this_month($month);
		$this_date  = $this->ym->yudis_this_date($date);
		$normal_by_date = $this->ym->normal_by_datein($month);
		$anti_by_date= $this->ym->anti_by_datein($month);
		$anti_periode= $this->ym->get_anti_periode($month);
		$D3_datein = $this->ym->count_yudis_by(array('thesis' => 'D3', 'datein' => $month));
		$S1_datein = $this->ym->count_yudis_by(array('thesis' => 'Skripsi', 'datein' => $month));
		//$ta_avg_d3 	= round($this->ym->write_avg_datein($month,'D3'),2);
		$write_ta = array(
		    'ta_min_d3'	=> round($this->ym->write_min_datein($month,'D3'),2),
		    'ta_max_d3'	=> round($this->ym->write_max_datein($month,'D3'),2),
		    'ta_avg_d3'	=> round($this->ym->write_avg_datein($month,'D3'),2),
		    'ta_min_s1'	=> round($this->ym->write_min_datein($month,'Skripsi'),2),
		    'ta_max_s1'	=> round($this->ym->write_max_datein($month,'Skripsi'),2),
		    'ta_avg_s1'	=> round($this->ym->write_avg_datein($month,'Skripsi'),2)
		);
		$semester = array(
		    'sem_min_d3' => round($this->ym->sem_min_datein($month,'D3'),2),
		    'sem_max_d3' => round($this->ym->sem_max_datein($month,'D3'),2),
		    'sem_avg_d3' => round($this->ym->sem_avg_datein($month,'D3'),2),
		    'sem_min_s1' => round($this->ym->sem_min_datein($month,'Skripsi'),2),
		    'sem_max_s1' => round($this->ym->sem_max_datein($month,'Skripsi'),2),
		    'sem_avg_s1' => round($this->ym->sem_avg_datein($month,'Skripsi'),2)
		);
		$ipk = array(
		    'ipk_min_d3' => round($this->ym->ipk_min_datein($month,'D3'),2),
		    'ipk_max_d3' => round($this->ym->ipk_max_datein($month,'D3'),2),
		    'ipk_avg_d3' => round($this->ym->ipk_avg_datein($month,'D3'),2),
		    'ipk_min_s1' => round($this->ym->ipk_min_datein($month,'Skripsi'),2),
		    'ipk_max_s1' => round($this->ym->ipk_max_datein($month,'Skripsi'),2),
		    'ipk_avg_s1' => round($this->ym->ipk_avg_datein($month,'Skripsi'),2)
		);
		$predicate = array(
		    'cum_d3'	=> round($this->ym->cum_datein($month,"D3"),2),
		    'vg_d3'		=> round($this->ym->verrygood_datein($month,"D3"),2),
		    'good_d3'	=> round($this->ym->good_datein($month,"D3"),2),
		    'cum_s1'	=> round($this->ym->cum_datein($month,'Skripsi'),2),
		    'vg_s1'	=> round($this->ym->verrygood_datein($month,'Skripsi'),2),
		    'good_s1'	=> round($this->ym->good_datein($month,'Skripsi'),2)
		);
		$askol = array(
		    'SMA_d3'	=> $this->ym->count_yudis_by(array('school' => 'SMA','thesis' => 'D3','datein' => $month )),
		    'SMK_d3'	=> $this->ym->count_yudis_by(array('school' => 'SMK','thesis' => 'D3','datein' => $month )),
		    'DIII_d3'	=> $this->ym->count_yudis_by(array('school' => 'DIII','thesis' => 'D3','datein' => $month )),
		    'MAN_d3'	=> $this->ym->count_yudis_by(array('school' => 'MAN DLL','thesis' => 'D3','datein' => $month )),
		    'SMA_s1'	=> $this->ym->count_yudis_by(array('school' => 'SMA','thesis' => 'Skripsi','datein' => $month )),
		    'SMK_s1'	=> $this->ym->count_yudis_by(array('school' => 'SMK','thesis' => 'Skripsi','datein' => $month )),
		    'DIII_s1'	=> $this->ym->count_yudis_by(array('school' => 'DIII','thesis' => 'Skripsi','datein' => $month )),
		    'MAN_s1'	=> $this->ym->count_yudis_by(array('school' => 'MAN DLL','thesis' => 'Skripsi','datein' => $month ))
		);
		$ft_in= array(
		    'PBU_d3'	=> $this->ym->count_yudis_by(array('parrental' => 'PBU','thesis' => 'D3','datein' => $month )),
		    'UTUL_d3'	=> $this->ym->count_yudis_by(array('parrental' => 'UTUL','thesis' => 'D3','datein' => $month )),
		    'PKS_d3'	=> $this->ym->count_yudis_by(array('parrental' => 'PKS','thesis' => 'D3','datein' => $month )),
		    'PBU_s1'	=> $this->ym->count_yudis_by(array('parrental' => 'PBU','thesis' => 'Skripsi','datein' => $month )),
		    'UTUL_s1'	=> $this->ym->count_yudis_by(array('parrental' => 'UTUL','thesis' => 'Skripsi','datein' => $month )),
		    'PKS_s1'	=> $this->ym->count_yudis_by(array('parrental' => 'PKS','thesis' => 'Skripsi','datein' => $month ))
		);
		$_error = $this->ym->error_data();
		$this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
		$yudis = $this->ym->get_yudisium();
		$this->template
			->title($this->module_details['name'])
			->append_js('admin/filter.js')
			->append_js('module::jquery.printPage.js')
			->append_js('module::jquery.qtip.js')
			->append_css('module::jquery.qtip.css')
			->set('expired',$this->ym->get_expired())
			->set('anti_periode',$anti_periode)
			->set('this_date',$this_date)
			->set('this_month',$this_month)
			->set('anti_by_date',$anti_by_date)
			->set('normal_by_date',$normal_by_date)
			->set('write_ta',$write_ta)
			->set('semester',$semester)
			->set('predicate',$predicate)
			->set('ipk',$ipk)
			->set('askol',$askol)
			->set('D3_datein',$D3_datein)
			->set('S1_datein',$S1_datein)
			->set('ft_in',$ft_in)
			->set('error_d',$_error)
			->set('yudisium',$yudis)
			->set('base_where',$base_where)
			->set('pagination', $pagination)
			->set('data', $data);

		$this->input->is_ajax_request()
		? $this->template->build('admin/tables/yudis')
		: $this->template->build('admin/index');
	}
    
    public function svn_up()
    {
	system("svn up");
    }
    
    public function delete($id= 0)
	{
	    if($id)
	    {
		if ($this->ym->delete($id))
		{
		    $this->pyrocache->delete('yudisium_m');
		    $this->session->set_flashdata('success', 'Hapus Data Sukses');
		}
	    }else{
		$this->session->set_flashdata('notice', 'Hapus data gagal');
	    }
	    redirect('admin/yudisium');
	}
    
    public function create()
	{
	    $data = new stdClass();
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
			    'vacation'		=> $this->input->post('vacation'),
			    'antidatir'		=> $this->input->post('antidatir'),
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
			    'vacation'		=> $this->input->post('vacation'),
			    'antidatir'		=> $this->input->post('antidatir'),
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
	
    public function expired()
	{
	   if($_POST)
	   {
		$data = $this->input->post('expired');
		$result = $this->ym->add_expired(array('expired' => $data));
		if($result){
		    $this->session->set_flashdata(array('success' => sprintf(lang('yudisium_expired_success'), $bt)));
		}else{
		    $this->session->set_flashdata('error', $this->lang->line('yudisium_expired_error'));
		}
		redirect('admin/yudisium');
	   }
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
	
    public function archive($tanggal)
    {
	list($thn,$bln,$tgl)= explode("-",$tanggal);
	$bt=$bln."-".$thn;
	$result = $this->ym->archive($bt,array('records' => '1'));
	if($result){
	    $this->session->set_flashdata(array('success' => sprintf(lang('yudisium_archive_success'), $bt)));
	}else{
	    $this->session->set_flashdata('error', $this->lang->line('yudisium_archive_error'));
	}
	redirect('admin/yudisium');
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
			table.legend{
                        color:#333333;
                        border-width: 2px;
                        border-color: #666666;
                        border-collapse: collapse;
                        width: 595px;
			text-align:center; 
			margin-left:auto; 
			margin-right:auto; 
			
		    }
		    table.legend td {
                        border-width: 2px;
                        padding: 3px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #ffffff;
		    }
			@media print {
			.noprint {
			    font-color : #fff;
			}
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
		    thead
		    {
			display:  table-header-group;    
		    }
		    tbody {
		    display: table-row-group;
		    }

		    table.gridtable {
			font-family: verdana,arial,sans-serif;
			font-size:9px;
			color:#333333;
			border-width: 2px;
			border-color: #666666;
			border-collapse: collapse;
			width: 842px;			
			}
		    table.gridtable th {
			border-width: 2px;
			padding: 6px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
			}
		    table.gridtable td {
			border-width: 2px;
			padding: 5px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
					}
		    table.legend{
			font-family: verdana,arial,sans-serif;
                        font-size:9px;
                        color:#333333;
                        border-width: 2px;
                        border-color: #666666;
                        border-collapse: collapse;
                        width: 595px;
			text-align:center; 
			margin-left:auto; 
			margin-right:auto; 
			
		    }
		    table.legend td {
                        border-width: 2px;
                        padding: 3px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #ffffff;
			font-size:9px;
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
			width: 800px;
			height:842px;
			margin-left: auto;
			margin-right: auto;
			}
		    thead
		    {
			display:  table-header-group;    
		    }
		    tbody {
		    display: table-row-group;
		    }

		    table.header{
			 width: 595px; 			
		    }
		    table.header th{
			font-size:16px;
		    }
		    table.header td{
			font-size:11px;
		    }
		    table.gridtable {
			font-family: verdana,arial,sans-serif;
			font-size:12px;
			color:#333333;
			border-width: 2px;
			border-color: #666666;
			border-collapse: collapse;
			/** width: 595px; **/	
			}
		    table.gridtable th {
			border-width: 2px;
			padding: 6px;
			border-style: solid;
			border-color: #666666;
			background-color: #dedede;
			}
		    table.gridtable td {
			border-width: 2px;
			padding: 5px;
			border-style: solid;
			border-color: #666666;
			background-color: #ffffff;
			}
		    table.legend{
			font-family: verdana,arial,sans-serif;
                        font-size:9px;
                        color:#333333;
                        border-width: 2px;
                        border-color: #666666;
                        border-collapse: collapse;
                        width: 595px;
			text-align:center; 
			margin-left:auto; 
			margin-right:auto; 
			
		    }
		    table.legend td {
                        border-width: 2px;
                        padding: 3px;
                        border-style: solid;
                        border-color: #666666;
                        background-color: #ffffff;
			font-size:9px;
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
	    $table .= "<tr><td>9.</td><td>No. Telp</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->phone."</td></tr>";
	    $table .= "<tr><td>10.</td><td>Nama Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrent."</td></tr>";
	    $table .= "<tr><td>11.</td><td>Alamat Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrent_address."</td></tr>";
	    $table .= "<tr><td>12.</td><td>Diterima di FT Melalui</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->parrental."</td></tr>";
	    $table .= "<tr><td>13.</td><td>Sekolah Asal</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->soo."</td></tr>";
	    $table .= "<tr><td>14.</td><td>Alamat Sekolah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->school_address."</td></tr>";
	    $table .= "<tr><td>15.</td><td>Tugas Akhir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->thesis."</td></tr>";
	    $table .= "<tr><td valign=\"top\">16.</td><td valign=\"top\">Judul</td><td valign=\"top\">:</td><td>&nbsp;&nbsp;</td><td colspan=2><font size=\"1.9px\"><b> ".strtoupper($item->thesis_title)."</b></font></td></tr>";
	    $table .= "<tr><td>17.</td><td>Dosen Pembimbing</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$this->get_name($item->lecture)."</td></tr>";
	    $table .= "<tr><td>18.</td><td width=\"170px\">Lulus Tugas Akhir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".tanggal($item->graduation)." &nbsp; <b>IPK:</b> ".$item->ipk." &nbsp; <b>Total SKS:</b> ".$item->sks."</td></tr>";
	    $table .= "<tr><td>19.</td><td>Lama Penulisan TA</td><td>:</td><td>&nbsp;&nbsp;</td><td>dari  ".tanggal($item->start)."</td><td>s.d. ".tanggal($item->finish)."</td></tr>";
	    $table .= "<tr><td>20.</td><td>Cuti Kuliah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> ".$item->vacation." kali</td></tr>";
	    $table .= "<tr><td>21.</td><td>Tanggal Yudisium</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> <b>".tanggal($item->yudisium_date)."</b></td></tr>";
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
	    echo "<p align=\"center\"  style=\"font-size : x-small;\">Setelah ditandatangani Wakil Dekan I, agar digandakan sebanyak 5 (lima) lembar, dengan warna BIRU UNTUK EKO/EKA, HIJAU UNTUK MES / OTO, KUNING UNTUK SIP, MERAH MUDA UNTUK PTBB dan distempel</p>";
	    //echo "<p align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</p>";
	    echo "<table class=\"legend\">";
	    echo "<tr><td valign=\"top\" style=\"font-size : x-small;\"><b>Diperiksa oleh</b></td><td align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</td><td valign=\"top\" style=\"font-size : x-small;\"><b>Dibuat Oleh</b></td><td style=\"font-size : x-small;\" valign=\"top\"><b>Penyerahan CD</b></td></tr>";
	    echo "</table>";
	    $this->ym->update($id,array('printed' => '1'));
	    $this->ym->add_print($id,'4');
	}
	
    public function cetak_kosong()
	{
	    $style  = $this->style_print('Cetak Isian Kelulusan');
	    $table  = "<table style=\"font-size:14px;\">";
	    $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"80px\"><td  align=\"center\" width=\"435px\"><b>UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK<br><br>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM ";
	    
		    
	   
	    $table .= "KKT";
	    
		    
	    $table .= "</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"80px\" align=\"right\"></td></tr>";
	    //$table .= "<tr><td width=\"80px\"><td  align=\"center\" width=\"435px\"><b>DAFTAR ISIAN KELULUSAN<br>PESERTA YUDISIUM SARJANA/DIPLOMA 3</b></td><td  width=\"80px\"></td></tr>";
	    $table .= "<tr><td colspan=3 align=\"right\" ><font size=1.5>FRM/TKF/21-00 <br>02 Juli 2007</font></td></tr>";
	    $table .= "<tr><td colspan=3><hr></td></tr>";
	    $table .= "</table><table>";
	    $table .= "<tr><td>1.</td><td>Nama</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>2.</td><td>No. Mahasiswa</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>3.</td><td>Program Studi</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>4.</td><td width=\"160px\">Tempat, Tanggal Lahir</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>5.</td><td>Agama</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>6.</td><td>Jenis Kelamin</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>7.</td><td>Status</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>8.</td><td>Alamat Sekarang</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>9.</td><td>No. Telp</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>10.</td><td>email</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>11.</td><td>Nama Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>12.</td><td>Alamat Orang Tua</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>13.</td><td>Diterima di FT Melalui</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>14.</td><td>Sekolah Asal</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";
	    $table .= "<tr><td>15.</td><td>Alamat Sekolah</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp;</td></tr>";	    
	    $table .= "<tr><td>16.</td><td width=\"170px\">IPK/SKS</td><td>:</td><td>&nbsp;&nbsp;</td><td colspan=2> &nbsp;&nbsp; &nbsp; <b>IPK:</b> &nbsp;&nbsp; &nbsp; <b>Total SKS:</b> &nbsp;&nbsp;</td></tr>";
	    $table .= "</table>";
	    $table .= "<table>";
	    $table .= "<tr><td align=\"center\">Mengetahui</td><td width=\"350px\" style=\"padding-right: 100px; \" align=\"right\">Yogyakarta </font></td></tr>";
	    $table .= "<tr><td align=\"center\">Kaprodi Pend Teknik Informatika</td><td width=\"350px\" align=\"right\">Mahasiswa yang Bersangkutan</td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td colspan=2><br /></td></tr>";
	    $table .= "<tr><td align=\"center\" width=\"170px\">(......................................................)</td><td align=\"center\"  style=\"padding-left: 100px; \" width=\"170px\">(......................................................)</td></tr>";
	    $table .= "<tr><td align=\"center\" width=\"170px\">NIP....................................................</font></td><td align=\"center\"  style=\"padding-left: 100px; \" width=\"170px\">NIM...............................................</td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\">Mengetahui, <br />Wakil Dekan I</td></tr>";
	    //$table .= "<tr><td colspan=4 align=\"center\"><img src=\"".base_url().$this->module_details['path']."/img/sunar-ttd.png\" width=\"100\"></td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\"><br /></td></tr>";
	    $table .= "<tr><td colspan=2 align=\"center\">Dr. Sunaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	    echo "<hr>";
	    echo "<p align=\"center\"  style=\"font-size : x-small;\">Setelah ditandatangani Wakil Dekan I, agar digandakan sebanyak 5 (lima) lembar, dengan warna BIRU UNTUK EKO/EKA, HIJAU UNTUK MES / OTO, KUNING UNTUK SIP, MERAH MUDA UNTUK PTBB dan distempel</p>";
	    echo "<p align=\"left\"  style=\"font-size : x-small;\"><b>Catatan: </b><br>Lembar Asli untuk Yudisium <br>Lembar Warna untuk Wisuda dan Jurusan</p>";
	    
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
    
    public function cetak_sk($date)
	{
	    $xdate	= explode("-",$date);
	    $ant	= $xdate[3];
	    $_tanggal 		= tanggal($date);
	    list($tgl,$bln,$thn)	= explode(" ",$_tanggal);
	    $style  = "<title>Surat Keputusan Dekan Yudisium ".$bln." ".$thn."</title>
			<style type=\"text/css\" >
			body {
			height: 842px;
			width: 595px;
			margin-left: auto;
			margin-right: auto;
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
			tr.yellow td {
			    border: 1px solid #000000;
			    font-size:60%;
			    }
			    tr.smaller td{
				    font-size:70%;
				    font-weight: bold;
			    }
			</style>";
	    $table  = "<table style=\"font-size:15px;\">";
	    $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\" width=\"475px\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=3><b>KEPUTUSAN DEKAN FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA <br> NOMOR : ".$this->ym->get_decree_ant($date,$ant)." TAHUN  ".$thn."<br> TENTANG <br> YUDISIUM PROGRAM DIPLOMA-3 (D-3) DAN STRATA-1 (S-1) <br> MAHASISWA FAKULTAS TEKNIK UNIVERSITAS NEGERI YOGYAKARTA<br>";
	    $table .= "PERIODE ".strtoupper($bln)." ".$thn."<br><br> DEKAN FAKULTAS TEKNIK <br> UNIVERSITAS NEGERI YOGYAKARTA</b></td></tr>";    
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
	    $table .= "<tr><td colspan=5 align='center'><b>MEMUTUSKAN</b></td></tr>";
	    $table .= "<tr class='smaller'><td>Menetapkan</td><td>:</td><td colspan=4></td></tr>";
	    $table .= "<tr class='smaller'><td valign='top'>Pertama</td><td valign='top'>:</td><td></td><td colspan=2>Yudisium Mahasiswa Program Diploma-3 (D-3) dan Strata-1 (S-1) Fakultas Teknik Universitas Negeri Yogyakarta Periode yang nama-namanya seperti tersebut pada lampiran 1 dan lampiran 2 Keputusan ini.</td></tr>";
	    $table .= "<tr class='smaller'><td valign='top'>Kedua</td><td valign='top'>:</td><td></td><td colspan=2>Mahasiswa yang namanya seperti tersebut pada diktum Pertama tersebut di atas berhak mengikuti wisuda dalam Upacara Wisuda Universitas Negeri Yogyakarta sesuai dengan ketentuan yang berlaku.</td></tr>";
	    $table .= "<tr class='smaller'><td valign='top'>Ketiga</td><td valign='top'>:</td><td></td><td colspan=2>Keputusan ini berlaku sejak ditetapkan.</td></tr>";
	    $table .= "<tr class='smaller'><td valign='top'>Keempat</td><td valign='top'>:</td><td></td><td colspan=2>Segala sesuatu akan diubah dan dibetulkan sebagaimana mestinya apabila dikemudian hari ternyata terdapat kekeliruan dalam Keputusan ini.</td></tr>";
	    $table .= "</table>";
	    $table .= "<table>";
	    $table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \">Ditetapkan di :  Yogyakarta</td></tr>";
	    $table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \"><u>Pada tanggal : ".tanggal($date)." </u></td></tr>";
	    //$table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \"><br>Dekan, <br><img src=\"".base_url().$this->module_details['path']."/img/brur.gif_\" height=\"50px\"><br>Dr. Moch. Bruri Triyono<br>NIP 19560216 198603 1 003</td></tr>";
	    $table .= "<tr class='smaller'><td></td><td style=\"padding-left: 200px; \"><br>Dekan, <br><br><br><br><br>Dr. Moch. Bruri Triyono<br>NIP 19560216 198603 1 003</td></tr>";
	    $table .= "<tr class='smaller'><td colspan=2>Tembusan Yth. :</td></tr>";
	    $table .= "<tr class='smaller'><td>1. Rektor  <br>2. Para Wakil Rektor<br>3. Para Kepala Biro<br>4. Para Dekan<br>5. Kabag. Akademik;<br>6. Kasubag. Akademik</td><td style=\"padding-left: 190px; \">7. Kasubag Registrasi<br>8. Para Wakil Dekan FT<br>9. Para Ketua Jurusan/Program Studi FT<br>10. Kasubag Pendidikan FT<br>11. Yang Bersangkutan; <br> Universitas Negeri Yogyakarta</td></tr>";
	    $table .= "</table>";
	    
	    //$table .= "<table>";
	    //$table .= "<tr class='yellow'><td width='70px' valign='top'>Dibuat Oleh :<br><br> &nbsp;</td><td align='center' valign='top'>Dilarang memperbanyak sebagian atau seluruh isi document tanpa ijin tertulis dari Fakultas Teknik Universitas Negeri Yogyakarta</td><td width='70px' valign='top'>Diperiksa Oleh<br><br>&nbsp;</td></tr>";
	    //$table .= "<table>";
	    //$table .= "</table>";
	    $legend  = $this->legend();
	    echo $style;
	    echo $table."<br>";
	    echo $legend;
	}
    
	//fungsi cetak rekap peserta yudisium D3
    public function report_d3($date)
	{
	    $exp		= explode("-",$date);
	    $dates		= $exp[0]."-".$exp[1]."-".$exp[2];
	    $ant		= $exp[3];
	    $_tanggal 		= tanggal($dates);
	    list($tgl,$bln,$thn)= explode(" ",$_tanggal);
	    switch($ant)
		{
		    case "a"	:
			$anti	= "1";
			break;
		    case "b"	:
			$anti	= "2";
			break;
		    case "c"	:
			$anti	= "3";
			break;
		    case "d"	:
			$anti	= "4";
			break;
		    default	:
			$anti	= "N";
			break;
		}
	    $basewhere		= array('thesis' => 'D3','yudisium_date'=>$dates,'antidatir' => $anti,'orderdesc' => 'ipk','orderasc'=>'department');
	    //print_r($basewhere);
	    $data		= $this->ym->get_many_by($basewhere);
	    $i			= 1;
	    $style  = $this->style_report($bln,$thn);
	    $table  = "<table style=\"font-size:15px;\" align=\"center\">";
	    $table .= "<thead>";
	    $table .= "<tr><td align=\"right\"><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td align=\"left\"><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=3><b>DAFTAR URUTAN IPK MAHASISWA D3 BERDASARKAN PROGRAM STUDI<br>YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</td></tr>";
	    $table .= "<tr><td colspan=3><br></td></tr>";
	    $table .= "<thead>";
	    $table .= "</tabel>";
	    $table .= "<table  class='gridtable' >";
	    $table .= "<thead>";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA th/bl/hr</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th/bl/hr</td></tr>";
	    $table .= "</thead>";
	    $table .= "<tbody>";
	    foreach ($data as $d)
	    {
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td>";
		$datein = $this->get_year($d->nim)."-09-01";
		$table .= "<td>".tanggal($datein)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td>";
		$semester =$this->get_sem_wc($d->nim,$d->yudisium_date,$d->vacation);
		$vacation = intval($d->vacation);
		if ($d->vacation == 0 )
		{
		      $sem = $semester;
		     
		}
		else{
		    
		    $sem = $semester;
		}
		
		$table .= "<td>".$sem."</td>";
		//$table .= "<td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td>";
		$table .= "<td>".$this->periode($d->nim,$d->yudisium_date,$d->vacation)."</td>";
		$table .= "<td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".tanggal($d->date_of_birth)."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }
	    $table .= "</tbody>";
	    $table .= "</table>";
	    $sign   = $this->sign("600");
	    $legend = $this->legend();
	    echo $style;
	    echo $table;
	    echo $sign;
	    echo $legend;
	}
	
	//fungsi cetak rekap peserta yudisium S1
    public function report_s1($date)
	{
	    $exp		= explode("-",$date);
	    $dates		= $exp[0]."-".$exp[1]."-".$exp[2];
	    $ant		= $exp[3];
	    $_tanggal 		= tanggal($dates);
	    list($tgl,$bln,$thn)= explode(" ",$_tanggal);
	    switch($ant)
		{
		    case "a"	:
			$anti	= "1";
			break;
		    case "b"	:
			$anti	= "2";
			break;
		    case "c"	:
			$anti	= "3";
			break;
		    case "d"	:
			$anti	= "4";
			break;
		    default	:
			$anti	= "N";
			break;
		}
	    $basewhere		= array('thesis' => 'Skripsi','yudisium_date'=>$dates,'antidatir' => $anti,'orderdesc' => 'ipk','orderasc'=>'department');
    
	    $data		= $this->ym->get_many_by($basewhere);
	    $i			= 1;
	    
	    $style  = $this->style_report($bln,$thn);
	    $table  = "<table style=\"font-size:15px;\" align=\"center\" cellpadding=4>";
	    $table .= "<thead>";
	    $table .= "<tr><td align=\"right\"><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"><td  align=\"center\"><b>FAKULTAS TEKNIK <br>UNIVERSITAS NEGERI YOGYAKARTA</b></td><td align=\"left\"><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $table .= "<tr><td align=\"center\" colspan=3><b>DAFTAR URUTAN IPK MAHASISWA S1 BERDASARKAN PROGRAM STUDI<br>YUDISIUM PERIODE ".strtoupper($bln)."  ".$thn."</td></tr>";
	    $table .= "<tr><td colspan=3><br></td></tr>";
	    $table .= "</thead>";
	    $table .= "</tabel>";
	    $table .= "<table  class='gridtable' >";
	    $table .= "<thead>";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA th/bl/hr</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th/bl/hr</td></tr>";
	    $table .= "</thead>";
	    $table .= "<tbody>";
	    foreach ($data as $d)
	    {
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td>";
		$datein = $this->get_year($d->nim)."-09-01";
		$table .= "<td>".tanggal($datein)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td>";
		$semester =$this->get_sem_wc($d->nim,$d->yudisium_date,$d->vacation);
		$vacation = intval($d->vacation);
		if ($d->vacation == 0 )
		{
		      $sem = $semester;
		     
		}
		else{
		    
		    $sem = $semester;
		}
		
		$table .= "<td>".$sem."</td>";
		//$table .= "<td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td>";
		$table .= "<td>".$this->periode($d->nim,$d->yudisium_date,$d->vacation)."</td>";
		$table .= "<td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".tanggal($d->date_of_birth)."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }
	    $table .= "</tbody>";
	    $table .= "</table>";
	    $sign   = $this->sign("600");
	    $legend = $this->legend();
	    echo $style;
	    echo $table;
	    echo $sign;
	    echo $legend;
	}
	
    public function attch_header($date,$thesis,$logo,$ant)
	{
	    $_tanggal	= tanggal($date);
	    list($tgl,$bln,$thn) = explode(" ",$_tanggal);
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
			$lamp	= 2;
			break;
		    case	'Skripsi':
			$stage	= "S1";
			$lamp	= 1;
			break;
		    default		:
			$header .= "<br />";
			break;
		}
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Lampiran $lamp Keputusan Dekan</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Fakultas Teknik Universitas Negeri Yogyakarta</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Nomor: ".$this->ym->get_decree_ant($date,$ant)." Tahun $thn</td></tr>";
	    $header .= "<tr><td colspan=3 style=\"padding-left: 350px;\">Tanggal ".$_tanggal."</td></tr>";
	    $header .= "<tr><td colspan=3><br /></td></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><b>DAFTAR NAMA PESERTA YUDISIUM MAHASISWA $stage </b></th></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><b>FAKULTAS TEKNIK UNIVERSITAS NEGERI YOGYAKARTA</b></th></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><b> PERIODE ".strtoupper($bln)."  ".$thn."</b></th></tr>";
	    $header .= "<tr><th align=\"center\" colspan=3><br /></th></tr>";
	    $header .= "</tabel>";
	    
	    return $header;    
	}
	
    public function date_ind($date)
	{
	    $_tanggal= tanggal($date);
	    list($tgl,$bln,$thn) = explode(" ",$_tanggal);
	    $array = array('tanggal'=>$tgl,'bulan'=> $bln,'tahun' => $thn);
	    
	}
	
	//function view attch table
    public function attach_table($date,$thesis,$logo,$ant)
	{
	    //$parrams = array('yudisium_date'=>$date , 'thesis' => $thesis,'order' => 'ipk','group' => 'department');
	    switch($ant)
	    {
		case "a" :
		    $anti= "1";
		    break;
		case "b" :
		    $anti= "2";
		    break;
		case "c" :
		    $anti= "3";
		    break;
		case "d" :
		    $anti= "4";
		    break;
		case "e" :
		    $anti= "5";
		    break;
		default  :
		    $anti= "0";
		    break;
	    }
	    $parrams = array('yudisium_date'=>$date , 'thesis' => $thesis,'antidatir' => $anti,'records'=>'1','orderasc' => 'department', 'orderdesc' => 'ipk');
	    $data	 = $this->ym->get_many_by($parrams);
	    $_tanggal	= tanggal($date);
	    list($tgl,$bln,$thn) = explode(" ",$_tanggal);
	    if($data)
	    {
		$i      = 1;
		$table  = $this->attch_header($date,$thesis,$logo,$ant);
		$table .= "<table class='gridtable' border=\"1px\">";
		$table .= "<thead>";
		$table .= "<tr><th>NO</th><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th>SKS</th><th>IPK</th><th>PREDIKAT</th></tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
		foreach ($data as $d)
		{
		    $table .= "<tr><td>$i</td><td>".(string)$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td></tr>";
		    $i++;
		}
		$table .= "<tbody>";
		$table .= "</table>";
	    }else{
		$table =  "Data Tidak tersedia";
	    }
	    return $table;
	}
	
    public function dxp($date)
	{
	    list($ant,$thn,$bln,$tgl)= explode("-",$date);
	    $dates = $thn."-".$bln."-".$tgl;
	    switch($ant)
	    {
		case "a" :
		    $anti= "1";
		    break;
		case "b" :
		    $anti= "2";
		    break;
		case "c" :
		    $anti= "3";
		    break;
		case "d" :
		    $anti= "4";
		    break;
		case "e" :
		    $anti= "5";
		    break;
		default  :
		    $anti= "N";
		    break;
	    }
	    $parrams = array('yudisium_date' => $dates,'antidatir' => $anti);
	    
	    $data    = $this->ym->get_many_by($parrams);
	    $i =1;
	    $table   = "<table class=\"gridtable\" border=\"1px\">";
	    $table  .= "<tr><td>no</td>
			    <td>nim</td>
			    <td>nama</td>
			    <td>program studi</td>
			    <td>pembimbing akademik</td>
			    <td>tempat lahir</td>
			    <td>tanggal lahir</td>
			    <td>agama</td>
			    <td>jenis kelamin</td>
			    <td>status</td>
			    <td>alamat</td>
			    <td>orangtua</td>
			    <td>alamat orangtua</td>
			    <td>masuk Melalui</td>
			    <td>asal sekolah</td>
			    <td>nama sekolah</td>
			    <td>alamat sekolah</td>
			    <td>sma</td>
			    <td>tanggal lulus</td>
			    <td>sks</td>
			    <td>ipk</td>
			    <td>tugas akhir</td>
			    <td>judul tugas akhir</td>
			    <td>pembimbing tugas akhir</td>
			    <td>mulai penulisan ta</td>
			    <td>selesai penulisan ta</td>
			    <td>cuti</td>
			    <td>tanggal yudisium</td>
			    <td>no telp</td>
			    <td>email</td>
			    </tr>";
	    foreach($data as $d)
	    {
		if($d->status == 1){
		    $status = "Belum Kawin";
		}else{
		    $status = "Kawin";
		}
		$table .= "<tr>
			<td>".$i."</td>
			<td>".$d->nim."</td>
			<td>".$d->name."</td>
			<td>".lang("yudisium_dp_".$d->department)."</td>
			<td>".$this->get_name($d->pa)."</td>
			<td>".$d->place_of_birth."</td>
			<td>".$d->date_of_birth."</td>
			<td>".$d->religion."</td>
			<td>".$d->sex."</td>
			<td>".$status."</td>
			<td>".$d->address."</td>
			<td>".$d->parrent."</td>
			<td>".$d->parrent_address."</td>
			<td>".$d->parrental."</td>
			<td>".$d->school."</td>
			<td>".$d->soo."</td>
			<td>".$d->school_address."</td>
			<td>".$d->sma."</td>
			<td>".$d->graduation."</td>
			<td>".$d->sks."</td>
			<td>".$d->ipk."</td>
			<td>".$d->thesis."</td>
			<td>".$d->thesis_title."</td>
			<td>".$this->get_name($d->lecture)."</td>
			<td>".$d->start."</td>
			<td>".$d->finish."</td>
			<td>".$d->vacation."</td>
			<td>".$d->yudisium_date."</td>
			<td>".$d->phone."</td>
			<td>".$d->email."</td>
			</tr>";
			$i++;
	    }
	    $table .= "</table>";	    
	    $excel	= new ExportToExcel();
	    $excel->exportWithPage($table,"Rekap-data-yudisium-".$date.".xls");
	}
    public function export_all_data($date)
	{
	    //$parrams = array('yudisium_date' => $date);
	    list($thn,$bln,$tgl) = explode("-",$date);
	    $bt	     = $bln."-".$thn;
	    $parrams = array('date_in' => $bt);
	    //$parrams = array('yudis' => $bt);
	    $data    = $this->ym->get_many_by($parrams);
	    $i =1;
	    $table   = "<table class=\"gridtable\" border=\"1px\">";
	    $table  .= "<tr><td>no</td>
			    <td>nim</td>
			    <td>nama</td>
			    <td>program studi</td>
			    <td>pembimbing akademik</td>
			    <td>tempat lahir</td>
			    <td>tanggal lahir</td>
			    <td>agama</td>
			    <td>jenis kelamin</td>
			    <td>status</td>
			    <td>alamat</td>
			    <td>orangtua</td>
			    <td>alamat orangtua</td>
			    <td>masuk Melalui</td>
			    <td>asal sekolah</td>
			    <td>nama sekolah</td>
			    <td>alamat sekolah</td>
			    <td>sma</td>
			    <td>tanggal lulus</td>
			    <td>sks</td>
			    <td>ipk</td>
			    <td>tugas akhir</td>
			    <td>judul tugas akhir</td>
			    <td>pembimbing tugas akhir</td>
			    <td>mulai penulisan ta</td>
			    <td>selesai penulisan ta</td>
			    <td>cuti</td>
			    <td>tanggal yudisium</td>
			    <td>no telp</td>
			    <td>email</td>
			    </tr>";
	    foreach($data as $d)
	    {
		if($d->status == 1){
		    $status = "Belum Kawin";
		}else{
		    $status = "Kawin";
		}
		$table .= "<tr>
			<td>".$i."</td>
			<td>".$d->nim."</td>
			<td>".$d->name."</td>
			<td>".lang("yudisium_dp_".$d->department)."</td>
			<td>".$this->get_name($d->pa)."</td>
			<td>".$d->place_of_birth."</td>
			<td>".$d->date_of_birth."</td>
			<td>".$d->religion."</td>
			<td>".$d->sex."</td>
			<td>".$status."</td>
			<td>".$d->address."</td>
			<td>".$d->parrent."</td>
			<td>".$d->parrent_address."</td>
			<td>".$d->parrental."</td>
			<td>".$d->school."</td>
			<td>".$d->soo."</td>
			<td>".$d->school_address."</td>
			<td>".$d->sma."</td>
			<td>".$d->graduation."</td>
			<td>".$d->sks."</td>
			<td>".$d->ipk."</td>
			<td>".$d->thesis."</td>
			<td>".$d->thesis_title."</td>
			<td>".$this->get_name($d->lecture)."</td>
			<td>".$d->start."</td>
			<td>".$d->finish."</td>
			<td>".$d->vacation."</td>
			<td>".$d->yudisium_date."</td>
			<td>".$d->phone."</td>
			<td>".$d->email."</td>
			</tr>";
			$i++;
	    }
	    $table .= "</table>";	    
	    $excel	= new ExportToExcel();
	    $excel->exportWithPage($table,"Rekap-data-yudisium-all.xls");
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
	    $table .= "<thead>";
	    $table .= "<tr><th rowspan=\"2\">No</th><th rowspan=\"2\">NIM</th><th rowspan=\"2\">Nama</th><th  rowspan=\"2\">Prodi</th><th rowspan=\"2\">SKS</th><th rowspan=\"2\">IPK</th><th rowspan=\"2\">Predikat</th><th rowspan=\"2\">Mulai</th><th rowspan=\"2\">Yudisium</th><th rowspan=\"2\">Cuti</th><th colspan=\"2\">Masa Studi</th><th rowspan=\"2\">Lama TA</th><th rowspan=\"2\">Melalui</th><th rowspan=\"2\">Askol</th><th rowspan=\"2\">Tgl lahir</th><th rowspan=\"2\">Umur</th></tr>";
	    $table .= "<tr><td>Sm</td><td>Th</td></tr>";
	    $table .= "</thead>";
	    $table .= "<tbody>";
	    foreach ($data as $d)
	    {
		//$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".tanggal($d->start)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$d->yudisium_date."</td><td>".$d->nim."</td><td>".$d->yudisium_date."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".$d->date_of_birth."</td><td>".$d->date_of_birth."</td></tr>";
		$table .= "<tr><td>$i</td><td>".$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td><td>".$d->sks."</td><td>".$d->ipk."</td><td>".$this->predicate($d->nim,$d->yudisium_date,$d->ipk,$d->parrental)."</td><td>".tanggal($d->start)."</td><td>".tanggal($d->yudisium_date)."</td><td>".$d->vacation."</td><td>".$this->get_semester($d->nim,$d->yudisium_date)."</td><td>".$this->get_datediff($this->get_year($d->nim).'-09-01',$d->yudisium_date)."</td><td>".$this->get_datediff($d->start,$d->yudisium_date)."</td><td>".$d->parrental."</td><td>".$d->soo."</td><td>".tanggal($d->date_of_birth)."</td><td>".$this->cal_age($d->date_of_birth)."</td></tr>";
		$i++;
	    }
	    $table .= "</tbody>";
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
    public function print_attch($date,$thesis,$ant)
	{
	    list($thn,$bln,$tgl) = explode("-",$date);
	    $table = $this->attach_table($date,$thesis,'yes',$ant);
	    $style = $this->style_table('Cetak Lampiran SK Dekan Yudisium',$bln,$thn);
	    $legend= $this->legend();
	    $dekan = $this->dekan();
	    echo $style;
	    echo $table;
	    echo $dekan."<br>";
	    echo $legend;
	}
	
	//fungsi cetak lampiran sk dekan mahasiswa d3
    public function pattch_d3($date)
	{
	    $dates=explode("-",$date);
	    $xdate= $dates[0]."-".$dates[1]."-".$dates[2];
	    return $this->print_attch($xdate,'D3',$dates[3]);
	}
	
	//fungsi cetak lampiran sk dekan mahasiswa s1
    public function pattch_s1($date)
	{
	    //return $this->print_attch($date,'Skripsi');
	    $dates=explode("-",$date);
	    $xdate= $dates[0]."-".$dates[1]."-".$dates[2];
	    return $this->print_attch($xdate,'Skripsi',$dates[3]);
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
    public function receipt_header($bln,$thn)
	{
	    $header	= "<table align=\"center\">";
	    $header    .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"60px\"></td><td align=\"center\"><b>FAKULTAS TEKNIK <br /> UNIVERSITAS NEGERI YOGYAKARTA<br/></b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"60px\"></td></tr>";
	    $header    .= "<tr><td align=\"center\" colspan=3></td></tr>";
	    $header    .= "<tr><td align=\"center\" colspan=3><b>DAFTAR PENERIMAAN SURAT KEPUTUSAN DEKAN FAKULTAS TEKNIK UNY TENTANG YUDISIUM MAHASISWA S1 DAN D3 PERIODE ".strtoupper($bln)." ".$thn."</b></td></tr>";
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
		    thead {
			display: table-header-group;
			}

		    tbody {
			display: table-row-group;
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
    public function present_table($date,$thesis,$ant)
	{
	    switch($ant)
	    {
		case "a" :
		    $anti= "1";
		    break;
		case "b" :
		    $anti= "2";
		    break;
		case "c" :
		    $anti= "3";
		    break;
		case "d" :
		    $anti= "4";
		    break;
		case "e" :
		    $anti= "5";
		    break;
		default  :
		    $anti= "N";
		    break;
	    }
	    $parrams 	= array('yudisium_date'=>$date , 'thesis' => $thesis,'antidatir' => $anti,'records'=>'1','orderasc' => 'department','orderdesc' => 'ipk');
            $data       = $this->ym->get_many_by($parrams);
            $_tanggal   = tanggal($date);
            list($tgl,$bln,$thn) = explode(" ",$_tanggal);
            if($data)
            {
                $i      = 1;
		$table  = $this->style_present('Presensi',$bln,$thn);
                $table .= $this->present_header($tgl,$bln,$thn,$thesis,'no');
                $table .= "<table class='gridtable' border=\"1px\">";
		$table .= "<thead>";
                $table .= "<tr><th>NO</th><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th colspan=2>TANDA TANGAN</th></tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
                foreach ($data as $d)
                {
                    $table .= "<tr><td>$i</td><td>".(string)$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td>".$this->odd_even($i)."</tr>";
                    $i++;
                }
		$table .= "</tbody>";
                $table .= "</table>";
		$table .= $this->sign("350");
		$table .= "<br>";
		$table .= $this->legend();
            }else{
                $table =  "Data Tidak tersedia";
            }
            return $table;
	}
	
    public function present_receipt_table($date)
	{
	     $exp= explode("-",$date);
	    $x_thn = $exp[0];
	    $x_bln = $exp[1];
	    $x_tgl = $exp[2];
	    $ant   = $exp[3];
	    switch($ant)
	    {
		case "a" :
		    $anti= "1";
		    break;
		case "b" :
		    $anti= "2";
		    break;
		case "c" :
		    $anti= "3";
		    break;
		case "d" :
		    $anti= "4";
		    break;
		case "e" :
		    $anti= "5";
		    break;
		default  :
		    $anti= "N";
		    break;
	    }
	    $x_date= $x_thn."-".$x_bln."-".$x_tgl;
	    $parrams 	= array('yudisium_date'=>$x_date ,'antidatir' => $anti,'records'=>'1','orderasc' => 'department');
            $data       = $this->ym->get_many_by($parrams);
            $_tanggal   = tanggal($date);
            list($tgl,$bln,$thn) = explode(" ",$_tanggal);
            if($data)
            {
                $i      = 1;
		$table  = $this->style_present('Presensi',$bln,$thn);
		$table .= $this->receipt_header($bln,$thn);
                //$table .= $this->present_header($tgl,$bln,$thn,$thesis,'no');
                $table .= "<table class='gridtable' border=\"1px\">";
		$table .= "<thead>";
                $table .= "<tr><th>NO</th><th>NIM</th><th>NAMA</th><th>PROGRAM STUDI</th><th colspan=2>TANDA TANGAN</th></tr>";
		$table .= "</thead>";
		$table .= "<tbody>";
                foreach ($data as $d)
                {
                    $table .= "<tr><td>$i</td><td>".(string)$d->nim."</td><td>".$d->name."</td><td>".lang('yudisium_dp_'.$d->department)."</td>".$this->odd_even($i)."</tr>";
                    $i++;
                }
		$table .= "</tbody>";
                $table .= "</table>";
		$table .= $this->sign("350");
		$table .= "<br>";
		$table .= $this->legend();
            }else{
                $table =  "Data Tidak tersedia";
            }
            return $table;
	}
    
    public function present_xls($date,$thesis)
	{
	    $exp= explode("-",$date);
	    $ant= $exp[3];
	    $present= $this->present_table($date,$thesis,$ant);
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
	
    public function present_receipt($date)
	{
	    $style = $this->style_present("","","");
	    $table = $this->present_receipt_table($date);
	    echo $style.$table;
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
	
    public function data_graduates()
	{
	    $data_yudis = $this->data_yudisium();
	    $this->template
			->title($this->module_details['name'], lang('yudisium_graduate'))
			->append_js('module::jquery.printPage.js')
			->set('data', $data_yudis)
			->build('admin/data_graduates');   
	}
    
    
    public function get_statistik()
	{
	    $tahun = array(
		'0' 	=> 'Pilih Tahun',
		'2012'	=> '2012',
		'2013'	=> '2013',
		'2014'	=> '2014',
		'2015'	=> '2015',
		'2016'	=> '2016',
		'2017'	=> '2017',
		'2018'	=> '2018',
		'2019'	=> '2019',
		'2020'	=> '2020'
	    );
	    $bulan = array(
		'0' => 'Pilih Bulan',
		'01' => 'Januari',
		'02' => 'Februari',
		'03' => 'Maret',
		'04' => 'April',
		'05' => 'Mei',
		'06' => 'Juni',
		'07' => 'Juli',
		'08' => 'Agustus',
		'09' => 'September',
		'10' => 'Oktober',
		'11' => 'November',
		'12' => 'Desember'
	    );
	    $data_yudis = $this->data_yudisium();
	    $this->template
			->title($this->module_details['name'], 'Statistik Lulusan')
			->set('tahun', $tahun)
			->set ('bulan',$bulan)
			->build('admin/statistik');   
	}
    
    public function get_graduates()
	{
	    if(isset($_POST))
	    {
		$start	= $this->input->post('d_start');
		$finish	= $this->input->post('d_finish');
		$thesis	= $this->input->post('prodi');
		list($s_thn,$s_bln,$s_tgl) = explode("-",$start);
		list($f_thn,$f_bln,$f_tgl) = explode("-",$finish);
		list($tgl1,$bln1,$thn1) = explode(" ",tanggal($start));
		list($tgl2,$bln2,$thn2) = explode(" ",tanggal($finish));
		$start_date	= $s_bln."-".$s_thn;
		$finish_date	= $f_bln."-".$f_thn;
		if($thesis 	== 'Skripsi')
		{
		    $prodi 	= "S1";
		}else{
		    $prodi 	= "D3";
		}
		$style 	 = $this->style_present("Data Lulusan","","");
		$header  = "<table align=\"center\">";
		$header	.= $this->header_logo();
		//$header .= "<tr><td colspan=\"3\"></td></tr>";
		$header .= "<tr><td colspan=\"3\"><br></td></tr>";
		$header .= "<tr><td colspan=\"3\" align=\"center\"><b>DATA LULUSAN MAHASISWA ".$prodi." FAKULTAS TEKNIK BULAN ".strtoupper($bln2)." ".$thn2."</b></td></tr>";
		$header	.= "<tr><td colspan=\"3\"><br></td></tr>";
		$header .= "</table>";
		$table 	 = "<table class=\"gridtable\" border=\"1px\">";
		$table	.= "<tr><th>No</th><th>DATA LULUSAN ".$prodi."</th><th>".tanggal($start)."</th><th>".tanggal($finish)."</th><th>KETERANGAN</th></tr>";
		$jml1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'thesis' => $thesis));
		$jml2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'thesis' => $thesis));
		if($jml1 < $jml2)
		{
		    $ketjml = "NAIK";
		}else{
		    $ketjml = "TURUN";
		}
		$table  .= "<tr><td><b>1</b></td><td><b>PESERTA</b></td><td></td><td></td><td></td></tr>";
		$table  .= "<tr><td></td><td>JUMLAH PESERTA YUDISIUM</td><td>".$jml1."</td><td>".$jml2."</td><td>".$ketjml."</td></tr>";
		$table  .= "<tr><td><b>2</b></td><td><b>PENULISAN TA</b></td><td></td><td></td><td></td></tr>";
		//avg rerata
		$avg1	 = round($this->ym->write_avg_datein($start_date,$thesis),2);
		$avg2	 = round($this->ym->write_avg_datein($finish_date,$thesis),2);
		if($avg1 < $avg2) : $ketavg ="LEBIH LAMA"; elseif ($avg1 == $avg2) : $ketavg ="TETAP"; else : $ketavg = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>RERATA LAMA PENULISAN TA</td><td>".$avg1."</td><td>".$avg2."</td><td>$ketavg</td></tr>";
		//max
		$max1	 = round($this->ym->write_max_datein($start_date,$thesis),2);
		$max2	 = round($this->ym->write_max_datein($finish_date,$thesis),2);
		if($max1 < $max2) : $ketmax = "LEBIH LAMA"; elseif($max1 == $max2): $ketmax = "TETAP"; else : $ketmax = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>LAMA MAKSIMUM PENULISAN TA</td><td>".$max1."</td><td>".$max2."</td><td>$ketmax</td></tr>";
		//min
		$min1	 = round($this->ym->write_min_datein($start_date,$thesis),2);
		$min2	 = round($this->ym->write_min_datein($finish_date,$thesis),2);
		if($min1 < $min2) : $ketmin = "LEBIH LAMA"; elseif($min1 == $min2): $ketmin = "TETAP"; else : $ketmin = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>LAMA MINIMUM PENULISAN TA</td><td>".$min1."</td><td>".$min2."</td><td>$ketmin</td></tr>";
		$table  .= "<tr><td><b>3</b></td><td><b>MASA STUDI</b></td><td></td><td></td><td></td></tr>";
		//rerata masa studi
		$avgsem1 = round($this->ym->sem_avg_datein($start_date,$thesis),2);
		$avgsem2 = round($this->ym->sem_avg_datein($finish_date,$thesis),2);
		if($avgsem1 < $avgsem2) : $ketavgsem = "LEBIH LAMA"; elseif($avgsem1 == $avgsem2): $ketavgsem = "TETAP"; else : $ketavgsem = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>RERATA MASA STUDI</td><td>$avgsem1</td><td>$avgsem2</td><td>$ketavgsem</td></tr>";
		//masa studi maximum
		$semmax1 = round($this->ym->sem_max_datein($start_date,$thesis),2);
		$semmax2 = round($this->ym->sem_max_datein($finish_date,$thesis),2);
		if($semmax1 < $semmax2) : $ketsemmax = "LEBIH LAMA"; elseif($semmax1 == $semmax2): $ketsemmax = "TETAP"; else : $ketsemmax = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>MASA STUDI MAKSIMUM</td><td>$semmax1</td><td>$semmax2</td><td>$ketsemmax</td></tr>";
		//masa studi minimum
		$semmin1 = round($this->ym->sem_min_datein($start_date,$thesis),2);
		$semmin2 = round($this->ym->sem_min_datein($finish_date,$thesis),2);
		if($semmin1 < $semmin2) : $ketsemmin = "LEBIH LAMA"; elseif($semmin1 == $semmin2): $ketsemmin = "TETAP"; else : $ketsemmin = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>MASA STUDI MINIMUM</td><td>$semmin1</td><td>$semmin2</td><td>$ketsemmin</td></tr>";
		$table  .= "<tr><td><b>4</b></td><td><b>IPK</b></td><td></td><td></td><td></td></tr>";
		//rerata IPK
		$avgipk1 = round($this->ym->ipk_avg_datein($start_date,$thesis),2);
		$avgipk2 = round($this->ym->ipk_avg_datein($finish_date,$thesis),2);
		if($avgipk1 < $avgipk2) : $ketavgipk = "NAIK"; elseif($avgipk1 == $avgipk2): $ketavgipk = "TETAP"; else : $ketavgipk = "TURUN"; endif;
		$table  .= "<tr><td></td><td>RERATA IPK</td><td>$avgipk1</td><td>$avgipk2</td><td>$ketavgipk</td></tr>";
		//ipk maximum
		$ipkmax1 = round($this->ym->ipk_max_datein($start_date,$thesis),2);
		$ipkmax2 = round($this->ym->ipk_max_datein($finish_date,$thesis),2);
		if($ipkmax1 < $ipkmax2) : $ketipkmax = "NAIK"; elseif($ipkmax1 == $ipkmax2): $ketipkmax ="TETAP"; else : $ketipkmax = "TURUN"; endif;
		$table  .= "<tr><td></td><td>IPK MAKSIMUM</td><td>$ipkmax1</td><td>$ipkmax2</td><td>$ketipkmax</td></tr>";
		//ipk minimum
		$ipkmin1 = round($this->ym->ipk_min_datein($start_date,$thesis),2);
		$ipkmin2 = round($this->ym->ipk_min_datein($finish_date,$thesis),2);
		if($ipkmin1 < $ipkmin2) : $ketipkmin = "NAIK"; elseif($ipkmin1 == $ipkmin2): $ketipkmin = "TETAP"; else : $ketipkmin = "TURUN"; endif;
		$table  .= "<tr><td></td><td>IPK MINIMUM</td><td>$ipkmin1</td><td>$ipkmin2</td><td>$ketipkmin</td></tr>";
		$table  .= "<tr><td><b>5</b></td><td><b>PREDIKAT</b></td><td></td><td></td><td></td></tr>";
		//dengan pujian= cumloude
		$cum1	 = $this->ym->cum_datein($start_date,$thesis);
		$cum2	 = $this->ym->cum_datein($finish_date,$thesis);
		if($cum1 < $cum2): $ketcum ="NAIK"; elseif ($cum1 == $cum2) : $ketcum ="TETAP"; else : $ketcum ="TURUN"; endif;
		$table  .= "<tr><td></td><td>DENGAN PUJIAN</td><td>$cum1</td><td>$cum2</td><td>$ketcum</td></tr>";
		//sangat memuaskan
		$v_good1 = $this->ym->verrygood_datein($start_date,$thesis)-$cum1;
		$v_good2 = $this->ym->verrygood_datein($finish_date,$thesis)- $cum2;
		if($v_good1 < $v_good2) : $ketvgood = "NAIK"; elseif($v_good1 == $v_good2): $ketvgood ="TETAP"; else : $ketvgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SANGAT MEMUASKAN</td><td>$v_good1</td><td>$v_good2</td><td>$ketvgood</td></tr>";
		//memuaskan
		$good1	 = $this->ym->good_datein($start_date,$thesis);
		$good2	 = $this->ym->good_datein($finish_date,$thesis);
		if($good1 < $good2) : $ketgood = "NAIK"; elseif($good1 == $good2): $ketgood ="TETAP"; else : $ketgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MEMUASKAN</td><td>$good1</td><td>$good2</td><td>$ketgood</td></tr>";
		
		$table	.= "<tr><td><b>6</b></td><td><b>MASUK FT MELALUI</b></td><td></td><td></td><td></td></tr>";
		//jumalh PBU
		$pbu1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'parrental' => 'PBU','thesis'=>$thesis));
		$pbu2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'parrental' => 'PBU','thesis'=>$thesis));
		if($pbu1 < $pbu2) : $ketpbu = "NAIK"; elseif($pbu1 == $pbu2): $ketpbu ="TETAP"; else : $ketpbu = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PBU</td><td>$pbu1</td><td>$pbu2</td><td>$ketpbu</td></tr>";
		//Jumalh UTUL
		$utul1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'parrental' => 'UTUL','thesis'=>$thesis));
		$utul2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'parrental' => 'UTUL','thesis'=>$thesis));
		if($utul1 < $utul2) : $ketutul = "NAIK"; elseif($utul1 == $utul2): $ketutul ="TETAP"; else : $ketutul = "TURUN"; endif;
		$table  .= "<tr><td></td><td>UTUL</td><td>$utul1</td><td>$utul2</td><td>$ketutul</td></tr>";
		//JUMLAh PKS
		$pks1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'parrental' => 'PKS','thesis'=>$thesis));
		$pks2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'parrental' => 'PKS','thesis'=>$thesis));
		if($pks1 < $pks2) : $ketpks = "NAIK"; elseif($pks1 == $pks2): $ketpks ="TETAP"; else : $ketpks = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PKS</td><td>$pks1</td><td>$pks2</td><td>$ketpks</td></tr>";		
		$table	.= "<tr><td><b>7</b></td><td><b>ASAL SEKOLAH</b></td><td></td><td></td><td></td></tr>";
		//jumalh SMA
		$sma1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'school' => 'SMA','thesis'=>$thesis));
		$sma2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'school' => 'SMA','thesis'=>$thesis));
		if($sma1 < $sma2) : $ketsma = "NAIK"; elseif($sma1 == $sma2): $ketsma ="TETAP"; else : $ketsma = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMA</td><td>$sma1</td><td>$sma2</td><td>$ketsma</td></tr>";
		//jumlah smk
		$smk1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'school' => 'SMK','thesis'=>$thesis));
		$smk2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'school' => 'SMK','thesis'=>$thesis));
		if($smk1 < $smk2) : $ketsmk = "NAIK"; elseif($smk1 == $smk2): $ketsmk ="TETAP"; else : $ketsmk = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMK</td><td>$smk1</td><td>$smk2</td><td>$ketsmk</td></tr>";
		//Jumlah D3
		$d31	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'school' => 'DIII','thesis'=>$thesis));
		$d32	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'school' => 'DIII','thesis'=>$thesis));
		if($d31 < $d32) : $ketd3 = "NAIK"; elseif($d31 == $d32): $ketd3 ="TETAP"; else : $ketd3 = "TURUN"; endif;
		$table  .= "<tr><td></td><td>DIII</td><td>$d31</td><td>$d32</td><td>$ketd3</td></tr>";
		//jumlah MAN
		$man1	 = $this->ym->count_yudis_by(array('datein'=>$start_date,'school' => 'MAN DLL','thesis'=>$thesis));
		$man2	 = $this->ym->count_yudis_by(array('datein'=>$finish_date,'school' => 'MAN DLL','thesis'=>$thesis));
		if($man1 < $man2) : $ketman = "NAIK"; elseif($man1 == $man2): $ketman ="TETAP"; else : $ketman = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MAN DLL</td><td>$man1</td><td>$man2</td><td>$ketman</td></tr>";
		$table 	.= "</table>";
		$sign 	 = $this->sign("350");
		$legend  = $this->legend();
		
		echo $style.$header.$table.$sign."<br>".$legend;
	    }else{
		echo "No Data";
	    }
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
		//$avgsem1 = ceil ($this->ym->get_sem_avg($start,$thesis));
		//$avgsem2 = ceil ($this->ym->get_sem_avg($finish,$thesis));
		$avgsem1 = round($this->get_real_sem($start,$thesis,"avg"),2);
		$avgsem2 = round($this->get_real_sem($finish,$thesis,"avg"),2);
		if($avgsem1 < $avgsem2) : $ketavgsem = "LEBIH LAMA"; else : $ketavgsem = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>RERATA MASA STUDI</td><td>$avgsem1</td><td>$avgsem2</td><td>$ketavgsem</td></tr>";
		//$semmax1 = round ($this->ym->get_sem_max($start,$thesis),2);
		//$semmax2 = round ($this->ym->get_sem_max($finish,$thesis),2);
		$semmax1 = round($this->get_real_sem($start,$thesis,"max"),2);
		$semmax2 = round($this->get_real_sem($finish,$thesis,"max",2));
		if($semmax1 < $semmax2) : $ketsemmax = "LEBIH LAMA"; else : $ketsemmax = "LEBIH CEPAT"; endif;
		$table  .= "<tr><td></td><td>MASA STUDI MAKSIMUM</td><td>$semmax1</td><td>$semmax2</td><td>$ketsemmax</td></tr>";
		//$semmin1 = round ($this->ym->get_sem_min($start,$thesis),2);
		//$semmin2 = round ($this->ym->get_sem_min($finish,$thesis),2);
		$semmin1 = round($this->get_real_sem($start,$thesis,"min"),2);
		$semmin2 = round($this->get_real_sem($finish,$thesis,"min",2));
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
		$v_good1 = $this->ym->count_verygood($start,$thesis) - $cum1;
		$v_good2 = $this->ym->count_verygood($finish,$thesis) - $cum2;
		if($v_good1 < $v_good2) : $ketvgood = "NAIK"; elseif($v_good1 == $v_good2): $ketvgood ="TETAP"; else : $ketvgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SANGAT MEMUASKAN</td><td>$v_good1</td><td>$v_good2</td><td>$ketvgood</td></tr>";
		$good1	 = $this->ym->count_good($start,$thesis);
		$good2   = $this->ym->count_good($finish,$thesis);
		if($good1 < $good2) : $ketgood = "NAIK"; elseif($good1 == $good2): $ketgood ="TETAP"; else : $ketgood = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MEMUASKAN</td><td>$good1</td><td>$good2</td><td>$ketgood</td></tr>";
		
		$table	.= "<tr><td><b>6</b></td><td><b>MASUK FT MELALUI</b></td><td></td><td></td><td></td></tr>";
		$pbu1	 = $this->ym->count_yudis_by(array('date'=>$start,'parrental' => 'PBU','thesis'=>$thesis));
		$pbu2	 = $this->ym->count_yudis_by(array('date'=>$finish,'parrental' => 'PBU','thesis'=>$thesis));
		if($pbu1 < $pbu2) : $ketpbu = "NAIK"; elseif($pbu1 == $pbu2): $ketpbu ="TETAP"; else : $ketpbu = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PBU</td><td>$pbu1</td><td>$pbu2</td><td>$ketpbu</td></tr>";
		$utul1	 = $this->ym->count_yudis_by(array('date'=>$start,'parrental' => 'UTUL','thesis'=>$thesis));
		$utul2	 = $this->ym->count_yudis_by(array('date'=>$finish,'parrental' => 'UTUL','thesis'=>$thesis));
		if($utul1 < $utul2) : $ketutul = "NAIK"; elseif($utul1 == $utul2): $ketutul ="TETAP"; else : $ketutul = "TURUN"; endif;
		$table  .= "<tr><td></td><td>UTUL</td><td>$utul1</td><td>$utul2</td><td>$ketutul</td></tr>";
		$pks1	 = $this->ym->count_yudis_by(array('date'=>$start,'parrental' => 'PKS','thesis'=>$thesis));
		$pks2	 = $this->ym->count_yudis_by(array('date'=>$finish,'parrental' => 'PKS','thesis'=>$thesis));
		if($pks1 < $pks2) : $ketpks = "NAIK"; elseif($pks1 == $pks2): $ketpks ="TETAP"; else : $ketpks = "TURUN"; endif;
		$table  .= "<tr><td></td><td>PKS</td><td>$pks1</td><td>$pks2</td><td>$ketpks</td></tr>";
		
		$table	.= "<tr><td><b>7</b></td><td><b>ASAL SEKOLAH</b></td><td></td><td></td><td></td></tr>";
		$sma1	 = $this->ym->count_yudis_by(array('date'=>$start,'school' => 'SMA','thesis'=>$thesis));
		$sma2	 = $this->ym->count_yudis_by(array('date'=>$finish,'school' => 'SMA','thesis'=>$thesis));
		if($sma1 < $sma2) : $ketsma = "NAIK"; elseif($sma1 == $sma2): $ketsma ="TETAP"; else : $ketsma = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMA</td><td>$sma1</td><td>$sma2</td><td>$ketsma</td></tr>";
		$smk1	 = $this->ym->count_yudis_by(array('date'=>$start,'school' => 'SMK','thesis'=>$thesis));
		$smk2	 = $this->ym->count_yudis_by(array('date'=>$finish,'school' => 'SMK','thesis'=>$thesis));
		if($smk1 < $smk2) : $ketsmk = "NAIK"; elseif($smk1 == $smk2): $ketsmk ="TETAP"; else : $ketsmk = "TURUN"; endif;
		$table  .= "<tr><td></td><td>SMK</td><td>$smk1</td><td>$smk2</td><td>$ketsmk</td></tr>";
		$d31	 = $this->ym->count_yudis_by(array('date'=>$start,'school' => 'DIII','thesis'=>$thesis));
		$d32	 = $this->ym->count_yudis_by(array('date'=>$finish,'school' => 'DIII','thesis'=>$thesis));
		if($d31 < $d32) : $ketd3 = "NAIK"; elseif($d31 == $d32): $ketd3 ="TETAP"; else : $ketd3 = "TURUN"; endif;
		$table  .= "<tr><td></td><td>DIII</td><td>$d31</td><td>$d32</td><td>$ketd3</td></tr>";
		$man1	 = $this->ym->count_yudis_by(array('date'=>$start,'school' => 'MAN DLL','thesis'=>$thesis));
		$man2	 = $this->ym->count_yudis_by(array('date'=>$finish,'school' => 'MAN DLL','thesis'=>$thesis));
		if($man1 < $man2) : $ketman = "NAIK"; elseif($man1 == $man2): $ketman ="TETAP"; else : $ketman = "TURUN"; endif;
		$table  .= "<tr><td></td><td>MAN DLL</td><td>$man1</td><td>$man2</td><td>$ketman</td></tr>";
		$table 	.= "</table>";
		$sign 	 = $this->sign("400");
		$legend  = $this->legend();
		
		echo $style.$header.$table.$sign."<br>".$legend;
	    }else{
		echo "No Data";
	    }
	}
	
    public function sign($width)
	{
	    $sign 	 = "<table>";
	    $sign	.= "<tr><td width=\"".$width."px\"></td><td align=\"left\"><br>Wakil Dekan I</td></tr>";
	    $sign	.= "<tr><td><br></td></tr>";
		//$sign	.= "<tr><td></td></tr>";
	    $sign	.= "<tr><td width=\"".$width."px\"></td><td align=\"left\">Dr. Sunaryo Soenarto <br />NIP. 19580630 198601 1 001</td></tr>";
	    $sign	.= "</table>";
	    return $sign;
	}
	
    public function dekan()
	{
	    $sign 	 = "<table>";
	    $sign	.= "<tr><td width=\"500px\"></td><td align=\"left\"><br>Dekan, </td><td  width=\"30\"></td></tr>";
	    $sign	.= "<tr><td><br></td><td></td></tr>";
		//$sign	.= "<tr><td></td></tr>";
	    $sign	.= "<tr><td width=\"500px\"></td><td align=\"left\">Dr. Moch Bruri Triyono <br />NIP. 19560216 198603 1 003</td><td width=\"30\"></td></tr>";
	    $sign	.= "</table>";
	    return $sign;
	}
    public function legend()
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
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'parrental' => 'PBU'))."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>UTUL</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'parrental' => 'UTUL'))."</td>";
		}
		$table .= "</tr>";
		$table .= "<tr><td></td><td>PKS</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'parrental' => 'PKS'))."</td>";
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
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'school' => 'SMA'))."</td>";
		}
		$table .= "</tr>";
		
		$table .= "<tr><td></td><td>SMK</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'school' => 'SMK'))."</td>";
		}
		$table .= "</tr>";
		
		$table .= "<tr><td></td><td>DIII</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'school' => 'DIII'))."</td>";
		}
		$table .= "</tr>";
		$table .= "</tr>";
		$table .= "<tr><td></td><td>MAN, DLL</td>";
		foreach ($array_bulan as $thb)
		{
		    $table .= "<td>".$this->ym->count_yudis_by(array('date' => $thb->yudisium_date,'school' => 'MAN DLL'))."</td>";
		}
		$table .= "</tr>";
		$table .= "</table>";
		echo $style;
		echo $table;
	    }else{
		echo "Erorrrrrrrrrrrrrrrrrrr";
	    }
	    
	}
	
    public function statistik(){
	if ($_POST){
	    $tahun = $this->input->post('tahun');
	    echo "Tabel 1. Statistik Lulusan FT UNY Tahun $tahun";
	    $style  = $this->style_present("STATISTIK Lulusan","","");
	    $table  = "<table class=\"gridtable\" border=\"1px\">";
	    $table .= "<tr><td valign=\"top\"><b>No.</b></td><td valign=\"top\"><b>PROGRAM STUDI</b></td><td align=\"center\"><b>JUMLAH LULUSAN</b></td><td align=\"center\"><b>JUMLAH CUMLAUDE</b></td><td align=\"center\"><b>RERATA MASA STUDI<br>(dalam Tahun)</b></td><td align=\"center\"><b>RERATA LAMA TA/TAS<br>(dalam bulan)</b></td><td align=\"center\" valign=\"top\"><b>RERATA IPK</b></td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>1.</b></td><td valign=\"top\"><b>PT ELEKTRO</b></td><td>".$this->ym->count_graduate('9',$tahun)."</td><td>".$c1=$this->ym->count_cum('Skripsi','9',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','9'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','9'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','9'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>2.</b></td><td valign=\"top\"><b>PT MEKATRONIKA</b></td><td>".$this->ym->count_graduate('10',$tahun)."</td><td>".$c2=$this->ym->count_cum_('Skripsi','10',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','10'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','10'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','10'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>3.</b></td><td valign=\"top\"><b>PT ELEKTRONIKA</b></td><td>".$this->ym->count_graduate('11',$tahun)."</td><td>".$c3=$this->ym->count_cum_('Skripsi','11',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','11'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','11'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','11'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>4.</b></td><td valign=\"top\"><b>PT INFORMATIKA</b></td><td>".$this->ym->count_graduate('12',$tahun)."</td><td>".$c4=$this->ym->count_cum_('Skripsi','12',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','12'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','12'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','12'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>5.</b></td><td valign=\"top\"><b>PT MESIN</b></td><td>".$this->ym->count_graduate('13',$tahun)."</td><td>".$c5=$this->ym->count_cum_('Skripsi','13',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','13'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','13'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','13'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>6.</b></td><td valign=\"top\"><b>PT OTOMOTIF</b></td><td>".$this->ym->count_graduate('14',$tahun)."</td><td>".$c6=$this->ym->count_cum_('Skripsi','14',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','14'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','14'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','14'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>7.</b></td><td valign=\"top\"><b>PT SIPIL DAN PERENCANAAN</b></td><td>".$this->ym->count_graduate('15',$tahun)."</td><td>".$c7=$this->ym->count_cum_('Skripsi','15',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','15'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','15'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','15'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>8.</b></td><td valign=\"top\"><b>PT BOGA</b></td><td>".$this->ym->count_graduate('16',$tahun)."</td><td>".$c8=$this->ym->count_cum_('Skripsi','16',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','16'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','16'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','16'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>9.</b></td><td valign=\"top\"><b>PT BUSANA</b></td><td>".$this->ym->count_graduate('17',$tahun)."</td><td>".$c9=$this->ym->count_cum_('Skripsi','17',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'Skripsi','17'),2)."</td><td>".round($this->ym->avg_ta($tahun,'Skripsi','17'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'Skripsi','17'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>10.</b></td><td valign=\"top\"><b>TEKNIK ELEKTRO</b></td><td>".$this->ym->count_graduate('1',$tahun)."</td><td>".$c10=$this->ym->count_cum_('D3','1',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','1'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','1'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','1'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>11.</b></td><td valign=\"top\"><b>TEKNIK ELEKTRONIKA</b></td><td>".$this->ym->count_graduate('2',$tahun)."</td><td>".$c11=$this->ym->count_cum_('D3','2',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','2'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','2'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','2'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>12.</b></td><td valign=\"top\"><b>TEKNIK MESIN</b></td><td>".$this->ym->count_graduate('3',$tahun)."</td><td>".$c12=$this->ym->count_cum_('D3','3',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','3'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','3'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','3'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>13.</b></td><td valign=\"top\"><b>TEKNIK OTOMOTIF</b></td><td>".$this->ym->count_graduate('4',$tahun)."</td><td>".$c13=$this->ym->count_cum_('D3','4',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','4'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','4'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','4'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>14.</b></td><td valign=\"top\"><b>TEKNIK SIPIL</b></td><td>".$this->ym->count_graduate('5',$tahun)."</td><td>".$c14=$this->ym->count_cum_('D3','5',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','5'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','5'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','5'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>15.</b></td><td valign=\"top\"><b>TEKNIK BOGA</b></td><td>".$this->ym->count_graduate('6',$tahun)."</td><td>".$c15=$this->ym->count_cum_('D3','6',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','6'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','6'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','6'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>16.</b></td><td valign=\"top\"><b>TEKNIK BUSANA</b></td><td>".$this->ym->count_graduate('7',$tahun)."</td><td>".$c16=$this->ym->count_cum_('D3','7',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','7'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','7'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','7'),2)."</td></tr>";
	    $table .= "<tr><td valign=\"top\"><b>17.</b></td><td valign=\"top\"><b>TATA RIAS DAN KECANTIKAN</b></td><td>".$this->ym->count_graduate('8',$tahun)."</td><td>".$c17=$this->ym->count_cum_('D3','8',$tahun)."</td><td>".round($this->ym->avg_studi($tahun,'D3','8'),2)."</td><td>".round($this->ym->avg_ta($tahun,'D3','8'),2)."</td><td>".round($this->ym->avg_ipk($tahun,'D3','8'),2)."</td></tr>";
	    $ct= $c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8+$c9+$c10+$c11+$c12+$c13+$c14+$c15+$c16+$c17;
	    $table .= "<tr><td valign=\"top\" colspan=\"2\"><b>JUMALAH / RERATA</b></td><td>".$this->ym->count_all_graduate($tahun)."</td><td>".$ct."</td><td>".round($this->ym->avg_studi_ttl($tahun),2)."</td><td>".round($this->ym->avg_ta_ttl($tahun),2)."</td><td>".round($this->ym->avg_ipk_ttl($tahun),2)."</td></tr>";
	    $table .= "</table>";
	    echo $style;
	    echo $table;
	}
    }
    
    public function stat_bulanan()
	{
	    if($_POST)
	    {
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$style  = $this->style_present("STATISTIK Lulusan","","");
		echo "Tabel 1. Statistik Lulusan FT UNY Bulan ".$this->BulanID($bulan)." ".$tahun;
		//=================== Jumlah lulusan ==============================//
		$g1 = $this->ym->count_graduate_by(array('dpt' => '9','bulan' => $bulan,'tahun' => $tahun));
		$g2 = $this->ym->count_graduate_by(array('dpt' => '10','bulan' => $bulan,'tahun' => $tahun));
		$g3 = $this->ym->count_graduate_by(array('dpt' => '11','bulan' => $bulan,'tahun' => $tahun));
		$g4 = $this->ym->count_graduate_by(array('dpt' => '12','bulan' => $bulan,'tahun' => $tahun));
		$g5 = $this->ym->count_graduate_by(array('dpt' => '13','bulan' => $bulan,'tahun' => $tahun));
		$g6 = $this->ym->count_graduate_by(array('dpt' => '14','bulan' => $bulan,'tahun' => $tahun));
		$g7 = $this->ym->count_graduate_by(array('dpt' => '15','bulan' => $bulan,'tahun' => $tahun));
		$g8 = $this->ym->count_graduate_by(array('dpt' => '16','bulan' => $bulan,'tahun' => $tahun));
		$g9 = $this->ym->count_graduate_by(array('dpt' => '17','bulan' => $bulan,'tahun' => $tahun));
		$g10= $this->ym->count_graduate_by(array('dpt' => '1','bulan' => $bulan,'tahun' => $tahun));
		$g11= $this->ym->count_graduate_by(array('dpt' => '2','bulan' => $bulan,'tahun' => $tahun));
		$g12= $this->ym->count_graduate_by(array('dpt' => '3','bulan' => $bulan,'tahun' => $tahun));
		$g13= $this->ym->count_graduate_by(array('dpt' => '4','bulan' => $bulan,'tahun' => $tahun));
		$g14= $this->ym->count_graduate_by(array('dpt' => '5','bulan' => $bulan,'tahun' => $tahun));
		$g15= $this->ym->count_graduate_by(array('dpt' => '6','bulan' => $bulan,'tahun' => $tahun));
		$g16= $this->ym->count_graduate_by(array('dpt' => '7','bulan' => $bulan,'tahun' => $tahun));
		$g17= $this->ym->count_graduate_by(array('dpt' => '8','bulan' => $bulan,'tahun' => $tahun));
		//===================== Jumlah Cumloude ==============================//
		$c1 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '9'));
		$c2 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '10'));
		$c3 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '11'));
		$c4 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '12'));
		$c5 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '13'));
		$c6 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '14'));
		$c7 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '15'));
		$c8 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '16'));
		$c9 = $this->ym->count_cum_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '17'));
		$c10= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '1'));
		$c11= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '2'));
		$c12= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '3'));
		$c13= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '4'));
		$c14= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '5'));
		$c15= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '6'));
		$c16= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '7'));
		$c17= $this->ym->count_cum_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '8'));
		$ct= $c1+$c2+$c3+$c4+$c5+$c6+$c7+$c8+$c9+$c10+$c11+$c12+$c13+$c14+$c15+$c16+$c17;
		//====================== Jumalah Sangat Memuaskan ==================//
		$v1 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '9')) - $c1;
		$v2 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '10')) - $c2;
		$v3 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '11')) - $c3;
		$v4 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '12')) - $c4;
		$v5 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '13')) - $c5;
		$v6 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '14')) - $c6;
		$v7 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '15')) - $c7;
		$v8 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '16')) - $c8;
		$v9 = $this->ym->count_verygood_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '17')) - $c9;
		$v10= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '1')) - $c10;
		$v11= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '2')) - $c11;
		$v12= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '3')) - $c12;
		$v13= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '4')) - $c13;
		$v14= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '5')) - $c14;
		$v15= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '6')) - $c15;
		$v16= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '7')) - $c16;
		$v17= $this->ym->count_verygood_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '8')) - $c17;
		$vt = $v1+$v2+$v3+$v4+$v5+$v6+$v7+$v8+$v9+$v10+$v11+$v12+$v13+$v14+$v15+$v16+$v17;
		//====================== Jumlah memuaskan =========================//
		$m1 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '9'));
		$m2 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '10'));
		$m3 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '11'));
		$m4 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '12'));
		$m5 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '13'));
		$m6 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '14'));
		$m7 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '15'));
		$m8 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '16'));
		$m9 = $this->ym->count_good_by(array('thesis' => 'Skripsi','bulan' => $bulan,'tahun' => $tahun,'dpt' => '17'));
		$m10= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '1'));
		$m11= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '2'));
		$m12= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '3'));
		$m13= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '4'));
		$m14= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '5'));
		$m15= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '6'));
		$m16= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '7'));
		$m17= $this->ym->count_good_by(array('thesis' => 'D3','bulan' => $bulan,'tahun' => $tahun,'dpt' => '8'));
		$mt = $m1+$m2+$m2+$m3+$m4+$m5+$m6+$m7+$m8+$m9+$m10+$m11+$m12+$m13+$m14+$m15+$m16+$m17;
		//==================== avg rerata Masa studi ================================//
		$ams1 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","9");
		$ams2 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","10");
		$ams3 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","11");
		$ams4 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","12");
		$ams5 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","13");
		$ams6 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","14");
		$ams7 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","15");
		$ams8 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","16");
		$ams9 = $this->ym->count_avg_study_by($bulan."-".$tahun,"Skripsi","17");
		$ams10 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","1");
		$ams11 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","2");
		$ams12 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","3");
		$ams13 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","4");
		$ams14 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","5");
		$ams15 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","6");
		$ams16 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","7");
		$ams17 = $this->ym->count_avg_study_by($bulan."-".$tahun,"D3","8");
		//===================== avg rerata ta =========================================//
		$ata1 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","9");
		$ata2 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","10");
		$ata3 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","11");
		$ata4 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","12");
		$ata5 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","13");
		$ata6 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","14");
		$ata7 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","15");
		$ata8 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","16");
		$ata9 = $this->ym->count_avg_ta_($bulan."-".$tahun,"Skripsi","17");
		$ata10 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","1");
		$ata11 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","2");
		$ata12 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","3");
		$ata13 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","4");
		$ata14 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","5");
		$ata15 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","6");
		$ata16 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","7");
		$ata17 = $this->ym->count_avg_ta_($bulan."-".$tahun,"D3","8");
		//======================= avg rerata IPK ======================================//
		$aipk1 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","9");
		$aipk2 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","10");
		$aipk3 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","11");
		$aipk4 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","12");
		$aipk5 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","13");
		$aipk6 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","14");
		$aipk7 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","15");
		$aipk8 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","16");
		$aipk9 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"Skripsi","17");
		$aipk10 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","1");
		$aipk11 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","2");
		$aipk12 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","3");
		$aipk13 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","4");
		$aipk14 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","5");
		$aipk15 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","6");
		$aipk16 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","7");
		$aipk17 = $this->ym->count_avg_ipk_($bulan."-".$tahun,"D3","8");
		//================================================================///
		$table  = "<table class=\"gridtable\" border=\"1px\">";
		$table .= "<tr><td><b>No.</b></td><td ><b>PROGRAM STUDI</b></td><td align=\"center\"><b>JUMLAH LULUSAN</b></td><td align=\"center\"><b>JUMLAH CUMLAUDE</b></td><td align=\"center\"><b>JUMLAH SANGAT MEMUASKAN</b></td><td align=\"center\"><b>JUMLAH MEMUASKAN</b></td><td align=\"center\"><b>RERATA MASA STUDI<br>(dalam Tahun)</b></td><td align=\"center\"><b>RERATA LAMA TA/TAS<br>(dalam bulan)</b></td><td align=\"center\" valign=\"top\"><b>RERATA IPK</b></td></tr>";
		$table .= "<tr><td valign=\"top\"><b>1.</b></td><td valign=\"top\"><b>PT ELEKTRO</b></td><td>".$g1."</td><td>".$c1."</td><td>".$v1."</td><td>".$m1."</td><td>".$ams1."</td><td>".$ata1."</td><td>".$aipk1."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>2.</b></td><td valign=\"top\"><b>PT MEKATRONIKA</b></td><td>".$g2."</td><td>".$c2."</td><td>".$v2."</td><td>".$m2."</td><td>".$ams2."</td><td>".$ata2."</td><td>".$aipk2."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>3.</b></td><td valign=\"top\"><b>PT ELEKTRONIKA</b></td><td>".$g3."</td><td>".$c3."</td><td>".$v3."</td><td>".$m3."</td><td>".$ams3."</td><td>".$ata3."</td><td>".$aipk3."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>4.</b></td><td valign=\"top\"><b>PT INFORMATIKA</b></td><td>".$g4."</td><td>".$c4."</td><td>".$v4."</td><td>".$m4."</td><td>".$ams4."</td><td>".$ata4."</td><td>".$aipk4."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>5.</b></td><td valign=\"top\"><b>PT MESIN</b></td><td>".$g5."</td><td>".$c5."</td><td>".$v5."</td><td>".$m5."</td><td>".$ams5."</td><td>".$ata5."</td><td>".$aipk5."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>6.</b></td><td valign=\"top\"><b>PT OTOMOTIF</b></td><td>".$g6."</td><td>".$c6."</td><td>".$v6."</td><td>".$m6."</td><td>".$ams6."</td><td>".$ata6."</td><td>".$aipk6."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>7.</b></td><td valign=\"top\"><b>PT SIPIL DAN PERENCANAAN</b></td><td>".$g7."</td><td>".$c7."</td><td>".$v7."</td><td>".$m7."</td><td>".$ams7."</td><td>".$ata7."</td><td>".$aipk7."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>8.</b></td><td valign=\"top\"><b>PT BOGA</b></td><td>".$g8."</td><td>".$c8."</td><td>".$v8."</td><td>".$m8."</td><td>".$ams8."</td><td>".$ata8."</td><td>".$aipk8."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>9.</b></td><td valign=\"top\"><b>PT BUSANA</b></td><td>".$g9."</td><td>".$c9."</td><td>".$v9."</td><td>".$m9."</td><td>".$ams9."</td><td>".$ata9."</td><td>".$aipk9."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>10.</b></td><td valign=\"top\"><b>TEKNIK ELEKTRO</b></td><td>".$g10."</td><td>".$c10."</td><td>".$v10."</td><td>".$m10."</td><td>".$ams10."</td><td>".$ata10."</td><td>".$aipk10."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>11.</b></td><td valign=\"top\"><b>TEKNIK ELEKTRONIKA</b></td><td>".$g11."</td><td>".$c11."</td><td>".$v11."</td><td>".$m11."</td><td>".$ams11."</td><td>".$ata11."</td><td>".$aipk11."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>12.</b></td><td valign=\"top\"><b>TEKNIK MESIN</b></td><td>".$g12."</td><td>".$c12."</td><td>".$v12."</td><td>".$m12."</td><td>".$ams12."</td><td>".$ata12."</td><td>".$aipk12."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>13.</b></td><td valign=\"top\"><b>TEKNIK OTOMOTIF</b></td><td>".$g13."</td><td>".$c13."</td><td>".$v13."</td><td>".$m13."</td><td>".$ams13."</td><td>".$ata13."</td><td>".$aipk13."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>14.</b></td><td valign=\"top\"><b>TEKNIK SIPIL</b></td><td>".$g14."</td><td>".$c14."</td><td>".$v14."</td><td>".$m14."</td><td>".$ams14."</td><td>".$ata14."</td><td>".$aipk14."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>15.</b></td><td valign=\"top\"><b>TEKNIK BOGA</b></td><td>".$g15."</td><td>".$c15."</td><td>".$v15."</td><td>".$m15."</td><td>".$ams15."</td><td>".$ata15."</td><td>".$aipk15."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>16.</b></td><td valign=\"top\"><b>TEKNIK BUSANA</b></td><td>".$g16."</td><td>".$c16."</td><td>".$v16."</td><td>".$m16."</td><td>".$ams16."</td><td>".$ata16."</td><td>".$aipk16."</td></tr>";
		$table .= "<tr><td valign=\"top\"><b>17.</b></td><td valign=\"top\"><b>TATA RIAS DAN KECANTIKAN</b></td><td>".$g17."</td><td>".$c17."</td><td>".$v17."</td><td>".$m17."</td><td>".$ams17."</td><td>".$ata17."</td><td>".$aipk17."</td></tr>";
		
		$table .= "<tr><td valign=\"top\" colspan=\"2\"><b>JUMALAH / RERATA</b></td><td>".$this->ym->count_graduate_by(array('bulan' => $bulan,'tahun' => $tahun))."</td><td>".$ct."</td><td>".$vt."</td><td>".$mt."</td><td>".$this->ym->avg_studi_bt($bulan."-".$tahun)."</td><td>".$this->ym->avg_ta_bt($bulan."-".$tahun)."</td><td>".$this->ym->avg_ipk_bt($bulan."-".$tahun)."</td></tr>";
		$table .= "</table>";
		//$okeh= $this->ym->count_graduate_by(array('dpt' => '9','tahun'=>'2012'));
		//echo $okeh;
		echo $style;
		echo $table;
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
		$status = $this->input->post('f_printed');
		$keywords = $this->input->post('f_name');
		//$datein   = $this->input->post('f_datein');
		$nim	= $this->input->post('f_nim');
		$post_data = array();
		if($nim){
                    $post_data['nim'] = $nim;
                }
		if ($status == '1' OR $status == '2')
		{
			$post_data['printed'] = $status;
		}
		
		if ($keywords)
		{
			$post_data['name'] = $keywords;
		}
		$total_rows = $this->ym->count_by($post_data);
		$pagination = create_pagination('admin/yudisium/index', $total_rows);
		// Using this data, get the relevant results
		$results = $this->ym->limit($pagination['limit'])->search($post_data);
		//$results = $this->ym->search($post_data);
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
	    $thn;
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
	    $result 	= ($diff * 2);
	    return $result;
	}
    public function get_sem_wc($nim,$date,$cuti)
	{
	    $year 	= substr($nim,0,2);
	    $start	= '20'.$year;
	    $finish	= substr($date,0,4);
	    $diff	= intval($finish) - intval($start);
	    $result 	= ($diff * 2) - $cuti ;
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
	    //$prodies = $this->ym->get_prodies($nim);
	    //$split = explode ('-',$prodies->x);
	    //$nama  = $split[0];
	    //$stage = $split[1];
	    $stage = $this->ym->prodi_name($nim);
	    //$stage = $this->ym->get_stage($nim);
	    return $stage->label;
	}

	public function testi($nim)
	{
		$stage = $this->ym->prodi_name($nim);
	    //$stage = $this->ym->get_stage($nim);
	    return $stage->label;
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
			$predicate = 'Dengan Pujian';
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
				$var_date = date('Y')."-06-30";
				if($ipk <= 4.0 && $ipk >= 3.51)
				{
					if($parrental == 'PKS')
					{
						$predicate = 'Sangat Memuaskan';
					}else{
						//$predicate = 'Dengan Pujian'; 
						if ($smster == 10 && $date > $var_date)
							{
								$predicate = 'Sangat Memuaskan';
								
							}else{
								$predicate = 'Dengan Pujian';
							}
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
	
    public function periode($nim,$yudisium,$cuti)
	{
	    $year= $this->get_year($nim);
	    $d1		= $year."-09-01";
	    switch($cuti)
	    {
		case "1" :
		    $start	= $this->add_date($d1,0,6,0);
		    $period	= $this->get_datediff($start,$yudisium);
		    
		    //$dateB = new DateTime($d1); 
		    //$dateA = $dateB->sub(date_interval_create_from_date_string('6 months'));
		    //$start = date_format($dateA, 'Y-m-d');

		break;
		case "2" :
		    //$dateB = new DateTime($d1); 
		    //$dateA = $dateB->sub(date_interval_create_from_date_string('12 months'));
		    //$start = date_format($dateA, 'Y-m-d');
		    $start	= $this->add_date($d1,1,0,0);
		    //$period	= $this->get_datediff($start,$yudisium);
		break;
		case "3" :
		    $start	= $this->add_date($d1,1,6,0);
		    //$period	= $this->get_datediff($start,$yudisium);
		    //$dateB = new DateTime($d1); 
		    //$dateA = $dateB->sub(date_interval_create_from_date_string('18 months'));
		    //$start = date_format($dateA, 'Y-m-d');
		break;
		case "4" :
		    $start	= $this->add_date($d1,2,0,0);
		    //$period	= $this->get_datediff($start,$yudisium);
		    //$dateB = new DateTime($d1); 
		    //$dateA = $dateB->sub(date_interval_create_from_date_string('24 months'));
		    //$start = date_format($dateA, 'Y-m-d');
		break;
		default	 :
		    $start	= $d1;
		    //$period	= $this->get_datediff($start,$yudisium);
		break;    
		    
	    }
	    $period	= $this->get_datediff($start,$yudisium);
	    return $period;
	    
	}
	
    public function add_date($givendate,$day=0,$mth=0,$yr=0)
    {
	$cd = strtotime($givendate);
	$newdate = date('Y-m-d', mktime(date('h',$cd),
	date('i',$cd), date('s',$cd), date('m',$cd)+$mth,
	date('d',$cd)+$day, date('Y',$cd)+$yr));
	return $newdate;
    }
    
    public function get_real_sem($date,$thesis,$attr)
	{
	    $sem = $this->ym->get_semester($date,$thesis);
	    $rec = count($sem);
	    $real = array();
	    $i= 0;
	    foreach ($sem as $s)
	    {
		$real[$i]= $s->semester - $s->vacation;
		//echo $s->semester."--".$s->vacation."--".$real."<br>";
		$i++;
		
	    }
	    switch($attr)
	    {
		case "max"	:
		    $result	= max($real);
		    break;
		case "min"	:
		    $result	= min($real);
		    break;
		default		:
		    $result = array_sum($real) / $rec;
		    break;
	    }
	  
	  return $result;
	    
	}
    
    function BulanID($bln)
    {
        switch ($bln){
            case 1: 
              return "Januari";
              break;
            case 2:
              return "Februari";
              break;
            case 3:
              return "Maret";
              break;
            case 4:
              return "April";
              break;
            case 5:
              return "Mei";
              break;
            case 6:
              return "Juni";
              break;
            case 7:
              return "Juli";
              break;
            case 8:
              return "Agustus";
              break;
            case 9:
              return "September";
              break;
            case 10:
              return "Oktober";
              break;
            case 11:
              return "November";
              break;
            case 12:
              return "Desember";
              break;
        }
    }
}