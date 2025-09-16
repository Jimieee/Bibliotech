<?php
$books = $data['books'];
$q = $data['q'];
$author = $data['author'];
$category = $data['category'];
ob_start(); ?>
<div class="grid gap-6">
  <?php if (!empty($_GET['flash'])): ?>
    <div class="card p-4 border border-green-600">
      <p class="font-medium"><?= htmlspecialchars($_GET['flash']) ?></p>
    </div>
  <?php endif; ?>

  <section class="card p-5">
    <h2 class="text-lg font-bold mb-4">Buscar libros</h2>
    <form method="get" class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <div><label class="label">Título</label><input class="input" type="text" name="q" value="<?= htmlspecialchars($q ?? '') ?>" placeholder="Clean Code..." /></div>
      <div><label class="label">Autor</label><input class="input" type="text" name="author" value="<?= htmlspecialchars($author ?? '') ?>" placeholder="Martin..." /></div>
      <div><label class="label">Categoría</label><input class="input" type="text" name="category" value="<?= htmlspecialchars($category ?? '') ?>" placeholder="Software..." /></div>
      <div class="flex items-end gap-2">
        <button class="btn btn-primary w-full md:w-auto">Buscar</button>
        <a class="btn btn-ghost" href="/">Limpiar</a>
      </div>
    </form>
  </section>

  <section class="grid gap-3">
    <?php foreach ($books as $b): ?>
      <article class="card p-5 flex flex-col gap-4">
        <div class="flex items-start justify-between gap-3">
          <div>
            <h3 class="text-lg font-bold"><?= htmlspecialchars($b->getTitle()) ?></h3>
            <p class="text-sm text-neutral-500"><?= htmlspecialchars($b->getAuthor()) ?> • <?= htmlspecialchars($b->getCategory()) ?></p>
          </div>
          <span class="chip <?= $b->isAvailable() ? 'border-green-600 text-green-700' : 'border-amber-600 text-amber-700' ?>">
            <?= $b->isAvailable() ? 'Disponible' : 'Prestado' ?>
          </span>
        </div>

        <div class="flex flex-wrap gap-2">
          <?php if ($b->isAvailable()): ?>
            <form method="post" action="/loans/borrow" class="inline-flex">
              <input type="hidden" name="bookId" value="<?= $b->getId() ?>" />
              <input class="input w-40 mr-2" name="userName" placeholder="Tu nombre" required />
              <button class="btn btn-primary">Pedir préstamo</button>
            </form>
          <?php else: ?>
            <form method="post" action="/loans/return" class="inline-flex">
              <input type="hidden" name="bookId" value="<?= $b->getId() ?>" />
              <button class="btn btn-ghost">Devolver</button>
            </form>
          <?php endif; ?>

          <details class="ml-auto">
            <summary class="chip cursor-pointer">Editar</summary>
            <form method="post" action="/books/update" class="mt-3 grid grid-cols-1 md:grid-cols-5 gap-2">
              <input type="hidden" name="id" value="<?= $b->getId() ?>" />
              <input class="input" name="title" value="<?= htmlspecialchars($b->getTitle()) ?>" />
              <input class="input" name="author" value="<?= htmlspecialchars($b->getAuthor()) ?>" />
              <input class="input" name="category" value="<?= htmlspecialchars($b->getCategory()) ?>" />
              <label class="flex items-center gap-2">
                <input type="checkbox" name="available" <?= $b->isAvailable() ? 'checked' : '' ?> />
                <span class="text-sm">Disponible</span>
              </label>
              <div class="flex gap-2">
                <button class="btn btn-ghost">Guardar</button>
                <button form="del-<?= $b->getId() ?>" class="btn btn-danger" type="submit">Eliminar</button>
              </div>
            </form>
          </details>
          <form id="del-<?= $b->getId() ?>" method="post" action="/books/delete">
            <input type="hidden" name="id" value="<?= $b->getId() ?>" />
          </form>
        </div>
      </article>
    <?php endforeach; ?>
  </section>

  <section class="card p-5">
    <h3 class="font-bold mb-3">Agregar libro</h3>
    <form method="post" action="/books/store" class="grid grid-cols-1 md:grid-cols-4 gap-3">
      <input class="input" name="title" placeholder="Título" required />
      <input class="input" name="author" placeholder="Autor" required />
      <input class="input" name="category" placeholder="Categoría" required />
      <button class="btn btn-primary">Agregar</button>
    </form>
  </section>
</div>
<?php
$content = ob_get_clean();
$title = "Libros";
include __DIR__ . '/layout.php';
