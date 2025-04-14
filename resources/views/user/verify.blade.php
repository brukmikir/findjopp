@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="card">
            <div class="card-header">verify account</div>
            <div class="card-body">
                <p>your account is not verified please verify your account first.

                    <a href="{{route('resend.email')}}">resend verification link</a>
                </p>

            </div>
        </div>
    </div>
</div>
@endsection