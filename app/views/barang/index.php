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
            <div class="fulid-container">
                <div class="col-md-12">
                    <?php if (isset($_SESSION['success'])): ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?= $_SESSION['success'] ?>
                        </div>
                        <?php unset($_SESSION['success']) ?>
                        <?php elseif (isset($_SESSION['warning'])): ?>
                            <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <?= $_SESSION['warning'] ?>
                        </div>
                        <?php unset($_SESSION['warning']) ?>
                    <?php endif ?>
                    <a href="<?= $GLOBALS['path']; ?>barang/create/" class="btn btn-primary">Tambah Barang Baru</a>
                    <a href="<?= $GLOBALS['path']; ?>stok/create/" class="btn btn-primary">Tambah Stok Barang </a>
                    <div class="row">
                        <br>
                    </div>
                    <div class="box">
                        <div class="box-header">
                            <h3 class="box-title">Daftar Barang</h3>
                            <div class="box-tools">
                                <div class="input-group input-group-sm pull-left" style="width: 150px;">
                                    <input id="search" type="text" name="table_search" class= form-control pull-right" placeholder="Search" >
                                    <div class="input-group-btn" >
                                </div>
                                </div>
                                <ul class="pagination pagination-sm no-margin pull-right" id="pagination">
                                <?php if ($data['page'] > 1): ?>
                                    <li><a href="<?= $GLOBALS['path']; ?>barang?page=<?= $data['page'] - 1 ?>">&laquo</a></li>
                                <?php endif ?>

                                <?php if ($data['page'] < $data['hlmn']): ?>
                                    <li><a href="<?= $GLOBALS['path']; ?>barang?page=<?= $data['page'] + 1 ?>">&raquo</a></li>
                                <?php endif ?>
                                </ul>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding" id="table">
                            <table class="table table-condensed">
                            <?php if (empty($data['barang'])): ?>
                              <h3 class="text-center">Tidak ada Barang</h3>
                            <?php else: ?>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Nama Barang</th>
                                <th>Stok Barang</th>
                                <th>Harga Barang</th>
                                <th style="width: 200px" class="text-center">Action</th>
                            </tr>
                            <?php $no = 1; ?>
                                <?php foreach ($data['barang'] as $value): ?>
                                    <tr class="<?php if ($value['barang_stok'] < 1): ?>
                                    bg-danger
                                    <?php endif ?>">
                                        <td style="width: 10px"><?= $no++; ?></td>
                                        <td><?= $value['barang_nama']; ?></td>
                                        <?php if ($value['barang_stok'] < 1): ?>
                                            <td class="text-info">Stok Habis</td>
                                        <?php else: ?>
                                            <td><?= $value['barang_stok']; ?></td>
                                        <?php endif ?>
                                        <td>Rp.<?= number_format($value['barang_modal'] + $value['barang_laba']); ?></td>
                                        <td class="text-center">
                                            <a class="btn btn-xs btn-warning" href="<?= $GLOBALS['path']; ?>barang/edit/<?= $value['kode_barang'] ?>" >Edit</a>
                                            <a class="btn btn-xs btn-danger" href="<?= $GLOBALS['path']; ?>barang/destroy/<?= $value['kode_barang'] ?>" >Hapus</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            <?php endif ?>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php include 'app/views/template/footer.php'; ?>
<script >
    var search = document.getElementById('search')
    var table = document.getElementById('table')
    var pagination = document.getElementById('pagination');
    search.addEventListener('keyup',function() 
    {
        var ajax = new XMLHttpRequest()

        ajax.onreadystatechange = function () 
        {
            if (ajax.readyState == 4 && ajax.status == 200) {
                table.innerHTML = ajax.responseText
                pagination.hide = ajax.responseText
            }           
        }

        ajax.open('GET','<?= $GLOBALS['path'] ?>barang/search?name='+search.value, true)
        ajax.send()
    });
    
</script>