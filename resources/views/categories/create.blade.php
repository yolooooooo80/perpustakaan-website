@extends('layouts.app')

@section('title', 'Tambah Kategori')

@section('content')
<div class="row justify-content-center fade-in">
    <div class="col-md-6">
        <div class="card glass-card shadow-lg border-0">
            <div class="card-header bg-primary bg-gradient text-white">
                <h3 class="mb-0">Tambah Kategori</h3>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('categories.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="name" class="form-label">Nama Kategori</label>
                        <input type="text" class="form-control bg-dark text-white border-secondary @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required autofocus>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('staff.categories.index') }}" class="btn btn-outline-light">Kembali</a>
                        <button type="submit" class="btn btn-primary px-5">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
