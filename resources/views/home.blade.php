@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Notification') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <p>{{ __('Kamu berhasil login!') }}</p>

                    <!-- Detail Akun -->
                    <div class="mt-3">
                        <h5>Detail Akun :</h5>
                        <ul class="list-group">
                            <li class="list-group-item"><strong>Nama :</strong> {{ Auth::user()->name }}</li>
                            <li class="list-group-item"><strong>Email :</strong> {{ Auth::user()->email }}</li>
                            <li class="list-group-item">
                                <strong>Jumlah Task :</strong> {{ Auth::user()->todos->count() }}
                            </li>
                        </ul>
                    </div>

                    <!-- Tombol masuk ke halaman Welcome -->
                    <div class="mt-3">
                        <a href="{{ route('welcome') }}" class="btn btn-primary">Masuk ke Halaman Home</a>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
