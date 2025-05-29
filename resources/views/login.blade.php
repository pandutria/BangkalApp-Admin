<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bangkal App</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="/assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="/assets/css/sb-admin-2.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</head>

@php
    if (isset($_POST['submit'])) {
        
    }
@endphp

<body class="bodyPrimary">

    <div class="container flex-column d-flex justify-content-center align-items-center" style="height: 100vh;">

        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <div class="row justify-content-center align-items-center">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                                <img class="w-100 h-auto img-fluid my-auto" src="{{ asset('./image/login.jpg') }}" alt="">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang Kembali!</h1>
                                    </div>
                                    <form class="user">
                                        <div class="form-group mb-4">
                                            <input type="text" class="form-control form-control-user"
                                                id="inputName" aria-describedby="emailHelp"
                                                placeholder="Masukkan Nama Pengguna..." name="username">
                                        </div>
                                        <div class="form-group mb-4">
                                            <input type="password" class="form-control form-control-user"
                                                id="inputPassword" placeholder="Masukkan Kata Sandi..." name="password">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" id="submitBtn">Masuk</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
    <script src="/assets/vendor/jquery/jquery.min.js"></script>
    <script src="/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="/assets/js/sb-admin-2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        const submitBtn = document.getElementById('submitBtn');        
        submitBtn.addEventListener('click', function(e) {
            e.preventDefault();
            const inputName = document.getElementById('inputName').value;
            const inputPassword = document.getElementById('inputPassword').value;

            async function HandleSubmit() {
                try {
                    const response = await axios.post('/api/login', {
                        username: inputName,
                        password: inputPassword
                    });

                    const dataUser = {
                        token: response.data.token,
                        name:response.data.user.fullname
                    }

                    localStorage.setItem('data', JSON.stringify(dataUser));
                    Swal.fire({
                        title: 'Login Berhasil',
                        icon: 'success'
                    });

                    setTimeout(() => {
                        window.location.href = '/dashboard';
                    }, 3000);
                } catch (error) {
                    Swal.fire({
                        title: 'Nama Pengguna/Password Salah!',
                        icon: 'error'
                    });
                    console.error(error)
                }
            }

            HandleSubmit();
        });
    </script>
</body>
</html>