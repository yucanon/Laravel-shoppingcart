@extends('layouts.master')

<div style="background-image:url({{ asset('shopping.jpg') }});" height="100%" width="100%" >
@section('title')
    Laravel Shopping Cart
@endsection

@section('content')
<div class="row">
<div class="col-sm-4 col-md-4 col-md-offset-4 col-sm-offset-4" style="margin-top:18%;">
<h1 style="text-align:center; font-size:45px;">SHOPPING</h1>
<p style="text-align:center; margin-bottom:20px; font-size:15px;">~買いたいものを買えるだけ買おう！~</p>
<div class="list-group">
<button type="button" class="list-group-item list-group-item-info" style="text-align:center;" onclick="location.href=('{{ route('product.index') }}')"><strong>利用開始</strong></button>
<button type="button" class="list-group-item" style="margin-top:10px; text-align:center;" onclick="location.href=('{{ route('user.signin') }}')"><strong><a href="{{ route('product.index') }}">サインイン</a></strong></button>
</div>
</div>
</div>
<p style="margin-top:300px; text-indent:100%; white-space:nowrap; overflow:hidden;">a</p>
</div>






@endsection


