@extends('layouts.app')
@section('title-app', 'Access Denied')
@section('content')
    <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
            <h1>OPPS!!!</h1>
            <h2>Akun anda perlu diverifikasi.</h2>
            @if (Route::has('login'))
                <a class="btn" href="{{ route('login') }}">{{ __('Back to home') }}</a>
            @endif
            <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
            <div class="credits">
                <!-- All the links in the footer should remain intact. -->
                <!-- You can delete the links only if you purchased the pro version. -->
                <!-- Licensing information: https://bootstrapmade.com/license/ -->
                <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
                Designed by <span class="fw-bold text-primary">Jaya Sukses Mandiri</span>
            </div>
        </section>

    </div>
@endsection