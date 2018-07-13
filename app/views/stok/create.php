<?php include 'app/views/template/header.php'; ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li  class="active">
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
					<form role="form" action="<?= $GLOBALS['path']; ?>stok/store/" method="POST">
					<div class="box-body">
					<?php if (!empty($data['errors'])): ?>
						<div class="alert alert-danger alert-dismissible">
				            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
							Form tidak boleh ada yang kosong
				        </div>
					<?php endif ?>
						<div class="form-group">
							<label for="nama-barang">Nama Barang</label>
							<select class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="kode_barang">
	                        <option selected="selected">Nama</option>
	                        <?php foreach ($data['barang'] as $value): ?>
	                          <option value="<?= $value['kode_barang']; ?>"><?= $value['barang_nama']; ?></option>
	                        <?php endforeach ?>
	                      </select>
						</div>
						<div class="form-group">
							<label for="stok-barang">Stok Barang</label>
							<input type="number" min="0" class="form-control" id="stok-barang" placeholder="Stok Barang" name="masuk_jumlah">
						</div>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
					<input class="btn btn-primary" type="submit" name="submit" value="Simpan">
					<a href="../../barang/" class="btn btn-default">Batal</a>
					</div>
					</form>
				</div>
				<!-- /.box -->
			</div>
		</div>
	</section>
</div>
<?php include 'app/views/template/footer.php'; ?>