@extends('layout.master')

@section('title', 'Data Preorder')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Preorder</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <a href="/preorder/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Preorder
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
                                <th style="text-align: center">Pelanggan</th>
                                <th style="text-align: center">Produk</th>
                                <th style="text-align: center">Jumlah</th>
                                <th style="text-align: center">Bahan Baku</th>
                                <th style="text-align: center">Status</th>
                                <th style="text-align: center">Pembuat</th>
                                <th style="text-align: center">Tanggal</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($preorders as $preorder)
                                <tr>
                                    <td align="center" class="tb-col-mb">{{ $preorders->firstItem()+$loop->index }}</td>
                                    <td class="tb-col-mb">{{ $preorder->customer->name }}</td>
                                    <td class="tb-col-mb">{{ $preorder->product->name }}</td>
                                    <td align="right" class="tb-col-mb">{{ number_format($preorder->amount,0,',','.') }}</td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <ul>
                                            @foreach($preorder->product->material as $material)
                                                <li>
                                                    {{ number_format($material->pivot->amount*$preorder->amount,0,',','.') }} {{ $material->unit }} {{ $material->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td class="tb-col-mb">{{ $preorder->status }}</td>
                                    <td class="tb-col-mb">{{ $preorder->user->name }}</td>
                                    <td align="right" class="tb-col-mb">{{ $preorder->created_at->format('d-m-Y') }}</td>
                                    <td align="center" class="tb-col-mb">
                                        @if($preorder->status == 'Pending')
                                            <a href="/preorder/{{ $preorder->id }}/confirm" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Preorder"><em class="icon ni ni-check"></em></a>
                                            <form action="/preorder/{{ $preorder->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                                <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Cancel Preorder" onclick="return confirm('Anda yakin untuk hapus?')">
                                                    <em class="icon ni ni-cross"></em>
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
                {{ $preorders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection