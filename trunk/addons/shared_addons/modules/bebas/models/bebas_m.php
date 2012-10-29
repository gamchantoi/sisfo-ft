<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 	Dwi Agus Purwanto
 * @package 	PyroCMS
 * @subpackage 	Bebas Teori model
 * @since	v0.1
 *
 */

class Bebas_m extends MY_Model{
    protected $_table = 'bt';
    
    function add_bt($data)
        {
            return $this->db->insert('bt',$data);
        }
        
    function edit_bt($id,$data)
        {
            $this->db->where('id', $id);
            return $this->db->update('bt', $data); 
        }
        
    function del_bt($id)
        {
            $this->db->where('id', $id);
            return $this->db->delete('bt'); 
        }
        
    function get_mhs_row($parrams=array())
        {
            if(!empty($parrams['id']))
               {
                    $this->db->where('id',$parrams['id']);
               }
            if(!empty($parrams['nim']))
                {
                    $this->db->where('nim',$parrams['nim']);
                }
            if(!empty($parrams['name']))
                {
                    $this->db->where('name',$parrams['name']);   
                }
            if(!empty($parrams['x']))
                {
                    $this->db->where('x',$parrams['x']);
                }
            if(!empty($parrams['department']))
                {
                    $this->db->where('department',$parrams['department']);
                }
            return $this->db->get('college')->row();
        }
    
    function get_number()
        {
            return $this->db->select('no')->order_by('no','DESC')->get('bt')->row();
        }
    function get_dpt_row($params=array())
        {
            if(!empty($params['id']))
            {
                $this->db->where('id',$params['id']);
            }
            if(!empty($params['name']))
            {
                $this->db->where('name',$params['name']);
            }
            if(!empty($params['major']))
            {
                $this->db->where('major',$params['major']);
            }
            return $this->db->get('department')->row();
        }
    
    function get_all()
        {
            return $this->db->get('bt')->result();
        }
    
    function count_by($params=array())
        {
            if(!empty($params['nim']))
            {
                $this->db->where('nim',$params['nim']);
            }
            if(!empty($params['nama']))
            {
                $this->db->where('nama',$params['nama']);
            }
            if(!empty($params['prodi']))
            {
                $this->db->where('prodi',$params['prodi']);
            }
            return $this->db->count_all_results('bt');
        }
    function get_many_by($parrams=array())
        {
            if(!empty($parrams['id']))
            {
                $this->db->where('id',$parrams['id']);
            }
            if(!empty($parrams['nim']))
            {
                $this->db->where('nim',$parrams['nim']);
            }
            if(!empty($parrams['nama']))
            {
                $this->db->where('nama',$parrams['nama']);
            }
            if(!empty($parrams['prodi']))
            {
                $this->db->where('prodi',$parrams['prodi']);
            }
            if (isset($parrams['limit']) && is_array($parrams['limit']))
			$this->db->limit($parrams['limit'][0], $parrams['limit'][1]);
		elseif (isset($parrams['limit']))
			$this->db->limit($parrams['limit']);
	    return $this->get_all();
        }
    
    function get_row_by($params=array())
        {
            if(!empty($params['id']))
            {
                $this->db->where('id',$params['id']);
            }
            if(!empty($params['nim']))
            {
                $this->db->where('nim',$params['nim']);
            }
            if(!empty($params['name']))
            {
                $this->db->where('name',$params['name']);
            }
            if(!empty($params['prodi']))
            {
                $this->db->where('prodi',$params['prodi']);
            }
            return $this->db->get('bt')->row();
        }
    
    function check_exists($field, $value = '', $id = 0)
	{
		if (is_array($field))
		{
			$params = $field;
			$id = $value;
		}
		else
		{
			$params[$field] = $value;
		}
		$params['id !='] = (int) $id;

		return parent::count_by($params) == 0;
	}
    
    function search_by($data=array())
        {
             if (array_key_exists('nim', $data))
		{
			$this->db->where('nim', $data['nim']);
		}
	    if (array_key_exists('nama', $data))
		{
			$this->db->like('nama', $data['nama']);
		}
	    return $this->get_all();
        }

    function add_print($id,$code)
        {
            $this->db->set('id_parrent',$id)
                        ->set('code',$code)
                        ->set('date',date('Y-m-d H:m:s'));
            return $this->db->insert('printed');
        }

    function get_printed($id,$code)
        {
            $this->db->select('date')
                    ->where('id_parrent',$id)
                    ->where('code','7');
            return $this->db->get('printed')->result();
        }
}