<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?><?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
<div class="row">
<div class="col-8">
    <h2 class="my-3">Form Edit Data News</h2>
    <form action="/news/update/<?= $news['id']; ?>" method="post" enctype="multipart/form-data">
    <?= csrf_field(); ?>
    <input type="hidden" name="slug" value="<?= $news['slug']; ?>">

  <div class="row mb-3">
    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
    <div class="col-sm-10">
      <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" name="judul" autofocus value="<?= (old('judul')) ? old('judul') : $news['judul']; ?>">
      <div class="invalid-feedback">
        <?= $validation->getError('judul'); ?>
      </div>
    </div>
  </div>
  <div class="row mb-3">
    <label for="info" class="col-sm-2 col-form-label">Informasi</label>
    <div class="col-sm-10">
      <input type="text" class="form-control <?= ($validation->hasError('info')) ? 'is-invalid' : ''; ?>" id="info" name="info" value="<?= (old('info')) ? old('info') : $news['info']; ?>">
      <div class="invalid-feedback">
        <?= $validation->getError('info'); ?>
      </div>
    </div>
  </div>
  <div class="form-group row"> 
  <div class="col-sm-10">
  <button type="submit" class="btn btn-primary">Edit Data News</button>
  </div>
  </div>
</form>
</div>
</div>
</div>

<?= $this->endSection(); ?>