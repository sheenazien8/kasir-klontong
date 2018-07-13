<?php  
	class stokController extends Controller{
		public function create()
		{
			$barang = $this->model('Barang')->view();
			return $this->view('stok/create',['barang' => $barang]);
		}
		public function store()
		{
			if (isset($_POST['submit'])) {
				$validation = new Validation();

				$validation = $validation->check([
					'kode_barang' => ['required' => true],
					'masuk_jumlah' => ['required' => true],
				]);

				if ($validation->passed()) {
					$stok = $this->model('Stok')->create([
					'kode_barang' => $_POST['kode_barang'],
					'masuk_jumlah' => $_POST['masuk_jumlah'],
					'masuk_tanggal' => date('y-m-d')
					]);
					$barangmasuk = $this->model('Stok')->assoc($_POST['kode_barang']);
					$this->model('UangKeluar')->create([
						'kode_barang' => $_POST['kode_barang'],
						'barang_modal' => $_POST['masuk_jumlah'] * $barangmasuk['barang_modal'],
						'stok' => $_POST['masuk_jumlah'],
						'uang_tanggal_keluar' => date('y-m-d')
					]);
					$_SESSION['success'] = "Berhasil Menambah Stok $barangmasuk[barang_nama]";	
				}else {
					$errors = $validation->errors();
					$barang = $this->model('Barang')->view();
					return $this->view('stok/create', ['errors' => $errors, 'barang' => $barang]);
				}
			} 
			return Redirect::to('../../barang/');
		}
	}
?>