<?php
$loans = $data['loans'];
ob_start(); ?>
<div class="grid gap-6">
  <section class="card p-5">
    <div class="flex items-center justify-between">
      <h2 class="text-lg font-bold">Préstamos</h2>
      <a href="/" class="btn btn-ghost">Ir a libros</a>
    </div>
  </section>

  <section class="card p-5 overflow-x-auto">
    <table class="min-w-full text-sm">
      <thead>
        <tr class="text-left text-neutral-600">
          <th class="py-2 pr-4">Libro</th>
          <th class="py-2 pr-4">Usuario</th>
          <th class="py-2 pr-4">Inicio</th>
          <th class="py-2 pr-4">Fin</th>
          <th class="py-2 pr-4">Estado</th>
        </tr>
      </thead>
      <tbody class="divide-y divide-neutral-200">
        <?php foreach ($loans as $l): ?>
          <tr>
            <td class="py-2 pr-4 font-medium"><?= htmlspecialchars($l['title']) ?></td>
            <td class="py-2 pr-4"><?= htmlspecialchars($l['userName']) ?></td>
            <td class="py-2 pr-4"><?= htmlspecialchars($l['startAt']->format('Y-m-d H:i')) ?></td>
            <td class="py-2 pr-4"><?= $l['endAt'] ? htmlspecialchars($l['endAt']->format('Y-m-d H:i')) : '—' ?></td>
            <td class="py-2 pr-4">
              <span class="chip <?= $l['endAt'] ? 'border-neutral-400' : 'border-amber-600 text-amber-700' ?>">
                <?= $l['endAt'] ? 'Cerrado' : 'Abierto' ?>
              </span>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </section>
</div>
<?php
$content = ob_get_clean();
$title = "Préstamos";
include __DIR__ . '/layout.php';
