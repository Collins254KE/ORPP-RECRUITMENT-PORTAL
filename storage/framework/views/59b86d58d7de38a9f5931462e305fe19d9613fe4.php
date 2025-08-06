<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recruitment Portal Login</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .container {
      background-color: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      width: 100%;
      max-width: 360px;
      text-align: center;
    }

    .logo {
      width: 200px;
      height: auto;
      margin-bottom: 20px;
    }

    h2 {
      margin-bottom: 25px;
      color: #333;
    }

    label {
      font-weight: bold;
      display: block;
      text-align: left;
      margin-top: 15px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 12px;
      margin-top: 8px;
      border: 1px solid #ccc;
      border-radius: 6px;
      box-sizing: border-box;
    }

    .password-wrapper {
      position: relative;
    }

    .password-wrapper input {
      padding-right: 40px; /* space for icon */
    }

    .toggle-password {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: #007bff;
      font-size: 18px;
      padding: 0;
      user-select: none;
    }

    button[type="submit"] {
      background-color: #007bff;
      color: white;
      padding: 12px;
      margin-top: 20px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      width: 100%;
      font-weight: bold;
    }

    button[type="submit"]:hover {
      background-color: #0056b3;
    }

    .footer {
      margin-top: 20px;
      font-size: 14px;
    }

    .footer-links {
      display: flex;
      justify-content: space-between;
      margin-top: 10px;
    }

    .footer a {
      color: #007bff;
      text-decoration: none;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    .ecitizen-btn {
      margin-top: 20px;
      width: 100%;
      background-color: #e8e8e8;
      color: #007bff;
      padding: 12px;
      border: 1px solid #ccc;
      border-radius: 6px;
      cursor: pointer;
      font-weight: bold;
    }

    .ecitizen-btn:hover {
      background-color: #dcdcdc;
    }

    .toast {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      padding: 14px 20px;
      color: white;
      border-radius: 6px;
      z-index: 1000;
      transition: opacity 0.5s;
      display: none;
    }
  </style>
</head>

<body>
<div class="container">
  <img src="/assets/img/images.png" alt="ORPP Logo" class="logo" />
  <h2>
    <span style="color: #004085; font-weight: bold;">ORPP e-Recruitment Portal Log In</span>
  </h2>

  
  <?php if(session('verified')): ?>
    <div class="alert alert-success" style="background-color: #d4edda; color: #155724; padding: 12px; margin-bottom: 15px; border-radius: 6px;">
      Email verified successfully. You may now log in.
    </div>
  <?php endif; ?>

  <div class="toast" id="toast"></div>

 


    <form id="loginForm" action="/auth/signin" method="POST" onsubmit="return handleLogin(event)">
      <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" />

      <label for="login">Email or ID/Passport No.</label>
      <input type="text" id="login" name="login" placeholder="Enter Email or ID No." required />

      <label for="psw">Password</label>
      <div class="password-wrapper">
        <input type="password" id="psw" name="psw" placeholder="Enter Password" required />
        <button type="button" class="toggle-password" aria-label="Show password">
          <i class="fas fa-eye"></i>
        </button>
      </div>

      <button type="submit" id="btnSubmit">Log In</button>
    </form>

    <div class="footer">
      <div class="footer-links">
        <a href="<?php echo e(route('password.request')); ?>">Forgot Password?</a>
        <a href="/auth/register">Register</a>
      </div>

      <a href="<?php echo e(url('/auth/ecitizen-login')); ?>">
        <button class="ecitizen-btn" type="button">Sign In with E-citizen</button>
      </a>
    </div>
  </div>
<?php if(session('verified')): ?>
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      showToast('Your email has been verified. Please log in.', true);
    });
  </script>
<?php endif; ?>


  <script>
    const togglePasswordBtn = document.querySelector('.toggle-password');
    const passwordInput = document.getElementById('psw');
    const eyeIcon = togglePasswordBtn.querySelector('i');

    togglePasswordBtn.addEventListener('click', () => {
      if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.classList.remove('fa-eye');
        eyeIcon.classList.add('fa-eye-slash');
        togglePasswordBtn.setAttribute('aria-label', 'Hide password');
      } else {
        passwordInput.type = 'password';
        eyeIcon.classList.remove('fa-eye-slash');
        eyeIcon.classList.add('fa-eye');
        togglePasswordBtn.setAttribute('aria-label', 'Show password');
      }
    });

    function showToast(message, isSuccess) {
      const toast = document.getElementById('toast');
      toast.textContent = message;
      toast.style.backgroundColor = isSuccess ? '#28a745' : '#dc3545';
      toast.style.display = 'block';
      setTimeout(() => {
        toast.style.display = 'none';
      }, 3000);
    }

    function handleLogin(event) {
      event.preventDefault();

      const btnSubmit = document.getElementById('btnSubmit');
      btnSubmit.textContent = 'Logging in...';
      btnSubmit.disabled = true;

      const form = document.getElementById('loginForm');
      const formData = new FormData(form);
fetch(form.action, {
  method: 'POST',
  body: formData,
  headers: {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
  }
})

        .then(response => response.json())
        .then(data => {
          btnSubmit.textContent = 'Log In';
          btnSubmit.disabled = false;

          if (data.status === 'success') {
            showToast('Login successful!', true);
            window.location.href = '/dashboard';
          } else if (data.errors) {
            let errorMessage = Object.values(data.errors).flat().join('\n');
            showToast(errorMessage, false);
          } else {
            showToast(data.message || 'Login failed.', false);
          }
        })
        .catch(error => {
          console.error('Error:', error);
          btnSubmit.textContent = 'Log In';
          btnSubmit.disabled = false;
          showToast('An error occurred. Please try again.', false);
        });

      return false;
    }
  </script>

</body>

</html>
<?php /**PATH C:\orpp6\resources\views/auth/login.blade.php ENDPATH**/ ?>