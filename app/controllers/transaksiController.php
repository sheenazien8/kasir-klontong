<?php  
	class transaksiController extends Controller{
		public function index()
		{
			$barang = $this->model('Barang')->view();
			$detail = Session::get('transaksi');
			return $this->view('transaksi/index',['barang' => $barang, 'detail' => $detail]);
		}

		public function hitung()
		{
			$nama = ucwords($_GET['nama']);
			$barang = $this->model('Barang')->findfile($nama);
			$harga = $barang[0]['barang_modal'] + $barang[0]['barang_laba'];
			Session::set('harga',$harga);
			Session::set('laba',$barang[0]['barang_laba']);
			Session::set('nama', $barang[0]['barang_nama']);
			return $this->view('transaksi/harga', ['harga' => $harga]);
			
		}

		public function store()
		{
			$stok = $this->model('Barang')->findfile($_POST['kode_barang']);
			$id = $_POST['kode_barang'];
			if (isset($_POST['submit'])) {
				if (empty($stok)) {
					Session::flash('pesan','Pilih dulu pesanan');
					return Redirect::back();
				}
				if ($stok[0]['barang_stok'] <= 0) {
					Session::flash('pesan','Maaf Stok habis');
					return Redirect::back();
				}
				if ($_POST['jumlah_barang'] > $stok[0]['barang_stok']) {
						Session::flash('pesan','Maaf Pesanan yang diminta melebihi Stok '.$stok[0]['barang_nama']);
						return Redirect::back();
				}
				$transaksi = Session::get('transaksi') ? Session::get('transaksi') : false;
				$transaksi[$id] = [
					'kode_barang' => $_POST['kode_barang'],
					'barang_nama' => Session::get('nama'),
					'barang_harga' => Session::get('harga') * $_POST['jumlah_barang'],
					'barang_laba' => Session::get('laba') * $_POST['jumlah_barang'],
					'jumlah_barang' => $_POST['jumlah_barang'],
				];
				Session::set('transaksi', $transaksi) ;
			}
			return $this->index();
		}
		public function cetakpdf()
		{
			$detail = Session::get('transaksi');
			$kodepesanan = "KDP".rand(1000000,9999999);
			if (empty($detail)) {
				Session::flash('maaf', "Maaf belum ada data yang kamu pilih");
				return Redirect::back();
			}
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A6']);
			$html = "<style>
					td {
					    padding: 3px 5px 3px 5px;
					    border-right: 1px solid #666666;
					    border-bottom: 1px solid #666666;
					}
					 
					.head td {
					    font-weight: bold;
					    font-size: 12px;
					    background: #b7f0ff; 
					}
					 
					table .main tr td th{
					    font-size: 14px;
					}
					 
					table, table .main {
					    width: 100%;
					    border-top: 1px solid #666;
					    border-left: 1px solid #666;
					    border-collapse: collapse;
					    background: #fff;
					}
					 
					h1 {
					    font-size:20px;
					}
					</style>".
				"<div> 
				<p>Kode Pesanan: ".$kodepesanan."</p>
				<table class='main' repeat_header='1' cellspacing='0'>
					<tr class='head'>
						<td align='left' >Kode</td>
						<td>Nama</td>
						<td>Qty</td>
						<td align='right'>Harga</td>
					</tr>";
			$total = 0;
			foreach ($detail as $value) {
				$this->model('Transaksi')->create([
					'kode_barang' => $value['kode_barang'],
					'terjual_jumlah' => $value['jumlah_barang'],
					'terjual_tanggal' =>  date('y-m-d'),
				]);

				$this->model('UangMasuk')->create([
					'kode_barang' => $value['kode_barang'],
					'barang_modal' => $value['barang_harga'] - $value['barang_laba'],
					'barang_laba' => $value['barang_laba'],
					'stok' => $value['jumlah_barang'],
					'uang_tanggal_masuk' => date('y-m-d')
				]);
				$html .="<tr>
						<td>".$value['kode_barang']."</td>
						<td>".$value['barang_nama']."</td>
						<td>".$value['jumlah_barang']."</td>
						<td align='right'>Rp.".number_format($value['barang_harga'])."</td>
					</tr>";
				$total += $value['barang_harga'];
			}
			$html .= "<tr>
						<td colspan='3'><b>Total:</b></td>
						<td align='right'><b>Rp.".number_format($total)."</b></td>
					</tr>";
			$html .= "</table>
					</div>";
			$this->model('Transaksi')->pesanan([
			    'tanggal' => date('y-m-d'),
				'kode_pesanan' => $kodepesanan,
				'waktu_pesanan' => date('H:i:s'),
				'uang_masuk' => $total,
			]);
			Session::delete('transaksi');
			$mpdf->WriteHTML($html);
			$mpdf->Output('Struk-pembayaran.pdf','I');
			return $this->index();
		}
	}
?>