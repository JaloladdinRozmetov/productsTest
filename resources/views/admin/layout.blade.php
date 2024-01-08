<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Products')</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset("css/product.css")}}">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<style>
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }

    body {
        background-color: #F2F6FA;
    }

    #admin-container {
        display: flex;
        height: 100%;
    }

    #sidebar {
        background-color: #374050;
        color: #ffffff;
        min-width: 200px;
    }

    #sidebar img {
        max-width: 100%;
        height: auto;
        margin-bottom: 20px;
    }

    #sidebar ul {
        list-style: none;
        padding: 0;
    }

    #sidebar li {
        padding: 10px;
    }

    #sidebar a {
        color: rgba(255, 255, 255, 0.70);
        text-decoration: none;
        font-family: Roboto;
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        line-height: 11px; /* 91.667% */
    }

    #content {
        flex: 1;
    }

    #header {
        background-color: #ffffff;
        padding: 10px;
        border-bottom: 1px solid #ccc;
        display: flex;
        justify-content: space-between;
    }
    #header h2 {
        color: red;
    }

</style>
<body>

<div id="admin-container">

    <!-- Sidebar -->
    <nav id="sidebar">
        <img src="your-logo-image-url.jpg" alt="Logo">
        <ul>
            @auth()
            <li><a href="{{route('products.index')}}">Продукты</a></li>
            @endauth
        </ul>
    </nav>

    <div id="content">

        <!-- Header -->
        <div id="header">
            <div>
                @auth()
                <h2>Продукты</h2>
                    @endauth
            </div>
            <div>
                <ul class="navbar-nav ms-auto">
                    @guest
                    @else
                        <li class="nav-item">
                            <a class="nav-link text-secondary" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->name }}
                            </a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>

        @yield('content')


    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>
