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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name" value="{{ $product->name }}">
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('description') is-invalid @enderror" id="description" name="description" value="{{ $product->description }}">
                                <label class="form-label-outlined" for="description">Deskripsi</label>
                                @error('description')
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
                                            <td><input type="text" name="amount[]" class="form-control form-control-lg" value="{{ $material->pivot->amount }}" required></td>
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
                    "<td><input type='text' name='amount[]' class='form-control form-control-lg' required></td>"+
                    "<td align='center'><a href='javascript:void(0)' class='badge bg-danger deleteRow'>-</a></td>"+
                "</tr>"
        $('tbody').append(tr);
    });
    $('tbody').on('click', '.deleteRow', function(){
        $(this).parent().parent().remove();
    });
</script>
@endsection