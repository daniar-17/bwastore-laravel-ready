<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductGalleryRequest;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductGallery;
use App\Models\User;

use Yajra\DataTables\Facades\DataTables;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $query = ProductGallery::with(['product']); //Ini diambil dari Model yang dimana user dan category ini adalah function

            return DataTables::of($query)
                ->addColumn('action', function ($item) {
                    return '
                        <div class="btn-group">
                            <div class="dropdown">
                                <button
                                    class="btn btn-primary dropdown-toggle mr-1 mb-1"
                                    type="button"
                                    data-toggle="dropdown"
                                >
                                    Aksi
                                </button>
                                <div class="dropdown-menu">
                                    <form action="' . route('product-gallery.destroy', $item->id) . '" method="POST">
                                        ' . method_field('delete') . csrf_field() . '
                                        <button type="submit" class="dropdown-item text-danger">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    ';
                })
                ->editColumn('photos', function ($item) {
                    return $item->photos ? '<img src="' . url($item->photos) . '" style="max-height: 80px; border-radius: 8px;" />' : '';
                })
                ->rawColumns(['action', 'photos'])
                ->make();
        }
        return view('pages/admin/product-gallery/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('pages.admin.product-gallery.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductGalleryRequest $request)
    {
        $data = $request->all();
        $imageN = time() . '_' . $request->photos->getClientOriginalName();

        // $data['photos'] = $request->file('photos')->store('assets/product', 'public');
        $request->file('photos')->move(public_path('assets/product'), $imageN);
        $data['photos'] = "assets/product/" . $imageN;

        ProductGallery::create($data);

        return redirect()->route('product-gallery.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductGalleryRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = ProductGallery::findOrFail($id);
        $item->delete();

        return redirect()->route('product-gallery.index');
    }
}
