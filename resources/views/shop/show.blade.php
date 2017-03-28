@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')

<div class="col-md-offset-2 col-xs-offset-2 col-xs-8 col-md-8" style="margin-top:50px;">
<div class="thumbnail">
<img src="{{ asset($product->imagePath) }}" alt="{{ $product->title }}" class="img-responsive" style="margin-top:50px;">
<div class="caption">
<h4 style="color:black; margin-top:50px;">{{ $product->title }}</h4>
<p class="description" style="color:#7f7f7f; margin-top:30px; margin-bottom:30px;">
{{ $product->description }}
</p></a>
<div class="clearfix">
<div class="pull-left price">{{ $product->price }}円</div>
<a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">カートに入れる</a>
</div>
</div>
</div>
</div>


@endsection


