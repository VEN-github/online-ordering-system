<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="Online Ordering System, ordering system, online ordering, ordering" />
    <meta name="description" content="Online Ordering System with Inventory Management for Furniture Company" />
    <meta name="author" content="Raven Barrogo, Jade Soriano" />
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <title>Online Ordering System</title>

    @vite('resources/css/app.css')
  </head>
  <body class="antialiased bg-slate-100">
    <div id="app"></div>

    @vite('resources/js/app.js')
  </body>
</html>
