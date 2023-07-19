@extends('layout.master')

@section('title', 'Payment Preorder')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                             <h3 class="nk-block-title page-title">
                                Transaction
                            </h3>
                        </div>
                    </div>
                </div>
                @if(session()->has('alertSuccess'))
                <div class="alert alert-success alert-icon">
                    <em class="icon ni ni-check-circle"></em> <strong>{{ session('alertSuccess') }}</strong>
                </div>
                @endif
                <label for="" class="form-label">Please send money written in the paid amount to the listed account number.</label>
                <div class="nk-block">
                    <div class="card card-bordered card-stretch">
                        <div class="card-inner-group">
                            <div class="card-inner p-0">
                                <table class="table table-bordered">
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Sub Total
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Rp. {{ number_format($payment->subtotal,0,",",".") }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Fee
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Rp. {{ number_format($payment->fee,0,",",".") }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Paid Amount
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Rp. {{ number_format($payment->total,0,",",".") }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Reference Number
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->reference_id }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Transaction ID
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->transaction_id }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Via
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->via }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Channel
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->channel }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Account Name
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->payment_name }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Account Number
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                {{ $payment->payment_no }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="nk-tb-item">
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                Expired At
                                            </span>
                                        </td>
                                        <td class="nk-tb-col text-black">
                                            <span>
                                                @php
                                                    $expire = strtotime($payment->expired_at);
                                                @endphp
                                                {{ date('H:i d-m-Y', $expire) }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ route('preorder.index') }}" class="btn btn-dim btn-outline-danger mt-3">Kembali</a>
            </div>
        </div>
    </div>
</div>

@endsection