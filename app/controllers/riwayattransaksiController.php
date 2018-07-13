<?php  
	class riwayattransaksiController extends Controller{
		public function index()
		{
			$tanggal = $this->model('RiwayatTransaksi')->index();
			return $this->view('pesanan/index', ['tanggal' => $tanggal]);
		}

		public function detail($id)
		{
			$detail = $this->model('RiwayatTransaksi')->detail($id);
			return $this->view('pesanan/detail', ['detail' => $detail]);
		}

		public function cetaklaporan($id)
		{
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$detail = $this->model('RiwayatTransaksi')->detail($id);
			$uangmasuk = 0;
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
				<p>Laporan Riwayat Transaksi: ".$detail[0]['tanggal']."</p>
				<table class='main' cellspacing='0'>
					<tr class='head'>
						<td style='height: 40'>Kode</td>
						<td align='right'>Jam</td>
						<td align='right'>Uang Masuk</td>
					</tr>";
			foreach ($detail as $value) {
				$html .="
					<tr>
						<td>".$value['kode_pesanan']."</td>
						<td align='right'>".$value['waktu_pesanan']."</td>
						<td align='right'>Rp.".number_format($value['uang_masuk'])."</td>
					</tr>";
				$uangmasuk += $value['uang_masuk'];
			}
			$html .= "<tr>
						<td colspan='2'><b>Total:</b></td>
						<td align='right'><b>Rp.".number_format($uangmasuk)."</b></td>
					</tr>";
			
			$html .= "</table>
					</div>";
			$mpdf->WriteHTML($html);
			$mpdf->Output('Laporan-riwayat-transaksi.pdf','I');
		}
	}

?>