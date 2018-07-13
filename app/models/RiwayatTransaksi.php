<?php  
class RiwayatTransaksi{
		private $_db;
		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function index()
		{
			return $this->_db->sql("SELECT DISTINCT tanggal FROM pesanan ORDER BY tanggal DESC");
		}

		public function detail($id)
		{
			return $this->_db->index("pesanan WHERE tanggal = '$id'");
		}
	}

?>