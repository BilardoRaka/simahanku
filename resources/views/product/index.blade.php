@extends('layout.master')

@section('title', 'Data Produk')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Produk</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="form-control-wrap">
                                        <form action="/product">
                                            <div class="form-icon form-icon-right">
                                                <button type="submit" class="badge border-0 bg-white"><em class="icon ni ni-search"></em></button>
                                            </div>
                                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama/Deskripsi Produk">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <a href="/product/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Produk
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
                                <th style="text-align: center">Nama</th>
                                <th style="text-align: center">Deskripsi</th>
                                <th style="text-align: center">Bahan Baku Dibutuhkan</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr>
                                    <td align="center" class="nk-tb-col tb-col-mb">{{ $products->firstItem()+$loop->index }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $product->name }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $product->description }}</td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <ul>
                                            @foreach($product->material as $material)
                                                <li>
                                                    {{ $material->pivot->amount }} {{ $material->unit }} {{ $material->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td align="center" class="nk-tb-col tb-col-mb">
                                    <a href="/product/{{ $product->id }}/edit" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Produk"><em class="icon ni ni-edit"></em></a>
                                    <form action="/product/{{ $product->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Produk" onclick="return confirm('Anda yakin untuk hapus?')">
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
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection