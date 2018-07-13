<?php include 'app/views/template/header.php'; ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= $GLOBALS['path'] ?>barang/" >
            <b>DB</b>
            <span>Daftar Barang</span>
        </a>
      </li>
      <li>
        <a href="<?= $GLOBALS['path'] ?>transaksi/">
            <b>TR</b>
            <span>Transaksi</span>
        </a>
      </li>
      <li>
        <a href="<?= $GLOBALS['path'] ?>uangmasuk/">
            <b>UM</b>
            <span>Uang Masuk</span>
        </a>
      </li>
      <li>
        <a href="<?= $GLOBALS['path'] ?>uangkeluar/">
            <b>UK</b>
            <span>Uang Keluar</span>
        </a>
      </li>
      <li  class="active">
        <a href="<?= $GLOBALS['path'] ?>riwayattransaksi/">
            <b>RT</b>
            <span>Riwayat Transaksi</span>
        </a>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
<div class="content-wrapper">
    <section class="content">
        <div class="row">
            <div class="fulid-container">
                <div class="col-md-12">
					<div class="box">
						<div class="box-header">
						<h3 class="box-title">Daftar Riwayat Transaksi <?= $data['detail'][0]['tanggal'] ?></h3>
						<a target="_blank" href="<?= $GLOBALS['path'] ?>riwayattransaksi/cetaklaporan/<?= $data['detail'][0]['tanggal'] ?>" class="pull-right btn btn-default ">Cetak Laporan <i class="fa fa-print"></i></a>
						</div>
						<div class="box-body">
			            	<table class="table table-condensed">
				                <tr>
				                  <th style="width: 10px">#</th>
				                  <th>Kode Transaksi</th>
				                  <th>Jam Transaksi</th>
				                  <th>Uang Masuk</th>
				                </tr>
				                <?php $total = 0 ?>
				                <?php $no =1  ?>
				            	<?php foreach ($data['detail'] as $value): ?>
				            	<tr>
				            		<td><?= $no++ ?></td>
				            		<td><?= $value['kode_pesanan'] ?></td>
				            		<td><?= $value['waktu_pesanan'] ?></td>
				            		<td>Rp.<?= number_format($value['uang_masuk']) ?></td>
				            	</tr>
				            	<?php $total += $value['uang_masuk'] ?>
				            	<?php endforeach ?>
				            	<tr>
				            		<td></td>
				            		<td><b>Total:</b></td>
				            		<td></td>
				            		<td><b>Rp.<?= number_format($total) ?></b></td>
				            	</tr>
				            </table>
				        </div>
					</div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'app/views/template/footer.php'; ?>
