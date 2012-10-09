<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Module_Yudisium extends Module {
    
    public $version = 0.1;
    
    public function info()
	{
		return array(
			'name' => array(
			
				'en' => 'Yudisium'
				
			),
			'description' => array(
				
				'en' => 'Sistem Informasi Yudisium.Entri data Isian Keluluasan'
		
			),
			'frontend' => TRUE,
			'backend' => TRUE,
			'menu'	=> FALSE,
                        'sections' => array(
                            'yudisium' => array(
                                    'name'  => 'yudisium_list',
				    'uri'   => 'admin/yudisium',  
                            ),               
                            'new'  => array(
                                    'name'  => 'yudisium_add',
                                    'uri'   => 'admin/yudisium/create'
                            ),
                            'decree'  => array(
                                    'name'  => 'yudisium_decree',
                                    'uri'   => 'admin/yudisium/decree'
                            ),
                            'report'  => array(
                                    'name'  => 'yudisium_report',
                                    'uri'   => 'admin/yudisium/report'
                            ),
			    'graduate' => array(
				    'name'  => 'yudisium_graduate',
				    'uri'   => 'admin/yudisium/data_graduates'
			    ),
			    'college' => array(
				    'name'  => 'yudisium_college',
				    'uri'   => 'admin/yudisium/college'
			    )
                        ),                      
		);
	}

	public function install()
	{
		$this->dbforge->drop_table('yudisium');
		
		return $this->db->query("
			CREATE TABLE ".$this->db->dbprefix('yudisium')." (
				  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
				  `date` datetime NOT NULL,
				  `nim` varchar(12) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
				  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
				  `department` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
				  `pa` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
				  `place_of_birth` varchar(35) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
				  `date_of_birth` date DEFAULT NULL,
				  `religion` varchar(32) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
				  `sex` enum('L','P') COLLATE utf8_unicode_ci DEFAULT 'L',
				  `meriage` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
				  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `parrent` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `parrent_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `parrental` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
				  `soo` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
				  `school_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `sma` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
				  `graduation` varchar(125) COLLATE utf8_unicode_ci NOT NULL,
				  `sks` int(11) NOT NULL,
				  `ipk` double(3,2) NOT NULL,
				  `thesis` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
				  `thesis_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `lecture` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
				  `start` date NOT NULL,
				  `finish` date NOT NULL,
				  `yudisium_date` date NOT NULL,
				  `phone` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
				  `status` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
				  `email` varchar(55) COLLATE utf8_unicode_ci NOT NULL,
				  `printed` enum('1','2') COLLATE utf8_unicode_ci NOT NULL DEFAULT '2',
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='yudisium' AUTO_INCREMENT=7
		");
	}

	public function uninstall()
	{
		//it's a core module, lets keep it around
		return $this->dbforge->drop_table('yudisium');
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