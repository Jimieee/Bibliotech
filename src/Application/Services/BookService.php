<?php
namespace App\Application\Services;
use App\Domain\Entities\Book;
use App\Domain\Repositories\BookRepository;

class BookService {
    public function __construct(private BookRepository $repo) {}
    /** @return Book[] */ 
    public function list(?string $q, ?string $author, ?string $category): array {
        if ($q || $author || $category) return $this->repo->search($q,$author,$category);
        return $this->repo->all();
    }

    public function create(string $title, string $author, string $category): Book {
        return $this->repo->add(new Book(null, trim($title), trim($author), trim($category), true));
    }

    public function update(int $id, string $title, string $author, string $category, bool $available): void {
        $book = $this->repo->find($id); if (!$book) return;
        $book->setTitle($title); $book->setAuthor($author); $book->setCategory($category); $book->setAvailable($available);
        $this->repo->update($book);
    }
    
    public function delete(int $id): void { $this->repo->delete($id); }
    public function find(int $id): ?Book { return $this->repo->find($id); }
}
