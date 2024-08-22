@extends('layouts.layout')

@section('content')
    @include('sweetalert::alert')

    <!-- Header -->
    <div class="card mb-4">
        <div class="card-body d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0 text-gray-800">Edit Metode Pembayaran</h1>
        </div>
    </div>

    <!-- Form Edit -->
    <div class="card">
        <div class="card-body">
            <form action="{{ route('metodepembayaran.update', $metode->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Menggunakan metode PUT untuk update -->
                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ old('nama', $metode->nama) }}" required>
                    @error('nama')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" id="status" class="form-control" required>
                        <option value="Tersedia" {{ old('status', $metode->status) == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                        <option value="Tidak Tersedia" {{ old('status', $metode->status) == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
                    </select>
                    @error('status')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="saldo">Saldo</label>
                    <input type="number" name="saldo" id="saldo" class="form-control" value="{{ old('saldo', $metode->saldo) }}" min="0" step="0.01" required>
                    @error('saldo')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('metodepembayaran.index') }}" class="btn btn-secondary">Batal</a>
                </div>
            </form>
        </div>
    </div>
@endsection
