<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pijar Asa Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            width: 100%;
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .btn-bd-primary {
            --bd-violet-bg: #712cf9;
            --bd-violet-rgb: 112.520718, 44.062154, 249.437846;

            --bs-btn-font-weight: 600;
            --bs-btn-color: var(--bs-white);
            --bs-btn-bg: var(--bd-violet-bg);
            --bs-btn-border-color: var(--bd-violet-bg);
            --bs-btn-hover-color: var(--bs-white);
            --bs-btn-hover-bg: #6528e0;
            --bs-btn-hover-border-color: #6528e0;
            --bs-btn-focus-shadow-rgb: var(--bd-violet-rgb);
            --bs-btn-active-color: var(--bs-btn-hover-color);
            --bs-btn-active-bg: #5a23c8;
            --bs-btn-active-border-color: #5a23c8;
        }

        .bd-mode-toggle {
            z-index: 1500;
        }

        .bd-mode-toggle .dropdown-menu .active .bi {
            display: block !important;
        }
    </style>

</head>

<body>
    <div class="container mt-3">
        <div class="container">
            <main>
                @if (session()->has('register-fail'))
                    <div class="alert alert-danger" role="alert">
                        {{ session()->get('register-fail') }}
                    </div>
                @endif
                <div class="py-5 text-center">
                    <img class="d-block mx-auto mb-4" src="{{ asset('images/logo.png') }}" alt="" width="72"
                        height="57">
                    @if ($nameRoute === 'auth.register.student')
                        <h2>Registrasi Akun Murid</h2>
                    @else
                        <h2>Registrasi Akun Pengajar</h2>
                    @endif
                    <p class="lead">Isi data diri di bawah ini dengan data yang benar dan tepat..</p>
                </div>

                <div class="row g-5">
                    <div class="col-md-12 col-lg-12">
                        <form class="needs-validation" method="POST" action="{{ route('auth.register.store') }}">
                            @csrf
                            <div class="row g-3 mb-3">
                                <div class="col-sm-6">
                                    <label for="name" class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" name="name"
                                        placeholder="Ketik nama lengkap anda..." required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="email" class="form-label">Alamat Email</label>
                                    <input type="email" class="form-control" name="email"
                                        placeholder="Ketik email anda.." required>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender" class="form-label">Jenis Kelamin</label>
                                    <select class="form-select" name="gender" required>
                                        <option value="">Pilih Gender...</option>
                                        <option value="L">Laki-Laki</option>
                                        <option value="P">Perempuan</option>
                                    </select>
                                </div>
                                @if ($nameRoute === 'auth.register.student')
                                    <div class="col-md-6">
                                        <label for="nama_wali" class="form-label">Nama Orang Tua</label>
                                        <input type="text" class="form-control" name="nama_wali"
                                            placeholder="Ketik nama orang tua anda..." required>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="tempat_lahir" class="form-label">Tempat Lahir</label>
                                        <input type="text" class="form-control" name="tempat_lahir"
                                            placeholder="Ketik nama tempat lahir..." required>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                                        <input type="date" class="form-control" name="tanggal_lahir" required>
                                    </div>
                                @else
                                    <div class="col-md-6">
                                        <label for="mata_pelajaran" class="form-label">Mata Pelajaran</label>
                                        <input type="text" class="form-control" name="mata_pelajaran"
                                            placeholder="Ketik mata pelajaran..." required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="pendidikan_terakhir" class="form-label">Pendidikan Terakhir</label>
                                        <select class="form-select" name="pendidikan_terakhir" required>
                                            <option value="">Pilih jenjang...</option>
                                            <option value="SD">SD</option>
                                            <option value="SMP">SMP</option>
                                            <option value="SMA/SMK">SMA/SMK</option>
                                            <option value="D3">D3</option>
                                            <option value="D4/S1">D4/S1</option>
                                        </select>
                                    </div>
                                @endif
                                <div class="col-md-6">
                                    <label for="nomor_handphone" class="form-label">Nomor Handphone</label>
                                    <input type="number" class="form-control" name="nomor_handphone" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="alamat" class="form-label">Alamat Lengkap</label>
                                    <textarea class="form-control" name="alamat" required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="password" class="form-label">Password</label>
                                    <input class="form-control" type="password" name="password" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="password_confirm" class="form-label">Konfirmasi Password</label>
                                    <input class="form-control" type="password" name="password_confirm" required>
                                </div>
                                
                            </div>
                            <button class="w-25 btn btn-primary btn-md mb-3" type="submit">Registrasi</button>
                        </form>
                    </div>
                </div>
            </main>
        </div>
        <script src="/docs/5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
        </script>
        <script>
            $(".toggle-password").click(function() {

                $(this).toggleClass("fa-eye fa-eye-slash");
                var input = $($(this).attr("toggle"));
                if (input.attr("type") == "password") {
                    input.attr("type", "text");
                } else {
                    input.attr("type", "password");
                }
            });
        </script>
</body>

</html>
