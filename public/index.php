<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Core\Router;
use App\Core\SessionStore;
use App\Infrastructure\Persistence\Session\{SessionBookRepository, SessionLoanRepository};
use App\Application\Services\{BookService, LoanService};
use App\Presentation\Controllers\{BookController, LoanController};

SessionStore::start();

$bookRepo = new SessionBookRepository();
$loanRepo = new SessionLoanRepository();
$bookSvc = new BookService($bookRepo);
$loanSvc = new LoanService($bookRepo, $loanRepo);

$bookCtrl = new BookController($bookSvc);
$loanCtrl = new LoanController($loanSvc, $bookSvc);

$router = new Router();
$router->get('/', fn()=> $bookCtrl->index());
$router->get('/loans', fn()=> $loanCtrl->index());

$router->post('/books/store', fn()=> $bookCtrl->store());
$router->post('/books/update', fn()=> $bookCtrl->update());
$router->post('/books/delete', fn()=> $bookCtrl->destroy());

$router->post('/loans/borrow', fn()=> $loanCtrl->borrow());
$router->post('/loans/return', fn()=> $loanCtrl->giveBack());

$router->dispatch();
