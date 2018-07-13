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
<div class="box-body no-padding">
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
                    <a class="btn btn-xs btn-danger" href="<?= $GLOBALS['path']; ?>barang/destroy/<?= $value['kode_barang'] ?>">Hapus</a>
                </td>
            </tr>
        <?php endforeach ?>
    <?php endif ?>
    </table>
</div>