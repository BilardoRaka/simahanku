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
                        @if(auth()->user()->role == 'customer')
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <a href="/preorder/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Preorder
                                    </a>
                                </li>
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
                @if(session()->has('peringatan'))
                    <div class="alert alert-success alert-icon">
                        <em class="icon ni ni-check-circle"></em> <strong>{{ session('peringatan') }}</strong>
                    </div>
                @endif
                @if(session()->has('alertFailed'))
                    <div class="alert alert-danger alert-icon">
                        <em class="icon ni ni-check-cross"></em> <strong>{{ session('alertFailed') }}</strong>
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
                                <th style="text-align: center">Total Harga</th>
                                <th style="text-align: center">Status Pesanan</th>
                                <th style="text-align: center">Status Pembayaran</th>
                                <th style="text-align: center">Tanggal</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($preorders as $preorder)
                                <tr>
                                    <td align="center" class="tb-col-mb">{{ $preorders->firstItem()+$loop->index }}</td>
                                    <td class="tb-col-mb">{{ $preorder->customer->company_name }}</td>
                                    <td class="tb-col-mb">{{ $preorder->product->productType->product_type }} Ukuran {{ $preorder->product->space }} cm<sup>2</sup></td>
                                    <td align="right" class="tb-col-mb">{{ number_format($preorder->amount,0,',','.') }} Buah</td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <ul>
                                        @foreach($preorder->product->material as $material)
                                            <li>
                                                {{ number_format($material->pivot->amount*$preorder->amount,0,',','.') }} {{ $material->unit }} {{ $material->name }}
                                            </li>
                                        @endforeach
                                        </ul>
                                    </td>
                                    <td align="right" class="tb-col-mb">Rp. {{ number_format($preorder->total_price,0,",",".") }}</td>
                                    <td class="tb-col-mb">{{ ucfirst($preorder->status) }}</td>
                                    <td class="tb-col-mb">{{ ucfirst($preorder->payment_status) }}</td>
                                    <td align="right" class="tb-col-mb">{{ $preorder->created_at->format('d-m-Y') }}</td>
                                    <td align="center" class="tb-col-mb">
                                        @if($preorder->payment_status != 'paid' and auth()->user()->role != 'admin')
                                            <a href="/preorder/{{ $preorder->id }}/payment/page" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Bayar Pesanan"><em class="icon ni ni-paypal"></em></a>
                                        @endif
                                        @if($preorder->payment_status == 'paid' and $preorder->status == 'confirmed')
                                            <a href="/preorder/{{ $preorder->id }}/pdf" target="_blank" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Cetak Invoice"><em class="icon ni ni-file-pdf"></em></a>
                                        @endif
                                        @if(auth()->user()->role == 'admin' and $preorder->status != 'confirmed')
                                            <a href="/preorder/{{ $preorder->id }}/confirm" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Konfirmasi Pesanan"><em class="icon ni ni-check"></em></a>
                                        @endif
                                        @if($preorder->reference_id != null and auth()->user()->role == 'customer' and $preorder->payment_status != 'paid')
                                            <a href="{{ route('preorder.notification', $preorder->reference_id) }}" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Lihat Invoice"><em class="icon ni ni-money"></em><span></span></a>
                                        @endif
                                        @if(auth()->user()->role != 'pimpinan' and $preorder->status == 'pending' and $preorder->payment_status == 'pending')
                                            <form action="/preorder/{{ $preorder->id }}" method="post" class="d-inline">
                                            @method('delete')
                                            @csrf
                                                <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Batalkan Pesanan" onclick="return confirm('Anda yakin untuk batalkan pesanan?')">
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