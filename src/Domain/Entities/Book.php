<?php
namespace App\Domain\Entities;
class Book {
    public function __construct(
        private ?int $id,
        private string $title,
        private string $author,
        private string $category,
        private bool $available = true
    ) {}
    
    public function getId(): ?int { return $this->id; }
    public function setId(int $id): void { $this->id = $id; }
    public function getTitle(): string { return $this->title; }
    public function setTitle(string $v): void { $this->title = $v; }
    public function getAuthor(): string { return $this->author; }
    public function setAuthor(string $v): void { $this->author = $v; }
    public function getCategory(): string { return $this->category; }
    public function setCategory(string $v): void { $this->category = $v; }
    public function isAvailable(): bool { return $this->available; }
    public function setAvailable(bool $v): void { $this->available = $v; }
}
