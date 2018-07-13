<?php 
	class Barang{
		private $_db;

		public function __construct()
		{
			$this->_db = Database::getInstance();
		}

		public function create($array)
		{	
			return $this->_db->insert('barang',$array);
		}
		public function index($page)
		{
			$jmldataperhalaman = 20;
			$jmldata = count($this->_db->index('barang'));
			$jmlhlmn = ceil($jmldata / $jmldataperhalaman);
			$awaldata = ($jmldataperhalaman * $page) - $jmldataperhalaman;
			return $this->_db->index("barang ORDER BY barang.barang_id ASC LIMIT $awaldata,$jmldataperhalaman");
		}

		public function findfile($nama)
		{
			return $this->_db->sql("SELECT * FROM barang WHERE kode_barang = '$nama'");
		}

		public function search($nama)
		{
			return $this->_db->sql("SELECT * FROM barang WHERE 
			                       barang_nama LIKE '%$nama%'");
		}
		public function edit($id)
		{
			return $this->_db->index("barang WHERE kode_barang =  '$id'");
		}
		public function update($array,$id)
		{
			return $this->_db->update('barang',$array,'kode_barang', $id);
		}

		public function delete($id)
		{
			return $this->_db->delete('barang','kode_barang', $id);
		}

		public function assoc()
		{
			return $this->_db->assoc("barang");
		}
		public function view()
		{
			return $this->_db->index("barang");
		}

		public function check($field,$nama)
		{
			$data = $this->_db->getInfo('barang',$field,$nama);
			if (empty($data)) {
				return true;
			}else {
				return false;
			}
		}
	}

 ?>