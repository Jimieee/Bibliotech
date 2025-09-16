<?php
namespace App\Infrastructure\Persistence\Session;
use App\Domain\Entities\Book;
use App\Domain\Repositories\BookRepository;
use App\Core\SessionStore;

class SessionBookRepository implements BookRepository {
    public function __construct(){ SessionStore::start(); }

    public function all(): array {
        $s =& SessionStore::data();
        return array_map([$this,'hydrate'], array_values($s['books']));
    }

    public function find(int $id): ?Book {
        $s =& SessionStore::data();
        return isset($s['books'][$id]) ? $this->hydrate($s['books'][$id]) : null;
    }

    public function search(?string $q, ?string $author, ?string $category): array {
        $s =& SessionStore::data();
        $items = array_values($s['books']);
        $filtered = array_filter($items, function($b) use ($q,$author,$category){
            $ok = true;
            if ($q) $ok = $ok && stripos($b['title'], $q) !== false;
            if ($author) $ok = $ok && stripos($b['author'], $author) !== false;
            if ($category) $ok = $ok && stripos($b['category'], $category) !== false;
            return $ok;
        });
        return array_map([$this,'hydrate'], $filtered);
    }

    public function add(Book $book): Book {
        $s =& SessionStore::data();
        $id = $s['book_seq']++;
        $book->setId($id);
        $s['books'][$id] = [
            'id'=>$id,
            'title'=>$book->getTitle(),
            'author'=>$book->getAuthor(),
            'category'=>$book->getCategory(),
            'available'=>$book->isAvailable()
        ];
        return $book;
    }

    public function update(Book $book): void {
        $s =& SessionStore::data();
        $id = $book->getId();
        if (!$id || !isset($s['books'][$id])) return;
        $s['books'][$id] = [
            'id'=>$id,
            'title'=>$book->getTitle(),
            'author'=>$book->getAuthor(),
            'category'=>$book->getCategory(),
            'available'=>$book->isAvailable()
        ];
    }

    public function delete(int $id): void {
        $s =& SessionStore::data();
        unset($s['books'][$id]);
    }

    private function hydrate(array $r): Book {
        return new Book((int)$r['id'], $r['title'], $r['author'], $r['category'], (bool)$r['available']);
    }
}
