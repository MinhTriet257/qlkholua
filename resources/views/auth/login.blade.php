<h1 >WelCome Back</h1>

<form method="POST" action="{{ route('process_login') }}">
  @csrf 
  Email
  <input type="text" name="email">
  <br>
  PASSWORD
  <input type="text" name="password" >
  <br>
  <button>Login</button>
  <a href="{{ route('register') }}">
      Register
  </a>
</form>