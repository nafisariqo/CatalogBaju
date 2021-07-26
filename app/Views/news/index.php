<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<header class="jumbotron">
        <div class="container">
        <div class="row">
        <div class="col">
          <h1 class="h1">What's New From Women Stylish?</h1>
          <form action="" method="post">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Search here" name="keyword">
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
                    <a href="/news/create" class="btn btn-primary mb-3">Add Data News</a>
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
      <th scope="col">Judul</th>
      <th scope="col">Informasi</th>
      <th scope="col">Manipulate</th>
    </tr>
  </thead>
  <tbody>
  <?php $i = 1 + (4 * ($currentPage - 1)); ?>
  <?php foreach ($news as $n) : ?>
    <tr>
      <th scope="row"><?= $i++; ?></th>
      <td><?= $n['judul']; ?></td>
      <td><?= $n['info']; ?></td>
      <td>
      <a href="/news/<?= $n['slug']; ?>" class="btn btn-success">Manipulate</a>
      </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?= $pager->links('news', 'news_pagination'); ?>

</form>

            </div>
        </div>
    </div>

    <?= $this->endSection(); ?>