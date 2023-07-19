@extends('layout.master')

@section('title', 'Data Jenis Bahan Baku')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Jenis Bahan Baku</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="form-control-wrap">
                                        <form action="/type">
                                            <div class="form-icon form-icon-right">
                                                <button type="submit" class="badge border-0 bg-white"><em class="icon ni ni-search"></em></button>
                                            </div>
                                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Jenis Bahan Baku">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <a href="/type/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Jenis Bahan Baku
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @if(session()->has('peringatan'))
                    <div class="alert alert-success alert-icon">
                        <em class="icon ni ni-check-circle"></em> <strong>{{ session('peringatan') }}</strong>
                    </div>
                @endif
                <div class="table-responsive col-12">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center">No.</th>
                                <th style="text-align: center">Jenis Bahan Baku</th>
                                <th style="text-align: center">Komposisi Bahan Baku Dibutuhkan (cm<sup>3</sup>)</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($product_types as $product_type)
                                <tr>
                                    <td align="center" class="nk-tb-col tb-col-mb">{{ $product_types->firstItem()+$loop->index }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $product_type->product_type }}</td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <ul>
                                            @foreach($product_type->material as $material)
                                                <li>
                                                    {{ $material->pivot->amount }} {{ $material->unit }} {{ $material->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td align="center" class="nk-tb-col tb-col-mb">
                                    <a href="/type/{{ $product_type->id }}/edit" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Jenis Bahan Baku"><em class="icon ni ni-edit"></em></a>
                                    <form action="/type/{{ $product_type->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Jenis Bahan Baku" onclick="return confirm('Anda yakin untuk hapus?')">
                                            <em class="icon ni ni-trash"></em>
                                        </button>
                                    </form>
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{ $product_types->links() }}
            </div>
        </div>
    </div>
</div>
@endsection