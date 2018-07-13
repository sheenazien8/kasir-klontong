<?php  
	class UangMasuk{
		private $_db;
		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function index()
		{
			return $this->_db->sql('SELECT DISTINCT uang_tanggal_masuk FROM uang_masuk ORDER BY uang_tanggal_masuk DESC');
		}

		public function detail($id)
		{
			return $this->_db->sql("SELECT uang_masuk.*, barang.barang_nama FROM barang JOIN uang_masuk ON uang_masuk.kode_barang = barang.kode_barang WHERE uang_tanggal_masuk = '$id'");
		}

		public function create($array)
		{
			return $this->_db->insert('uang_masuk', $array);
		}
	}
?>