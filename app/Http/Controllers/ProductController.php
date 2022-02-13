<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
use Illuminate\Contracts\Pagination\Paginator;


class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function list(Request $request)
    {
        $data = $request->getQueryParams();
        $query = Product::orderBy('imgcode');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
                return $innerQuery
                    ->where('name', 'LIKE', "%{$word}%")
                    ->orWhere('price', 'LIKE', "%{$word}%");
            });
        }
        return view('product-list', [
            'term' => $term,
            'products' => $query->paginate(6),
        ]);
    }

    function show($productCode)
    {
        $product = Product::where('imgcode', $productCode)->firstOrFail();

        return view('product-view', [
            'product' => $product,
        ]);
    }

    function createForm()
    {
        $categories = Category::orderBy('name');

        return view('product-create', [
            'categories' => $categories->get(),
        ]);
    }

    function create(Request $request)
    {
        $this->authorize('update', Product::class);
        try {
            $data = $request->getParsedBody();
            $product = new Product();
            $product->fill($data);
            $product->category()->associate($data['category']);
            $product->save();

            return redirect()->route('product-create', ['product' => $product->code])
                ->with('status', "Successfully created");
        } catch (\Exception $excp) {
            return back()->withInput()->withErrors([
                'input' => $excp->getmessage(),
            ]);
        }
    }

    function updateForm($productCode)
    {
        $this->authorize('update', Product::class);
        $product = Product::where('code', $productCode)->firstOrFail();
        $categories = Category::orderBy('code')->get();

        return view('product-update', [
            'categories' => $categories,
            'product' => $product,
        ]);
    }

    function update(Request $request, $productCode)
    {
        $this->authorize('update', Product::class);
        try {
            $data = $request->getParsedBody();
            $product = Product::where('code', $productCode)->firstOrFail();
            $product->category()->associate($data['category']);
            $product->fill($request->getParsedBody());
            $product->save();

            return redirect()->route('product-update', ['product' => $product->code])
                ->with('status', "Product {$product->code} was update.");
        } catch (\Exception $excp) {
            return back()->withInput()->withErrors([
                'input' => $excp->getmessage(),
            ]);
        }
    }

    function delete($productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();
        $product->delete();

        return redirect()->route('product-list');
    }

    function removeLocation($productCode, $locationCode)
    {
        $this->authorize('update', Product::class);
        $product = Product::where('code', $productCode)->firstOrFail();
        $location = $product->locations()
            ->where('code', $locationCode)->firstOrFail();
        $product->locations()->detach($location);

        return back();
    }

    function addLocation(Request $request, $productCode)
    {
        $this->authorize('update', Location::class);

        $product = Product::where('code', $productCode)->firstOrFail();
        $data = $request->getParsedBody();
        $product->locations()->attach($data['location']);
        $location = Location::where('id', $data['location'])->firstOrFail();


        return back()->with('status', "Location {$location->code} was added to Product {$product->code}.");
    }

    function showLocation(Request $request, $productCode)
    {
        $product = Product::where('code', $productCode)->firstOrFail();
        $data = $request->getQueryParams();
        $query = $product->locations()->orderBy('code');
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
                return $innerQuery
                    ->where('code', 'LIKE', "%{$word}%")
                    ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }

        return view('product-view-location', [
            'term' => $term,
            'product' => $product,
            'locations' => $query->paginate(5),
        ]);
    }

    function addLocationForm(Request $request, $productCode)
    {
        $this->authorize('update', Product::class);

        $product = Product::where('code', $productCode)->firstOrFail();
        $query = Location::orderBy('code')
            ->whereDoesntHave('products', function ($innerQuery) use ($product) {
                $innerQuery->where('id', $product->id);
            });

        $data = $request->getQueryParams();
        $term = (key_exists('term', $data)) ? $data['term'] : '';
        foreach (preg_split('/\s+/', $term) as $word) {
            $query->where(function ($innerQuery) use ($word) {
                return $innerQuery
                    ->where('code', 'LIKE', "%{$word}%")
                    ->orWhere('name', 'LIKE', "%{$word}%");
            });
        }
        return view('product-add-location', [
            'term' => $term,
            'product' => $product,
            'locations' => $query->paginate(5),
        ]);
    }
}
