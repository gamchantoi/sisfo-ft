<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Prakerin
 * @category  	Module
 */
class Admin extends Admin_Controller{
    protected $section = 'prakerin';
    protected $v_rules= array(
            array(
                'field' => 'name[]',
		'label' => 'Nama',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'nim[]',
		'label' => 'NIM',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'company',
		'label' => 'Nama Perusahaan',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'address',
		'label' => 'Alamat',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'district',
		'label' => 'Kota / Kabupaten',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'department',
		'label' => 'Program Studi',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'start',
		'label' => 'Tanggal Mulai',
		'rules' => 'required|xss_clean'
            ),
            array(
                'field' => 'finish',
		'label' => 'Tanggal Selesai',
		'rules' => 'required|xss_clean'
            )
        );
    
   public function __construct()
    {
         parent::__construct();
	 $this->lang->load('prakerin');
         $this->load->library('form_validation');
         $this->load->model('prakerin_m','pkl');
	 $this->load->helper('yudisium/tanggal');
    }
    
    
   public function index()
   {
         $base_where = array('printed' => 'all');

		//add post values to base_where if f_module is posted
	 $base_where = $this->input->post('f_category') ? $base_where + array('category' => $this->input->post('f_category')) : $base_where;

	 $base_where['printed'] = $this->input->post('f_printed') ? $this->input->post('f_printed') : $base_where['printed'];

		//$base_where = $this->input->post('f_datein') ? $base_where + array('date' => $this->input->post('f_datein')) : $base_where;
	 $base_where = $this->input->post('f_keywords') ? $base_where + array('keywords' => $this->input->post('f_keywords')) : $base_where;
	 $mhs_num    = $this->pkl->count_mhs_by(array('printed' => 'all'));
	 $thanks_no  = $this->pkl->count_mhs_by(array('printed' => '2'));
	 $thanks_yes = $this->pkl->count_mhs_by(array('printed' => '1'));
	 $lp_yes_num = $this->pkl->count_by(array('printed' => '1'));
	 $lp_no_num  = $this->pkl->count_by(array('printed' => '2'));
	 $tp_yes_num = $this->pkl->count_by(array('t_printed' => '1'));
	 $tp_no_num  = $this->pkl->count_by(array('t_printed' => '2'));
	 $lp_num     = $this->pkl->count_by(array('printed' => 'all'));
	 $cp_num     = $this->pkl->count_all_company();
		// Create pagination links
	 $total_rows = $this->pkl->count_by($base_where);
	 $pagination = create_pagination('admin/prakerin/index', $total_rows);
		

		// Using this data, get the relevant results
	 $data = $this->pkl->limit($pagination['limit'])->get_many_by($base_where);
		//do we need to unset the layout because the request is ajax?
	 $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
		
	 $this->template
			->title($this->module_details['name'])
			->append_js('admin/filter.js')
			->append_js('module::jquery.printPage.js')
			->append_js('module::jquery.qtip.js')
			->append_css('module::jquery.qtip.css')
			->set('mhs_num',$mhs_num)
			->set('lp_num',$lp_num)
			->set('lp_yes_num',$lp_yes_num)
			->set('lp_no_num',$lp_no_num)
			->set('tp_yes_num',$tp_yes_num)
			->set('tp_no_num',$tp_no_num)
			->set('thanks_no',$thanks_no)
			->set('thanks_yes',$thanks_yes)
			->set('cp_num',$cp_num)
			->set('pagination', $pagination)
			->set('data', $data);

	 $this->input->is_ajax_request() ? $this->template->build('admin/tables/prakerin', $this->data) : $this->template->build('admin/index', $this->data);
   }
   
   public function preview($id=0)
   {
	$this->data->mhs = $this->pkl->get_data($id);
	$this->data->lisence= $this->get_printed($id,'2');
	$this->data->thanks = $this->get_printed($id,'3');
	$this->data->company= $this->pkl->get_company($id);
	$this->load->view('admin/view',$this->data);
   }
   
   public function mhs()
   {
	$base_where = array('printed' => 'all');
	$base_where = $this->input->post('f_nim') ? $base_where + array('nim' => $this->input->post('f_nim')) : $base_where;
	$base_where['printed'] = $this->input->post('f_printed') ? $this->input->post('f_printed') : $base_where['printed'];
	$base_where = $this->input->post('f_name') ? $base_where + array('name' => $this->input->post('f_name')) : $base_where;    
	$total_rows = $this->pkl->count_mhs_by($base_where);
	$pagination = create_pagination('admin/prakerin/mhs', $total_rows);
		// Using this data, get the relevant results
	 $data = $this->pkl->limit($pagination['limit'])->get_mhs_by($base_where);
	 //print_r($data);
		//do we need to unset the layout because the request is ajax?
	 $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
	 $this->template
			->title($this->module_details['name'])
			->append_metadata(js('admin/filter.js'))
			->append_metadata(js('jquery.printPage.js','yudisium'))
			->append_metadata(js('jquery.qtip.js','yudisium'))
			->append_metadata(css('jquery.qtip.css','yudisium'))
			->set('pagination', $pagination)
			->set('data', $data);

	 $this->input->is_ajax_request() ? $this->template->build('admin/tables/mhs', $this->data) : $this->template->build('admin/mhs', $this->data);
   }
   
   public function lisence($number)
   {
	$this->data->company= $this->pkl->get_company($number);
	list($this->data->date_in, $this->data->date_in) = explode(" ", $this->data->company['date']);
	$this->data->mhs    = $this->pkl->get_mhs($number);
	$this->data->nums   = $this->pkl->count_mhs($number);
	$this->load->view ('admin/lisence',$this->data);
   }
   
   public function l_printed($id)
   {
	$this->data->result= $this->get_printed($id,'2');
	$this->load->view('admin/printed',$this->data);
   }
   
   public function t_printed($id)
   {
	$result= $this->get_printed($id,'3');
   }
   public function get_printed($id,$code)
   {
	$result=$this->pkl->get_print($id,$code);
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
		$results = $this->pkl->search($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('data', $results)
			->build('admin/tables/prakerin');
	}
    public function ajax_search()
	{
	    $nim 	= $this->input->post('f_nim');
	    $name	= $this->input->post('f_name');
	    $printed 	= $this->input->post('f_printed');
	    $post_data 	= array();
	    
	    if($name)
		{
		    $post_data['name'] = $name;
		}
	    if($nim)
		{
		    $post_data['nim'] = $nim;
		}
	    if($printed == '1' OR $printed == '2')
		{
		    $post_data['printed'] = $printed;
		}
	    $result = $this->pkl->search_mhs($post_data);
	    $this->template
		    ->set_layout(FALSE)
		    ->set('data',$result)
		    ->build('admin/tables/mhs');
	}
}