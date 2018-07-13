<?php 
	class Transaksi{
		private $_db;

		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function create($array)
		{	
			return $this->_db->insert('barang_terjual',$array);
		}

		public function checkTransaksi($field,$name)
		{
			$data = $this->_db->getInfo('barang_terjual',$field,$name);
			if (empty($data)) {
				return true;
			}else {
				return false;
			}
		}

		public function pesanan($array)
		{	
			return $this->_db->insert('pesanan',$array);
		}
		public function index()
		{
			return $this->_db->sql("SELECT barang_terjual .*, barang.barang_nama FROM barang JOIN barang_terjual ON barang_terjual.kode_barang = barang.kode_barang");
		}
	}
?>