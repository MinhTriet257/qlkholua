<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng Ký Tài k</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
</head>
<body>
  
  
  <div >
    <h1 >Dang Ky Tai Khoan Moi</h1>
    <form method="post" action="{{ route('process_register') }}" >
      @csrf
      <label for="name">Name</label>
      <input type="name" name="name">
      <br>
      <label for="email">Email</label>
      <input type="email" name="email">
      <br>
      <label for="password">Password</label>
      <input type="password" name="password">
      <br>
      <button>
          Register
      </button>
    </form>
  </div>
</body>
</html>