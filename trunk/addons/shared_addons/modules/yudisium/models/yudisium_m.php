<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * @author 		Dwi Agus Purwanto
 * @package 	PyroCMS
 * @subpackage 	Yudicium model
 * @since		v0.1
 *
 */
class Yudisium_m extends MY_Model {
    protected $_table = 'yudisium';
    
    function get_prodies($nim){
    	return $get_major= $this->db->select('nim,name,x,department')->where('nim',$nim)->get('college')->row();
        //return $get_major->x;
    }
	
    function get_print($id)
    {
        $this->db->select('id,date')->where('id_parrent',$id);
        $this->db->where('code','4')->order_by('date','ASC');
        return $this->db->get('printed')->result();
    }
	
	function add_print($parrent,$code)
	{
		$this->db->set('id_parrent', $parrent);
		$this->db->set('code',$code);
		$this->db->set('date',date('Y-m-d H:i:s'));
		$this->db->insert('default_printed');
	}
    
	function get_yudisium()
	{
		return $this->db->select('DISTINCT(yudisium_date)')->get('yudisium')->result();
	}
    function get_religion($id)
    {
        $result = $this->db->select('id,name')->where('id',$id)->get('religions')->row();
        return $result->name;
    }
    
    function get_religions()
    {
        $result= array();
        $this->db->select('id,name');
        $this->db->from('default_religions');
        $this->db->order_by('id','ASC');
        $array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Agama-';
            $result[$row->id]= $row->name;
        }

        return $result;
    }
    
    function get_dept(){
        return $this->db->get('department')->result();
    }
	
	function get_dept_id($name){
        return $this->db->select('id,name')->where('name',$name)->get('department')->result();
    }
    
    function get_lecture(){
        return $this->db->select('id,name,major')->order_by('name','ASC')->get('lecture')->result();
    }
    
	function get_pa($key){
        return $this->db->select('id,name,major')->where('major',$key)->order_by('name','ASC')->get('lecture')->result();
    }
	
    function search_pa($key)
    {
        $get_major= $this->db->select('major')->where('id',$key)->get('department')->row();
        
        $result = array();
		$this->db->select('*');
		$this->db->from('default_lecture');
		$this->db->where('major',$get_major->major);
		$this->db->order_by('name','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Dosen-';
            $result[$row->id]= $row->name;
        }

        return $result;
    
    }
    
    function get_major($id)
    {
        $get_major= $this->db->select('id,major')->where('id',$id)->get('department')->row();
        return $get_major->major;
    }
	
	function get_major_by_name($name)
    {
        $get_major= $this->db->select('id,major')->where('name',$name)->get('department')->row();
        return $get_major->major;
    }
    
    function get_dosen($prodi_id){
        $prodi_id = $this->input->post('department');
        $get_major= $this->db->select('major')->where('id',$prodi_id)->get('department')->row();
		$result = array();
		$this->db->select('*');
		$this->db->from('default_lecture');
		$this->db->where('major',$get_major->major);
		$this->db->order_by('name','ASC');
		$array_keys_values = $this->db->get();
        foreach ($array_keys_values->result() as $row)
        {
            $result[0]= '-Pilih Dosen-';
            $result[$row->id]= $row->name;
        }

        return $result;

    }
    function get_lecture_by($key,$value=''){
        $this->db->select('id,nip,name,major');
        if (is_array($key))
		{
			$this->db->where($key);
		}
		else
		{
			$this->db->where($key, $value);
		}

		return $this->db->get('lecture')->row();
    }
    
    function get_by($key,$value='')
    {
        $this->db->select('id,nim,name,department');
        if (is_array($key))
		{
			$this->db->where($key);
		}
		else
		{
			$this->db->where($key, $value);
		}

		return $this->db->get($this->_table)->row();
    }
    
    function get_many_by($params = array())
	{
		$this->load->helper('date');
                
                // Is a status set?
		if (!empty($params['printed']))
		{
			// If it's all, then show whatever the status
			if ($params['printed'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('printed', $params['printed']);
			}
		}
		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('status', '1');
		}
                
                /**
		if(!empty($params['date'])){
                    $this->db->where('date_format("date","%Y-%m-%d")',$params['date']);
                }
                **/
                
                
                // Limit the results based on 1 number or 2 (2nd is offset)
		if (isset($params['limit']) && is_array($params['limit']))
			$this->db->limit($params['limit'][0], $params['limit'][1]);
		elseif (isset($params['limit']))
			$this->db->limit($params['limit']);

		return $this->get_all();
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
        
    public function search($data = array())
	{
		

		if (array_key_exists('printed', $data))
		{
			$this->db->where('printed', $data['printed']);
		}

                /**
		if(array_key_exists('date',$data))
                {
                        $this->db->where(' DATE_FORMAT("data", "%Y-%m-%d")', $data['date']);
                }
                **/
                
                if (array_key_exists('keywords', $data))
		{
			$matches = array();
			if (strstr($data['keywords'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['keywords'], $matches);
			}

			if (!empty($matches[0]))
			{
				foreach ($matches[0] as $match)
				{
					$phrases[] = str_replace('%', '', $match);
				}
			}
			else
			{
				$temp_phrases = explode(' ', $data['keywords']);
				foreach ($temp_phrases as $phrase)
				{
					$phrases[] = str_replace('%', '', $phrase);
				}
			}

			$counter = 0;
			foreach ($phrases as $phrase)
			{
				if ($counter == 0)
				{
					$this->db->like('yudisium.name', $phrase);
				}
				else
				{
					$this->db->or_like('yudisium.name', $phrase);
				}

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				//$this->db->or_like('profiles.display_name', $phrase);
				$counter++;
			}
		}
		return $this->get_all();
	}
}