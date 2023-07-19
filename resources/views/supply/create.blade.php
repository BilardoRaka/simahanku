@extends('layout.master')

@section('title', 'Buat Suplai Bahan Baku')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Buat Suplai Bahan Baku</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/supply">
                    @csrf
                    @method('POST')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="supplier_id" class="form-select js-select2 @error('supplier_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    <option value=" " disabled selected>Pilih Pemasok</option>
                                    @foreach($suppliers as $supplier)
                                    <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label-outlined" for="supplier_id">Nama Pemasok</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="material_id" class="form-select js-select2 @error('material_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    <option value=" " disabled selected>Pilih Bahan Baku</option>
                                    @foreach($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->name }}</option>
                                    @endforeach
                                </select>
                                @error('material_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                                <label class="form-label-outlined" for="material_id">Nama Bahan Baku</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('amount') is-invalid @enderror" id="amount" name="amount" onkeydown="validateNumber()">
                                <label class="form-label-outlined" for="amount">Jumlah Bahan</label>
                                @error('amount')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('price') is-invalid @enderror" id="price" name="price" onkeydown="validateNumber()">
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
                            <a href="/supply" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection