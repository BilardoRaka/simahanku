@extends('layout.master')

@section('title', 'Ubah Pemasok')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ubah Pemasok</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/supplier">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name" value="{{ $supplier->name }}">
                                <label class="form-label-outlined" for="name">Nama</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('address') is-invalid @enderror" id="address" name="address" value="{{ $supplier->address }}">
                                <label class="form-label-outlined" for="address">Alamat</label>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="email" class="form-control form-control-lg form-control-outlined @error('email') is-invalid @enderror" id="email" name="email" value="{{ $supplier->email }}">
                                <label class="form-label-outlined" for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ $supplier->phone }}"> 
                                <label class="form-label-outlined" for="phone">No. Telepon</label>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="/supplier" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('layout.master')

@section('title', 'Ubah Pemasok')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ubah Pemasok</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/supplier">
                    @csrf
                    @method('POST')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name">
                                <label class="form-label-outlined" for="name">Nama</label>
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('address') is-invalid @enderror" id="address" name="address">
                                <label class="form-label-outlined" for="address">Alamat</label>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="email" class="form-control form-control-lg form-control-outlined @error('email') is-invalid @enderror" id="email" name="email">
                                <label class="form-label-outlined" for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('phone') is-invalid @enderror" id="phone" name="phone">
                                <label class="form-label-outlined" for="phone">No. Telepon</label>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="/supplier" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection