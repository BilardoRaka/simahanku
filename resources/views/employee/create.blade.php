@extends('layout.master')

@section('title', 'Buat Karyawan')

@section('content')
<div class="nk-content ">
    <div class="container-fluid">
        <div class="nk-content-inner">
            <div class="nk-content-body">
                <div class="nk-block-head nk-block-head-sm">
                    <div class="nk-block-between">
                        <div class="nk-block-head-content">
                            <h3 class="nk-block-title page-title">Buat Karyawan</h3>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <form method="post" action="/employee" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                        <div class="form-group justify-content-center">
                            <div class="form-control-wrap">
                                <div class="d-flex align-items-center justify-content-center">
                                    <img id="preview-image-before-upload" class="mb-3 rounded-circle" style="max-height: 100px;">
                                </div>
                                <label class="form-label">Foto Karyawan (Maks. 1 mb)</label>
                                <div class="form-file">
                                    <input type="file" class="form-file-input @error('logo') is-invalid @enderror" id="logo" name="logo">
                                    <label class="form-file-label" for="logo">Pilih Gambar</label>
                                    @error('logo')
                                        <div class="invalid-feedback">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('name') is-invalid @enderror" id="name" name="name" value="{{ request('name') }}" required>
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
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('job_position') is-invalid @enderror" id="job_position" name="job_position" value="{{ request('job_position') }}" required>
                                <label class="form-label-outlined" for="job_position">Jabatan</label>
                                @error('job_position')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('address') is-invalid @enderror" id="address" name="address" value="{{ request('address') }}" required>
                                <label class="form-label-outlined" for="address">Alamat</label>
                                @error('address')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="text" class="form-control form-control-lg form-control-outlined @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ request('phone') }}" required>
                                <label class="form-label-outlined" for="phone">No. Telepon</label>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <input type="email" class="form-control form-control-lg form-control-outlined @error('email') is-invalid @enderror" id="email" name="email" value="{{ request('email') }}" required>
                                <label class="form-label-outlined" for="email">Email</label>
                                @error('email')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <a href="#" class="form-icon form-icon-right passcode-switch lg" data-target="password">
                                    <em class="passcode-icon icon-show icon ni ni-eye"></em>
                                    <em class="passcode-icon icon-hide icon ni ni-eye-off"></em>
                                </a>
                                <input type="password" class="form-control form-control-lg form-control-outlined @error('password') is-invalid @enderror" id="password" name="password" required>
                                <label class="form-label-outlined" for="password">Password</label>
                                @error('password')
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
                                        <input type="radio" class="custom-control-input" name="role" id="role1" value="admin" required>
                                        <label class="custom-control-label" for="role1"><em class="icon ni ni-user-alt-fill"></em><span>Administrator</span></label>
                                    </div>
                                </li>
                                <li>
                                    <div class="form-check custom-control custom-checkbox custom-control-pro no-control">
                                        <input type="radio" class="custom-control-input" name="role" id="role2" value="pimpinan" required>
                                        <label class="custom-control-label" for="role2"><em class="icon ni ni-user-alt"></em><span>Pimpinan</span></label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">Buat</button>
                            <a href="/employee" class="btn btn-danger">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function (e) {
       $('#logo').change(function(){
        let reader = new FileReader();
        reader.onload = (e) => { 
          $('#preview-image-before-upload').attr('src', e.target.result); 
        }
        reader.readAsDataURL(this.files[0]); 
       });
       
    });
</script>

@endsection