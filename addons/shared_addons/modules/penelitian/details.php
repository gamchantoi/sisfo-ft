<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_Penelitian extends Module {
    
    public $version = 0.1;
    
    public function info()
	{
		return array(
			'name' => array(
			
				'en' => 'Penelitian'
				
			),
			'description' => array(
				
				'en' => 'Sistem Informasi Survei / Penelitian .Entri data Survei'
		
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu'	=> FALSE,
                        'sections' => array(
                            'list' => array(
                                    'name'  => 'yudicium_new_entri',
				    'uri'   => 'admin/yudicium',  
                            ),
                            'new'  => array(
                                    'name'  => 'yudicium_new_entri',
                                    'uri'   => 'admin/yudicium/create'
                            )
                            
                        ),                      
		);
	}

	public function install()
	{
		/**
		$this->dbforge->drop_table('yudicium');
		
		return $this->db->query("
			CREATE TABLE ".$this->db->dbprefix('yudisium')." (
			    `id` int(10) unsigned NOT NULL auto_increment,
			    `nim` varchar(12) collate utf8_unicode_ci NOT NULL default '',
			    `name` varchar(255) collate utf8_unicode_ci NOT NULL default '',
			    `department` varchar(125) collate utf8_unicode_ci NOT NULL,
			    `pa` varchar(125) collate utf8_unicode_ci NOT NULL,
			    `place_of_birth` varchar(35) collate utf8_unicode_ci NOT NULL default '',
			    `date_of_birth` date default NULL,
			    `religion` varchar(32) collate utf8_unicode_ci NOT NULL default '',
			    `sex` enum('L','P') collate utf8_unicode_ci default 'L',
			    `meriage` varchar(55) collate utf8_unicode_ci NOT NULL,
			    `address` varchar(255) collate utf8_unicode_ci NOT NULL,
			    `parrent_address` varchar(255) collate utf8_unicode_ci NOT NULL,
			    `parrental` varchar(55) collate utf8_unicode_ci NOT NULL,
			    `soo` varchar(50) collate utf8_unicode_ci NOT NULL,
			    `school_address` varchar(255) collate utf8_unicode_ci NOT NULL,
			    `graduation` varchar(125) collate utf8_unicode_ci NOT NULL,
			    `sks` int(11) NOT NULL,
			    `ipk` int(11) NOT NULL,
			    `thesis` varchar(55) collate utf8_unicode_ci NOT NULL,
			    `thesis_title` varchar(255) collate utf8_unicode_ci NOT NULL,
			    `lecture` varchar(255) collate utf8_unicode_ci NOT NULL,
			    `start` date NOT NULL,
			    `finish` date NOT NULL,
			    `yudicium_date` date NOT NULL,
			    `phone` varchar(55) collate utf8_unicode_ci NOT NULL,
			    `email` varchar(55) collate utf8_unicode_ci NOT NULL,
			    PRIMARY KEY  (`id`)
			) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='yudisium' AUTO_INCREMENT=1
		");
		**/
		return TRUE;
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		//return $this->dbforge->drop_table('yudicium');
		return TRUE;
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