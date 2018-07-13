<?php 
	class uangkeluarController extends Controller
	{
		public function index()
		{
			$uangkeluar = $this->model('UangKeluar')->index();
			return $this->view('uangkeluar/index',['uangkeluar' => $uangkeluar]);
		}

		public function detail($id)
		{
			$detail = $this->model('UangKeluar')->detail($id);	
			return $this->view('uangkeluar/detail', ['uangkeluar' => $detail]);
		}
		public function cetaklaporan($id)
		{
			$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => 'A4']);
			$detail = $this->model('UangKeluar')->detail($id);
			$modal = 0;
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
				<p>Laporan Uang Keluar: ".$detail[0]['uang_tanggal_keluar']."</p>
				<table class='main' repeat_header='1' cellspacing='0'>
					<tr class='head'>
						<td style='height: 40'>Nama</td>
						<td>Stok </td>
						<td align='right'>Modal</td>
					</tr>";
			foreach ($detail as $value) {
				$html .="
					<tr>
						<td>".$value['barang_nama']."</td>
						<td>".$value['stok']."</td>
						<td align='right'>Rp.".number_format($value['barang_modal'])."</td>
					</tr>";
				$modal += $value['barang_modal'];
			}
			$html .= "<tr>
						<td colspan='2'><b>Total:</b></td>
						<td align='right'><b>Rp.".number_format($modal)."</b></td>
					</tr>";
			$html .= "</table>
					</div>";
			$mpdf->WriteHTML($html);
			$mpdf->Output('Laporan-uang-masuk.pdf','I');

		}
		
	}
 ?>