<head>
    <!-- ... other head elements ... -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
    <!-- ... your content ... -->
    @yield('content')
    <!-- ... your scripts ... -->
    @stack('scripts')
</body>