@extends('layouts.master')

<div style="background-image:url({{ asset('shopping.jpg') }});" height="100%" width="100%" >
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4" style="margin-top:15%; background-color:white; border-radius:15px;">
            <h1 style="text-align:center; margin-bottom:30px;">Sign Up</h1>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <form action="{{ route('user.signup') }}" method="post">
                <div class="form-group">
                    <label for="email">E-Mail</label>
                    <input type="text" id="email" name="email" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                {{ csrf_field() }}
            </form>
        </div>
    </div>
    <p style="margin-top:300px; text-indent:100%; white-space:nowrap; overflow:hidden;">a</p>
    </div>
@endsection