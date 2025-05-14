<form action="{{ route('login') }}" method="POST">
  @csrf
  <input type="text" name="login" placeholder="Username atau Email" required>
  <input type="password" name="password" placeholder="Password" required>
  <button type="submit">Login</button>
</form>