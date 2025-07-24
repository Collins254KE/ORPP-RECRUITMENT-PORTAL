<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">

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
      background-color: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 300px;
    }

    h2 {
      text-align: center;
    }

    input[type=email] {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    button {
      background-color: #007bff;
      color: white;
      padding: 12px;
      border: none;
      border-radius: 4px;
      width: 100%;
      cursor: pointer;
    }

    .toast {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background-color: #333;
      color: white;
      padding: 12px;
      border-radius: 4px;
      display: none;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Reset Password</h2>
  <form id="resetForm" onsubmit="return sendResetLink(event)">
      @csrf
    <input type="email" name="email" placeholder="Enter registered email" required>
    <button type="submit">Send Reset Link</button>
  </form>
</div>

<div class="toast" id="toast"></div>

<script>
  function showToast(message, isSuccess = true) {
    const toast = document.getElementById('toast');
    toast.textContent = message;
    toast.style.backgroundColor = isSuccess ? 'blue' : '#f44336';
    toast.style.display = 'block';
    setTimeout(() => toast.style.display = 'none', 3000);
  }

 



   function sendResetLink(event) {
  event.preventDefault();

  const form = document.getElementById('resetForm');
  const formData = new FormData(form);

  fetch('/password/email', {  // Or your actual route URL for sending reset link
    method: 'POST',
    headers: {
      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
      'X-Requested-With': 'XMLHttpRequest'
    },
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.status === 'success') {
      alert('Reset link sent to your email!');
    } else {
      alert('Error: ' + (data.message || 'Something went wrong'));
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('An unexpected error occurred.');
  });
}

</script>

</body>
</html>
