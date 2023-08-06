<!DOCTYPE html>
<html lang="zxx" class="js">

<head>
    <base href="../../../">
    <meta charset="utf-8">
    <meta name="author" content="Softnio">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="A powerful and conceptual apps base dashboard template that especially build for developers and programmers.">
    <!-- Fav Icon  -->
    <link rel="shortcut icon" href="{{ asset('images/nifandatama.png') }}">
    <!-- Page Title  -->
    <title>Registrasi | Simahanku</title>
    <!-- StyleSheets  -->
    <link rel="stylesheet" href="./assets/css/dashlite.css?ver=3.1.0">
    <link id="skin-default" rel="stylesheet" href="./assets/css/theme.css?ver=3.1.0">
</head>

<body class="nk-body bg-white npc-general pg-auth">
    <div class="nk-app-root">
        <!-- main @s -->
        <div class="nk-main ">
            <!-- wrap @s -->
            <div class="nk-wrap nk-wrap-nosidebar">
                <!-- content @s -->
                <div class="nk-content ">
                    <div class="nk-block nk-block-middle nk-auth-body wide-xs">
                        <div class="brand-logo pb-4 text-center">
                            <a href="html/index.html" class="logo-link">
                                <img class="logo-dark logo-img logo-img-lg" src="{{ asset('images/nifandatama.png') }}" srcset="./images/logo-dark2x.png 2x" alt="logo-dark">
                            </a>
                        </div>
                        <div class="card card-bordered">
                            <div class="card-inner card-inner-lg">
                                <div class="nk-block-head">
                                    <div class="nk-block-head-content">
                                        <h4 class="nk-block-title">Registrasi</h4>
                                    </div>
                                </div>
                                <form action="/registration" method="post" enctype="multipart/form-data">
                                @csrf
                                    <div class="form-group justify-content-center">
                                        <div class="form-control-wrap">
                                            <div class="d-flex align-items-center justify-content-center">
                                                <img id="preview-image-before-upload" class="mb-3 rounded-circle" style="max-height: 100px;">
                                            </div>
                                            <label class="form-label">Logo Perusahaan (Maks. 1 mb)</label>
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
                                            <input type="text" class="form-control form-control-lg form-control-outlined @error('company_name') is-invalid @enderror" id="company_name" name="company_name" value="{{ request('company_name') }}">
                                            <label class="form-label-outlined" for="title">Nama Perusahaan</label>
                                            @error('company_name')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg form-control-outlined @error('pic') is-invalid @enderror" id="pic" name="pic" value="{{ request('pic') }}">
                                            <label class="form-label-outlined" for="title">Person in Charge</label>
                                            @error('pic')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg form-control-outlined @error('address') is-invalid @enderror" id="address" name="address" value="{{ request('address') }}">
                                            <label class="form-label-outlined" for="title">Alamat Kantor</label>
                                            @error('address')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg form-control-outlined @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ request('phone') }}" onkeydown="validateNumber()">
                                            <label class="form-label-outlined" for="title">Nomor Telepon</label>
                                            @error('phone')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <input type="text" class="form-control form-control-lg form-control-outlined @error('email') is-invalid @enderror" id="email" name="email" value="{{ request('email') }}">
                                            <label class="form-label-outlined" for="title">Email</label>
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
                                            <input type="password" class="form-control form-control-lg form-control-outlined @error('password') is-invalid @enderror" id="password" name="password">
                                            <label class="form-label-outlined" for="password">Password</label>
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-lg btn-primary btn-block">Registrasi</button>
                                    </div>
                                </form>
                                <div class="form-note-s2 text-center pt-4"> Sudah punya akun ? Silahkan login <a href="/signin"><strong>disini</strong></a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!-- wrap @e -->
            </div>
            <!-- content @e -->
        </div>
        <!-- main @e -->
    </div>
    <!-- app-root @e -->
    <!-- JavaScript -->
    <script src="./assets/js/bundle.js?ver=3.1.0"></script>
    <script src="./assets/js/scripts.js?ver=3.1.0"></script>
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
    function validateNumber(evt) {
        var e = evt || window.event;
        var key = e.keyCode || e.which;

        if (!e.shiftKey && !e.altKey && !e.ctrlKey &&
            // numbers   
            key >= 48 && key <= 57 ||
            // Numeric keypad
            key >= 96 && key <= 105 ||
            // Backspace and Tab and Enter
            key == 8 || key == 9 || key == 13 ||
            // Home and End
            key == 35 || key == 36 ||
            // left and right arrows
            key == 37 || key == 39 ||
            // Del and Ins
            key == 46 || key == 45) {
            // input is VALID
        } else {
            e.returnValue = false;
            if (e.preventDefault) e.preventDefault();
        }
    }
    </script>
</html>