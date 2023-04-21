@extends('layout.master')

@section('title', 'Data Suplai Bahan Baku')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Suplai Bahan Baku</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <a href="/supply/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Suplai Bahan Baku
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
                                <th style="text-align: center">Pemasok</th>
                                <th style="text-align: center">Bahan Baku</th>
                                <th style="text-align: center">Jumlah</th>
                                <th style="text-align: center">Total Harga</th>
                                <th style="text-align: center">Pembuat</th>
                                <th style="text-align: center">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($supplies as $supply)
                                <tr>
                                    <td align="center" class="nk-tb-col tb-col-mb">{{ $supplies->firstItem()+$loop->index }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $supply->supplier->name }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $supply->material->name }}</td>
                                    <td align="right" class="nk-tb-col tb-col-mb">{{ number_format($supply->amount,0,",",".") }} {{ $supply->material->unit }}</td>
                                    <td align="right" class="nk-tb-col tb-col-mb">Rp. {{ number_format($supply->price*$supply->amount,2,",",".") }}</td>
                                    <td align="right" class="nk-tb-col tb-col-mb">{{ $supply->user->name }}</td>
                                    <td align="right" class="nk-tb-col tb-col-mb">{{ $supply->created_at->format('d-m-Y') }}</td>
                                </tr>
                            @endforeach
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{ $supplies->links() }}
            </div>
        </div>
    </div>
</div>
@endsection