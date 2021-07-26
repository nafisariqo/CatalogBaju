<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
<div class="row">
<div class="col-8">
    <h2 class="my-3">Form Edit Data Catalog</h2>
    <form action="/catalog/update/<?= $catalog['id']; ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <input type="hidden" name="slug" value="<?= $catalog['slug']; ?>">
    <input type="hidden" name="gambarLama" value="<?= $catalog['gambar']; ?>">

  <div class="row mb-3">
    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $catalog['judul']; ?>">
      <div class="invalid-feedback">
        <?= $validation->getError('judul'); ?>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="deskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?>" id="deskripsi" name="deskripsi" value="<?= (old('deskripsi')) ? old('deskripsi') : $catalog['deskripsi']; ?>">
      <div class="invalid-feedback">
        <?= $validation->getError('deskripsi'); ?>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="gambar" class="col-sm-2 col-form-label">Gambar</label>
    <div class="col-sm-2">
    <img src="/img/<?= $catalog['gambar']; ?>" class="img-thumbnail img-preview">
    </div>
    <div class="col-sm-8">
     <div class="custom-file">
     <input type="file" class="custom-file-input <?= ($validation->hasError('gambar')) ? 'is-invalid' : ''; ?>" id="gambar" name="gambar" onchange="previewImg()">
     <div class="invalid-feedback">
        <?= $validation->getError('gambar'); ?>
      </div>
     <label class="custom-file-label" for="gambar"><?= $catalog['gambar']; ?></label>
     </div>
    </div>
  </div>
  <div class="form-group row"> 
  <div class="col-sm-10">
  <button type="submit" class="btn btn-primary">Edit Data</button>
  </div>
  </div>
</form>
</div>
</div>
</div>

<?= $this->endSection(); ?>