<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *
 * @package  	PyroCMS
 * @subpackage  Bebas teori
 * @category  	Module
 * @author	Dwi Agus p
 * @email	dwiagus@cempakaweb.com
 */
class Admin extends Admin_Controller{
    
    protected $section = 'yudisium';
    
    protected $v_rules = array(
		    array(
			    'field' => 'sks',
			    'label' => 'lang:bebas_sks',
			    'rules' => 'trim|numeric|required|max_length[3]'
			  ),
		    array(
			    'field' => 'nim',
			    'label' => 'lang:bebas_nim',
			    'rules' => 'trim|numeric|required|max_length[25]|callback__check_nim'
			  ),
		    array(
			    'field' => 'nilai',
			    'label' => 'lang:bebas_nilai',
			    'rules' => 'trim|required'
		    ),
		    array(
			    'field' => 'ipk',
			    'label' => 'lang:bebas_ipk',
			    'rules' => 'trim|required'
		    )
		);
    
    public function __construct()
	{
	    parent::__construct();
            $this->load->model('bebas_m','bt');
	}
        
    public function index()
    {
        $data    = array('nim' => '04507131041');
        $college = $this->bt->get_mhs_row($data);
        echo "<pre>";
        print_r($college);
        echo "</pre>";
        echo $this->jenjang($college->x);
        echo "<br>";
        
       
        echo $this->kode($college->department);
    }
    
    public function jenjang($dpt)
        {
            list($dpt_name,$dpt_code)= explode("-",$dpt);
            return $jenjang = trim($dpt_code);
        }
    public function number()
        {
            $number = $this->bt->get_number();
            return $number->no;
        }
    public function kode($dpt)
        {
            switch ($dpt){
                case    'TEKNIK ELEKTRO - D3'     :
                    $code = "EKO/TAD3/";
                    break;
                case    'TEKNIK ELEKTRONIKA - D3'     :
                    $code = "EKA/TAD3/";
                    break;
                case    'TEKNIK MESIN - D3'     :
                    $code = "MES/TAD3/";
                    break;
                case    'TEKNIK OTOMOTIF - D3'     :
                    $code = "OTO/TAD3/";
                    break;
                case    'TEKNIK SIPIL - D3'     :
                    $code = "SIP/TAD3/";
                    break;
                case    'TEKNIK BOGA - D3'     :
                    $code = "BOG/TAD3/";
                    break;
                case    'TEKNIK BUSANA - D3'     :
                    $code = "BUS/TAD3/";
                    break;
                case    'TATA RIAS & KECANTIKAN - D3'     :
                    $code = "RIK/TAD3/";
                    break;
                case    'PEND. TEKNIK ELEKTRO - S1'     :
                    $code = "EKO/TAS/";
                    break;
                case    'PEND. TEKNIK MEKATRONIKA - S1'    :
                    $code = "MEK/TAS/";
                    break;
                case    'PEND. TEKNIK ELEKTRONIKA - S1'    :
                    $code = "EKA/TAS/";
                    break;
                case    'PEND. TEKNIK INFORMATIKA - S1'    :
                    $code = "TIK/TAS/";
                    break;
                case    'PEND. TEKNIK MESIN - S1'    :
                    $code = "MES/TAS/";
                    break;
                case    'PEND. TEKNIK OTOMOTIF - S1'    :
                    $code = "OTO/TAS/";
                    break;
                case    'PEND. TEKNIK SIPIL & PERENCANAAN - S1'    :
                    $code = "SIP/TAS/";
                    break;
                case    'PEND. TEKNIK BOGA - S1'    :
                    $code = "BOG/TAS/";
                    break;
                case    'PEND. TEKNIK BUSANA - S1'    :
                    $code = "BUS/TAS/";
                    break;
                default         :
                    $code = "error";
                    break;
            }
            return $code;
        }
    public function get_dpt($x)
        {
            $arr= array('name' => $x);
            $result = $this->bt->get_dpt_row($arr);
            return $result->id;
        }
    
    public function create()
        {
            $this->form_validation->set_rules($this->v_rules);
            $arr     = array('nim' => $this->input->post('nim'));
            $college = $this->bt->get_mhs_row($arr);
            $number  = $this->number()+1;
	    if($this->form_validation->run())
	    {
		
		$id=$this->bt->add_bt(array(
                            'no'                => $number,
			    'nim'	        => $this->input->post('nim'),
                            'nama'              => $college->name,
                            'prodi'             => $this->get_dpt($college->x),
                            'jenjang'           => $this->jenjang($college->x),
                            'kode'              => $this->kode($college->x),
			    'jam_pesan'         => date('Y-m-d H:i:s'),
                            'tanggal_surat'     => date('Y-m-d'),
                            'jam_selesai'       => date('Y-m-d H:i:s'),
			    'sks'               => $this->input->post('sks'),
                            'ipk'               => $this->input->post('ipk'),
                            'nilai_d'           => $this->input->post('nilai')
							));
							
		if ($id)
		{
		    $this->pyrocache->delete_all('bt');
		    $this->session->set_flashdata(array('success' => sprintf(lang('bt_add_success'), $this->input->post('nim'))));
			    
		}
		else
		{
		    $this->session->set_flashdata('error', $this->lang->line('bt_add_error'));
		}
		
		$this->input->post('btnAction') == 'save_exit' ? redirect('admin/bebas') : redirect('admin/bebas/edit/' . $id);
	    }else{
		foreach ($this->v_rules as $key => $field)
			    {
				    $data->$field['field'] = set_value($field['field']);
			    }
	    }
	    $this->template
			    ->title($this->module_details['name'],'Tambah Data Baru')
			    ->set('data', $data)
			    ->build('admin/form');
        }
    
    public function edit($id=0)
        {
            
        }
        
    public function delete($id)
        {
            
        }
    
    public function _check_nim($nim, $id = null)
	{
	    $this->form_validation->set_message('_check_nim', sprintf(lang('bt_already_exist_error'), lang('bt_nim_label')));
	    return $this->bt->check_exists('nim', $nim, $id);			
	}
	
}