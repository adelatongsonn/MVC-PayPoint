<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>PayPoint Staff Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        :root {
            --emerald: #087f5b;
            --dark-emerald: #075c43;
            --gold: #dbb52f;
            --light-bg: #f5f7f6;
            --text: #172033;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            background: var(--light-bg);
            font-family: Arial, sans-serif;
            color: var(--text);
        }

        .login-page {
            min-height: 100vh;
            display: flex;
        }

        .login-brand {
            width: 52%;
            min-height: 100vh;
            padding: 80px 10%;
            color: white;
            background:
                radial-gradient(circle at 20% 25%, rgba(219, 181, 47, .22), transparent 22%),
                linear-gradient(145deg, #075c43, #087f5b 60%, #064936);
            position: relative;
            overflow: hidden;
        }

        .login-brand::before,
        .login-brand::after {
            content: "";
            position: absolute;
            border: 2px solid rgba(219, 181, 47, .35);
            border-radius: 50%;
        }

        .login-brand::before {
            width: 420px;
            height: 420px;
            right: -180px;
            top: 80px;
        }

        .login-brand::after {
            width: 260px;
            height: 260px;
            left: -120px;
            bottom: 70px;
        }

        .brand-content {
            position: relative;
            z-index: 1;
            max-width: 520px;
        }

        .brand-icon {
            width: 64px;
            height: 64px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 28px;
            border-radius: 16px;
            background: var(--gold);
            color: #173b2e;
            font-size: 30px;
        }

        .brand-name {
            margin: 0;
            font-size: 34px;
            font-weight: 700;
        }

        .brand-subtitle {
            margin-top: 8px;
            color: #cce9dd;
            font-size: 18px;
        }

        .brand-heading {
            margin-top: 110px;
            font-size: clamp(42px, 5vw, 72px);
            line-height: 1.05;
            font-weight: 700;
        }

        .brand-description {
            max-width: 500px;
            margin-top: 28px;
            color: #d9f2e7;
            font-size: 20px;
            line-height: 1.6;
        }

        .login-panel {
            width: 48%;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 8%;
            background: white;
        }

        .login-form-wrapper {
            width: 100%;
            max-width: 500px;
        }

        .login-title {
            margin-bottom: 8px;
            font-size: 42px;
            font-weight: 700;
        }

        .login-subtitle {
            margin-top: 20px;
            margin-bottom: 42px;
            color: #667085;
            font-size: 18px;
        }

        .form-label {
            margin-bottom: 8px;
            font-weight: 600;
        }

        .form-control {
            min-height: 54px;
            border: 1px solid #cfd8d3;
            border-radius: 8px;
            padding: 12px 15px;
            font-size: 16px;
        }

        .form-control:focus {
            border-color: var(--emerald);
            box-shadow: 0 0 0 3px rgba(8, 127, 91, .12);
        }

        .login-button {
            width: 58%;
            min-height: 54px;
            margin-top: 16px;
            border: 0;
            border-radius: 28px;
            background: var(--emerald);
            color: white;
            font-size: 18px;
            font-weight: 700;
        }

        .login-button:hover {
            background: var(--dark-emerald);
        }

        .login-footer {
            margin-top: 70px;
            padding: 24px;
            background: #f3f5f4;
            color: #667085;
            text-align: center;
        }

        .login-footer strong {
            color: var(--emerald);
        }

        @media (max-width: 900px) {
            .login-page {
                display: block;
            }

            .login-brand,
            .login-panel {
                width: 100%;
                min-height: auto;
            }

            .login-brand {
                padding: 48px 30px;
            }

            .brand-heading {
                margin-top: 50px;
                font-size: 46px;
            }

            .login-panel {
                padding: 55px 30px;
            }

            .back-link {
                margin-bottom: 45px;
            }

            .login-button {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <main class="login-page">

        <section class="login-brand">
            <div class="brand-content">
                <div class="brand-icon">
                    <i class="bi bi-shop"></i>
                </div>

                <h1 class="brand-name">PayPoint</h1>
                <p class="brand-subtitle">POS Management System</p>

                <h2 class="brand-heading">
                    Manage Your<br>
                    Business Better
                </h2>

                <p class="brand-description">
                    A simple and reliable point-of-sale system for managing
                    products, customers, staff, and sales transactions.
                </p>
            </div>
        </section>

        <section class="login-panel">
            <div class="login-form-wrapper">

                <h2 class="login-title">Welcome!</h2>

                <p class="login-subtitle">
                    Please login to your staff account.
                </p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login.store') }}">
                    @csrf

                    <div class="mb-4">
                        <label for="username" class="form-label">
                            Username
                        </label>

                        <input
                            type="text"
                            id="username"
                            name="username"
                            value="{{ old('username') }}"
                            class="form-control"
                            required
                            autofocus
                        >
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">
                            Password
                        </label>

                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            required
                        >
                    </div>

                    <button type="submit" class="login-button">
                        Login
                    </button>
                </form>

                <div class="login-footer">
                    PayPoint <strong>POS Management System</strong>
                </div>

            </div>
        </section>

    </main>
</body>
</html>