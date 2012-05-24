<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Prakerin_m extends MY_model
{
     protected $_table = 'prakerin';
    function get_all()
	{
		$this->db->select('prakerin.*, kabupaten.nama AS district, prakerin.number AS number')
			->join('kabupaten', 'kabupaten.id = prakerin.district', 'left');
			//->join('prakerin_child', 'prakerin_child.id_prakerin = prakerin.number', 'left');

		$this->db->order_by('date', 'DESC');

		return $this->db->get('prakerin')->result();
	}
    function get_mhs_all()
        {
            $this->db->select('prakerin_child.*,lecture.name AS lecture,kabupaten.nama AS district, department.name AS department, prakerin.company,prakerin.address ')
                    ->join('lecture','lecture.id=prakerin_child.adviser','left')
                    ->join('prakerin','prakerin.number=prakerin_child.id_prakerin','left')
                    ->join('kabupaten','kabupaten.id=prakerin.district','left')
                    ->join('department','department.id = prakerin.department','left');
            return $this->db->get('prakerin_child')->result();
        }
    function get_data($id)
    {
		$this->db->select('prakerin.*, department.name AS department, kabupaten.nama AS district, prakerin.number AS number,prakerin_child.nim,prakerin_child.name')
			->join('kabupaten', 'kabupaten.id = prakerin.district', 'left')
                        ->join('department','department.id = prakerin.department','left')
			->join('prakerin_child', 'prakerin_child.id_prakerin = prakerin.number', 'left');

		$this->db->order_by('date', 'DESC');
                $this->db->where('number',$id);

		return $this->db->get('prakerin')->result();
	}
    
    function get_mhs($number){
        $this->db->select('prakerin_child.nim AS nim,prakerin_child.name AS name,id_prakerin,lecture.name AS adviser');
        $this->db->join('lecture','lecture.id=prakerin_child.adviser','left');
        //$this->db->join('department','prakerin_child.department=department.id','left');
        $this->where('id_prakerin',$number);
        $result = $this->db->get('prakerin_child')->result();
        return $result;
       
    }
    function get_company($number)
    {
        $this->db->select('company,address,number,start,finish, date, department.name AS dpt,kabupaten.nama AS district');
        $this->db->join('department','department.id = prakerin.department','left');
        $this->db->join('kabupaten', 'kabupaten.id = prakerin.district', 'left');
        $this->db->where('number',$number);
        $result = $this->db->get('prakerin')->result();
        foreach ($result as $row)
        {
            $res['company'] = $row->company;
            $res['address'] = $row->address;
            $res['number']  = $row->number;
            $res['district']= $row->district;
            $res['dpt']     = $row->dpt;
            $res['start']   = $row->start;
            $res['finish']  = $row->finish;
            $res['date']    = $row->date;
        }
        return $res;
    }
    
    function get_print($id,$code)
    {
        $this->db->select('id,date')->where('id_parrent',$id);
        $this->db->where('code',$code)->order_by('date','ASC');
        return $this->db->get('printed')->result();
    }
    
    function get_child($number)
    {
        $this->db->select('nim,name')->where('id_prakerin',$number);
        return $this->db->get('prakerin_child')->result();
        
    }
    function get_kab()
    {
        return $this->db->get('kabupaten')->result();
    }
    
    function get_dpt()
    {
        return $this->db->get('department')->result();
    }
    
    function get_lecture()
    {
        return $this->db->select('id,name,major')->order_by('major','ASC')->get('lecture')->result();
    }
    
    function get_number()
    {
        $result = $this->db->select('number')->order_by('id','DESC')->limit('1')->get('prakerin');
        foreach ($result->result() as $row)
            {
                $number= $row->number;
            }
        return $number;
    }
    
    function add_ch($ar)
    {
        return $this->db->insert('default_prakerin_child',$ar);
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
				$this->db->where('l_printed', $params['printed']);
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
    function get_mhs_by($params = array())
	{
                
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

		return $this->get_mhs_all();
	}
        
    public function search_mhs($data = array())
        {
            if(array_key_exists('printed',$data))
                {
                    if($data['printed'] != 'all')
                    {
                        $this->db->where('printed',$data['printed']);
                    }
                    
                }
            if(array_key_exists('nim',$data))
                {
                    $this->db->where('nim',$data['nim']);
                }
            if (array_key_exists('name', $data))
		{
			$matches = array();
			if (strstr($data['name'], '%'))
			{
				preg_match_all('/%.*?%/i', $data['name'], $matches);
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
				$temp_phrases = explode(' ', $data['name']);
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
					$this->db->like('prakerin_child.name', $phrase);
				}
				else
				{
					$this->db->or_like('prakerin_child.name', $phrase);
				}
				$counter++;
			}
		}
            return $this->get_mhs_all();
        }
    
    public function search($data = array())
	{
		

		if (array_key_exists('printed', $data))
		{
			$this->db->where('l_printed', $data['printed']);
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
					$this->db->like('prakerin.company', $phrase);
				}
				else
				{
					$this->db->or_like('prakerin.company', $phrase);
				}

				//$this->db->or_like('blog.body', $phrase);
				//$this->db->or_like('blog.intro', $phrase);
				//$this->db->or_like('profiles.display_name', $phrase);
				$counter++;
			}
		}
		return $this->get_all();
	}
        
        function count_by($params = array())
	{
	    
        if(!empty($param['t_printed']))
        {
          $this->db->where('t_printed',$param['t_printed']);
        }
		// Is a status set?
		if (!empty($params['printed']))
		{
			// If it's all, then show whatever the status
			if ($params['printed'] != 'all')
			{
				// Otherwise, show only the specific status
				$this->db->where('l_printed', $params['printed']);
			}
		}
		// Nothing mentioned, show live only (general frontend stuff)
		else
		{
			$this->db->where('status', '1');
		}

		return $this->db->count_all_results('prakerin');
	}

        function count_mhs_by($params = array())
	{
	    if(!empty($params['name']))
        {
            $this->db->like('name',$params['name']);
        }
        if(!empty($params['nim']))
        {
            $this->db->where('nim',$params['nim']);
        }
		
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

		return $this->db->count_all_results('prakerin_child');
	}
        
        function count_mhs($number){
            $this->db->where('id_prakerin',$number);
            return $this->db->count_all_results('prakerin_child');
        }

        function count_all_company()
        {
          $this->db->select('distinct(company)');
          $result = $this->db->get('prakerin');
          return $result->num_rows;
        }
}