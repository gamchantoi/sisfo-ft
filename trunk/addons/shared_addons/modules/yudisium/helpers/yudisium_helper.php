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
        $result = $ci->yudisium_m->antidatir($tgl);
        return $result;
    }
function get_yudis_normal($tgl)
    {
        $ci =& get_instance();
        $ci->load->model('yudisium_m');
        $result = $ci->yudisium_m->yudis_normal($tgl);
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