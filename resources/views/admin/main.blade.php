<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>In Advance</title>
    <link type="text/css" rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
<div class="container">
    <!--navigation-->
    @include('admin.templates.navbar')
    <!--main-->

    @yield('content')

</div>
<script src="/assets/js/jquery.min.js"></script>
<script src="/assets/js/jquery.mask.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<script>
    // MenuToggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function () {
        navigation.classList.toggle('active')
        main.classList.toggle('active')
    }
</script>
@yield('js')
</body>
</html>
