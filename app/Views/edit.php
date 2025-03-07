<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Edit Produk</h6>
        </div>
        <div class="card-body">
            <form action="<?= base_url('produk/update/' . $produk['id']); ?>" method="post" enctype="multipart/form-data">
                <?= csrf_field(); ?>

                <div class="form-group">
                    <label for="produk">Produk</label>
                    <input type="text" name="produk" id="produk" class="form-control" 
                        value="<?= esc($produk['produk']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="number" name="harga" id="harga" class="form-control" 
                        value="<?= esc($produk['harga']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="id_kategori">Kategori</label>
                    <select name="id_kategori" id="id_kategori" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        <?php foreach ($kategori as $k): ?>
                            <option value="<?= $k['id']; ?>" 
                                    <?= $produk['id_kategori'] == $k['id'] ? 'selected' : ''; ?>>
                                <?= esc($k['nama_kategori']); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>
                    <input type="file" name="thumbnail" id="thumbnail" class="form-control">
                    <input type="hidden" name="existing_thumbnail" value="<?= esc($produk['thumbnail']); ?>">
                    <?php if ($produk['thumbnail']): ?>
                        <div class="mt-2">
                            <img src="<?= base_url('uploads/' . $produk['thumbnail']); ?>" alt="Thumbnail" width="100">
                        </div>
                    <?php endif; ?>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                <a href="<?= base_url('admin'); ?>" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>


<?= $this->endSection() ?>