@extends('layouts.pos')

@section('title', 'POS Dashboard — PayPoint')
@section('page_title', 'POS Dashboard')
@section('page_subtitle', 'PayPoint Control Center')

@section('content')
    @php
        $currentUser = auth()->user();
    @endphp

    <style>
        /* Isolated dashboard composition & surface system */
        main.container-fluid:has(> .dash-root) {
            max-width: 1320px !important;
            margin-left: 0;
            padding: 28px 32px 36px !important;
        }

        .dash-root {
            display: flex;
            flex-direction: column;
            gap: 24px;
        }

        /* 1. Welcome Introduction */
        .dash-root .dash-intro {
            padding-bottom: 16px;
            border-bottom: 1px solid var(--tamaraw-border);
        }

        .dash-root .dash-title {
            font-size: 1.4375rem; /* 23px */
            font-weight: 600;
            line-height: 1.3;
            letter-spacing: -0.015em;
            color: var(--tamaraw-slate);
            margin-bottom: 4px;
        }

        .dash-root .dash-subtitle {
            font-size: 0.875rem; /* 14px */
            font-weight: 400;
            line-height: 1.5;
            color: var(--tamaraw-muted);
            margin-bottom: 0;
            max-width: 68ch;
        }

        .dash-root .dash-section-label {
            font-size: 0.75rem; /* 12px */
            font-weight: 600;
            line-height: 1.4;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            color: var(--tamaraw-muted);
            margin-bottom: 10px;
        }

        /* 2. Primary Operations Area (Asymmetrical 68% / 32% Split) */
        .dash-root .dash-ops-grid {
            display: grid;
            grid-template-columns: minmax(0, 68fr) minmax(260px, 32fr);
            gap: 20px;
            align-items: stretch;
        }

        .dash-root .dash-primary-op {
            background-color: var(--tamaraw-pale-green);
            border: 1px solid #8FCBB0;
            border-top: 3px solid var(--tamaraw-emerald);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .dash-root .dash-primary-body {
            padding: 20px 24px 18px;
        }

        .dash-root .dash-primary-header {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 10px;
        }

        .dash-root .dash-primary-icon {
            width: 28px;
            height: 28px;
            border-radius: 5px;
            background-color: #FFFFFF;
            border: 1px solid #8FCBB0;
            color: var(--tamaraw-emerald-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.9rem;
            flex-shrink: 0;
        }

        .dash-root .dash-primary-kicker {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--tamaraw-emerald-dark);
        }

        .dash-root .dash-primary-title {
            font-size: 1.25rem; /* 20px */
            font-weight: 600;
            line-height: 1.3;
            color: var(--tamaraw-slate);
            margin-bottom: 6px;
        }

        .dash-root .dash-primary-desc {
            font-size: 0.875rem;
            line-height: 1.55;
            color: #1F2937;
            margin-bottom: 0;
            max-width: 56ch;
        }

        .dash-root .dash-primary-footer {
            background-color: #FFFFFF;
            border-top: 1px solid #A8D9C3;
            padding: 14px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
        }

        .dash-root .dash-btn-primary {
            height: 38px;
            padding: 0 20px;
            border-radius: 6px;
            font-size: 0.84375rem; /* 13.5px */
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: background-color 150ms ease, border-color 150ms ease;
        }

        .dash-root .dash-secondary-op {
            background-color: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden;
        }

        .dash-root .dash-secondary-header {
            background-color: #E9ECEA;
            border-bottom: 1px solid var(--tamaraw-border);
            padding: 12px 20px;
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 0.90625rem; /* 14.5px */
            font-weight: 600;
            line-height: 1.35;
            color: var(--tamaraw-slate);
            margin-bottom: 0;
        }

        .dash-root .dash-icon-box {
            width: 26px;
            height: 26px;
            border-radius: 5px;
            background-color: var(--tamaraw-pale-green);
            border: 1px solid #8FCBB0;
            color: var(--tamaraw-emerald-dark);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 0.85rem;
            flex-shrink: 0;
        }

        .dash-root .dash-icon-box i,
        .dash-root .dash-primary-icon i,
        .dash-root .dash-btn-primary i,
        .dash-root .dash-btn-secondary i {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            line-height: 1;
        }

        .dash-root .dash-secondary-body {
            padding: 16px 20px;
            flex-grow: 1;
        }

        .dash-root .dash-secondary-desc {
            font-size: 0.8125rem; /* 13px */
            line-height: 1.55;
            color: var(--tamaraw-muted);
            margin-bottom: 0;
        }

        .dash-root .dash-secondary-footer {
            padding: 14px 20px;
            border-top: 1px solid var(--tamaraw-border);
            background-color: var(--tamaraw-bg);
            display: flex;
            align-items: center;
        }

        .dash-root .dash-secondary-footer .dash-btn-secondary {
            width: 100%;
            justify-content: space-between;
        }

        /* 3. Management Area (Unified 3-Column Enterprise Strip) */
        .dash-root .dash-mgmt-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            background-color: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            overflow: hidden;
        }

        .dash-root .dash-mgmt-col {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: background-color 150ms ease;
        }

        .dash-root .dash-mgmt-col:hover {
            background-color: #F8FAF9;
        }

        .dash-root .dash-mgmt-col + .dash-mgmt-col {
            border-left: 1px solid var(--tamaraw-border);
        }

        .dash-root .dash-mgmt-header {
            padding: 12px 20px;
            background-color: #E9ECEA;
            border-bottom: 1px solid var(--tamaraw-border);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dash-root .dash-mgmt-title {
            font-size: 0.90625rem; /* 14.5px */
            font-weight: 600;
            line-height: 1.35;
            color: var(--tamaraw-slate);
            margin: 0;
        }

        .dash-root .dash-mgmt-body {
            padding: 16px 20px;
            flex-grow: 1;
        }

        .dash-root .dash-mgmt-desc {
            font-size: 0.8125rem; /* 13px */
            line-height: 1.5;
            color: var(--tamaraw-muted);
            margin-bottom: 0;
        }

        .dash-root .dash-mgmt-footer {
            padding: 0 20px 18px;
        }

        .dash-root .dash-btn-secondary {
            height: 35px;
            padding: 0 14px;
            border-radius: 6px;
            font-size: 0.8125rem; /* 13px */
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background-color: #FFFFFF;
            transition: background-color 150ms ease, border-color 150ms ease, color 150ms ease;
        }

        .dash-root .dash-chevron {
            font-size: 0.72rem;
            opacity: 0.72;
            transition: transform 150ms ease, opacity 150ms ease;
        }

        .dash-root .dash-btn-secondary:hover .dash-chevron {
            transform: translateX(2px);
            opacity: 1;
        }

        /* 4. Staff Session (Compact Secondary Strip Below Workspace) */
        .dash-root .dash-session-bar {
            background-color: #FFFFFF;
            border: 1px solid var(--tamaraw-border);
            border-radius: 6px;
            box-shadow: 0 1px 3px rgba(15, 23, 42, 0.06);
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
        }

        .dash-root .dash-session-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 12px 28px;
            margin: 0;
            padding: 0;
        }

        .dash-root .dash-session-item {
            display: flex;
            align-items: baseline;
            gap: 8px;
        }

        .dash-root .dash-session-item + .dash-session-item {
            padding-left: 28px;
            border-left: 1px solid var(--tamaraw-border);
        }

        .dash-root .dash-session-label {
            font-size: 0.78125rem; /* 12.5px */
            font-weight: 400;
            color: var(--tamaraw-muted);
            margin: 0;
        }

        .dash-root .dash-session-value {
            font-size: 0.8125rem; /* 13px */
            font-weight: 500;
            color: var(--tamaraw-slate);
            margin: 0;
            word-break: break-word;
        }

        .dash-root .dash-signout-btn {
            height: 34px;
            padding: 0 16px;
            border-radius: 6px;
            font-size: 0.8125rem;
            font-weight: 500;
            color: var(--tamaraw-slate);
            background-color: #FFFFFF;
            border: 1px solid #9CA3AF;
            white-space: nowrap;
            transition: background-color 150ms ease, border-color 150ms ease;
        }

        .dash-root .dash-signout-btn:hover {
            background-color: #E5E7EB;
            border-color: #6B7280;
            color: var(--tamaraw-slate);
        }

        .dash-root .dash-btn-primary:focus-visible,
        .dash-root .dash-btn-secondary:focus-visible,
        .dash-root .dash-signout-btn:focus-visible {
            outline: 2px solid var(--tamaraw-emerald);
            outline-offset: 2px;
            box-shadow: none;
        }

        /* Responsive Breakpoints */
        @media (max-width: 991.98px) {
            main.container-fluid:has(> .dash-root) {
                padding: 24px 20px 32px !important;
            }

            .dash-root {
                gap: 22px;
            }

            .dash-root .dash-ops-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .dash-root .dash-mgmt-grid {
                grid-template-columns: minmax(0, 1fr);
            }

            .dash-root .dash-mgmt-col + .dash-mgmt-col {
                border-left: 0;
                border-top: 1px solid var(--tamaraw-border);
            }

            .dash-root .dash-session-bar {
                flex-direction: column;
                align-items: stretch;
                gap: 16px;
            }

            .dash-root .dash-session-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .dash-root .dash-session-item {
                width: 100%;
                justify-content: space-between;
            }

            .dash-root .dash-session-item + .dash-session-item {
                padding-left: 0;
                padding-top: 10px;
                border-left: 0;
                border-top: 1px solid var(--tamaraw-border);
            }

            .dash-root .dash-signout-btn {
                width: 100%;
            }
        }

        @media (max-width: 575.98px) {
            main.container-fluid:has(> .dash-root) {
                padding: 20px 16px 28px !important;
            }

            .dash-root .dash-primary-body,
            .dash-root .dash-primary-footer {
                padding-left: 16px;
                padding-right: 16px;
            }

            .dash-root .dash-btn-primary,
            .dash-root .dash-mgmt-footer .dash-btn-secondary {
                width: 100%;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .dash-root .dash-btn-primary,
            .dash-root .dash-btn-secondary,
            .dash-root .dash-mgmt-col,
            .dash-root .dash-signout-btn {
                transition: none;
            }
        }
    </style>

    <div class="dash-root">
        {{-- 1. Welcome Introduction --}}
        <section class="dash-intro" aria-label="Dashboard introduction">
            <h2 class="dash-title">Welcome, {{ $currentUser->full_name }}.</h2>
            <p class="dash-subtitle">
                Manage inventory, customer records, staff accounts, and point-of-sale transactions from one workspace.
            </p>
        </section>

        {{-- 2. Primary Operations Area --}}
        <section aria-labelledby="dash-transactions-heading">
            <h3 id="dash-transactions-heading" class="dash-section-label">Transactions</h3>

            <div class="dash-ops-grid">
                <div class="dash-primary-op">
                    <div class="dash-primary-body">
                        <div class="dash-primary-header">
                            <span class="dash-primary-icon" aria-hidden="true">
                                <i class="bi bi-cash-stack"></i>
                            </span>
                            <span class="dash-primary-kicker">Point of Sale</span>
                        </div>
                        <h4 class="dash-primary-title">Record Sale</h4>
                        <p class="dash-primary-desc">
                            Process a customer transaction, calculate totals automatically, and update product stock.
                        </p>
                    </div>

                    <div class="dash-primary-footer">
                        <a href="{{ route('sales.create') }}" class="btn btn-gold dash-btn-primary">
                            <i class="bi bi-cart-plus"></i>
                            <span>Open Register</span>
                        </a>
                    </div>
                </div>

                <div class="dash-secondary-op">
                    <div>
                        <h4 class="dash-secondary-header">
                            <span class="dash-icon-box" aria-hidden="true">
                                <i class="bi bi-receipt"></i>
                            </span>
                            <span>Sales History</span>
                        </h4>
                        <div class="dash-secondary-body">
                            <p class="dash-secondary-desc">
                                Review completed sales, sold quantities, customers, assigned staff, and timestamps.
                            </p>
                        </div>
                    </div>

                    <div class="dash-secondary-footer">
                        <a href="{{ route('sales.index') }}" class="btn btn-outline-emerald dash-btn-secondary">
                            <span>View Sales</span>
                            <i class="bi bi-chevron-right dash-chevron"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 3. Management Area --}}
        <section aria-labelledby="dash-management-heading">
            <h3 id="dash-management-heading" class="dash-section-label">Management</h3>

            <div class="dash-mgmt-grid">
                <div class="dash-mgmt-col">
                    <div>
                        <div class="dash-mgmt-header">
                            <span class="dash-icon-box" aria-hidden="true">
                                <i class="bi bi-box-seam"></i>
                            </span>
                            <h4 class="dash-mgmt-title">Manage Products</h4>
                        </div>
                        <div class="dash-mgmt-body">
                            <p class="dash-mgmt-desc">
                                Add, edit, or archive catalog items, adjust pricing, and monitor available stock.
                            </p>
                        </div>
                    </div>
                    <div class="dash-mgmt-footer">
                        <a href="{{ route('products.index') }}" class="btn btn-outline-emerald dash-btn-secondary">
                            <span>Go to Products</span>
                            <i class="bi bi-chevron-right dash-chevron"></i>
                        </a>
                    </div>
                </div>

                <div class="dash-mgmt-col">
                    <div>
                        <div class="dash-mgmt-header">
                            <span class="dash-icon-box" aria-hidden="true">
                                <i class="bi bi-people"></i>
                            </span>
                            <h4 class="dash-mgmt-title">Manage Customers</h4>
                        </div>
                        <div class="dash-mgmt-body">
                            <p class="dash-mgmt-desc">
                                Maintain customer profiles, email addresses, and phone numbers for checkout tracking.
                            </p>
                        </div>
                    </div>
                    <div class="dash-mgmt-footer">
                        <a href="{{ route('customers.index') }}" class="btn btn-outline-emerald dash-btn-secondary">
                            <span>Go to Customers</span>
                            <i class="bi bi-chevron-right dash-chevron"></i>
                        </a>
                    </div>
                </div>

                <div class="dash-mgmt-col">
                    <div>
                        <div class="dash-mgmt-header">
                            <span class="dash-icon-box" aria-hidden="true">
                                <i class="bi bi-person-badge"></i>
                            </span>
                            <h4 class="dash-mgmt-title">Manage Staff</h4>
                        </div>
                        <div class="dash-mgmt-body">
                            <p class="dash-mgmt-desc">
                                Add or update staff accounts, profile avatars, and login credentials.
                            </p>
                        </div>
                    </div>
                    <div class="dash-mgmt-footer">
                        <a href="{{ route('staff.index') }}" class="btn btn-outline-emerald dash-btn-secondary">
                            <span>Go to Staff</span>
                            <i class="bi bi-chevron-right dash-chevron"></i>
                        </a>
                    </div>
                </div>
            </div>
        </section>

        {{-- 4. Staff Session --}}
        <section aria-labelledby="dash-session-heading">
            <h3 id="dash-session-heading" class="dash-section-label">Staff Session</h3>

            <div class="dash-session-bar">
                <dl class="dash-session-meta">
                    <div class="dash-session-item">
                        <dt class="dash-session-label">Name</dt>
                        <dd class="dash-session-value">{{ $currentUser->full_name }}</dd>
                    </div>

                    <div class="dash-session-item">
                        <dt class="dash-session-label">Username</dt>
                        <dd class="dash-session-value">{{ $currentUser->username }}</dd>
                    </div>

                    <div class="dash-session-item">
                        <dt class="dash-session-label">Email</dt>
                        <dd class="dash-session-value">{{ $currentUser->email }}</dd>
                    </div>
                </dl>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn dash-signout-btn">
                        Sign Out
                    </button>
                </form>
            </div>
        </section>
    </div>
@endsection
