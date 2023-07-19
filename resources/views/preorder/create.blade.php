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
                                <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ auth()->user()->customer?->company_name }}">
                                <input type="hidden" name="customer_id" value="{{ auth()->user()->customer?->id }}">
                                <label class="form-label-outlined" for="customer_id">Nama Pelanggan</label>
                                @error('customer_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <select name="product_id" id="product_id" onchange="addPrice()" class="form-select js-select2 @error('product_id') is-invalid @enderror" data-ui="lg" data-search="on">
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}" data-price="{{ $product->price }}">
                                        {{ $product->productType->product_type }} Ukuran {{ $product->space }} cm2
                                    </option>
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
                        @if($products->count() != 0)
                        <input type="hidden" id="price" name="price" value="{{ $products[0]->price }}">
                        @endif
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('amount') is-invalid @enderror" id="amount" onkeydown="validateNumber()" onkeyup="calculate(this.value)" name="amount">
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('total_price') is-invalid @enderror" id="total_price" name="total_price" value=" " readonly>
                                <label class="form-label-outlined" for="total_price">Harga Beli</label>
                                @error('total_price')
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

@section('script')

<script>

    function calculate(number){
        var price = $("#price").val();
        var amount = $("#amount").val();
        $("#total_price").val(price * amount);
    }

    function addPrice(){
        var price = $('#product_id').find(':selected').attr('data-price');
        $('#price').val(price);
    };

</script>

@endsection