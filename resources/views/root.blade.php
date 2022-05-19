<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{config('amis-admin.title')}}</title>
    {!! AmisAdmin::css() !!}
    <script>
        window.AmisAdmin = @json($config)
    </script>
</head>
<body>
<div id="app"></div>
{!! AmisAdmin::baseJs() !!}
{{ vite_assets() }}
{!! AmisAdmin::js() !!}
</body>
</html>
