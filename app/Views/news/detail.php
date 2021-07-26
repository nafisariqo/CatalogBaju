<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
<div class="row">
<div class="col">
<h2 class="mt-2">Manipulate News</h2>
<div class="card mb-3" style="max-width: 540px;">
  <div class="row g-0">
    <div class="col-md-8">
      <div class="card-body">
        <h5 class="card-title"><?= $news['judul']; ?></h5>
        <p class="card-text"><b>Informasi : <b> <?= $news['info']; ?></p>

        <a href="/news/edit/<?= $news['slug']; ?>" class="btn btn-warning">Edit</a>

        <form action="/news/<?= $news['id']; ?>" method="post" class="d-inline">
        <?= csrf_field(); ?>
        <input type="hidden" name="_method" value="DELETE">
        <button type="submit" class="btn btn-danger" onclick="return confirm('apakah anda yakin?');">Delete</button>
        </form>
        
        <br></br>
        <a href="/news">Back to News Page</a>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</div>

<?= $this->endSection(); ?>