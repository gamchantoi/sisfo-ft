<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_Bebas extends Module {
    
    public $version = 0.1;
    
    public function info()
	{
		return array(
			'name' => array(
			
				'en' => 'Bebas Teori'
				
			),
			'description' => array(
				
				'en' => 'Sistem Informasi Bebas Teori'
		
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu'	=> FALSE,
                        'sections' => array(
                            'bebas' => array(
                                    'name'  => 'bt_list',
				    'uri'   => 'admin/bebas',  
                            ),               
                            'new'  => array(
                                    'name'  => 'bt_add',
                                    'uri'   => 'admin/bebas/create'
                            )
                        ),                      
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('bt');
		
		return $this->db->query("
			CREATE TABLE IF NOT EXISTS ".$this->db->dbprefix('bt')." (				  
                            `id` int(12) NOT NULL,
                            `no` int(12) NOT NULL,
                            `jam_pesan` datetime NOT NULL,
                            `tanggal_surat` date NOT NULL,
                            `jam_selesai` datetime NOT NULL,
                            `nim` varchar(25) NOT NULL,
                            `sks` tinyint(3) NOT NULL,
                            `nilai_d` tinyint(2) NOT NULL,
                            `ipk` varchar(4) NOT NULL,
                            `nama` varchar(255) NOT NULL,
                            `prodi` int(11) NOT NULL,
                            `jenjang` varchar(2) NOT NULL,
                            `kode` varchar(10) NOT NULL,
                            PRIMARY KEY (`id`),
                            KEY `nim` (`nim`),
                            KEY `prodi` (`prodi`)
                          ) ENGINE=InnoDB DEFAULT CHARSET=latin1
		");
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		return $this->dbforge->drop_table('bt');
	}

	public function upgrade($old_version)
	{
		// Your Upgrade Logic
		return TRUE;
	}

	public function help()
	{
		// Return a string containing help info
		// You could include a file and return it here.
		return "This module has no inline docs as it does not have a back-end.";
	}
}