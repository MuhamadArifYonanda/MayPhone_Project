<?= $this->extend('layout/template') ?>

<?= $this->section('content') ?>

<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#addModal">Tambah Produk</button>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Thumbnail</th>
                            <th>Produk</th>
                            <th>Harga</th>
                            <th>Kategori</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; ?>
                        <?php foreach ($produk as $p): ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td>
                                    <?php if ($p['thumbnail']): ?>
                                        <img src="<?= base_url('uploads/' . $p['thumbnail']); ?>" alt="Foto Produk" width="100">
                                    <?php else: ?>
                                        Tidak ada gambar
                                    <?php endif; ?>
                                </td>
                                <td><?= $p['produk']; ?></td>
                                <td><?= 'Rp ' . number_format($p['harga'], 0, ',', '.'); ?></td>
                                <td><?= $p['nama_kategori']; ?></td>
                                <td>
                                    <!-- Tombol Edit dan Hapus -->
                                    <a class="btn btn-warning btn-sm btn-icon-split" href="<?= base_url('edit' . $p['id']); ?>">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-edit"></i>
                                        </span>
                                        <span class="text">Edit</span>
                                    </a>
                                    <form action="/produk/delete/<?= $p['id']; ?>" method="post" style="display:inline;">
                                        <button type="button" class="btn btn-danger btn-sm btn-icon-split" onclick="confirmDelete('<?= base_url('produk/delete/' . $p['id']); ?>')">
                                            <span class="icon text-white-50">
                                                <i class="fas fa-trash"></i>
                                            </span>
                                            <span class="text">Hapus</span>
                                        </button>

                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<!-- Modal Add Produk -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('produk/create'); ?>" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" required>
                    </div>
                    <div class="form-group">
                        <label for="produk">Produk</label>
                        <input type="text" class="form-control" id="produk" name="produk" required>
                    </div>
                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control" id="harga" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label for="kategori">Kategori</label>
                        <select class="form-control" id="id_kategori" name="id_kategori" required>
                            <option value="">Pilih Kategori</option>
                            <?php foreach ($kategori as $k): ?>
                                <option value="<?= $k['id']; ?>"><?= $k['nama_kategori']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function validateForm() {
        const thumbnail = document.getElementById('thumbnail').value;
        const produk = document.getElementById('produk').value.trim();
        const harga = document.getElementById('harga').value;
        const kategori = document.getElementById('id_kategori').value;

        if (!thumbnail || !produk || !harga || !kategori) {
            alert('Semua kolom harus diisi!');
            return false;
        }

        return true;
    }
</script>

<script>
    $(document).ready(function() {
        $('#dataTable').DataTable({
            "paging": true,
            "searching": true,
            "info": true,
            "lengthChange": true
        });
    });
</script>

<?= $this->endSection() ?>