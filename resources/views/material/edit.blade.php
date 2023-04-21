@extends('layout.master')

@section('title', 'Ubah Bahan Baku')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ubah Bahan Baku</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/material/{{ $material->id }}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name" value="{{ $material->name }}">
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('unit') is-invalid @enderror" id="unit" name="unit" value="{{ $material->unit }}">
                                <label class="form-label-outlined" for="unit">Satuan</label>
                                @error('unit')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="/material" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection