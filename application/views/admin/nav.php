<?php

$menu=array(
	'Data Karyawan'=>array(		
		'icon'=>'fa fa-users',
		'slug'=>'karyawan',
		'child'=>array(
				'Semua Karyawan'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/karyawan",
					'target'=>"",
					),
				'Tambah Karyawan'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/karyawan/add",
					'target'=>"",
					),				
			),
	),	
	'Penilaian'=>array(		
		'icon'=>'fa fa-money',
		'slug'=>'penilaian',
		'child'=>array(
				'Semua Penilaian'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/penilaian/penilaian",
					'target'=>"",
					),
				'Kriteria Penilaian'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/penilaian/kriteria",
					'target'=>"",
					),
				'Peserta'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/penilaian/peserta",
					'target'=>"",
					),				
			),
	),
	// 'Wali Kelas'=>array(		
	// 	'icon'=>'fa fa-users',
	// 	'slug'=>'walikelas',
	// 	'child'=>array(
	// 			'Semua Wali Kelas'=>array(
	// 				'icon'=>'fa fa-circle-o',
	// 				'url'=>base_url(akses())."/walikelas",
	// 				'target'=>"",
	// 				),
	// 			'Tambah Wali Kelas'=>array(
	// 				'icon'=>'fa fa-circle-o',
	// 				'url'=>base_url(akses())."/walikelas/add",
	// 				'target'=>"",
	// 				),				
	// 		),
	// ),	
	'Master'=>array(		
		'icon'=>'fa fa-code',
		'slug'=>'master',
		'child'=>array(
				'Data Kriteria'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria",
					'target'=>"",
				),
				'Tambah Kriteria Utama'=>array(
					'icon'=>'fa fa-circle-o',
					'url'=>base_url(akses())."/master/kriteria/add",
					'target'=>"",
				),				
			),
	),
	// 'Users'=>array(		
	// 	'icon'=>'fa fa-users',
	// 	'slug'=>'user',
	// 	'child'=>array(
	// 			'All User'=>array(
	// 				'icon'=>'fa fa-circle-o',
	// 				'url'=>base_url(akses())."/users",
	// 				'target'=>"",
	// 				),
	// 			'Add User'=>array(
	// 				'icon'=>'fa fa-circle-o',
	// 				'url'=>base_url(akses())."/users/add",
	// 				'target'=>"",
	// 				),				
	// 		),
	// ),	
);
?>