<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Categories
 * @category  	Module
 * @author		mrcoco@cempakaweb.com
 */

class Yudisium extends Public_Controller {
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
			    'field' => 'gender',
			    'label' => 'lang:yudisium_gender',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'merriage',
			    'label' => 'lang:yudisium_merriage',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'pob',
			    'label' => 'lang:yudisium_pob',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'dob',
			    'label' => 'lang:yudisium_dob',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'address',
			    'label' => 'lang:yudisium_address',
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
			    'rules' => 'trim|required'
		    )
		);
    
    public function __construct()
	{		
		parent::__construct();
		$this->lang->load('yudisium');
		$this->load->model('yudisium_m');
		$religions= array(
					      0 => '-Agama-',
					      1 => 'Islam',
					      2 => 'Katholik',
					      3 => 'Kristen',
					      4 => 'Hindu',
					      5 => 'Budha',
					      6 => 'Konghuchu',
					      7 => 'Lainnya'
					      );
		$vacations= array(
						'0' => '0',
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4'
		);
		$this->template->set('religions', $religions)
		    ->set('vacations',$vacations)
		    ->set('prodies',$this->prodies())
		    ->set('lectures',$this->lectures());
		//$this->data->prodies  = $this->prodies();
                //$this->data->lectures = $this->lectures();
		/**
		
		$this->data->religions= array(
					      0 => '-Agama-',
					      1 => 'Islam',
					      2 => 'Katholik',
					      3 => 'Kristen',
					      4 => 'Hindu',
					      5 => 'Budha',
					      6 => 'Konghuchu',
					      7 => 'Lainnya'
					      );
		**/
	}
        
    
    
    public function index() {
        $this->template
//			->set('departments',$dpid)
			->append_css('module::ui-lightness/jquery-ui-1.7.3.custom.css')
			->append_js('module::jquery-ui-min.js')
			->append_metadata('<script type="text/javascript">
					  $(function() {
					  $( "#datepicker" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true,yearRange: "1980:2000"});
					  $( "#graduation" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#start" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#finish" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#date" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  });</script>')
			->title($this->module_details['name'])
                        ->build('index');
    }
    
    public function prodi(){
    	$nim	 = $this->input->post('nim');
		$profile = $this->yudisium_m->get_prodies($nim);
		$major   = $this->yudisium_m->get_major_by_name($profile->x);
		$pa  	 = $this->get_pa($major);
		$result  = "<div>";
		$result .= "<label for=\"name\">".lang('yudisium_name')."</label>";
		$result .= form_input('name',$profile->name);
		$result .= "</div>";
		$result .= "<div>";
		$result .= "<label for=\"department\">".lang('yudisium_department')." </label>";
		$result .= form_dropdown('department', $this->prodies_id($profile->x),'','class="department"'); 
		$result .= "</div>";
		$result .= "<div>";
		$result .= "<label for=\"lecture\">".lang('yudisium_pa')."</label>";
		//$result .= form_dropdown('pa',$this->lectures()); 
		$result .= form_dropdown('pa',$pa); 
		$result .= "</div>";
		echo $result;
    }
	
	
	
    public function create() {
	$this->load->library('form_validation');
	$this->form_validation->set_rules($this->v_rules);
	if($this->form_validation->run()){
	    if($this->input->post('submit')=='Simpan'){
		$id=$this->yudisium_m->insert(array(
						    'name'	        => $this->input->post('name'),
                                                    'date'              => date('Y-m-d H:i:s'),
						    'date_in'           => date('Y-m-d H:i:s'),
						    'nim'	        => $this->input->post('nim'),
						    'department'        => $this->input->post('department'),
						    'pa'	        => $this->input->post('pa'),
                                                    'place_of_birth'    => $this->input->post('pob'),
                                                    'date_of_birth'     => $this->input->post('dob'),
                                                    'religion'          => $this->input->post('religion'),
                                                    'sex'               => $this->input->post('gender'),
                                                    'meriage'           => $this->input->post('merriage'),
                                                    'address'           => $this->input->post('address'),
                                                    'parrent'           => $this->input->post('parrent'),
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
                                                    'vacation'          => $this->input->post('vacation'),
                                                    'yudisium_date'     => $this->input->post('yudisium_date'),
						    'antidatir'		=> $this->input->post('antidatir'),
                                                    'phone'             => $this->input->post('phone'),
                                                    'email'             => $this->input->post('email')
						    ));	
		if($id){
                    $this->pyrocache->delete_all('yudisium_m');
		    $message='Data Berhasil disimpan';
		    $this->session->set_flashdata('success', $message);
		}else{
		    $message='Data Gagal disimpan';
		    $this->session->set_flashdata('error', $message);
		}
		
		redirect('yudisium');
	    }
	    
	}else{
	    foreach ($this->v_rules as $key => $field)
		{
			if (isset($_POST[$field['field']]))
			{
				$post->$field['field'] = set_value($field['field']);
			}
		}
	}
	
	$this->template->build('index',$this->data);
	
    }
    
    function get_major($id=0)
    {
        $major = $this->yudisium_m->get_dosen($id);
        echo $major->major;
        //print_r($major);
    }
    
    function search_pa()
    {

       if('IS_AJAX'){
        $data= $this->yudisium_m->search_pa($key);
        $this->load->view('chain/selectcity',$data);
       }
       
    }
    
    //tampil program studi
    public function prodies()
    {
        $result= array(0 => 'Pilih Program Studi');
	    if($prodies = $this->yudisium_m->get_dept())
	    {
		foreach($prodies as $dpt)
		{
		    $result[$dpt->id] = $dpt->name;
		}
	    }
        return $result;
    }
    
	public function prodies_id($name)
	{
		if($prodies = $this->yudisium_m->get_dept_id($name))
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
	    if($lectures = $this->yudisium_m->get_lecture())
	    {
		foreach($lectures as $lec){
		    $result[$lec->id]= $lec->name;
		}
	    }
        return $result;
    }
    
	public function get_pa($major)
	{
		$result= array(0 => 'Pilih Dosen');
	    if($lectures = $this->yudisium_m->get_pa($major))
	    {
		foreach($lectures as $lec){
		    $result[$lec->id]= $lec->name;
		}
	    }
        return $result;
	}
    public function _check_nim($nim, $id = null)
	{
		$this->form_validation->set_message('_check_nim', sprintf(lang('yudisium_already_exist_error'), lang('yudisium_nim_label')));
		return $this->yudisium_m->check_exists('nim', $nim, $id);			
	}
}
