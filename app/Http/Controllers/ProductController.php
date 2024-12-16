<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    // Exibe a lista de produtos, com opção de busca
    public function index()
    {
        // Recebe o parâmetro de busca da requisição
        $search = request('search');

        // Se houver um termo de busca, filtra os produtos com base no título
        if ($search) {
            $products = Product::where([
                ['title', 'like','%'.$search.'%']  // Busca produtos que contêm o termo 'search' no título
            ])->get();

        } else {
            $products = Product::all();  // Caso contrário, exibe todos os produtos
        }

        // Retorna a view 'welcome', passando os produtos e o termo de busca
        return view('welcome', ['products' => $products, 'search'=> $search]);
    }

    // Exibe o formulário para criar um novo produto
    public function create()
    {
        return view('products.create');  // Retorna a view de criação de produto
    }

    // Armazena os dados de um novo produto
    public function store(Request $request)
    {
        // Cria uma instância de Product
        $product = new Product;

        // Atribui os dados do formulário aos atributos do produto
        $product->title = $request->title;
        $product->price = $request->price;
        $product->city = $request->city;
        $product->private = $request->private;
        $product->description = $request->description;
        $product->items = $request->items;

        // Verifica se há uma imagem no request e se é válida
        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            // Recebe a imagem enviada
            $requestImage = $request->image;

            // Obtém a extensão da imagem
            $extension = $requestImage->extension();

            // Gera um nome único para a imagem
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            // Move a imagem para a pasta pública
            $requestImage->move(public_path('img/products'), $imageName);

            // Atribui o nome da imagem ao produto
            $product->image = $imageName;
        }

        // Atribui o id do usuário autenticado ao produto
        $user = auth()->user();
        $product->user_id = $user->id;

        // Salva o produto no banco de dados
        $product->save();

        // Redireciona para a página inicial com uma mensagem de sucesso
        return redirect('/')->with('msg', 'Produto anunciado com sucesso!');
    }

    // Exibe os detalhes de um produto específico
    public function show($id)
    {
        // Recupera o produto pelo id fornecido
        $product = Product::findOrFail($id);
        
        // Obtém o proprietário do produto
        $productOwner = $product->user;

        // Verifica se o usuário autenticado já participou do produto
        $user = auth()->user();
        $hasUserJoined = false;

        if ($user) {
            // Verifica se o usuário já está associado ao produto
            $userProducts = $user->productsAsParticipant->toArray();
            foreach ($userProducts as $userProduct) {
                if ($userProduct['id'] == $id) {
                    $hasUserJoined = true;
                }
            }
        }

        // Obtém os dados do proprietário do produto
        $productOwner = User::where('id', $product->user_id)->first()->toArray();

        // Retorna a view com os detalhes do produto e o status de participação do usuário
        return view('products.show', ['product' => $product, 'productOwner' => $productOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    // Exibe o painel de controle do usuário, com os produtos que ele criou e participou
    public function dashboard()
    {
        // Obtém o usuário autenticado
        $user = auth()->user();
        
        // Obtém os produtos criados pelo usuário
        $products = $user->products;

        // Obtém os produtos nos quais o usuário participou
        $productsAsParticipant = $user->productsAsParticipant;

        // Retorna a view com os produtos do usuário
        return view('products.dashboard', ['products' => $products, 'productsAsParticipant' => $productsAsParticipant]);
    }

    // Exclui um produto do banco de dados
    public function destroy($id)
    {
        // Localiza o produto e o deleta
        Product::findOrFail($id)->delete();

        // Redireciona para o painel com uma mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Produto excluído com sucesso!');
    }

    // Exibe o formulário de edição de um produto
    public function edit($id)
    {
        // Obtém o usuário autenticado
        $user = auth()->user();
        
        // Localiza o produto pelo id
        $product = Product::findOrFail($id);

        // Verifica se o usuário autenticado é o proprietário do produto
        if ($user->id != $product->user_id) {
            return redirect('/dashboard');  // Redireciona se o usuário não for o proprietário
        }

        // Retorna a view com os dados do produto para edição
        return view('products.edit', ['product' => $product]);
    }

    // Atualiza os dados de um produto no banco de dados
    public function update(Request $request)
    {
        // Recebe todos os dados do formulário
        $data = $request->all();

        // Se houver uma imagem, faz o upload e atualiza o nome da imagem
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;
            $requestImage->move(public_path('img/products'), $imageName);
            $data['image'] = $imageName;
        }
       
        // Atualiza o produto no banco de dados
        Product::findOrFail($request->id)->update($data);

        // Redireciona para o painel com uma mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Editado com sucesso!');
    }

    // Adiciona um produto aos favoritos do usuário
    public function joinProduct($id)
    {
        // Obtém o usuário autenticado
        $user = auth()->user();

        // Associa o produto ao usuário
        $user->productsAsParticipant()->attach($id);
    
        // Localiza o produto pelo id
        $product = Product::findOrFail($id);

        // Redireciona para o painel com uma mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Item adicionado a favoritos: ' . $product->title);
    }

    // Remove um produto dos favoritos do usuário
    public function leaveProduct($id)
    {
        // Obtém o usuário autenticado
        $user = auth()->user();
        
        // Desassocia o produto do usuário
        $user->productsAsParticipant()->detach($id);
        
        // Localiza o produto pelo id
        $product = Product::findOrFail($id);

        // Redireciona para o painel com uma mensagem de sucesso
        return redirect('/dashboard')->with('msg', 'Item removido dos favoritos: ' . $product->title);
    }
}
