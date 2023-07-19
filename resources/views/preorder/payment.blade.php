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
                    <form method="post" action="/preorder/{{ $preorder->id }}/payment/post">
                    @csrf
                    @method('PUT')
                        <div class="row">
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $preorder->customer->company_name }}" name="customer_name" readonly>
                                    <label class="form-label-outlined" for="customer_name">Nama Pelanggan</label>
                                    @error('customer_name')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $preorder->customer->user->email }}" name="customer_email" readonly>
                                    <label class="form-label-outlined" for="customer_email">Email Pelanggan</label>
                                    @error('customer_email')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $preorder->customer->phone }}" name="customer_phone" readonly>
                                    <label class="form-label-outlined" for="customer_phone">Nomor Telepon Pelanggan</label>
                                    @error('customer_phone')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $preorder->product->productType->product_type }} Ukuran {{ $preorder->product->space }} cm2" name="product_name" readonly>
                                    <label class="form-label-outlined" for="product_name">Produk Dibeli</label>
                                    @error('product_name')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $preorder->amount }} Buah" name="amount" readonly>
                                    <label class="form-label-outlined" for="amount">Produk Dibeli</label>
                                    @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-4">
                                <div class="form-control-wrap">
                                    <input type="text" class="form-control form-control-lg form-control-outlined" value="Rp. {{ number_format($preorder->total_price,0,",",".") }}" readonly>
                                    <input type="hidden" name="total_price" value="{{ $preorder->total_price }}">
                                    <label class="form-label-outlined" for="total_price">Total Harga Pesanan</label>
                                    @error('total_price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group col-8">
                                <div class="form-control-wrap">
                                    <select name="payment_channel" id="payment_channel" class="form-select js-select2" data-ui="lg" required>
                                        <option value="bca">Virtual Account Bank Central Asia</option>
                                        <option value="bni">Virtual Account Bank Negara Indonesia</option>
                                        <option value="bmi">Virtual Account Bank Muamalat Indonesia</option>
                                        <option value="bsi">Virtual Account Bank Syariah Indonesia</option>
                                        <option value="mandiri">Virtual Account Bank Mandiri</option>
                                    </select>
                                    <label class="form-label-outlined" for="payment_channel">Pilih Metode Pembayaran</label>
                                </div>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Bayar</button>
                            <a href="/preorder" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection