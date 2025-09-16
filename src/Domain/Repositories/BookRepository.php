<?php
namespace App\Domain\Repositories;
use App\Domain\Entities\Book;
interface BookRepository {
    /** @return Book[] */ 
    public function all(): array;
    public function find(int $id): ?Book;
    
    /** @return Book[] */ 
    public function search(?string $q, ?string $author, ?string $category): array;
    public function add(Book $book): Book;
    public function update(Book $book): void;
    public function delete(int $id): void;
}
