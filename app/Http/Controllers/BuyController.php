<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBuyRequest;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\VirtualProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use NumberFormatter;
class BuyController extends Controller
{   
    private NumberFormatter $formatter;

    public function __construct() {
        $this->formatter = new \NumberFormatter('pt_BR', NumberFormatter::CURRENCY);
    }

    /**
     * Create new resource.
     */
    public function create($product_id)
    {   
        $model = Product::findOrFail($product_id);

        return view('buy.create', [
            'model' => $model
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBuyRequest $request)
    {
        $products = Session::get('products');

        $products[$request->variant_id] = ['variant_id' => $request->variant_id, 'units' => $request->units];

        Session::put('products', $products);

        return Redirect::route('product.index');
    }

    /**
     * Display validate from order
     */
    public function order(Request $request)
    {
        $order = [
            'buy'         => $request->get('buy'),
            'frete'       => $request->get('frete'),
            'cupom'       => $request->get('cupom'),
            'email'       => $request->get('email'),
            'initial'     => $request->get('initial'),
            'cupom_id'    => $request->get('cupom_id'),
            'subtotal'    => $request->get('subtotal'),
            'field_cupom' => $request->get('field_cupom'),

            'fmt_frete'    => $this->formatter->formatCurrency($request->get('frete'), 'BRL'),
            'fmt_cupom'    => $this->formatter->formatCurrency($request->get('cupom'), 'BRL'),
            'fmt_subtotal' => $this->formatter->formatCurrency($request->get('initial'), 'BRL'),
            'fmt_buy'      => $this->formatter->formatCurrency($request->get('buy'), 'BRL'),
        ];

        $orders = $request->get('items', []);

        $collection = !empty($orders) ? Collection::make($orders)->map(fn(array $data) => VirtualProduct::create($data)) : Collection::make([]);

        if($collection->isNotEmpty()) {
            
            $vproduct = VirtualProduct::vProductReduced($collection);

            $collection->push($vproduct);
        }
        
        return view('buy.comfirm', [
            'order' => $order,
            'collection' => $collection
        ]);
    }

    /**
     * Finish Buy
     */
    public function finish(Request $request)
    {
        $model = Order::create([
            'email'          => $request->get('email'),
            'cupom_id'       => $request->get('cupom_id'),
            'buy'            => $request->get('buy'),
            'frete'          => $request->get('frete'),
            'cupom'          => $request->get('cupom'),
            'subtotal'       => $request->get('subtotal'),
            'status'         => $request->get('status'),
            'payment_method' => $request->get('payment_method'),
        ]);

        $items = Collection::make($request->get('items', []));

        $items->map(function($item) use ($model) {
            $item['order_id'] = $model->id;
            OrderItem::create($item);
        });

        Session::forget('products');

        return Redirect::route('product.index')->with('success', __(':resource registered successfully!', ['resource' => __('Pedido')]));
    }
}
