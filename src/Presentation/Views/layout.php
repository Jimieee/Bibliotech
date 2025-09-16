<?php
?>
<!doctype html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title><?= htmlspecialchars($title ?? 'Bibliotech') ?></title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    .card {
      border-radius: 1rem;
      border: 1px solid rgb(229, 229, 229);
      background: #fff;
      box-shadow: 0 10px 15px -3px rgba(0, 0, 0, .1), 0 4px 6px -4px rgba(0, 0, 0, .1)
    }

    .chip {
      border-radius: 9999px;
      border: 1px solid rgb(212, 212, 212);
      padding: .25rem .75rem;
      font-size: .875rem;
      line-height: 1.25rem;
      background: #fff;
      display: inline-block
    }

    .btn {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      border-radius: .75rem;
      padding: .5rem 1rem;
      font-weight: 600;
      border: 1px solid rgb(212, 212, 212);
      background: #fff;
      gap: .5rem;
      cursor: pointer
    }

    .btn-primary {
      background: #111827;
      border-color: #111827;
      color: #fff
    }

    .btn-ghost {
      background: #fff;
      border-color: rgb(212, 212, 212)
    }

    .btn-danger {
      border-color: rgb(220, 38, 38);
      color: rgb(185, 28, 28)
    }

    .input {
      border-radius: .75rem;
      border: 1px solid rgb(212, 212, 212);
      padding: .5rem 1rem;
      width: 100%;
      background: #fff
    }

    .label {
      font-size: .875rem;
      font-weight: 700
    }

    details>summary {
      list-style: none;
      cursor: pointer
    }

    details>summary::-webkit-details-marker {
      display: none
    }
  </style>
</head>

<body class="bg-neutral-50 text-neutral-900">
  <div class="min-h-screen mx-auto max-w-7xl px-4 py-6 grid grid-cols-1 md:grid-cols-[240px_1fr] gap-6">
    <!-- Sidebar -->
    <aside class="card p-4 md:sticky md:top-6 h-fit">
      <div class="flex items-center gap-3 mb-4">
        <div>
          <h1 class="text-base font-extrabold">Bibliotech</h1>
        </div>
      </div>
      <nav class="flex flex-col gap-2">
        <a href="/" class="btn btn-ghost w-full justify-start">Libros</a>
        <a href="/loans" class="btn btn-ghost w-full justify-start">Préstamos</a>
      </nav>
    </aside>

    <!-- Content -->
    <main>
      <?= $content ?>
    </main>
  </div>
  <script src="/assets/js/ui.js"></script>
</body>

</html>