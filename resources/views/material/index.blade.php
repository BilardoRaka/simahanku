@extends('layout.master')

@section('title', 'Data Bahan Baku')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Bahan Baku</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <form action="{{ route('material.index') }}">
                                    {{-- @csrf --}}
                                        <div class="form-group">
                                            <div class="form-control-wrap">
                                                <div class="form-icon form-icon-right">
                                                    <em class="icon ni ni-calendar-alt"></em>
                                                </div>
                                                <input type="text" autocomplete="off" name="date" data-date-format="yyyy-mm-dd" class="form-control date-picker" value="{{ request('date') }}">
                                            </div>
                                        </div>
                                    </li>
                                <li>
                                    <button type="submit" class="btn btn-dim btn-outline-primary"><em class="icon ni ni-search"></em></button>
                                </form>
                                </li>
                                <li>
                                    <div class="form-control-wrap">
                                        <form action="/material">
                                            <div class="form-icon form-icon-right">
                                                <button type="submit" class="badge border-0 bg-white"><em class="icon ni ni-search"></em></button>
                                            </div>
                                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama Bahan Baku">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <a href="/material/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Bahan Baku
                                    </a>
                                </li>
                                <li>
                                    <a href="/material/pdf" target="_blank" class="btn btn-primary">
                                        <em class="icon ni ni-file-pdf"></em>&nbsp;Cetak
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
                                <th style="text-align: center">Jumlah Stok</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td align="center" class="nk-tb-col tb-col-mb">{{ $materials->firstItem()+$loop->index }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $material->name }}</td>
                                    <td align="right" class="nk-tb-col tb-col-mb">
                                        @php
                                            $supplyQty = 0;  
                                            $preorderQty = 0; 
                                        @endphp
                                        @foreach($supplies as $supply)
                                            @if($supply->material_id == $material->id)
                                                @php
                                                $supplyQty += $supply->amount;
                                                @endphp
                                            @endif
                                        @endforeach
                                        @foreach($preorders as $preorder)
                                            @foreach($preorder->product->material as $mat)
                                                @if($mat->pivot->material_id == $material->id)
                                                    @php
                                                    $preorderQty += $mat->pivot->amount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @php
                                            $preorderQty *= $preorder->amount;
                                            @endphp
                                        @endforeach
                                        @php
                                            $material_result = $material->stock - $supplyQty + $preorderQty;
                                        @endphp
                                        <p @if($material_result < 0) class="text-danger" @endif>
                                            {{ $material_result }}
                                            {{ $material->unit }}
                                        </p>
                                    </td>
                                    <td align="center" class="nk-tb-col tb-col-mb">
                                    <a href="/material/{{ $material->id }}/edit" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Bahan Baku"><em class="icon ni ni-edit"></em></a>
                                    <form action="/material/{{ $material->id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Bahan Baku" onclick="return confirm('Anda yakin untuk hapus?')">
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
                {{ $materials->links() }}
            </div>
        </div>
    </div>
</div>
@endsection