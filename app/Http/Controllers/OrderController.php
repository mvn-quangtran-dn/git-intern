<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use App\Product;
use App\OrderDetail;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function create()
    { 
        $products = Product::take(2)->get();
        return view('orders.create', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        // dd($data);
        $dataOrder = $request->only('name','address','phone');
        $userEmail = $request->only('email');
        $order = Order::create($dataOrder);
        // $dataOrderDetails = $request->only('product_id', 'quantity_id', 'price_id');
        $data = [];
        foreach ($request->product_id as $key => $item) {
            $data[] = [
                'product_id' => $item,
                'quantity' => $request->quantity[$key],
                'price' => $request->price[$key],
                'order_id' => $order->id
            ] ;
            
        }
        // dd($data);
        $orderDetail =OrderDetail::insert($data);
        if ($orderDetail) {
            //send mail
            $orderDetail = OrderDetail::where('order_id', $order->id)->get();
            $data= [
                'order' => $order,
                'orderDetail' =>  $orderDetail
            ];
            // dd($userEmail, $dataOrder, config('mail.username'));
            \Mail::send('mails.order-detail', $data, function ($message) use ($userEmail, $dataOrder) {
                $message->from(config('mail.username'),'Admin');
                $message->to($userEmail['email'],  $dataOrder['name']);
                $message->subject('Confirm Order');
            });
            return 'success';
        }
        return redirect()->back()->with(['error' => 'create order fail']) ;



    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }
}
