<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background:rgb(182, 182, 182);
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
    }
    .login-card {
      background: rgb(206, 200, 200);
      padding: 2rem;
      border-radius: 1rem;
      box-shadow: 0 0 20px rgba(0,0,0,0.1);
      width: 100%;
      max-width: 400px;
    }
    .login-card h4 {
      margin-bottom: 1.5rem;
    }
  </style>
</head>
<body>

  <div class="login-card">
    <h4 class="text-center">Login</h4>
    <form method="POST" action="/login">
      <!-- CSRF Token (if Blade) -->
      {{-- @csrf --}}
      <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" class="form-control" id="email" name="email" required autofocus>
      </div>
      <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="remember">
        <label class="form-check-label" for="remember">Remember Me</label>
      </div>
      <button type="submit" class="btn btn-primary w-100">Login</button>
    </form>
    <div class="text-center mt-3">
      <a href="#">Forgot Password?</a>
    </div>
  </div>

</body>
</html>
