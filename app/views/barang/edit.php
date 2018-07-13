<?php include 'app/views/template/header.php'; ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="active">
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
      <li>
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
		<div class="col-md-12">
		<!-- general form elements -->
			<div class="box box-primary">
				<div class="box-header with-border">
					<h3 class="box-title">Tambah Barang</h3>
				</div>
				<!-- /.box-header -->
				<!-- form start -->
				<form role="form" action="<?= $GLOBALS['path']; ?>barang/update/" method="POST">
				<div class="box-body">
					<?php foreach ($data['barang'] as $value): ?>
						<input type="hidden" name="kode_barang" id="" value=<?= $value['kode_barang'] ?>>
						<div class="form-group">
							<label for="nama-barang">Nama Barang</label>
							<input type="text" class="form-control" id="nama-barang" placeholder="Masukkan Nama Barang" name="barang_nama" value="<?= $value['barang_nama'] ?>">
						</div>
						<div class="form-group">
							<label for="barang-harga">Modal</label>
							<input type="number" class="form-control" id="barang-harga" placeholder="Harga Barang" name="barang_modal" value="<?= $value['barang_modal'] ?>">
						</div>
						<div class="form-group">
							<label for="barang-laba">Untung</label>
							<input type="number" class="form-control" id="barang-laba" placeholder="Untung Barang" name="barang_laba" value="<?= $value['barang_laba'] ?>">
						</div>
                  	<?php endforeach ?>
				</div>
				<!-- /.box-body -->

				<div class="box-footer">
				<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
				<a href="../" class="btn btn-default">Batal</a>
				</div>
				</form>
			</div>
			<!-- /.box -->
		</div>
	</div>
</section>
</div>
<?php include 'app/views/template/footer.php'; ?>
