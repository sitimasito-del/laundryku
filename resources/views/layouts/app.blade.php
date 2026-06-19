<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Laundryku')</title>
    <style>
        :root {
            font-family: Inter, ui-sans-serif, system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", sans-serif;
            color: #172026;
            background: #f4f6f8;
        }

        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; background: #f4f6f8; }
        a { color: inherit; text-decoration: none; }
        button, input, select { font: inherit; }
        .shell { display: grid; grid-template-columns: 248px 1fr; min-height: 100vh; }
        .sidebar { background: #172026; color: #f8fafc; padding: 24px; }
        .brand { display: block; font-size: 26px; font-weight: 800; margin-bottom: 28px; }
        .nav { display: grid; gap: 8px; }
        .nav a { padding: 12px 14px; border-radius: 8px; color: #cbd5e1; }
        .nav a.active, .nav a:hover { background: #24313a; color: #ffffff; }
        .main { padding: 28px; }
        .topbar { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        h1 { margin: 0; font-size: 30px; line-height: 1.1; }
        .muted { color: #64748b; }
        .grid { display: grid; gap: 16px; }
        .stats { grid-template-columns: repeat(4, minmax(0, 1fr)); margin-bottom: 22px; }
        .card { background: #ffffff; border: 1px solid #dbe1e8; border-radius: 8px; padding: 18px; }
        .stat-label { color: #64748b; font-size: 14px; margin-bottom: 8px; }
        .stat-value { font-size: 28px; font-weight: 800; }
        .toolbar { display: flex; align-items: center; justify-content: space-between; gap: 12px; margin-bottom: 16px; }
        .filters { display: flex; gap: 10px; flex-wrap: wrap; }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: 8px; min-height: 40px; padding: 9px 14px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #172026; font-weight: 700; cursor: pointer; }
        .btn.primary { background: #0f766e; border-color: #0f766e; color: #ffffff; }
        .btn.danger { background: #b91c1c; border-color: #b91c1c; color: #ffffff; }
        .btn.small { min-height: 34px; padding: 6px 10px; font-size: 14px; }
        .table-wrap { overflow-x: auto; background: #ffffff; border: 1px solid #dbe1e8; border-radius: 8px; }
        table { width: 100%; border-collapse: collapse; min-width: 780px; }
        th, td { padding: 14px 16px; border-bottom: 1px solid #e5eaf0; text-align: left; vertical-align: top; }
        th { color: #64748b; font-size: 13px; text-transform: uppercase; letter-spacing: .04em; background: #f8fafc; }
        tr:last-child td { border-bottom: 0; }
        .actions { display: flex; gap: 8px; flex-wrap: wrap; }
        .badge { display: inline-flex; padding: 5px 9px; border-radius: 999px; background: #e6fffb; color: #0f766e; font-size: 13px; font-weight: 800; }
        .badge.gray { background: #eef2f7; color: #475569; }
        .badge.orange { background: #fff7ed; color: #c2410c; }
        .badge.blue { background: #eff6ff; color: #1d4ed8; }
        .badge.green { background: #ecfdf5; color: #047857; }
        .alert { padding: 12px 14px; border-radius: 8px; margin-bottom: 16px; border: 1px solid; }
        .alert.success { background: #ecfdf5; border-color: #a7f3d0; color: #047857; }
        .alert.error { background: #fef2f2; border-color: #fecaca; color: #b91c1c; }
        .form { max-width: 860px; }
        .form-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 16px; }
        .field { display: grid; gap: 7px; }
        label { font-weight: 800; }
        input, select { width: 100%; min-height: 42px; padding: 9px 11px; border-radius: 8px; border: 1px solid #cbd5e1; background: #ffffff; color: #172026; }
        .error-text { color: #b91c1c; font-size: 13px; }
        .form-actions { display: flex; gap: 10px; margin-top: 18px; }
        .pagination { margin-top: 16px; }
        .detail { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; }
        .detail div { padding: 14px; background: #f8fafc; border-radius: 8px; }
        .detail span { display: block; color: #64748b; font-size: 13px; margin-bottom: 5px; }

        @media (max-width: 900px) {
            .shell { grid-template-columns: 1fr; }
            .sidebar { position: static; }
            .stats, .form-grid, .detail { grid-template-columns: 1fr; }
            .topbar, .toolbar { align-items: flex-start; flex-direction: column; }
            .main { padding: 20px; }
        }
    </style>
</head>
<body>
    <div class="shell">
        <aside class="sidebar">
            <a class="brand" href="{{ route('dashboard') }}">Laundryku</a>
            <nav class="nav">
                <a class="{{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                <a class="{{ request()->routeIs('transaksis.*') ? 'active' : '' }}" href="{{ route('transaksis.index') }}">Transaksi</a>
                <a class="{{ request()->routeIs('layanans.*') ? 'active' : '' }}" href="{{ route('layanans.index') }}">Layanan</a>
            </nav>
        </aside>

        <main class="main">
            @if (session('success'))
                <div class="alert success">{{ session('success') }}</div>
            @endif

            @if (session('error'))
                <div class="alert error">{{ session('error') }}</div>
            @endif

            @yield('content')
        </main>
    </div>
</body>
</html>
