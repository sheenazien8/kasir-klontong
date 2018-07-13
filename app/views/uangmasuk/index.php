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
      <li  class="active">
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
				<div class="box">
		            <div class="box-header">
		              <h3 class="box-title">Pemasukan Uang</h3>
		            </div>
		            <!-- /.box-header -->
		            <div class="box-body">
			            <div class="list-group">
			            <?php if (empty($data['uangmasuk'])): ?>
			            		<h3 class="text-center">Belum ada Pemasukan</h3>
			            	<?php else: ?>
			              	<?php foreach ($data['uangmasuk'] as $value): ?>
			           			<a href="<?= $GLOBALS['path'] ?>uangmasuk/detail/<?= $value['uang_tanggal_masuk'] ?>/" class="list-group-item"><h4>Pemasukan <?= $value['uang_tanggal_masuk'] ?></h4></a>
			              	<?php endforeach ?>
			              <?php endif ?>
			            </div>
		            </div>
		            <!-- /.box-body -->
		          	<div class="box-footer">
		          	
		          	</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php include 'app/views/template/footer.php'; ?>
