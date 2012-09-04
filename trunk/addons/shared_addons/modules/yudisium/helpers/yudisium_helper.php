<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

function count_yudisium_all($tgl)
    {
        $parrams = array('date' => $tgl);
        $ci =& get_instance();            
        $ci->load->model('yudisium_m');
        $count = $ci->yudisium_m->count_yudis_by($parrams);
        //print_r($parrams);
        return $count;
    }
    
function count_yudisium_by($tgl,$thesis)
    {
        $parrams = array('date' => $tgl, 'thesis' => $thesis);
        $ci =& get_instance();            
        $ci->load->model('yudisium_m');
        $count = $ci->yudisium_m->count_yudis_by($parrams);
        return $count;
    }
    
function get_antidatir($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->antidatir($tgl,'0');
        return $result;
    }
function get_antidatir_a($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->antidatir($tgl,'1');
        return $result;
    }
function get_antidatir_b($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->antidatir($tgl,'2');
        return $result;
    }
function get_antidatir_c($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->antidatir($tgl,'3');
        return $result;
    }
function get_antidatir_d($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->antidatir($tgl,'4');
        return $result;
    }
function get_yudis_normal($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->yudis_normal($tgl);
        return $result;
    }
function antidatir_by_datein($month)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->anti_by_datein($month);
        return $result;
    }
function antidatir_periode($month)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->get_anti_periode($month);
        return $result;
    }
function yudis_date_n_datein($date)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->yudis_date_n_datein($date);
        return $result;
    }
function get_decree_num($date)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->decree_num($date);
        return $result;
    }
/**    
function export_xls($date,$thesis)
    {
	    if($thesis   == 'all')
	    {
		$parrams = array('date'=>$date);
	    }else{
		$parrams = array('date'=>$date , 'thesis' => $thesis);
	    }
            $ci          =& get_instance();
            $ci->load->model('yudisium_m');
	    $data	 = $ci->yudisium_m->get_many_by($parrams);
	    print_r($data);
    }
**/