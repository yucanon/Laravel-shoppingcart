@extends('layouts.master')


@section('title')
    Laravel Shopping Cart
@endsection

@section('content')

@if(Session::has('cart'))
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

        <div class="row">
            <div class="col-sm-6 col-md-6 col-sm-offset-1 col-md-offset-1" style="margin-top:60px;">
                <ul class="list-group">
                    @foreach($products as $product)
                    <div class="thumbnail">
                    <img src="{{ asset($product['item']['imagePath']) }}" alt="" class="img-responsive">
                            <li class="list-group-item">
                                
                                <strong>{{ $product['item']['title'] }}</strong>
                                <strong>×{{ $product['qty'] }}</strong>
                                <strong> : {{ $product['price'] }}円</strong>
                                
                                <div class="btn-group" style="float:right">
                                    <button type="button" class="btn btn-success btn-xs dropdown-toogle" data-toggle="dropdown">注文の取り消し <span class="caret"></span></button>
                                    <ul class="dropdown-menu">
                                        <li><a href="{{ route('product.reduceByOne', ['id' => $product['item']['id']]) }}">1つ取り消し</a></li>
                                        <li><a href="{{ route('product.remove', ['id' => $product['item']['id']]) }}">複数取り消し</a></li>
                                    </ul>
                                </div>
                            </li></div>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-md-offset-8 col-sm-offset-8" style="margin-top:50px;">
                <strong>合計金額: {{ $totalPrice }}円</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-4 col-md-4 col-md-offset-8 col-sm-offset-8">
                <a href="{{ route('checkout') }}" type="button" class="btn btn-success">購入手続きをする</a>
            </div>
        </div>
    @else
        <div class="row">
            <div class=" ">
                <h2>カートに商品は入っていません。ご購入お願いします</h2>
            </div>
        </div>
    @endif
@endsection