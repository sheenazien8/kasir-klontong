<?php include 'app/views/template/header.php'; ?>
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li>
        <a href="<?= $GLOBALS['path'] ?>barang/"a>
        	<b>DB</b>
			<span>Daftar Barang</span>
        </a>
      </li>
      <li class="active">
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
			<div class="col-md-8">
			<?php if (isset($_SESSION['pesan'])): ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?= $_SESSION['pesan'] ?>
			</div>
				<?php unset($_SESSION['pesan']) ?>
			<?php endif ?>
				<div class="box box-default">
					<div class="box-header with-border">
						<h3>Harga</h3>
					</div>
						<div class="box-body" id="barang_harga">
							<h1>Rp.<?= number_format(0) ?></h1>
						</div>
					<div class="box-footer no-padding">	
						<form action="<?= $GLOBALS['path']; ?>transaksi/store/" method="POST">
							<div class="form-group col-md-8">
								<label for="nama-barang">Nama Barang</label>
								<select id="barang_nama" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true" name="kode_barang">
			                        <option selected="selected">Nama</option>
			                        <?php foreach ($data['barang'] as $value): ?>
			                          <option value="<?= $value['kode_barang'];?>"><?= $value['barang_nama']; ?></option>
			                        <?php endforeach ?>
			                    </select>
							</div>
							<div class="form-group col-md-2">
								<label for="jumlah-barang">Jumlah</label>
								<input type="number" min="1" value="1" class="form-control" id="jumlah_barang" name="jumlah_barang">
							</div>
							<div class="col-md-2">
								<label for="jumlah-barang">Simpan</label>
								<input type="submit" class="form-control btn btn-primary" name="submit">
							</div>
						</form>
					</div>
					
				</div>
			</div>
			<div class="col-md-4">
			<?php if (isset($_SESSION['maaf'])): ?>
			<div class="alert alert-danger alert-dismissible">
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
				<?= $_SESSION['maaf'] ?>
			</div>
				<?php unset($_SESSION['maaf']) ?>
			<?php endif ?>
				<div class="box box-default">
					<div class="box-header with-border">
						<h3>Daftar Barang</h3>
					</div>
					<div class="box-body">
						<table class="table table-condensed">
							<thead>
								<tr>
									<th>Kode</th>
									<th>Nama</th>
									<th>Qty</th>
									<th>Harga</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!Session::exists('transaksi')): ?>
									<tr>
										<td colspan="4" class="text-center">Belum ada data</td>
									</tr>
								<?php else: ?>
									<tr>
									<?php $total = 0;  ?>
									<?php foreach ($data['detail'] as $value): ?>
										<td><?= $value['kode_barang'] ?></td>
										<td><?= $value['barang_nama'] ?></td>
										<td><?= $value['jumlah_barang'] ?></td>
										<td>Rp.<?= number_format($value['barang_harga']) ?></td>
									</tr>
									<?php $total += $value['barang_harga'];?>
									<?php endforeach ?>
							</tbody>
									<tr>
										<td colspan="3"><b>Total:</b></td>
										<td><b>Rp.<?= number_format($total) ?></b></td>
									</tr>
								<?php endif ?>
						</table>
					</div>
					<!-- /.box-body -->

					<div class="box-footer">
						<a target="_blank" href="<?= $GLOBALS['path']; ?>transaksi/cetakpdf/" class="btn btn-primary">Cetak Struk</a>
					</div>
					
				</div>
			</div>
		</div>
	</section>
</div>
  <script>
    var barangNama = document.getElementById('barang_nama');
    var barangHarga = document.getElementById('barang_harga');
    var jmlBrg = document.getElementById('jumlah_barang');
    barangNama.addEventListener('change', function () {
    	var ajax = new XMLHttpRequest();

    	ajax.onreadystatechange = function () {
    		if (ajax.readyState == 4 && ajax.status == 200) {
    			barangHarga.innerHTML = ajax.responseText;
    		}    		
    	}

    	ajax.open('GET', '<?= $GLOBALS['path']; ?>transaksi/hitung?nama='+barangNama.value, true)
    	ajax.send();
    });
  </script>
<?php include 'app/views/template/footer.php'; ?>
