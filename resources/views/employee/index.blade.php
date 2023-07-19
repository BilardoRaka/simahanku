@extends('layout.master')

@section('title', 'Data Karyawan')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">List Data Karyawan</h3>
                        </div>
                        <div class="nk-block-head-content">
                            <ul class="nk-block-tools g-3">
                                <li>
                                    <div class="form-control-wrap">
                                        <form action="/employee">
                                            <div class="form-icon form-icon-right">
                                                <button type="submit" class="badge border-0 bg-white"><em class="icon ni ni-search"></em></button>
                                            </div>
                                            <input type="text" class="form-control" id="search" name="search" value="{{ request('search') }}" placeholder="Nama / Alamat">
                                        </form>
                                    </div>
                                </li>
                                <li>
                                    <a href="/employee/create" class="btn btn-primary">
                                        <em class="icon ni ni-plus-circle"></em>&nbsp;Tambah Karyawan
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
                                <th style="text-align: center">Nama Karyawan</th>
                                <th style="text-align: center">Jabatan</th>
                                <th style="text-align: center">Hak Akses</th>
                                <th style="text-align: center">Alamat</th>
                                <th style="text-align: center">No. Telepon</th>
                                <th style="text-align: center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($employees as $employee)
                                <tr>
                                    <td align="center" class="nk-tb-col tb-col-mb">{{ $employees->firstItem()+$loop->index }}</td>
                                    <td class="nk-tb-col tb-col-mb">
                                        <div class="user-card">
                                            <div class="user-avatar">
                                            @if($employee->image != null)
                                            <img src="{{ asset('/storage/'.$employee->image) }}" alt="...">
                                            @else   
                                            <em class="icon ni ni-user-alt"></em>
                                            @endif
                                            </div>
                                            <div class="user-name">
                                                <span class="tb-lead">
                                                    {{ $employee->name }}
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="nk-tb-col tb-col-mb">{{ $employee->job_position }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $employee->user->role }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $employee->address }}</td>
                                    <td class="nk-tb-col tb-col-mb">{{ $employee->phone }}</td>
                                    <td align="center" class="nk-tb-col tb-col-mb">
                                    <a href="/employee/{{ $employee->id }}/edit" class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Ubah Karyawan"><em class="icon ni ni-edit"></em></a>
                                    <form action="/employee/{{ $employee->user_id }}" method="post" class="d-inline">
                                    @method('delete')
                                    @csrf
                                        <button class="btn btn-trigger btn-icon" data-bs-toggle="tooltip" data-bs-placement="top" title="Hapus Karyawan" onclick="return confirm('Anda yakin untuk hapus?')">
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
                {{ $employees->links() }}
            </div>
        </div>
    </div>
</div>
@endsection