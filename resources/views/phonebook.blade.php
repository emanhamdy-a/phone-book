<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>PhoneBook</title>
</head>
<body>
  <div id="app">
    <Myheader></Myheader>
      <div class='container'>
        <router-view></router-view>
      </div>
    <Myfooter></Myfooter>
  </div>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
