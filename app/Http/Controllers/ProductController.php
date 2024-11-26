<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;
class ProductController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $products = Product::where([
                ['title', 'like','%'.$search.'%']
            ])->get();

        } else {
            $products = Product::all();
        }
   
        return view('welcome', ['products' => $products, 'search'=> $search]);

    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {

        $product = new Product;

        $product->title = $request->title;
        $product->price = $request->price;
        $product->city = $request->city;
        $product->private = $request->private;
        $product->description = $request->description;
        $product->items = $request->items;

        //image upload

        if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/products'), $imageName);

            $product->image = $imageName;

        }

        $user = auth()->user();
        $product->user_id = $user->id;

        $product->save();

        return redirect('/')->with('msg', 'Produto anunciado com sucesso!');
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
       
        $productOwner = $product->user;

        $user = auth()->user();
        $hasUserJoined= false;

        if($user){

            $userProducts = $user -> productsAsParticipant -> toArray();

            foreach ($userProducts as $userProduct) {
                if($userProduct['id'] == $id) {
                    $hasUserJoined=true;
                }
            }

        }

        $productOwner = User::where('id', $product->user_id)->first()->toArray();

        return view('products.show', ['product' => $product, 'productOwner' => $productOwner, 'hasUserJoined' => $hasUserJoined]);
    }

    public function dashboard(){
        
        $user = auth()->user();
        
        $products = $user->products;

        $productsAsParticipant = $user ->productsAsParticipant;

        return view('products.dashboard',['products'=>$products, 'productsAsParticipant' => $productsAsParticipant]);
    }

    public function destroy($id){
        Product::findOrFail($id)->delete();

        return redirect('/dashboard')->with('msg', 'Produto excluído com sucesso!');
    }

    public function edit($id){

        $user = auth() -> user();
        
        $product = Product::findOrFail($id);

        if ($user -> id != $product -> user_id){

            return redirect('/dashboard');

        }

        return view('products.edit',['product' => $product]);
    }

    public function update (Request $request){
       $data = $request -> all();
        
       //image upload

         if ($request->hasFile('image') && $request->file('image')->isValid()) {

            $requestImage = $request->image;

            $extension = $requestImage->extension();

            $imageName = md5($requestImage->getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage->move(public_path('img/products'), $imageName);

            $data['image'] = $imageName;

        }
       
        Product::findOrFail($request->id)->update($data);

        return redirect('/dashboard')-> with('msg','Editado com sucesso!');
    }

    public function joinProduct($id) {

        $user = auth() -> user();

        $user->productsAsParticipant()->attach($id);
    
        $product = Product::findOrFail($id);

        return redirect('/dashboard')->with('msg',' Item adicionado a favoritos: '. $product->title );

    }


    public function leaveProduct ($id){

        $user = auth() -> user();
        
        $user->productsAsParticipant()->detach($id);
        
        $product = Product::findOrFail($id);

        return redirect('/dashboard')->with('msg',' Item removido dos favoritos: '. $product->title );


    }


}
