<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $title ?? 'POS System' }}</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        nav {
            margin-bottom: 30px;
        }

        nav a {
            margin-right: 15px;
        }

        table {
            border-collapse: collapse;
            margin-top: 20px;
            width: 100%;
        }

        th {
            background: #eeeeee;
        }

        th,
        td {
            padding: 8px;
        }

        input,
        select {
            padding: 6px;
            min-width: 250px;
        }

        button {
            padding: 7px 12px;
            cursor: pointer;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>
    @auth
        <nav>
            <a href="{{ route('dashboard') }}">Dashboard</a>
            <a href="{{ route('products.index') }}">Products</a>
            <a href="{{ route('customers.index') }}">Customers</a>
            <a href="{{ route('staff.index') }}">Staff</a>
            <a href="{{ route('sales.create') }}">Record Sale</a>
            <a href="{{ route('sales.index') }}">Sales History</a>

            <form
                method="POST"
                action="{{ route('logout') }}"
                style="display:inline"
            >
                @csrf
                <button type="submit">Logout</button>
            </form>
        </nav>
    @endauth

    @if (session('success'))
        <p class="success">{{ session('success') }}</p>
    @endif

    @if ($errors->any())
        <ul class="error">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    @yield('content')
</body>
</html>