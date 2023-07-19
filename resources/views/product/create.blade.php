@extends('layout.master')

@section('title', 'Buat Produk')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Buat Produk</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/product">
                    @csrf
                    @method('POST')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="product_type_id" class="form-select js-select2 @error('product_type_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    <option value=" " disabled selected>Pilih Jenis Produk</option>
                                    @foreach($product_types as $product_type)
                                    <option value="{{ $product_type->id }}">{{ $product_type->product_type }}</option>
                                    @endforeach
                                </select>
                                @error('product_type_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label-outlined" for="product_type_id">Jenis Produk</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">                    
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('long') is-invalid @enderror" id="long" onkeydown="validateNumber()" name="long">
                                        <label class="form-label-outlined" for="long">Panjang (cm)</label>
                                        @error('long')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">                            
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('wide') is-invalid @enderror" id="wide" onkeydown="validateNumber()" name="wide">
                                        <label class="form-label-outlined" for="wide">Lebar (cm)</label>
                                        @error('wide')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">                            
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('height') is-invalid @enderror" id="height" onkeydown="validateNumber()" name="height">
                                        <label class="form-label-outlined" for="height">Tinggi (cm)</label>
                                        @error('height')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('description') is-invalid @enderror" id="description" name="description">
                                <label class="form-label-outlined" for="description">Deskripsi</label>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('price') is-invalid @enderror" id="price" name="price" onkeydown="validateNumber()">
                                <label class="form-label-outlined" for="price">Harga Produk per Buah</label>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <a href="/product" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

