@extends('website.layouts.master')
@section('TitlePage' , 'verify')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card rounded-0 ">
                    {{-- <div class="card-header fw-bold">Verify your email</div> --}}

                    <div class="card-body">
                        <h5 class="card-title">Verify your email</h5>

                        @if (session('message'))
                            <div class="alert alert-success rounded-0" role="alert">
                                {{ session('message') }}
                            </div>
                        @endif
                        <p>Before proceeding, please <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank">check your email</a> via the link we sent you. If you did not receive the email,</p>
                        <form action="{{ route('verification.resend') }}" method="POST" class="text-center">
                            @csrf
                            <button type="submit" class="btn btn-primary text-dark">Resend verification to your email</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
