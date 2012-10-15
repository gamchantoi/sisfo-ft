<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 	Dwi Agus Purwanto
 * @package 	PyroCMS
 * @subpackage 	Admin Decrees
 * @since		v0.1
 *
 */

class Admin_Decrees extends Admin_Controller
{
    protected $rules = array(
                array(
			    'field' => 'date',
			    'label' => 'lang:yudisium_date',
			    'rules' => 'trim|htmlspecialchars|required|max_length[100]'
			  ),
		    array(
			    'field' => 'number',
			    'label' => 'lang:yudisium_nim',
			    'rules' => 'trim|required|max_length[10]'
			  ),
		    array(
			    'field' => 'ant',
			    'label' => 'lang:yudisium_ant_code',
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
        $base_where = array('desc' => 'id');
        if ($this->input->post('f_date')) 	$base_where['date'] = $this->input->post('f_date');
	if ($this->input->post('f_number')) 	$base_where['number'] 	= $this->input->post('f_number');
	// Create pagination links
	$total_rows = $this->ym->count_decrees_by($base_where);
	$pagination = create_pagination('admin/yudisium/decrees/index', $total_rows);

		// Using this data, get the relevant results
	$decrees = $this->ym->limit($pagination['limit'])->get_decrees_by($base_where);

		//do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
        
	$this->template
		->title($this->module_details['name'])
		->append_js('admin/filter.js')
                ->set('row',$total_rows)
		->set('pagination', $pagination)
		->set('decrees', $decrees);
               
        $this->input->is_ajax_request()
			? $this->template->build('admin/tables/decrees')
			: $this->template->build('admin/decrees/index');
			
    }
    
    public function create()
    {
        $this->form_validation->set_rules($this->rules);
        if($this->form_validation->run())
        {
            $id=$this->ym->add_decrees(array(
			    'number'	        => $this->input->post('number'),	    
			    'date'	        => $this->input->post('date'),
                            'ant'               => $this->input->post('ant')
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
		
		$this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/decrees') : redirect('admin/yudisium/decrees/edit/' . $id);
        }else{
            foreach ($this->rules as $key => $field)
		    {
			$data->$field['field'] = set_value($field['field']);
		    }
        }
        $this->template
               ->append_metadata('<script type="text/javascript">
					  $(function() {	    
					  $( "#date" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  });</script>')
                ->set('data',$data)->build('admin/decrees/form_decrees');
    }
    
    public function delete($id=0)
    {
        $id OR redirect('admin/yudisium/decrees');
        $result = $this->ym->del_decrees($id);
        if($result)
            {
                $this->pyrocache->delete('ym');
                $this->session->set_flashdata('success', 'Berhasil menghapus data SK');
        }else{
                $this->session->set_flashdata('error', 'Gagal Menghapus data SK');
            }
        redirect('admin/yudisium/decrees');
    }
    
    public function edit($id=0)
    {
        $id OR redirect('admin/yudisium/decrees');
            $mhs_id= array('id' => $id);
            $data= $this->ym->get_decrees_rows($mhs_id);
            $this->form_validation->set_rules($this->rules);
	    if($this->form_validation->run()){
		$result = $this->ym->edit_decrees($id,array(
			    'number'	 => $this->input->post('number'),
			    'date'	 => $this->input->post('date'),
			    'ant'        => $this->input->post('ant')
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
			    $this->input->post('btnAction') == 'save_exit' ? redirect('admin/yudisium/decrees') : redirect('admin/yudisium/decrees/edit/' . $id);
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
                ->title($this->module_details['name'], sprintf(lang('yudisium_decree_edit'), $data->number))
                ->set('data',$data)
                ->build('admin/decrees/form_decrees');
    }
    
    public function ajax_filter()
	{
		$date      = $this->input->post('f_date');
		$number    = $this->input->post('f_number');
		$post_data = array();

		if($date){
                    $post_data['date'] = $date;
                }
		if ($number)
		{
			$post_data['number'] = $number;
		}
		$total_rows = $this->ym->count_decrees_by($post_data);
		$pagination = create_pagination('admin/yudisium/decrees/index', $total_rows);
		// Using this data, get the relevant results
		$results = $this->ym->limit($pagination['limit'])->search_decrees($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			//->set('pagination',$pagination)
			->set('decrees', $results)
			->build('admin/tables/decrees');
	}
}