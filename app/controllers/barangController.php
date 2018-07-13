<?php 
	class barangController extends Controller{

		public function index()
		{
			$jmldata = count($this->model('Barang')->view());
			$jmlhlmn = ceil($jmldata / 20);
			$page = ( isset($_GET['page'] ) ) ? $_GET['page'] : 1;
			$barang = $this->model('Barang')->index($page);
			return $this->view('barang/index',['barang' => $barang , 'page' => $page , 'hlmn' => $jmlhlmn]);
		}

		public function create()
		{
			return $this->view('barang/create');
		}

		public function store()
		{
			$rand = rand(100,999);
			if (isset($_POST['submit'])) {
				if (!$this->model('Barang')->check('barang_nama',ucwords($_POST['barang_nama']))) {
					Session::flash('gagal', "Maaf ".ucwords($_POST['barang_nama'])." sudah ada");
					return $this->view('barang/create');
				}
				$validation = new Validation();

				$validation = $validation->check([
					'barang_nama' => ['required' => true],
					'barang_stok' => ['required' => true],
					'barang_modal' => ['required' => true],
					'barang_laba' => ['required' => true],
				]);
				
				if ($validation->passed()) {
						$barang = $this->model('Barang')->create([
					    'kode_barang' => "BR".$rand,
						'barang_nama' => ucwords($_POST['barang_nama']),
						'barang_stok' => $_POST['barang_stok'],
						'barang_modal' => $_POST['barang_modal'],
						'barang_laba' => $_POST['barang_laba'],
						'barang_tanggal' => date('y-m-d'),
					]);
					$this->model('UangKeluar')->create([
						'kode_barang' => "BR".$rand,
						'barang_modal' => $_POST['barang_modal'] * $_POST['barang_stok'],
						'stok' => $_POST['barang_stok'],
						'uang_tanggal_keluar' => date('y-m-d')
					]);
					Session::flash("success","Berhasil Menambahkan ".ucwords($_POST['barang_nama']));
				}else {
					$errors = $validation->errors();
					return $this->view('barang/create',['errors' => $errors]);		
				}
			}
			return $this->index();
		}

		public function edit($id)
		{
			$barang = $this->model('Barang')->edit($id);
			return $this->create();
			return $this->view('barang/edit', ['barang' => $barang]);
		}

		public function update()
		{
			$id = $_POST['kode_barang'];
			if (isset($_POST['submit'])) {
				$this->model('Barang')->update([
					'kode_barang' => $id,
					'barang_nama' => ucwords($_POST['barang_nama']),
					'barang_modal' => $_POST['barang_modal'],
					'barang_laba' => $_POST['barang_laba'],
					'barang_tanggal' => date('y-m-d')
				],$id);
				Session::flash("success","Berhasil Mengupdate ". ucwords($_POST['barang_nama']));
				return $this->index();
			}
		}

		public function destroy($id)
		{
			$check = $this->model('Transaksi')->checkTransaksi('kode_barang',$id);
			if ($check) {
				$barang = $this->model('Barang')->delete($id);
				Session::flash("success","Berhasil Menghapus");
				return Redirect::back();
			}else {
				Session::flash("warning","Maaf Gagal Menghapus Karena Sudah Ada Riwayat Transaksi");
				return Redirect::back();
			}
		}

		public function search()
		{
			$barang = $this->model('Barang')->search($_GET['name']);
			return $this->view('barang/search',['barang' => $barang]);
		}
	}

 ?>