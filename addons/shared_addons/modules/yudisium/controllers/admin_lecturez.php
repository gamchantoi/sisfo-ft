<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 	Dwi Agus Purwanto
 * @package 	PyroCMS
 * @subpackage 	Admin lecture
 * @since		v0.1
 *
 */

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
			'rules' => 'trim|required|max_length[100]'
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
	$this->data->majors= $this->ym->get_majors();
    }
    
    public function index()
    {
        $base_where= array();
	if ($this->input->post('f_nip')) 	$base_where['nip']	= $this->input->post('f_nip');
	if ($this->input->post('f_name')) 	$base_where['name'] 	= $this->input->post('f_name');
	// Create pagination links
	$total_rows = $this->ym->count_lectures_by($base_where);
	$pagination = create_pagination('admin/yudisium/lecturez/index', $total_rows);
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
        $this->form_validation->set_rules($this->rules);
        if($this->form_validation->run())
        {
            $id=$this->ym->add_lectures(array(
			    'nip'	        => $this->input->post('nip'),	    
			    'name'	        => $this->input->post('name'),
                            'major'             => $this->input->post('major')
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
		
		$this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/lecturez') : redirect('admin/yudisium/lecturez/edit/' . $id);
        }else{
            foreach ($this->rules as $key => $field)
		    {
			$data->$field['field'] = set_value($field['field']);
		    }
        }
        $this->template
	    ->set('data',$data)
	    ->set('jurusan',$this->data->majors)
	    ->build('admin/lectures/form_lectures');
    }
    
    public function edit($id=0)
	{
	    $id OR redirect('admin/yudisium/lecturez');
	    $dos_id= array('id' => $id);
	    $data= $this->ym->get_lecture_by($dos_id);
            $this->form_validation->set_rules($this->rules);
	    if($this->form_validation->run()){
		$result = $this->ym->edit_lectures($id,array(
			    'nip'	 => $this->input->post('nip'),
			    'name'	 => $this->input->post('name'),
			    'major'      => $this->input->post('major')
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
			    $this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/lecturez') : redirect('admin/yudisium/lecturez/edit/' . $id);
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
                ->title($this->module_details['name'], sprintf(lang('yudisium_lectures_edit'), $data->name))
		->set('jurusan',$this->data->majors)
                ->set('data',$data)
                ->build('admin/lectures/form_lectures');
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
    
    public function ajax_filter()
	{
		$name = $this->input->post('f_name');
		$nip   = $this->input->post('f_nip');
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
		$results = $this->ym->limit($pagination['limit'])->search_lectures($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('pagination',$pagination)
			->set('lectures', $results)
			->build('admin/tables/lectures');
			
	}
}