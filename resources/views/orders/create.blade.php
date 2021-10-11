@extends('layouts.master')
@section('content')
<form action="{{ route('orders.store') }}" method="post">
    @csrf
    @foreach($products as $product)
    <div class="form-group">
        <label>Product ID</label>
        <input type="text" class="form-control" name="product_id[]" value="{{ $product->id }}" >
        <label>Product Quantity</label>
        <input type="text" class="form-control" name="quantity[]">
        <label>Product Price</label>
        <input type="text" class="form-control" name="price[]">
    </div>
    @endforeach
    <div class="form-group">
        <label>Name</label>
        <input type="text" class="form-control" name="name">
        <label>Address</label>
        <input type="text" class="form-control" name="address">
        <label>Phone</label>
        <input type="text" class="form-control" name="phone">
        <label>Email</label>
        <input type="email" class="form-control" name="email">
    </div>
    <button type="submit" class="btn btn-default">Submit</button
</form>
@endsection