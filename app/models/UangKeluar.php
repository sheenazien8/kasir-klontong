<?php  
	class UangKeluar{
		private $_db;
		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function index()
		{
			return $this->_db->sql('SELECT DISTINCT uang_tanggal_keluar FROM uang_keluar ORDER BY uang_tanggal_keluar DESC');
		}

		public function detail($id)
		{
			return $this->_db->sql("SELECT uang_keluar.*, barang.barang_nama FROM barang JOIN uang_keluar ON uang_keluar.kode_barang = barang.kode_barang WHERE uang_tanggal_keluar = '$id'" );
		}

		public function create($array)
		{
			return $this->_db->insert('uang_keluar', $array);
		}
	}
?>