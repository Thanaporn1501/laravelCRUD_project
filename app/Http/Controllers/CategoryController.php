<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;


class CategoryController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Category::orderBy('code')->withCount('products');

        return view('category-list', [
            'categories' => $query->paginate(5),
            ]);
        }

        function show($categoryCode) {
            $category = Category::where('code', $categoryCode)->firstOrFail();

            return view('category-view', [
            'category' => $category,
            ]);
        }
        function showProduct(Request $request, $categoryCode) {
            $category = Category::where('code', $categoryCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = $category->products()->orderBy('code');
            $term = (key_exists('term', $data))? $data['term'] : '';
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('code', 'LIKE', "%{$word}%")
                        ->orWhere('name', 'LIKE', "%{$word}%")
                    ;
                });
        }

            return view('category-view-product', [
                'term' => $term,
                'category' => $category,
                'products' => $query->paginate(6),
            ]);
            }

        function delete($categoryCode){
            $this->authorize('update', Category::class);
            $category = Category::where('code',$categoryCode)->firstOrFail();
            $category->delete();

            return redirect()->route('category-list');
        }

        function updateForm($categoryCode){
            $this->authorize('update', Category::class);

            $category = Category::where('code', $categoryCode)->firstOrFail();
            $products = Product::orderBy('code')->get();

            return view('category-update', [
                'category' => $category,
                'products' => $products ,
                ]);
        }

        function update(Request $request, $categoryCode) {
            $this->authorize('update', Category::class);
        try{
            $data = $request->getParsedBody();
            $category = category::where('code', $categoryCode)->firstOrFail();
            $category->fill($request->getParsedBody());
            $category->save();

            return redirect()->route('category-update', ['category' => $category->code])
            ->with('status', "Category {$category->code} was update.");

            }catch(\Exception $excp) {
                return back()->withInput()->withErrors([
                    'input' => $excp->getmessage(),

                ]);
            }
        }

        function createForm(){
            return view('category-create', [
                'categories' => (object)[],
                'submitMessage' => 'Create' ,
            ]);
        }

        function create(Request $request){
            $this->authorize('update', Category::class);

            try{
                $data = $request->getParsedBody();
                $category = new Category();
                $category->fill($data);
                $category->save();

                return redirect()->route('category-create', ['category' => $category->code])
                ->with('status', "Successfully created");

            }catch(\Exception $excp) {
                return back()->withInput()->withErrors([
                    'input' => $excp->getmessage(),

                ]);
            }
        }
        function addProductForm(Request $request, $categoryCode) {
            $this->authorize('update', Category::class);

            $category = category::where('code',$categoryCode)->firstOrFail();
            $query =Product::orderBy('code')
                    ->whereDoesntHave('category',function($innerQuery) use ($category){
                        $innerQuery->where('id',$category->id);
                });

            $data = $request->getQueryParams();
            $term = (key_exists('term', $data))? $data['term'] : '';
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                return $innerQuery
                    ->where('code', 'LIKE', "%{$word}%")
                    ->orWhere('name', 'LIKE', "%{$word}%")
                ;
            });
            }

            return view('category-add-product', [
                'term' => $term,
                'category' => $category,
                'products' => $query->paginate(6),
            ]);
            }

            function addProduct(Request $request, $categoryCode) {
                $this->authorize('update', Category::class);

                $category = Category::where('code', $categoryCode)->firstOrFail();
                $data = $request->getParsedBody();
                $product = Product::find($data['product']);
                $product->category()->associate($category);
                $product->save();

                return back()->with('status', "Product {$product->code} was added to Category {$category->code}.");
        }


}
