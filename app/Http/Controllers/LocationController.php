<?php

namespace App\Http\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
use Mapper;

class LocationController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }


    function list(Request $request) {
        $data = $request->getQueryParams();
        $query = Location::orderBy('code')->withCount('products');
        $term = (key_exists('term', $data))? $data['term'] : '';
        foreach(preg_split('/\s+/', $term) as $word) {
        $query->where(function($innerQuery) use ($word) {
        return $innerQuery
        ->where('code', 'LIKE', "%{$word}%")
        ->orWhere('name', 'LIKE', "%{$word}%")
        ->orWhere('address', 'LIKE', "%{$word}%");
        });
        }


        return view('location-list', [
        'term' => $term,
        'locations' => $query->paginate(7),
        ]);
        }

        function createForm() {

            return view('location-create');
        }

        function create(Request $request) {
            $this->authorize('update', Location::class);
            try{
                $location = Location::create($request->getParsedBody());
                $location->save();
                return redirect()->route('location-create', ['location' => $location->code])
                ->with('status', "Successfully created");

            }catch(\Exception $excp) {
                return back()->withInput()->withErrors([
                    'input' => $excp->getmessage(),
                ]);
            }
        }

        function showProduct(Request $request, $locationCode) {
            $location = Location::where('code', $locationCode)->firstOrFail();
            $data = $request->getQueryParams();
            $query = $location->products()->orderBy('code');
            $term = (key_exists('term', $data))? $data['term'] : '';
            foreach(preg_split('/\s+/', $term) as $word) {
                $query->where(function($innerQuery) use ($word) {
                    return $innerQuery
                        ->where('code', 'LIKE', "%{$word}%")
                        ->orWhere('name', 'LIKE', "%{$word}%")
                    ;
                });
            }


            return view('location-view-product', [
                'term' => $term,
                'location' => $location,
                'products' => $query->paginate(7),
            ]);
            }

        function addProductForm(Request $request, $locationCode) {
            $this->authorize('update', Location::class);

            $location = Location::where('code', $locationCode)->firstOrFail();
            $query = Product::orderBy('code')
                ->whereDoesntHave('locations',function($innerQuery) use ($location){
                    $innerQuery->where('id',$location->id);
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

            return view('location-add-product', [
                'term' => $term,
                'location' => $location,
                'products' => $query->paginate(7),
            ]);
            }

        function addProduct(Request $request, $locationCode) {
            $this->authorize('update', Location::class);



             $location = Location::where('code', $locationCode)->firstOrFail();
            $data = $request->getParsedBody();

            $location ->products()->attach($data['product']);
             $product = Product::where('id',$data['product'])->firstOrFail();

            return back()->with('status', "Product {$product->code} was added to Location {$location->code}.");
        }

        function removeProduct($locationCode, $productCode) {
            $this->authorize('update', Location::class);


            $location = Location::where('code', $locationCode)->firstOrFail();
            $product = $location->products()
                ->where('code', $productCode)->firstOrFail();
            $location->product()->detach($product);


            return back()->with('status', "Product {$productCode} was removed from location
            {$location->code}.");
        }


        function updateForm($locationCode){
            $this->authorize('update', Location::class);
            $location = Location::where('code',$locationCode)->firstOrFail();

            return view('location-update', [
                'location' => $location,
                ]);
        }


        function update(Request $request, $locationCode) {
            $this->authorize('update', Location::class);
        try{
            $data = $request->getParsedBody();
            $location = Location::where('code', $locationCode)->firstOrFail();
            $location->fill($request->getParsedBody());
            $location->save();

            return redirect()->route('location-update', ['location' => $location->code])
                ->with('status', "location {$location->code} was update.");

            }catch(\Exception $excp) {
                 return back()->withInput()->withErrors([
                    'input' => $excp->getmessage(),

                ]);
            }
        }

        function delete($locationCode){
            $location = Location::where('code',$locationCode)->firstOrFail();
            $location->delete();

            return redirect()->route('location-list')
            ->with('status', "Location {$location->code} was deleted.");
        }


        function show($locationCode) {
             $location = location::where('code', $locationCode)->firstOrFail();
             Mapper::map($location['latitude'], $location['longitude'],['zoom' => 15,]);

            return view('location-view', [
                'location' => $location
            ]);
        }
}
