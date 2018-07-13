<?php  
	class Stok{
		private $_db;

		public function __construct()
		{
			$this->_db = Database::getInstance();
		}
		public function assoc($id)
		{
			return $this->_db->assoc("barang WHERE kode_barang = '$id'");
		}
		public function create($array)
		{
			return $this->_db->insert('barang_masuk',$array);
		}
	}
?>