<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Define a rota para a página inicial ('/'). 
// Quando o usuário acessar essa URL, o método 'index' do ProductController será executado.
Route::get('/', [ProductController::class, 'index']);

// Define a rota para a página de criação de produtos ('/products/create'). 
// O método 'create' do ProductController será executado quando a rota for acessada.
// A rota usa o middleware 'auth', garantindo que apenas usuários autenticados possam acessar.
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth');

// Define a rota para exibir detalhes de um produto específico.
// O 'id' do produto é passado como parâmetro na URL, e o método 'show' do ProductController será executado.
Route::get('/products/{id}', [ProductController::class, 'show']);

// Define a rota para o envio do formulário de criação de produto. A solicitação será do tipo POST.
// O método 'store' do ProductController será executado quando o formulário for enviado.
Route::post('/products', [ProductController::class, 'store']);

// Define a rota para excluir um produto específico.
// A rota usa o método DELETE e a URL contém o 'id' do produto que será excluído.
// O middleware 'auth' é usado para garantir que apenas usuários autenticados possam excluir produtos.
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth');

// Define a rota para editar um produto específico. A URL contém o 'id' do produto.
// Quando acessada, o método 'edit' do ProductController será executado.
// O middleware 'auth' garante que apenas usuários autenticados possam editar um produto.
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->middleware('auth');

// Define a rota para atualizar um produto específico. O método 'put' é usado para enviar as alterações.
// A URL contém o 'id' do produto que será atualizado, e o método 'update' do ProductController será executado.
// O middleware 'auth' garante que apenas usuários autenticados possam realizar essa ação.
Route::put('products/update/{id}', [ProductController::class,'update'])->middleware('auth');

// Define a rota para o painel do usuário ('/dashboard'), onde ele pode gerenciar seus produtos.
// O método 'dashboard' do ProductController será executado quando a rota for acessada.
// O middleware 'auth' é utilizado para garantir que apenas usuários autenticados possam acessar o painel.
Route::get('/dashboard',[ProductController::class,'dashboard'])->middleware('auth');

// Define a rota para adicionar um produto aos favoritos do usuário.
// O método 'joinProduct' será executado quando a rota for acessada.
// O middleware 'auth' assegura que apenas usuários autenticados possam adicionar produtos aos favoritos.
Route::post('/products/join/{id}', [ProductController::class, 'joinProduct'])->middleware('auth');

// Define a rota para remover um produto dos favoritos do usuário.
// O método 'leaveProduct' será executado quando a rota for acessada.
// O middleware 'auth' assegura que apenas usuários autenticados possam remover produtos dos favoritos.
Route::delete('/products/leave/{id}', [ProductController::class, 'leaveProduct'])->middleware('auth');
