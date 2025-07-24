<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Recruitment Portal Registration</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: transparent;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 150vh;
      margin: 0;
    }

    .container {
      background-color: white;
      padding: 20px 30px;
      border-radius: 8px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      width: 500px;
      box-sizing: border-box;
    }

    .logo {
      display: block;
      margin: 0 auto 20px auto;
      max-width: 150px;
      height: auto;
    }

    h1 {
      text-align: center;
      margin-bottom: 10px;
      font-weight: 700;
    }

    p {
      text-align: center;
      margin-bottom: 20px;
      font-size: 1rem;
      color: #444;
    }

    label {
      font-weight: 600;
      margin-bottom: 5px;
      display: block;
    }

    input[type=text],
    input[type=date],
    input[type=tel],
    input[type=email],
    input[type=password],
    select {
      width: 100%;
      padding: 12px 15px;
      margin: 6px 0 14px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-family: inherit;
      font-size: 16px;
      box-sizing: border-box;
      transition: border-color 0.3s ease;
    }

    input[type=text]:focus,
    input[type=date]:focus,
    input[type=tel]:focus,
    input[type=email]:focus,
    input[type=password]:focus,
    select:focus {
      border-color: #005fcc;
      outline: none;
    }

    .row {
      display: flex;
      gap: 15px;
      flex-wrap: wrap;
    }

    .column {
      flex: 1;
      min-width: 140px;
      display: flex;
      flex-direction: column;
    }

    button {
      background-color: #005fcc;
      color: white;
      padding: 14px 0;
      margin: 12px 0 0 0;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      width: 100%;
      font-size: 1.1rem;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    button:hover {
      background-color: #0047b3;
    }

    .footer {
      text-align: center;
      margin-top: 15px;
      font-size: 0.9rem;
      color: #555;
    }

    .footer a {
      color: #005fcc;
      text-decoration: none;
      font-weight: 600;
    }

    .footer a:hover {
      text-decoration: underline;
    }

    .terms {
      margin: 10px 0 20px 0;
      font-size: 0.9rem;
    }

    .terms input[type="checkbox"] {
      margin-right: 8px;
      vertical-align: middle;
      cursor: pointer;
    }

    .terms label {
      display: inline;
      font-weight: normal;
      color: #333;
    }

    .terms a {
      color: #005fcc;
      text-decoration: none;
      font-weight: 600;
    }

    .terms a:hover {
      text-decoration: underline;
    }
  </style>
</head>

<body>
  <div class="container">

    <h1>Recruitment Portal Registration</h1>
    <p>Please fill in this form to create an account.</p>
    <form id="registrationForm" method="post" enctype="application/x-www-form-urlencoded" onsubmit="return handleRegistration(event)">
      <!-- CSRF token placeholder if using frameworks -->
      @csrf
      @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
      <div class="row">
        <div class="column">
          <label for="name">Full Name</label>
          <input type="text" name="name" id="name" placeholder="Full Name" required />
        </div>
      </div>
<div class="row">
  <div class="column">
    <label for="national_id"><b>ID / Passport Number</b></label>
    <input type="text" placeholder="ID or Passport Number" name="national_id" id="national_id" maxlength="10" pattern="\d{1,10}" inputmode="numeric" required>
  </div>
</div>

      <div class="row">
        <div class="column">
          <label for="phone"><b>Phone Number</b></label>
          <input type="tel" placeholder="Phone Number" name="phone" id="phone" pattern="\d{10}" maxlength="10" required>
        </div>
      </div>

<script>
  const idInput = document.getElementById('national_id');
  idInput.addEventListener('input', function () {
    this.value = this.value.replace(/\D/g, '').slice(0, 10);
  });
</script>

      <div class="row">
        <div class="column">
          <label for="email"><b>Email</b></label>
          <input type="email" placeholder="Enter Email" name="email" id="email" required>
        </div>
      </div>

      <div class="row">
        <div class="column">
          <label for="psw"><b>Password</b></label>
          <input type="password" placeholder="Enter Password" name="psw" id="psw" required>
        </div>

        <div class="column">
          <label for="psw_confirmation"><b>Repeat Password</b></label>
          <input type="password" placeholder="Repeat Password" name="psw_confirmation" id="psw_confirmation" required>
        </div>
      </div>

      <div class="terms">
        <input type="checkbox" id="terms" name="terms" value="terms" required>
        <label for="terms">
          By creating an account you agree to our 
          <a href="javascript:void(0);" onclick="document.getElementById('termsModal').style.display='flex';">
            Terms & Privacy
          </a>.
        </label>

      </div>

      <button type="submit" class="registerbtn" id="registerBtn">Register</button>


    </form>


    <div class="footer">
      <p>Already have an account? <a href="/auth/login">Sign in</a>.</p>
    </div>
  </div>
<!-- Terms Modal -->
<div id="termsModal" style="display:flex; position:fixed; top:0; left:0; width:100%; height:100%; 
  background:rgba(0,0,0,0.6); justify-content:center; align-items:center; z-index:999;">
  <div style="background:white; padding:20px; max-width:600px; max-height:80vh; overflow-y:auto; border-radius:8px;">
    <h2>ORPP Terms & Privacy Policy</h2>
    <h3>Privacy Statement</h3>
    <ol>
      <li><strong>Purpose of Data Collection</strong><br>
          The Office of the Registrar of Political Parties (ORPP) collects personal information solely to process your employment applications.</li>
      <li><strong>Use of Your Data</strong><br>
          Your data will be used to evaluate qualifications, communicate about recruitment stages, and comply with legal requirements.</li>
      <li><strong>Data Security</strong><br>
          ORPP ensures your personal information is stored securely and accessed only by authorized personnel.</li>
      <li><strong>Confidentiality Assurance</strong><br>
          All documents and personal data submitted are handled with strict confidentiality and are not shared with third parties unless legally mandated.</li>
      <li><strong>Accuracy of Information</strong><br>
          You must provide accurate and complete information; false or misleading data may lead to disqualification.</li>
      <li><strong>Consent to Use Data</strong><br>
          By registering, you consent to the collection, storage, and use of your personal data as described in this statement.</li>
    </ol>
    <div class="d-flex gap-3 mt-3">
      <button id="acceptBtn" type="button" class="btn btn-success">Accept</button>
      <button id="declineBtn" type="button" class="btn btn-danger">Decline</button>
    </div>
  </div>
</div>

  <script>
    function showToast(message, isSuccess) {
        const toast = document.createElement('div');
        toast.textContent = message;
        toast.style.backgroundColor = isSuccess ? 'blue' : '#f44336'; // Green for success, red for error
        toast.style.color = 'white';
        toast.style.position = 'fixed';
        toast.style.bottom = '20px';
        toast.style.left = '50%';
        toast.style.transform = 'translateX(-50%)';
        toast.style.padding = '16px';
        toast.style.borderRadius = '4px';
        document.body.appendChild(toast);

        setTimeout(() => {
            document.body.removeChild(toast);
        }, 3000); // Hide after 3 seconds
    }

    function handleRegistrationold(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(document.getElementById('registrationForm'));

        fetch('/auth/signup', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Indicate that this is an AJAX request
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                showToast('Registration successful! Redirecting to login...', true);
                // Redirect to login page after a short delay
                setTimeout(() => {
                    window.location.href = '/auth/login';
                }, 2000); // 2 seconds delay
            } else {
                // Handle validation errors
                let errorMessage = 'Registration failed:\n';
                for (const [key, value] of Object.entries(data.errors)) {
                    errorMessage += `${value.join(', ')}\n`; // Join multiple errors for the same field
                }
                showToast(errorMessage, false);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('An error occurred. Please try again.', false);
        });
    }

