<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prakerin extends Public_Controller {
    
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
                'field' => 'adviser[]',
		'label' => 'Pembimbing',
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
		$this->load->model('prakerin_m','pkl');
		$this->data->prodies  = $this->prodies();
		$this->data->lectures = $this->lectures();
                $this->data->district = $this->district();
                $this->data->number   = $this->number();
	}
    
    public function index()
    {
        $this->template
            ->append_js('module::duplicate.js' )
            ->append_css('module::ui-lightness/jquery-ui-1.7.3.custom.css')
		    ->append_js('module::jquery-ui-min.js') 
		    ->append_metadata('<script type="text/javascript">
					  $(function() {					  
					  $( "#start" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});
					  $( "#finish" ).datepicker({dateFormat: "yy-mm-dd",changeMonth: true,changeYear: true});	
					  });</script>')
                    ->build('index',$this->data);
    }
    
    public function create()
    {
        $num        = $this->data->number+1;
        $fields     = array('name', 'nim','adviser');
        $numbers    = array('id_prakerin' => $num);
        $this->load->library('form_validation');
        $this->form_validation->set_rules($this->v_rules);
        if($this->form_validation->run())
        {
            foreach ($fields as $field)
                {
                    foreach ($_POST[$field] as $key => $value)
                    {
                        $data[$key][$field] = $value;
                    }
                }
                
                foreach ($data as $values)
                {
                    $push = $values+$numbers;                    
                    $this->pkl->add_ch($push);
                }
            $data = array(
                            'number'    =>  $num,
                            'date'      =>  date('Y-m-d H:m:s'),
                            'company'   =>  $this->input->post('company'),
                            'address'   =>  $this->input->post('address'),
                            'district'  =>  $this->input->post('district'),
                            'department'=>  $this->input->post('department'),
                            'start'     =>  $this->input->post('start'),
                            'finish'    =>  $this->input->post('finish')
                                    );
           $add= $this->pkl->insert($data);
           if($add){
            $this->pyrocache->delete_all('pkl');
		$this->session->set_flashdata(array('success' => sprintf('Simpan Data Sukses'.$num, $this->input->post('company'))));
           }else{
            $this->session->set_flashdata('error', 'Gagal');
           }
           redirect('prakerin');
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
    
    public function district()
    {
        $result= array(0 => 'Pilih Kota / Kabupaten');
	    if($district = $this->pkl->get_kab())
	    {
		foreach($district as $kab)
		{
		    $result[$kab->id] = $kab->nama;
		}
	    }
        return $result;
    }
    
    public function prodies()
    {
        $result= array(0 => 'Pilih Program Studi');
	    if($prodies = $this->pkl->get_dpt())
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
	    if($lectures = $this->pkl->get_lecture())
	    {
		foreach($lectures as $lec){
		    $result[$lec->id]= $lec->name;
		}
	    }
        return $result;
    }
    
    public function number()
    {
        return $result = $this->pkl->get_number();
    }
}