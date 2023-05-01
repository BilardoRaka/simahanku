@extends('layout.master')

@section('title', 'Buat Preorder')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Buat Preorder</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/preorder">
                    @csrf
                    @method('POST')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="customer_id" class="form-select js-select2 @error('customer_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    <option value=" " disabled selected>Pilih Pelanggan</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                    @endforeach
                                </select>
                                @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label-outlined" for="customer_id">Nama Pelanggan</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="product_id" class="form-select js-select2 @error('product_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    <option value=" " disabled selected>Pilih Produk</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->productType->product_type }} Ukuran {{ $product->space }} cm2</option>
                                    @endforeach
                                </select>
                                @error('product_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label-outlined" for="product_id">Nama Produk</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('amount') is-invalid @enderror" id="amount" name="amount">
                                <label class="form-label-outlined" for="amount">Jumlah Beli</label>
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('price') is-invalid @enderror" id="price" name="price">
                                <label class="form-label-outlined" for="price">Harga Beli</label>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <a href="/preorder" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection