<?php
namespace App\Core;

class SessionStore {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['_bibliotech'])) {
            $_SESSION['_bibliotech'] = [
                'books' => [],
                'loans' => [],
                'book_seq' => 1,
            ];
            // seed with some data
            self::seed();
        }
    }

    private static function seed(): void {
        $s =& $_SESSION['_bibliotech'];
        $add = function($title,$author,$category,$available=true) use (&$s) {
            $id = $s['book_seq']++;
            $s['books'][$id] = [
                'id'=>$id,'title'=>$title,'author'=>$author,'category'=>$category,'available'=>$available
            ];
        };
        $add("Clean Code","Robert C. Martin","Software",true);
        $add("El principito","Antoine de Saint-Exupéry","Ficción",true);
        $add("Introducción a Algoritmos","Cormen","Académico",true);
    }

    public static function &data(): array {
        self::start();
        return $_SESSION['_bibliotech'];
    }
}
