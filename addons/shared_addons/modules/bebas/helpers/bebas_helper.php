<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

if(!function_exists("get_prodi"))
{
    function get_prodi($id)
    {
        $arr= array('id' => $id);
        $ci =& get_instance();            
        $ci->load->model('bebas_m','bt');
        $result = $ci->bt->get_dpt_row($arr);
        return $result->name;
    }
}

if(!function_exists("get_printed"))
{
  function get_printed($id)
  {
    $ci =& get_instance();
    $ci->load->model('bebas_m','bt');
    $result = $ci->bt->get_printed($id,'7');
    return $result;
  }
}

if(! function_exists("tanggal"))
{
    function tanggal($tgl){
      $tanggal = substr($tgl,8,2);
      $bulan    = getBulan(substr($tgl,5,2));
      $tahun    = substr($tgl,0,4);
      return $tanggal." ".$bulan." ".$tahun;
    }
}

if(! function_exists("getBulan"))
{
    function getBulan($bln)
    {
        switch ($bln){
            case 1: 
              return "Januari";
              break;
            case 2:
              return "Februari";
              break;
            case 3:
              return "Maret";
              break;
            case 4:
              return "April";
              break;
            case 5:
              return "Mei";
              break;
            case 6:
              return "Juni";
              break;
            case 7:
              return "Juli";
              break;
            case 8:
              return "Agustus";
              break;
            case 9:
              return "September";
              break;
            case 10:
              return "Oktober";
              break;
            case 11:
              return "November";
              break;
            case 12:
              return "Desember";
              break;
        }
    }
}