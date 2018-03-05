<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Models\Pokemon;
use App\Models\Element;
use App\Models\Cart;
use Session;

class PokemonController extends Controller
{
    /** for Admin */
    public function index()
    {
        $elements = Element::all();
        $pokemons = Pokemon::orderBy('id', 'DESC')->get();

        return view('admin.pokemon.index', compact('pokemons', 'elements'));
    }

    public function create()
    {
        $elements = Element::all(); 
        return view('admin.pokemon.create', compact('elements'));
    }

    public function store(Request $request)
    {
        // dd($request);
        $this->validate($request, [
            'name'=>'required|alpha|min:3', 
            //'image'=>'required|image', 
            'element'=>'required', 
            'gender'=>'required', 
            //'description'=>'required|alpha', 
            'price'=>'required|numeric|min:1000',
        ]);

        /** Validation element */
        if(empty($request->element))
            return redirect('/admin/pokemon/create')->withInput($request->input());
        
        /** Insert Image */
        $file = $request->file('img_pokemon');
        $filename = $file->getClientOriginalName();
        $request->file('img_pokemon')->move("image_pokemon/", $filename);

        /** Make slug */
        $slug = str_slug($request->name, '-');
        if(Pokemon::where('slug', $slug)->first() != null) 
            $slug = $slug . '-' . time();

        $pokemon = Pokemon::create([
            'name'=>$request->name, 
            'image_path'=>$filename,
            'gender'=>$request->gender, 
            'description'=>$request->description, 
            'price'=>$request->price, 
            'slug'=>$slug,
            'element_id'=>$request->element,
        ]);       
 
        return redirect('/admin/pokemon')->with('msg-success', 'Pokemon Added');
    }

    public function show($id)
    {
        
    }

    public function edit($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $elements = Element::all();
        return view('admin.pokemon.edit', compact('pokemon', 'elements'));
    }

    public function update(Request $request, $id)
    {

        dd('sampai boss');
        $this->validate($request, [
            'name'=>'required|alpha|min:3', 
            // 'image'=>'required|image', 
            'element'=>'required', 
            'gender'=>'required', 
            // 'description'=>'required|alpha', 
            'price'=>'required|numeric|min:1000',
        ]);

        /** Validation element */
        // if(empty($request->element))
        //     return redirect('pokemon/{{ $id }}/edit')->withInput($request->input());
        
        $pokemon = Pokemon::findOrFail($id);

        /** Insert Image */
        $file = $request->file('img_pokemon');
        $filename = $file->getClientOriginalName();
        $request->file('img_pokemon')->move("image_pokemon/", $filename);

        /** Make slug */
        $slug = str_slug($request->name, '-');
        if(Pokemon::where('slug', $slug)->first() != null) 
            $slug = $slug . '-' . time();

        $pokemon->update([
            'name'=>$request->name, 
            'image_path'=>$filename,
            'gender'=>$request->gender, 
            'description'=>$request->description, 
            'price'=>$request->price, 
            'slug'=>$slug,
            'element_id'=>$request->element,
        ]);       
 
        return redirect('/admin/pokemon')->with('msg-success', 'Pokemon Updated');
    }

    public function destroy($id)
    {
        $pokemon = Pokemon::findOrFail($id);
        $pokemon->delete();

        return redirect('/admin/pokemon')->with('msg-delete', 'Pokemon Deleted');
    }

    /** For Auth */
    public function indexpokemon(Request $request)
    {
        $elements = Element::all();

        /** Search Title */
        $search_q = urlencode($request->input('search'));

        if(!empty($search_q))
            $pokemons = Pokemon::with('element')->where('name', 'like', '%'.$search_q.'%')->get();
        else
            $pokemons = Pokemon::orderBy('id', 'DESC')->get();

        return view('member.pokemon.index', compact('pokemons', 'elements'));
    }

    public function showpokemon($slug) 
    {
        $pokemon = Pokemon::with('element')->where('slug', $slug)->first();
        if(empty($pokemon)) abort(404);

        return view('member.pokemon.single', compact('pokemon'));
    }

    /** For Cart */
    public function getAddToCart(Request $request, $id) {
        $pokemon = Pokemon::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($pokemon, $pokemon->id);

        $request->session()->put('cart', $cart);
        // dd($request->session()->get('cart'));
        return redirect('/pokemon');
    }

    public function getCart() {
        if(!Session::has('cart')) {
            return view('shop.shopping-cart', ['products' => null]);
        }

        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart', ['products'=> $cart->items, 'totalPrice' => $cart->totalPrice]);

    }

    public function getCheckout() {
        if(!Session::has('cart')) {
            return view('shop.shopping-cart');
        }
        
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        return view('shop.checkout', ['total' => $total]);
    }

    public function postCheckout() {
        dd('sampai boss');

    }
}
