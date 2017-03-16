@extends('layouts.master')

@section('title')
    Laravel Shopping Cart
@endsection

@section('content')

<div class="col-sm-4 col-md-2" style="margin-top: 50px; margin-right:50px;">
<form action="{{ route('product.index') }}">
<div class="row">
<div class="col-xs-12">
<h3 style="font-weight:500;">商品検索</h3>
</div>
<div class="col-xs-12" style="margin-top:20px;">
<label class="control-label" style="font-size:20px; font-weight:500;">Keyword</label>
</div>
<div class="col-xs-12" style="margin-top:5px;">
<input type="text" name="keyword" value="{{$keyword}}" placeholder="入力してください" class="form-control">
</div>
<div class="col-xs-12" style="margin-top:20px;">
<input type="submit" value="検索" class="btn btn-success">
</div> 
</div>
</form>
</div>


    @if (Session::get('success'))
    <div class="row">
        <div class="col-sm-10 col-md-10 col-md-offset-4 col-sm-offset-3">
            <div id="charge-message" class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        </div>
    </div>
    @endif
    @foreach($products->chunk(3) as $productChunk)
        <div class="row">
            @foreach($productChunk as $product)
                <div class="col-sm-4 col-md-3" style="margin-top:50px;">
                <div class="thumbnail">
                    <img src="{{ $product->imagePath }}" alt="{{ $product->title }}" class="img-responsive">
                    <div class="caption">
                        <h4>{{ $product->title }}</h4>
                        <p class="description">
                            {{ mb_strimwidth($product->description, 0, 100, '...') }}
                        </p>
                        <div class="clearfix">
                            <div class="pull-left price">{{ $product->price }}円</div>
                            <a href="{{ route('product.addToCart', ['id' => $product->id]) }}" class="btn btn-success pull-right" role="button">カートに入れる</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endforeach
@endsection


