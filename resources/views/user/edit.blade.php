@extends('layout.master')

@section('title', 'Ubah User')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Ubah User</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/user/{{ $user->id }}">
                    @csrf
                    @method('PUT')
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name" value="{{ $user->name }}">
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
                                <input type="email" class="form-control form-control-lg form-control-outlined @error('email') is-invalid @enderror" id="email" name="email" value="{{ $user->email }}">
                                <label class="form-label-outlined" for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="role">Hak Akses&nbsp;&nbsp;&nbsp;</label>
                            <ul class="custom-control-group">
                                <li>
                                    <div class="form-check custom-control custom-checkbox custom-control-pro no-control">
                                        <input type="radio" class="custom-control-input" name="role" id="role1" value="administrator" required @if($user->role == 'administrator') checked @endif>
                                        <label class="custom-control-label" for="role1"><em class="icon ni ni-user-alt-fill"></em><span>Administrator</span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check custom-control custom-checkbox custom-control-pro no-control">
                                        <input type="radio" class="custom-control-input" name="role" id="role2" value="pimpinan" required @if($user->role == 'pimpinan') checked @endif>
                                        <label class="custom-control-label" for="role2"><em class="icon ni ni-user-alt"></em><span>Pimpinan</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Ubah</button>
                            <a href="/user" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection