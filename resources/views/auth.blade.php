<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Đăng nhập admin</title>
</head>

<body>
    @yield('auth')
</body>

<script>
    document.querySelector("#eyes").addEventListener("click", () => {

        if (document.querySelector("#eyes").classList.toggle('active')) {

            document.querySelector("#eyes").innerHTML = '<i class="fa-solid fa-eye"></i>';
            document.querySelector("input[type='password']").type = 'text';

        } else {
            document.querySelector("#eyes").innerHTML = '<i class="fa-solid fa-eye-slash"></i>';
            document.querySelector("input#password").type = 'password';


        }

    })
</script>

</html>
