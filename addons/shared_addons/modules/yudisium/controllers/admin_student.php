<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Mahasiswa
 * @category  	Module
 * @author	mrcoco@cempakaweb.com
 */

class Admin_Student extends Admin_Controller {
    
    public function __construct()
	{
	    parent::__construct();
            $this->lang->load('yudisium');
            $this->load->model('yudisium_m','ym');
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
}