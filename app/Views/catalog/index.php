<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<header class="jumbotron">
        <div class="container">
        <div class="row">
        <div class="col">
          <h1 class="h1">Catalog for Women</h1>
          <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search Keyword" name="keyword">
          <div class="input-group-append">
            <button class="btn btn-outline-secondary" type="submit" name="submit">Search</button>
          </div>
          </div>
          </form>
          </div>
        </div>
            <div class="row">
                <div class="col-md-12">
                    <?php if (session()->getFlashdata('pesan')) :?>
                      <div class="alert alert-success" role="alert">
                      <?= session()->getFlashdata('pesan'); ?>
                      </div>
                    <?php endif; ?>
                    <a href="/catalog/create" class="btn btn-primary mb-3">Add Data</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
            <form action="" class="form">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Gambar</th>
      <th scope="col">Judul</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1 + (3 * ($currentPage - 1)); ?>
  <?php foreach ($catalog as $c) : ?>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><img src="/img/<?= $c['gambar']; ?>" alt="" class="gambar"></td>
      <td><?= $c['judul']; ?></td>
      <td>
      <a href="/catalog/<?= $c['slug']; ?>" class="btn btn-success">Detail</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $pager->links('catalog', 'catalog_pagination'); ?>

</form>

            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>