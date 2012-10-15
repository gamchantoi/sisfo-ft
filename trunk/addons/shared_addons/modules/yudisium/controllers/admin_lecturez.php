<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Lecturez extends Admin_Controller
{
    protected $rules = array(
                array(
			'field' => 'nip',
			'label' => 'lang:yudisium_date',
			'rules' => 'trim|required|max_length[100]'
			),
		array(
			'field' => 'name',
			'label' => 'lang:yudisium_lecture_name',
			'rules' => 'trim|required|max_length[10]'
			),
		array(
			'field' => 'major',
			'label' => 'lang:yudisium_major',
			'rules' => 'trim|required'
                        )
            );
    
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('yudisium');
        $this->load->model('yudisium_m','ym');
        $this->load->helper('tanggal');        
    }
    public function index()
    {
        $base_where= array();
	if ($this->input->post('f_nip')) 	$base_where['nip']	= $this->input->post('f_nip');
	if ($this->input->post('f_name')) 	$base_where['name'] 	= $this->input->post('f_name');
	// Create pagination links
	$total_rows = $this->ym->count_lectures_by($base_where);
	$pagination = create_pagination('admin/yudisium/lectures/index', $total_rows);
	$lectures = $this->ym->limit($pagination['limit'])->get_lectures_by($base_where);

		//do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
	$this->template
		->title($this->module_details['name'])
		->append_js('admin/filter.js')
		->set('pagination',$pagination)
		->set('lectures', $lectures);

		$this->input->is_ajax_request()
		? $this->template->build('admin/tables/lectures')
		: $this->template->build('admin/lectures/index');	
    }
    
    public function create()
    {
        
    }
    
    public function edit($id=0)
	{
	  $id OR redirect('admin/yudisium/lecturez');  
	}
    
    public function delete($id=0)
    {
        $id OR redirect('admin/yudisium/lecturez');
        $result = $this->ym->del_lectures($id);
        if($result)
            {
                $this->pyrocache->delete('ym');
                $this->session->set_flashdata('success', 'Berhasil menghapus data Dosen');
        }else{
                $this->session->set_flashdata('error', 'Gagal Menghapus data Dosen');
            }
        redirect('admin/yudisium/lecturez');
    }
    
    public function ajax_filter($nip)
	{
		$nip      = $this->input->post('f_nip');
		$name    = $this->input->post('f_name');
		$post_data = array();

		if($nip){
                    $post_data['nip'] = $nip;
                }
		if ($name)
		{
			$post_data['name'] = $name;
		}
	    
		$total_rows = $this->ym->count_lectures_by($post_data);
		$pagination = create_pagination('admin/yudisium/lecturez/index', $total_rows);
		// Using this data, get the relevant results
		$lectures = $this->ym->limit($pagination['limit'])->search_lectures($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('lectures', $lectures)
			->build('admin/tables/lectures');
	}
}