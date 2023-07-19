@extends('layout.master')

@section('title', 'Ubah Produk')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ubah Produk</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/product/{{ $product->id }}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="hidden" id="product_type_id" name="product_type_id" value="{{ $product->product_type_id }}">
                                <input type="text" class="form-control form-control-lg form-control-outlined" value="{{ $product->productType->product_type }}" readonly>
                                <label class="form-label-outlined" for="product_type_id">Jenis Produk</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">                    
                                    <div class="form-control-wrap">
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('long') is-invalid @enderror" onkeydown="validateNumber()" id="long" name="long" value="{{ $product->long }}">
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
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('wide') is-invalid @enderror" onkeydown="validateNumber()" id="wide" name="wide" value="{{ $product->wide }}">
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
                                        <input type="text" class="form-control form-control-lg form-control-outlined @error('height') is-invalid @enderror" onkeydown="validateNumber()" id="height" name="height" value="{{ $product->height }}">
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('description') is-invalid @enderror" id="description" name="description" value="{{ $product->description }}">
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('price') is-invalid @enderror" id="price" name="price" value="{{ $product->price }}" onkeydown="validateNumber()">
                                <label class="form-label-outlined" for="price">Harga Produk per Buah</label>
                                @error('price')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-12 child-repeater-table">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th style="text-align:center; margin: auto;">Bahan Baku</th>
                                            <th style="text-align:center; margin: auto;">Jumlah Dibutuhkan</th>
                                            <th style="text-align:center; margin: auto;"><a href="javascript:void(0)" class="badge bg-success addRow">+</a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($product->material as $material)
                                        <tr>
                                            <td>
                                                <select name="material[]" class="form-select js-select2" data-ui="lg" data-search="on">
                                                    @foreach($mats as $mat)
                                                    <option value="{{ $mat->id }}" @if($material->id == $mat->id) selected @endif>{{ $mat->name }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td><input type="text" name="amount[]" onkeydown="validateNumber()" class="form-control form-control-lg" value="{{ $material->pivot->amount }}" required></td>
                                            <td align="center">
                                                @if (!$loop->first)
                                                    <a href='javascript:void(0)' class='badge bg-danger deleteRow'>-</a>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="/product" class="btn btn-danger">Kembali</a>
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
    $('thead').on('click', '.addRow', function(){
        var tr = "<tr>"+
                    "<td>"+
                        "<select name='material[]' class='form-select js-select2' data-ui='lg' data-search='on'>"+
                            "<option value=' ' disabled selected>Pilih Bahan Baku</option>"+
                            "@foreach($mats as $mat)"+
                            "<option value='{{ $mat->id }}'>{{ $mat->name }}</option>"+
                            "@endforeach"+
                        "</select>"+
                    "</td>"+
                    "<td><input type='text' name='amount[]' onkeydown='validateNumber()' class='form-control form-control-lg' required></td>"+
                    "<td align='center'><a href='javascript:void(0)' class='badge bg-danger deleteRow'>-</a></td>"+
                "</tr>"
        $('tbody').append(tr);
    });
    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });

    function validateNumber(evt) {
        var e = evt || window.event;
        var key = e.keyCode || e.which;

        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
            // numbers   
            key >= 48 && key <= 57 ||
            // Numeric keypad
            key >= 96 && key <= 105 ||
            // Backspace and Tab and Enter
            key == 8 || key == 9 || key == 13 ||
            // Home and End
            key == 35 || key == 36 ||
            // left and right arrows
            key == 37 || key == 39 ||
            // Del and Ins
            key == 46 || key == 45) {
            // input is VALID
        } else {
            e.returnValue = false;
            if (e.preventDefault) e.preventDefault();
        }
    }
</script>
@endsection