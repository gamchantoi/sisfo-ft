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