function validatePasswordStrength(password) {
  // Regex for strong password:
  // Minimum 8 chars, at least 1 uppercase, 1 lowercase, 1 number, 1 special char
  const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
  return strongPasswordRegex.test(password);
}

function handleRegistration(event) {
  event.preventDefault(); // Prevent form submit by default

  const registerBtn = document.getElementById('registerBtn');
  registerBtn.disabled = true;
  registerBtn.textContent = 'Registering...';

  const password = document.getElementById('psw').value;
  const confirmPassword = document.getElementById('psw_confirmation').value;

  // Validate password strength
  if (!validatePasswordStrength(password)) {
    showToast(
      'Password must be at least 8 characters long, with uppercase, lowercase, number, and special character.',
      false
    );
    registerBtn.disabled = false;
    registerBtn.textContent = 'Register';
    return false; // stop submission
  }

  // Check if passwords match
  if (password !== confirmPassword) {
    showToast('Passwords do not match.', false);
    registerBtn.disabled = false;
    registerBtn.textContent = 'Register';
    return false; // stop submission
  }

  // If everything is good, proceed with your existing fetch code
  const formData = new FormData(document.getElementById('registrationForm'));

  fetch('/auth/signup', {
    method: 'POST',
    body: formData,
    headers: {
      'X-Requested-With': 'XMLHttpRequest' // AJAX indicator
    }
  })
    .then(response => response.json())
    .then(data => {
      if (data.status === 'success') {
        showToast('Registration successful! Redirecting...', true);
        setTimeout(() => {
          if (data.redirect) {
            window.location.href = data.redirect;
          } else {
            window.location.href = '/auth/login';
          }
        }, 2000);
      } else {
        let errorMessage = 'Registration failed:\n';
        for (const [key, value] of Object.entries(data.errors)) {
          errorMessage += `${value.join(', ')}\n`;
        }
        showToast(errorMessage, false);
        registerBtn.disabled = false;
        registerBtn.textContent = 'Register';
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred. Please try again.', false);
      registerBtn.disabled = false;
      registerBtn.textContent = 'Register';
    });
}
</script>


<script>
  const phoneInput = document.getElementById('phone');

  phoneInput.addEventListener('input', function () {
    // Replace any non-digit characters with empty string
    this.value = this.value.replace(/\D/g, '');
  });
</script>


<script>
  function closeDeclinePopup() {
    document.getElementById('declinePopup').style.display = 'none';
  }
</script>


<script>
  const termsModal = document.getElementById('termsModal');
  const registrationForm = document.getElementById('registrationForm');

  const acceptBtn = document.getElementById('acceptBtn');
  const declineBtn = document.getElementById('declineBtn');

  acceptBtn.addEventListener('click', () => {
    termsModal.style.display = 'none';
    registrationForm.style.display = 'block';
    document.getElementById('terms').checked = true;
    alert('Thank you for accepting the terms. You may now complete your registration.');
  });
declineBtn.addEventListener('click', () => {
  termsModal.style.display = 'none';
    alert('You must accept the Terms and Privacy Statement to register.');
  document.getElementById('declinePopup').style.display = 'flex';
});

  
</script>
<!-- Decline Message Modal -->
<div id="declinePopup" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; 
  background:rgba(0,0,0,0.6); z-index:1000; justify-content:center; align-items:center;">
  <div style="background:white; padding:30px 40px; max-width:500px; text-align:center; border-radius:12px; box-shadow:0 0 20px rgba(0,0,0,0.2);">
    <i class="fas fa-exclamation-triangle" style="color:#f44336; font-size:48px; margin-bottom:20px;"></i>
    <h2 style="color:#333; margin-bottom:10px;">Terms Not Accepted</h2>
    <p style="font-size:16px; color:#555;">You must accept the Terms and Privacy Policy to create an account on the recruitment portal.</p>
    <button onclick="closeDeclinePopup()" style="margin-top:20px; background:#005fcc; color:white; border:none; padding:12px 24px; border-radius:5px; cursor:pointer;">Okay</button>
  </div>
</div>

</body>

</html>