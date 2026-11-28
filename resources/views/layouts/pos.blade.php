<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PayPoint POS')</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
        crossorigin="anonymous"
    >
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
        rel="stylesheet"
    >

    <style>
        :root {
            --tamaraw-emerald: #047857;
            --tamaraw-emerald-dark: #065F46;
            --tamaraw-emerald-deep: #034232;
            --tamaraw-gold: #D4AF37;
            --tamaraw-gold-hover: #C29D28;
            --tamaraw-bg: #F2F4F3;
            --tamaraw-pale-green: #E8F7F0;
            --tamaraw-slate: #111827;
            --tamaraw-muted: #4B5563;
            --tamaraw-border: #CFD8D3;
        }

        body {
            background-color: var(--tamaraw-bg);
            color: var(--tamaraw-slate);
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
        }

        .app-shell {
            min-height: 100vh;
        }

        .sidebar {
            width: 265px;
            background-color: #046C4E;
            color: #FFFFFF;
            flex-shrink: 0;
        }

        .sidebar-brand {
            border-bottom: 1px solid rgba(255, 255, 255, 0.14);
        }

        .bi {
            line-height: 1;
        }

        .brand-mark {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            background-color: var(--tamaraw-gold);
            color: var(--tamaraw-emerald-deep);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.15rem;
            font-weight: 700;
        }

        .brand-mark i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .sidebar-section-label {
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.78);
            padding: 0.75rem 1rem 0.35rem;
            font-weight: 600;
        }

        .sidebar .nav-link {
            color: rgba(255, 255, 255, 0.94);
            border-radius: 0.6rem;
            padding: 0.65rem 0.9rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .sidebar .nav-link i {
            width: 1.15rem;
            font-size: 1rem;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            opacity: 0.92;
            flex-shrink: 0;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #FFFFFF;
        }

        .sidebar .nav-link:hover i,
        .sidebar .nav-link.active i {
            opacity: 1;
        }

        .sidebar .nav-link.active {
            background-color: var(--tamaraw-pale-green);
            color: var(--tamaraw-emerald-deep);
            font-weight: 600;
            box-shadow: inset 4px 0 0 var(--tamaraw-gold);
        }

        .sidebar-footer {
            border-top: 1px solid rgba(255, 255, 255, 0.14);
            background-color: rgba(6, 95, 70, 0.55);
        }

        .topbar {
            background-color: #FFFFFF;
            border-bottom: 1px solid var(--tamaraw-border);
        }

        .btn-gold {
            background-color: var(--tamaraw-gold);
            border-color: #B89320;
            color: var(--tamaraw-emerald-deep);
            font-weight: 600;
        }

        .btn-gold:hover,
        .btn-gold:focus {
            background-color: var(--tamaraw-gold-hover);
            border-color: #A68218;
            color: var(--tamaraw-emerald-deep);
        }

        .btn-emerald {
            background-color: var(--tamaraw-emerald);
            border-color: var(--tamaraw-emerald);
            color: #FFFFFF;
            font-weight: 500;
        }

        .btn-emerald:hover,
        .btn-emerald:focus {
            background-color: var(--tamaraw-emerald-dark);
            border-color: var(--tamaraw-emerald-dark);
            color: #FFFFFF;
        }

        .btn-outline-emerald {
            border-color: var(--tamaraw-emerald);
            color: var(--tamaraw-emerald);
            font-weight: 500;
        }

        .btn-outline-emerald:hover,
        .btn-outline-emerald:focus {
            background-color: var(--tamaraw-pale-green);
            border-color: var(--tamaraw-emerald);
            color: var(--tamaraw-emerald-dark);
        }

        .welcome-banner {
            background: linear-gradient(135deg, #FFFFFF 0%, var(--tamaraw-pale-green) 100%);
            border: 1px solid #D1FAE5;
            border-radius: 0.9rem;
        }

        .pos-card {
            background-color: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 0.9rem;
            transition: transform 0.15s ease, box-shadow 0.15s ease, border-color 0.15s ease;
        }

        .pos-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 24px rgba(4, 120, 87, 0.08);
            border-color: var(--tamaraw-gold);
        }

        .pos-surface {
            background-color: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 0.9rem;
            overflow: hidden;
        }

        .pos-table thead th {
            background-color: #F5F5F5;
            color: var(--tamaraw-muted);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            border-bottom: 1px solid var(--tamaraw-border);
            padding: 0.85rem 1rem;
        }

        .pos-table tbody td {
            padding: 0.9rem 1rem;
            border-color: var(--tamaraw-border);
        }

        .pos-thumb {
            width: 56px;
            height: 56px;
            object-fit: cover;
            border-radius: 0.6rem;
            border: 1px solid var(--tamaraw-border);
            background-color: #F5F5F5;
        }

        .pos-thumb-empty {
            width: 56px;
            height: 56px;
            border-radius: 0.6rem;
            background-color: var(--tamaraw-pale-green);
            color: var(--tamaraw-emerald);
            border: 1px solid #D1FAE5;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
        }

        .icon-pill {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background-color: var(--tamaraw-pale-green);
            color: var(--tamaraw-emerald);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.35rem;
        }

        .icon-pill-gold {
            background-color: rgba(214, 183, 108, 0.22);
            color: #8A6B1C;
        }

        .avatar-circle {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: var(--tamaraw-gold);
            color: var(--tamaraw-emerald-deep);
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            overflow: hidden;
        }

        .avatar-circle img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .text-muted-slate {
            color: var(--tamaraw-muted);
        }

        .badge-tamaraw {
            background-color: var(--tamaraw-pale-green);
            color: var(--tamaraw-emerald-deep);
            border: 1px solid #8FD1B3;
            font-weight: 600;
        }

        .pagination .page-link {
            color: var(--tamaraw-emerald);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--tamaraw-emerald);
            border-color: var(--tamaraw-emerald);
            color: #FFFFFF;
        }

        /* ══════════════════════════════════════════
           Products pages — scoped to .prod-root
           and .prod-form-root
           ══════════════════════════════════════════ */

        /* Section label */
        .prod-section-label {
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: var(--tamaraw-muted);
            margin-bottom: 0.3rem;
        }

        .prod-page-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--tamaraw-slate);
            letter-spacing: -0.01em;
        }

        /* Primary add button */
        .prod-btn-primary {
            height: 38px;
            padding: 0 1.1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }

        /* ── Catalog panel ── */
        .prod-panel {
            background: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
        }

        .prod-panel-header {
            background-color: #F3F6F5;
            border-bottom: 1px solid var(--tamaraw-border);
            padding: 0.95rem 1.25rem;
        }

        .prod-icon-box {
            width: 32px;
            height: 32px;
            border-radius: 7px;
            background-color: var(--tamaraw-pale-green);
            border: 1px solid #8FCBB0;
            color: var(--tamaraw-emerald-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.95rem;
            flex-shrink: 0;
        }

        .prod-panel-title {
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--tamaraw-slate);
            line-height: 1.3;
        }

        .prod-panel-meta {
            font-size: 0.75rem;
            color: var(--tamaraw-muted);
            line-height: 1.3;
        }

        /* ── Table ── */
        .prod-table thead th {
            background-color: #F8FAFA;
            color: var(--tamaraw-muted);
            font-size: 0.72rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.055em;
            border-bottom: 1px solid var(--tamaraw-border);
            padding-top: 0.8rem;
            padding-bottom: 0.8rem;
            white-space: nowrap;
        }

        .prod-table tbody td {
            padding-top: 0.85rem;
            padding-bottom: 0.85rem;
            border-color: #EBF0ED;
            vertical-align: middle;
        }

        .prod-row:last-child td {
            border-bottom: none;
        }

        .prod-name {
            font-weight: 600;
            font-size: 0.875rem;
            color: var(--tamaraw-slate);
            line-height: 1.4;
        }

        .prod-price {
            font-weight: 600;
            font-size: 0.875rem;
            color: #1F2937;
            font-variant-numeric: tabular-nums;
        }

        /* ── Status badges ── */
        .prod-badge {
            display: inline-flex;
            align-items: center;
            font-size: 0.72rem;
            font-weight: 600;
            padding: 0.28rem 0.65rem;
            border-radius: 20px;
            letter-spacing: 0.01em;
            white-space: nowrap;
        }

        .prod-badge-success {
            background-color: var(--tamaraw-pale-green);
            color: var(--tamaraw-emerald-dark);
            border: 1px solid #8FD1B3;
        }

        .prod-badge-warning {
            background-color: #FFFBEB;
            color: #92400E;
            border: 1px solid #FCD34D;
        }

        .prod-badge-danger {
            background-color: #FEF2F2;
            color: #991B1B;
            border: 1px solid #FECACA;
        }

        /* ── Table action buttons ── */
        .prod-btn-secondary {
            height: 32px;
            padding: 0 0.75rem;
            font-size: 0.8rem;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 500;
        }

        .prod-btn-archive {
            height: 32px;
            padding: 0 0.75rem;
            font-size: 0.8rem;
            border-radius: 6px;
            border: 1px solid #FECACA;
            color: #991B1B;
            background: transparent;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            font-weight: 500;
            transition: background-color 0.15s ease, color 0.15s ease;
        }

        .prod-btn-archive:hover,
        .prod-btn-archive:focus {
            background-color: #FEF2F2;
            color: #7F1D1D;
            border-color: #FCA5A5;
        }

        /* ── Empty state ── */
        .prod-empty-state {
            text-align: center;
            padding: 3.5rem 1rem;
        }

        .prod-empty-icon {
            width: 56px;
            height: 56px;
            border-radius: 14px;
            background-color: var(--tamaraw-pale-green);
            border: 1px solid #8FCBB0;
            color: var(--tamaraw-emerald);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }

        .prod-empty-title {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--tamaraw-slate);
            margin-bottom: 0.4rem;
        }

        .prod-empty-desc {
            font-size: 0.8125rem;
            color: var(--tamaraw-muted);
        }

        /* ── Pagination footer ── */
        .prod-pagination-bar {
            background-color: #FAFCFB;
            border-top: 1px solid var(--tamaraw-border);
            padding: 0.75rem 1.25rem;
            display: flex;
            justify-content: flex-end;
        }

        /* ══ Form pages (create / edit) ══ */

        .prod-back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--tamaraw-emerald);
            text-decoration: none;
            transition: color 0.15s;
        }

        .prod-back-link:hover {
            color: var(--tamaraw-emerald-dark);
        }

        .prod-form-panel {
            background: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
        }

        .prod-form-panel-header {
            background-color: #F3F6F5;
            border-bottom: 1px solid var(--tamaraw-border);
            padding: 1rem 1.5rem;
        }

        .prod-form-icon-box {
            width: 36px;
            height: 36px;
            border-radius: 8px;
            background-color: var(--tamaraw-pale-green);
            border: 1px solid #8FCBB0;
            color: var(--tamaraw-emerald-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1rem;
            flex-shrink: 0;
        }

        .prod-form-panel-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--tamaraw-slate);
            line-height: 1.3;
        }

        .prod-form-panel-meta {
            font-size: 0.775rem;
            color: var(--tamaraw-muted);
            line-height: 1.3;
        }

        .prod-form-body {
            padding: 1.5rem;
        }

        /* ── Form fields ── */
        .prod-label {
            display: block;
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--tamaraw-slate);
            margin-bottom: 0.4rem;
            letter-spacing: 0.01em;
        }

        .prod-label-optional {
            font-size: 0.7rem;
            font-weight: 500;
            color: var(--tamaraw-muted);
            background: #F0F4F2;
            border: 1px solid var(--tamaraw-border);
            border-radius: 4px;
            padding: 0 0.35rem;
            margin-left: 0.4rem;
            vertical-align: middle;
            text-transform: lowercase;
            letter-spacing: 0;
        }

        .prod-input {
            font-size: 0.875rem;
            border-color: var(--tamaraw-border);
            color: var(--tamaraw-slate);
            border-radius: 6px;
        }

        .prod-input:focus {
            border-color: var(--tamaraw-emerald);
            box-shadow: 0 0 0 0.2rem rgba(4, 120, 87, 0.12);
            outline: none;
        }

        .prod-input-prefix {
            background-color: #F3F6F5;
            border: 1px solid var(--tamaraw-border);
            border-right: none;
            border-radius: 6px 0 0 6px;
            color: var(--tamaraw-muted);
            font-size: 0.875rem;
            font-weight: 600;
            padding: 0.375rem 0.6rem;
            display: flex;
            align-items: center;
        }

        .prod-input-addon {
            border-radius: 0 6px 6px 0;
        }

        .prod-hint {
            font-size: 0.75rem;
            color: var(--tamaraw-muted);
            margin-top: 0.3rem;
        }

        /* ── Current image preview ── */
        .prod-current-image {
            display: flex;
            align-items: center;
            gap: 0.9rem;
            padding: 0.75rem 1rem;
            background: #F8FAFA;
            border: 1px solid var(--tamaraw-border);
            border-radius: 8px;
        }

        .prod-image-preview {
            width: 72px;
            height: 72px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid var(--tamaraw-border);
            flex-shrink: 0;
        }

        .prod-current-image-title {
            font-size: 0.8125rem;
            font-weight: 600;
            color: var(--tamaraw-slate);
        }

        .prod-current-image-hint {
            font-size: 0.75rem;
            color: var(--tamaraw-muted);
            margin-top: 0.1rem;
        }

        /* ── Form footer buttons ── */
        .prod-form-footer {
            display: flex;
            justify-content: flex-end;
            gap: 0.65rem;
            padding-top: 1.25rem;
            margin-top: 1rem;
            border-top: 1px solid var(--tamaraw-border);
        }

        .prod-cancel-btn {
            height: 38px;
            padding: 0 1rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            border: 1px solid var(--tamaraw-border);
            color: var(--tamaraw-muted);
            background: #FFFFFF;
            display: inline-flex;
            align-items: center;
            transition: background-color 0.15s, color 0.15s;
        }

        .prod-cancel-btn:hover {
            background: #F3F6F5;
            color: var(--tamaraw-slate);
        }

        .prod-submit-btn {
            height: 38px;
            padding: 0 1.25rem;
            border-radius: 6px;
            font-size: 0.875rem;
            display: inline-flex;
            align-items: center;
            gap: 0.3rem;
        }
    </style>
