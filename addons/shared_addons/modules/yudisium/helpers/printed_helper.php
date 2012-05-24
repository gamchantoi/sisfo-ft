<?php if ( ! defined("BASEPATH")) exit("No direct script access allowed");

if(! function_exists("printed"))
{
    function get_printed($nim)
    {
       $results = array();
    
       $otherdb = ci()->load->database();      
       $sql = "  SELECT id,nim,date
                   FROM default_printed
                  WHERE nim = '".$nim."'
               ORDER BY date DESC         
              ";                        
       $query = $otherdb->query($sql);
       
       foreach ($query->result() as $row)
       {
           $results[$row->id] = $row->date;
       }
       
       return $results;
    }
}

