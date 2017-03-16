@extends('layouts.master')

<div style="background-image:url({{ asset('shopping.jpg') }});" height="100%" width="100%" >
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1 style="background-color:white; text-align:center; border-radius:10px;">プロフィール</h1>
            <hr>
            <ul class="nav nav-tabs">
            <li role="presentation" class="active"><a href="#">注文履歴</a></li>
            <li role="presentation"><a href="#">個人情報編集</a></li>
            </ul>
            @foreach($orders as $order)
                <div class="panel panel-default">
                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach($order->cart->items as $item)
                                <li class="list-group-item">
                                    {{ $item['item']['title'] }} | {{ $item['qty'] }} 点
                                    <span class="badge">{{ $item['price'] }}円</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="panel-footer">
                    <ul class="list-group">
                        <li class="list-group-item">
                            <span class="badge">注文日時: {{ $order->created_at }}</span>
                            <strong>合計額: {{ $order->cart->totalPrice }}円</strong></li>
                        </ul>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <p style="margin-top:300px; text-indent:100%; white-space:nowrap; overflow:hidden;">a</p>
    </div>
@endsection