</head>
<body>
    @php
        $currentUser = auth()->user();
        $initials = collect(explode(' ', trim($currentUser->full_name)))
            ->filter()
            ->take(2)
            ->map(fn ($part) => strtoupper(substr($part, 0, 1)))
            ->implode('');
        $hasAvatar = $currentUser->avatar && file_exists(public_path('storage/' . $currentUser->avatar));

        $navSections = [
            'Overview' => [
                ['route' => 'dashboard', 'pattern' => 'dashboard', 'icon' => 'bi-grid-1x2-fill', 'label' => 'Dashboard'],
            ],
            'Transactions' => [
                ['route' => 'sales.create', 'pattern' => 'sales.create', 'icon' => 'bi-cart-plus', 'label' => 'Record Sale'],
                ['route' => 'sales.index', 'pattern' => 'sales.index', 'icon' => 'bi-receipt', 'label' => 'Sales History'],
            ],
            'Management' => [
                ['route' => 'products.index', 'pattern' => 'products.*', 'icon' => 'bi-box-seam', 'label' => 'Products'],
                ['route' => 'customers.index', 'pattern' => 'customers.*', 'icon' => 'bi-people', 'label' => 'Customers'],
                ['route' => 'staff.index', 'pattern' => 'staff.*', 'icon' => 'bi-person-badge', 'label' => 'Staff'],
            ],
        ];
    @endphp

    <div class="d-flex app-shell">
        {{-- Desktop Sidebar --}}
        <aside class="sidebar d-none d-lg-flex flex-column">
            <div class="sidebar-brand p-3 d-flex align-items-center gap-3">
                <span class="brand-mark">
                    <i class="bi bi-shop"></i>
                </span>
                <div>
                    <div class="fw-bold fs-6 lh-sm">PayPoint</div>
                    <small class="text-white-50">POS Management</small>
                </div>
            </div>

            <div class="p-3 flex-grow-1">
                @foreach ($navSections as $sectionLabel => $items)
                    <div class="sidebar-section-label {{ !$loop->first ? 'mt-2' : '' }}">{{ $sectionLabel }}</div>
                    <ul class="nav flex-column gap-1">
                        @foreach ($items as $item)
                            <li class="nav-item">
                                <a
                                    href="{{ route($item['route']) }}"
                                    class="nav-link {{ request()->routeIs($item['pattern']) ? 'active' : '' }}"
                                >
                                    <i class="bi {{ $item['icon'] }}"></i>
                                    <span>{{ $item['label'] }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endforeach
            </div>

            <div class="sidebar-footer p-3">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <span class="avatar-circle">
                        @if ($hasAvatar)
                            <img src="{{ asset('storage/' . $currentUser->avatar) }}" alt="{{ $currentUser->full_name }}">
                        @else
                            {{ $initials ?: 'U' }}
                        @endif
                    </span>
                    <div class="overflow-hidden">
                        <div class="fw-semibold text-truncate small">{{ $currentUser->full_name }}</div>
                        <div class="text-white-50 text-truncate" style="font-size: 0.75rem;">{{ '@' . $currentUser->username }}</div>
                    </div>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-gold btn-sm w-100">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </button>
                </form>
            </div>
        </aside>

        {{-- Mobile Offcanvas Sidebar --}}
        <div class="offcanvas offcanvas-start sidebar d-lg-none" tabindex="-1" id="mobileSidebar" aria-labelledby="mobileSidebarLabel">
            <div class="offcanvas-header sidebar-brand">
                <div class="d-flex align-items-center gap-3" id="mobileSidebarLabel">
                    <span class="brand-mark">
                        <i class="bi bi-shop"></i>
                    </span>
                    <div>
                        <div class="fw-bold fs-6 lh-sm text-white">PayPoint</div>
                        <small class="text-white-50">POS Management</small>
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column p-3">
                <div class="flex-grow-1">
                    @foreach ($navSections as $sectionLabel => $items)
                        <div class="sidebar-section-label {{ !$loop->first ? 'mt-2' : '' }}">{{ $sectionLabel }}</div>
                        <ul class="nav flex-column gap-1">
                            @foreach ($items as $item)
                                <li class="nav-item">
                                    <a
                                        href="{{ route($item['route']) }}"
                                        class="nav-link {{ request()->routeIs($item['pattern']) ? 'active' : '' }}"
                                    >
                                        <i class="bi {{ $item['icon'] }}"></i>
                                        <span>{{ $item['label'] }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endforeach
                </div>

                <div class="sidebar-footer p-3 rounded mt-3">
                    <div class="d-flex align-items-center gap-2 mb-3">
                        <span class="avatar-circle">
                            @if ($hasAvatar)
                                <img src="{{ asset('storage/' . $currentUser->avatar) }}" alt="{{ $currentUser->full_name }}">
                            @else
                                {{ $initials ?: 'U' }}
                            @endif
                        </span>
                        <div class="overflow-hidden">
                            <div class="fw-semibold text-truncate small text-white">{{ $currentUser->full_name }}</div>
                            <div class="text-white-50 text-truncate" style="font-size: 0.75rem;">{{ '@' . $currentUser->username }}</div>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-gold btn-sm w-100">
                            <i class="bi bi-box-arrow-right me-1"></i> Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Main Workspace --}}
        <div class="flex-grow-1 d-flex flex-column min-w-0">
            <header class="topbar px-4 py-3 d-flex align-items-center justify-content-between gap-3">
                <div class="d-flex align-items-center gap-3">
                    <button
                        class="btn btn-outline-emerald btn-sm d-lg-none"
                        type="button"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#mobileSidebar"
                        aria-controls="mobileSidebar"
                    >
                        <i class="bi bi-list fs-5"></i>
                    </button>
                    <div>
                        <h1 class="h5 mb-0 fw-bold">@yield('page_title', 'POS Dashboard')</h1>
                        <small class="text-muted-slate">@yield('page_subtitle', 'PayPoint Control Center')</small>
                    </div>
                </div>

                <div class="d-flex align-items-center gap-2">
                    <span class="badge badge-tamaraw px-3 py-2 d-inline-flex align-items-center gap-1">
                        <i class="bi bi-person-check"></i>
                        <span>{{ $currentUser->full_name }}</span>
                    </span>
                </div>
            </header>

            <main class="p-4 container-fluid" style="max-width: 1200px;">
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="mb-0 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"
    ></script>
</body>
</html>
