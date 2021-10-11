<h1>Here is Your Order</h1>
<p style="color: red;">Your name : {{ $order->name }}</p>
<p>Your Address : {{ $order->address }}</p>
<p>Your Phone : {{ $order->phone }}</p>
<table >
    <tr>
        <td>Product Name</td>
        <td>Quantity</td>
        <td>Price</td>
    </tr>
    @foreach($orderDetail as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->price }}</td>
    </tr>
    @endforeach
</table>