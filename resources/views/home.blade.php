@extends('layouts.layout')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Selamat Datang Di Sistem Penjualan Rumah Makan Sate Maranggi Si Bungsu') }}
                {{ Auth::user()->name}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
