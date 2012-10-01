<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Mahasiswa
 * @category  	Module
 * @author	mrcoco@cempakaweb.com
 */

class Admin_Student extends Admin_Controller {
    
    protected $rules = array(
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
                        )
            );
    public function __construct()
	{
	    parent::__construct();
            $this->load->driver('Streams');
            $this->lang->load('yudisium');
            $this->load->model('yudisium_m','ym');
            $this->data->prodies  = $this->prodies();
	}
    
    public function index()
	{
            $base_where = array('status' => 0);
            $base_where['status'] = $this->input->post('f_module') ? (int)$this->input->post('f_status') : $base_where['status'];
            $base_where = $this->input->post('f_keywords') ? $base_where + array('name' => $this->input->post('f_keywords')) : $base_where;
            $total_rows = $this->ym->count_mhs_by($base_where);
	    $pagination = create_pagination('admin/yudisium/college/index', $total_rows);		
		// Using this data, get the relevant results
	    $data = $this->ym->limit($pagination['limit'])->get_college_by($base_where);
	    //do we need to unset the layout because the request is ajax?
	    $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
	    $this->template
			->title($this->module_details['name'])
			->append_js('admin/filter.js')
                       // ->set('pagination',$pagination)
			->set('data', $data);

		$this->input->is_ajax_request()
		? $this->template->build('admin/tables/college')
		: $this->template->build('admin/college_index');
	}
    public function create()
        {
            $this->form_validation->set_rules($this->rules);
	    if($this->form_validation->run())
            {
                $id=$this->ym->insert_college(array(
			    'name'	        => $this->input->post('name'),	    
			    'nim'	        => $this->input->post('nim'),
                            'x'                 => $this->get_dpt_name($this->input->post('department')),
			    'department'        => $this->input->post('department')
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
		
		$this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/college') : redirect('admin/yudisium/college/edit/' . $id);
            }else{
                foreach ($this->rules as $key => $field)
		    {
			$data->$field['field'] = set_value($field['field']);
		    }
            }
            $this->template
                ->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
                ->set('data',$data)->build('admin/form_college');
        }
    public function edit($id=0)
        {
            $id OR redirect('admin/yudisium/create');
            $mhs_id= array('id' => $id);
            $data= $this->ym->get_mhs_by($mhs_id);
            $this->form_validation->set_rules($this->rules);
	    if($this->form_validation->run()){
		$result = $this->ym->update_mhs($id,array(
			    'name'	        => $this->input->post('name'),
			    'nim'	        => $this->input->post('nim'),
			    'department'        => $this->input->post('department'),
			    'x'                 => $this->get_dpt_name($this->input->post('department'))
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
			    $this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/college') : redirect('admin/yudisium/college/edit/' . $id);
	    }
	    // Go through all the known fields and get the post values
	    foreach ($this->rules as $key => $field)
		    {
			    if (isset($_POST[$field['field']]))
			    {
				    $data->$field['field'] = set_value($field['field']);
			    }
		    }
            $this->template
                ->title($this->module_details['name'], sprintf(lang('yudisium_edit_title'), $data->name))
		->append_metadata($this->load->view('fragments/wysiwyg', $this->data, TRUE))
                ->set('data',$data)
                ->build('admin/form_college');
        }
    public function ajax_filter()
	{
		//$category = $this->input->post('f_category');
		$status = $this->input->post('f_status');
		$keywords = $this->input->post('f_keywords');
		$nim   = $this->input->post('f_nim');
		$post_data = array();

		if ($status == '1' OR $status == '2')
		{
			$post_data['status'] = $status;
		}
		if($nim){
                    $post_data['nim'] = $nim;
                }
		if ($keywords)
		{
			$post_data['keywords'] = $keywords;
		}
		$total_rows = $this->ym->count_mhs_by($post_data);
		$pagination = create_pagination('admin/yudisium/college/index', $total_rows);
		// Using this data, get the relevant results
		$results = $this->ym->limit($pagination['limit'])->search_mhs($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('pagination',$pagination)
			->set('data', $results)
			->build('admin/tables/college');
	}
        
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
        
    public function _check_nim($nim, $id = null)
	{
	    $this->form_validation->set_message('_check_nim', sprintf(lang('yudisium_already_exist_error'), lang('yudisium_nim_label')));
	    return $this->ym->check_nim_exists('nim', $nim, $id);			
	}
    public function get_dpt_name($id)
        {
            return $this->ym->get_dpt_name($id);
        }
}