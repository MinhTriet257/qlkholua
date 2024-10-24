<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hệ Thống Quan Ly Kho Lúa</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
  </head>
  <body>
    <h1 >Hệ Thống Quản lý Kho</h1> 
    <form method="POST" action="{{ route('process_login') }}">
      @csrf 
      Email
      <input type="text" name="email">
      <br>
      Password
      <input type="password" name="password" >
      <br>
      <button class="btn">Login</button>
      <a href="{{ route('register') }}">
          Register
      </a>
    </form>
    
</body>
</html>