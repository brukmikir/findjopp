@extends('layouts.app')

@section('content')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-lg">
                <div class="card-header bg-success text-white">log in</div>
                <form action="{{route('postlogin')}}" method="post">@csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="">email</label>
                            <input type="text" name="email" class="form-control">

                            @if ($errors->has('email'))
                            <span class="text-danger">{{$errors->first('email')}}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="text" name="password" class="form-control">

                            @if ($errors->has('password'))
                            <span class="text-danger">{{$errors->first('password')}}</span>
                            @endif
                        </div>
                        <br>
                        <div class="form-group text-center">
                            <button class="btn btn-success btn-lg " type="submit">login</button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection