<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>eCitizen Login</title>
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f6f8;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #fff;
      padding: 40px 30px;
      border-radius: 10px;
      box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 400px;
      text-align: center;
    }

    .logo {
      width: 80px;
      margin-bottom: 20px;
    }

    h2 {
      color: #333;
      margin-bottom: 10px;
    }

    p.subtitle {
      color: #777;
      font-size: 14px;
      margin-bottom: 30px;
    }

    label {
      text-align: left;
      display: block;
      margin: 12px 0 5px;
      font-weight: bold;
      font-size: 14px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      margin-bottom: 10px;
    }

    .actions {
      text-align: right;
      margin-top: -5px;
      font-size: 13px;
    }

    .actions a {
      color: #007bff;
      text-decoration: none;
    }

    .actions a:hover {
      text-decoration: underline;
    }

    button {
      width: 100%;
      padding: 12px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 6px;
      font-weight: bold;
      cursor: pointer;
      margin-top: 15px;
    }

    button:hover {
      background-color: #0056b3;
    }

    .alt-login {
      margin-top: 25px;
      font-size: 14px;
    }

    .alt-login a {
      color: #007bff;
      text-decoration: none;
      font-weight: bold;
    }

    .alt-login a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- ORPP Logo -->
    <img src="/assets/img/ecitizen.png" alt="ORPP Logo" class="logo" />

    <h2>One Login</h2>
    <p class="subtitle">All Government Services</p>

    <form method="POST" action="/auth/ecitizen-authenticate">
      @csrf
      <label for="username">Email address or ID number</label>
      <input type="text" name="username" placeholder="Enter your email or ID number" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" required>

      <div class="actions">
        <a href="#">Forgot Password?</a>
      </div>

      <button type="submit">Sign In</button>
    </form>

    <div class="alt-login">
      Or continue with<br><br>
      <a href="#">Sign in with Digital ID</a><br><br>
      Don’t have an account? <a href="#">Sign up</a>
    </div>
  </div>

</body>
</html>
