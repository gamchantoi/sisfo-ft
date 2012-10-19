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
			    'field' => 'nilai_d',
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
            $this->load->helper('bebas');
            $this->lang->load('bebas');
	}
        
    public function index()
    {
        $base_where = array();
        if ($this->input->post('f_nim')) 	$base_where['nim']  = $this->input->post('f_nim');
	if ($this->input->post('f_nama')) 	$base_where['name'] = $this->input->post('f_nama');
	// Create pagination links
	$total_rows = $this->bt->count_by($base_where);
	$pagination = create_pagination('admin/bebas/index', $total_rows);

		// Using this data, get the relevant results
	$bebas = $this->bt->limit($pagination['limit'])->get_many_by($base_where);

		//do we need to unset the layout because the request is ajax?
        $this->input->is_ajax_request() ? $this->template->set_layout(FALSE) : '';
        
	$this->template
		->title($this->module_details['name'])
		->append_js('admin/filter.js')
                ->set('row',$total_rows)
		->set('pagination', $pagination)
		->set('bebas', $bebas);
               
        $this->input->is_ajax_request()
			? $this->template->build('admin/tables/bebas')
			: $this->template->build('admin/index');
       
        
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
                            'nilai_d'           => $this->input->post('nilai_d')
							));
							
		if ($id)
		{
		    $this->pyrocache->delete_all('bt_m');
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
            $id OR redirect('admin/bebas');
            $data = $this->bt->get_row_by(array('id' => $id));
            $arr     = array('nim' => $this->input->post('nim'));
            $college = $this->bt->get_mhs_row($arr);
            $this->form_validation->set_rules(array_merge($this->v_rules, array(
			    'title' => array(
				    'field' => 'nim',
				    'label' => 'lang:bebas_nim',
				    'rules' => 'trim|htmlspecialchars|required|max_length[100]|callback__check_nim['.$id.']'
			    ),
		    )));
	    if($this->form_validation->run()){
		$result = $this->bt->edit_bt($id,array(
			    'nim'	        => $this->input->post('nim'),
			    'sks'	        => $this->input->post('sks'),
			    'ipk'               => $this->input->post('ipk'),
			    'nilai_d'           => $this->input->post('nilai_d'),
                            'nama'              => $college->name,
                            'prodi'             => $this->get_dpt($college->x),
                            'jenjang'           => $this->jenjang($college->x),
                            'kode'              => $this->kode($college->x)
			));
            if ($result)
		    {
			$this->session->set_flashdata(array('success' => sprintf(lang('bt_edit_success'), $this->input->post('nim'))));
		    }
		    else
			{
			    $this->session->set_flashdata('error', $this->lang->line('bt_edit_error'));
			}
    
			    // Redirect back to the form or main page
			    $this->input->post('btnAction') == 'save_exit' ? redirect('admin/bebas') : redirect('admin/bebas/edit/' . $id);
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
                ->title($this->module_details['name'], sprintf(lang('yudisium_edit_title'), $data->nim))
                ->set('data',$data)
                ->build('admin/form');
        }
        
    public function delete($id=0)
        {
            $id OR redirect('admin/bebas');
            $result = $this->bt->del_bt($id);
            if($result)
            {
                 $this->pyrocache->delete('bt_m');
                $this->session->set_flashdata('success', $this->lang->line('bt_delete_success'));
            }else{
                $this->session->set_flashdata('error', $this->lang->line('bt_delete_error'));
            }
            redirect('admin/bebas');
        }
    
    public function _check_nim($nim, $id = null)
	{
	    $this->form_validation->set_message('_check_nim', sprintf(lang('bt_already_exist_error'), lang('bt_nim_label')));
	    return $this->bt->check_exists('nim', $nim, $id);			
	}
    
    public function ajax_filter()
        {
            $nama = $this->input->post('f_nama');
	    $nim   = $this->input->post('f_nim');
	    $post_data = array();

		if($nim){
                    $post_data['nim'] = $nim;
                }
		if ($nama)
		{
			$post_data['nama'] = $nama;
		}
		$total_rows = $this->bt->count_by($post_data);
		$pagination = create_pagination('admin/bebas/index', $total_rows);
		// Using this data, get the relevant results
		$results = $this->bt->limit($pagination['limit'])->search_by($post_data);

		//set the layout to false and load the view
		$this->template
			->set_layout(FALSE)
			->set('pagination',$pagination)
			->set('bebas', $results)
			->build('admin/tables/bebas');
        }
    
    public function prints($id=0)
        {
            $id OR redirect('admin/bebas');
            $data = $this->bt->get_row_by(array('id' => $id));
            $style= "
            <html><head><title>Cetak SK Bebas Teori</title>
                    <style>
                    /**
                    @media print {
                    @page {
                    size:a5;
                    }
                    }
                    .rotate{
                    size: A5 landscape;
                    -webkit-transform: rotate(-90deg) scale(.90,.90); 
                    -moz-transform:rotate(-90deg) scale(.95,.95);
                    /**zoom: 58%;**/
                    filter: progid:DXImageTransform.Microsoft.BasicImage(Rotation=3);
                    }
                    **/
                    .kotak1{
                        width : 559px
                    }
                    </style> </head>";
            $table  = "<body>";
            $table .= "<table>";
            $table .= "<tr><td width=\"580px\"></td>";
            $table .= "<td>";
            $table .= "<table style=\"font-size:14px;\">";
	    $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/Logo_uny.gif\" width=\"80px\"><td  align=\"center\"><b><font size=\"1.5\">KEMENTERIAN PENDIDIKAN DAN KEBUDAYAAN </font><br>UNIVERSITAS NEGERI YOGYAKARTA<br>FAKULTAS TEKNIK<br><small>Alamat : Kampus Karangmalang, Yogyakarta, 55281<br>Telp. (0274) 586168 psw. 276,289,292 (0274) 586734 Fax. (0274) 586734<br>website: http://ft.uny.ac.id <br>email:ft@uny.ac.id, teknik@uny.ac.id</small> ";
            $table .= "</b></td><td><img src=\"".base_url().$this->module_details['path']."/img/iso.png\" width=\"80px\" align=\"right\"></td></tr>";
            $table .= "<tr><td colspan=3><hr></td></tr><tr><td colspan=3><br></td></tr>";
            $table .= "<tr><td colspan=3 align=\"center\"><u><b>SURAT KETERANGAN BEBAS TEORI</b></u></tr></tr>";
            $table .= "<tr><td colspan=3 align=\"center\">Nomor : ".$data->no."/".$data->kode."/".date('Y')."</tr>";
            $table .= "</table>";
            $table .= "<table><tr><td colspan=2>Kepala Sub Bagian Pendidikan Fakultas Teknik Universitas Negeri Yogyakarta<br> menerangkan bahwa: </td></tr>";
            $table .= "<tr><td>Nama</td><td>: ".$data->nama."</td></tr>";
            $table .= "<tr><td>NIM</td><td>: ".$data->nim."</td></tr>";
            $table .= "<tr><td>Program Studi</td><td>: ".$this->bt->get_dpt_row(array('id' => $data->prodi))->name."</td></tr>";
            $table .= "<tr><td>Fakultas</td><td>: Teknik</td></tr>";
            $table .= "</table>";
            $table .= "<table>";
            $table .= "<tr><td colspan=2>Telah mencapai hasil studi sebagai berikut :</td></tr>";
            $table .= "<tr><td>Jumlah SKS</td><td>: ".$data->sks." sks</td></tr>";
            $table .= "<tr><td>Mata Kuliah Wajib Lulus</td><td>: sudah terpenuhi</td></tr>";
            $table .= "<tr><td>Jumlah nilai D</td><td>: ".$data->nilai_d." sks</td></tr></table>";
            $table .= "<table><tr><td colspan=2>Keterangan ini diberikan untuk keperluan : </td></tr>";
            if($data->jenjang == 'D3'):
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/unchecked.png\" width=\"32px\"> </td><td valign=\"middle\"> 1. Menempuh Ujian Tugas Akhir Bukan Skripsi</td></tr>";
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/unchecked.png\" width=\"32px\"> </td><td valign=\"middle\"> 2. Menempuh Ujian Tugas Akhir Skripsi</td></tr>";
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/checked.png\" width=\"32px\"> </td><td valign=\"middle\"> 3. Menempuh Ujian Tugas Akhir D3</td></tr>";
            else :
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/unchecked.png\" width=\"32px\"> </td><td valign=\"middle\"> 1. Menempuh Ujian Tugas Akhir Bukan Skripsi</td></tr>";
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/checked.png\" width=\"32px\"> </td><td valign=\"middle\"> 2. Menempuh Ujian Tugas Akhir Skripsi</td></tr>";
            $table .= "<tr><td><img src=\"".base_url().$this->module_details['path']."/img/unchecked.png\" width=\"32px\"> </td><td valign=\"middle\"> 3. Menempuh Ujian Tugas Akhir D3</td></tr>";
            endif;
            $table .= "</table>";
            $table .= "<table><tr><td align=\"left\">Telah menempuh ujian TABS/TAS/<br> TA D3, pada tanggal ....<br>Ketua program Studi,</td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=\"center\">Yogyakarta, ".tanggal($data->tanggal_surat)." <br> Kepala Sub Bagian Pendidikan<br> Fakultas Teknik UNY</td></tr>";
            $table .= "<tr><td colspan=2><br><br><br></td></tr>";
            $table .= "<tr><td>(__________________________)<br>NIP. </td><td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td><td align=\"center\">Dra. Sari Puspita<br /> Nip. 19630912 198812 2 001</td></tr>";
            $table .= "</table></td></tr></table>";
            $table .= "</body></html>";
            echo $style;
            echo $table;
            
        }
}