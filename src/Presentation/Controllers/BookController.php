<?php
namespace App\Presentation\Controllers;
use App\Application\Services\BookService;

class BookController {
    public function __construct(private BookService $svc) {}

    public function index(): string {
        $q = $_GET['q'] ?? null; $author = $_GET['author'] ?? null; $category = $_GET['category'] ?? null;
        $books = $this->svc->list($q,$author,$category);
        ob_start(); $data = compact('books','q','author','category'); include __DIR__ . '/../Views/books.php'; return ob_get_clean();
    }

    public function store(): string { $this->svc->create($_POST['title'], $_POST['author'], $_POST['category']); header('Location: /'); exit; }   
    public function update(): string { $this->svc->update((int)$_POST['id'], $_POST['title'], $_POST['author'], $_POST['category'], isset($_POST['available'])); header('Location: /'); exit; }
    public function destroy(): string { $this->svc->delete((int)$_POST['id']); header('Location: /'); exit; }
}
