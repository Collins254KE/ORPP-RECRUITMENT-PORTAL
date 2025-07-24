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
        <div class="column"style="display: none;">
          <label for="title">Title/Salutation</label>
          <select name="title" id="title" required>
            <option value="" disabled selected>Select Title</option>
            <option value="Mr">Mr</option>
            <option value="Mrs">Mrs</option>
            <option value="Miss">Miss</option>
            <option value="Dr">Dr</option>
          </select>
        </div>
      </div>

      <div class="row"style="display: none;">
        <div class="column">
          <label for="county">County</label>
          <select name="county" id="county" onchange="loadSubCounties()">
            <option value="" disabled selected>Select County</option>
            <option value="Mombasa">Mombasa</option>
            <option value="Kwale">Kwale</option>
            <option value="Kilifi">Kilifi</option>
            <option value="Tana River">Tana River</option>
            <option value="Lamu">Lamu</option>
            <option value="Taita-Taveta">Taita-Taveta</option>
            <option value="Garissa">Garissa</option>
            <option value="Wajir">Wajir</option>
            <option value="Mandera">Mandera</option>
            <option value="Marsabit">Marsabit</option>
            <option value="Isiolo">Isiolo</option>
            <option value="Meru">Meru</option>
            <option value="Tharaka-Nithi">Tharaka-Nithi</option>
            <option value="Embu">Embu</option>
            <option value="Kitui">Kitui</option>
            <option value="Machakos">Machakos</option>
            <option value="Makueni">Makueni</option>
            <option value="Nyandarua">Nyandarua</option>
            <option value="Nyeri">Nyeri</option>
            <option value="Kirinyaga">Kirinyaga</option>
            <option value="Murang'a">Murang'a</option>
            <option value="Kiambu">Kiambu</option>
            <option value="Turkana">Turkana</option>
            <option value="West Pokot">West Pokot</option>
            <option value="Samburu">Samburu</option>
            <option value="Trans Nzoia">Trans Nzoia</option>
            <option value="Uasin Gishu">Uasin Gishu</option>
            <option value="Elgeyo-Marakwet">Elgeyo-Marakwet</option>
            <option value="Nandi">Nandi</option>
            <option value="Baringo">Baringo</option>
            <option value="Laikipia">Laikipia</option>
            <option value="Nakuru">Nakuru</option>
            <option value="Narok">Narok</option>
            <option value="Kajiado">Kajiado</option>
            <option value="Kericho">Kericho</option>
            <option value="Bomet">Bomet</option>
            <option value="Kakamega">Kakamega</option>
            <option value="Vihiga">Vihiga</option>
            <option value="Bungoma">Bungoma</option>
            <option value="Busia">Busia</option>
            <option value="Siaya">Siaya</option>
            <option value="Kisumu">Kisumu</option>
            <option value="Homa Bay">Homa Bay</option>
            <option value="Migori">Migori</option>
            <option value="Kisii">Kisii</option>
            <option value="Nyamira">Nyamira</option>
            <option value="Nairobi">Nairobi</option>
          </select>
        </div>

        <div class="column">
          <label for="subcounty">Sub_County</label>
         
          <select name="sub_county" id="subcounty">

            <option value="">Select Sub_County</option>
          </select>
        </div>
      </div>

      <div class="row"style="display: none;">
        <div class="column">
          <label for="ethnicity">Ethnicity</label>
          <select name="ethnicity" id="ethnicity">
            <option value="" disabled selected>Select Ethnicity</option>
            <option value="Kikuyu">Kikuyu</option>
            <option value="Luhya">Luhya</option>
            <option value="Luo">Luo</option>
            <option value="Kalenjin">Kalenjin</option>
            <option value="Kamba">Kamba</option>    
            <option value="Somali">Somali</option>
            <option value="Kisii">Kisii</option>
            <option value="Mijikenda">Mijikenda</option>
            <option value="Meru">Meru</option>
            <option value="Turkana">Turkana</option>
            <option value="Maasai">Maasai</option>
            <option value="Embu">Embu</option>
            <option value="Taita">Taita</option>
            <option value="Taveta">Taveta</option>
            <option value="Samburu">Samburu</option>
            <option value="Pokot">Pokot</option>
            <option value="Boran">Boran</option>
            <option value="Rendille">Rendille</option>
            <option value="Swahili">Swahili</option>
            <option value="Other">Other</option>
          </select>
        </div>
            

        <div class="column">
          <label for="dob"><b>Date of Birth</b></label>
          <input type="date" name="dob" id="dob">
        </div>

      </div>

      <div class="row">
        <div class="column">
          <label for="phone"><b>Phone Number</b></label>
          <input type="tel" placeholder="Phone Number" name="phone" id="phone" pattern="\d{10}" maxlength="10" required>
        </div>

        <div class="column"style="display: none;">
          <label for="id_passport"><b>ID/Passport</b></label>
          <input type="tel" placeholder="ID/Passport" name="id_passport" inputmode="numeric"  id="id_passport" pattern="\d{1,10}" maxlength="10">
        </div>
      </div>

       <div class="row"style="display: none;">
        <div class="column">
          <label for="gender"><b>Gender</b></label>
          <select name="gender" id="gender">
            <option value="" disabled selected>Select Gender</option>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
            </select>        
          </div>

        <div class="column">
          <label for="nationality"><b>Nationality</b></label>
          <input type="text" placeholder="Nationality" name="nationality" id="nationality">
        </div>
      </div>

      <div class="row">
        <div class="column"style="display: none;">
          <label for="kra_pin"><b>KRA PIN</b></label>
          <input type="tel" placeholder="KRA PIN" name="kra_pin" id="kra_pin">
        </div>

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



      <div class="mb-3"style="display: none;">
        <label class="form-label">Are you living with a disability?</label><br>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="disability_status" id="disabilityYes" value="yes">
            <label class="form-check-label" for="disabilityYes">Yes</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="disability_status" id="disabilityNo" value="no" checked>
            <label class="form-check-label" for="disabilityNo">No</label>
        </div>
    </div>

    <div class="mb-3" id="certificateNumberField" style="display: none;">
        <label for="disability_certificate_number" class="form-label">Disability Certificate Number</label>
        <input type="text" class="form-control" name="disability_certificate_number" id="disability_certificate_number" placeholder="Enter certificate number">
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

      <button type="submit" class="registerbtn">Register</button>


    </form>


    <div class="footer">
      <p>Already have an account? <a href="/auth/login">Sign in</a>.</p>
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

    function handleRegistration(event) {
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
  </script>
  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const yesRadio = document.getElementById('disabilityYes');
        const noRadio = document.getElementById('disabilityNo');
        const certField = document.getElementById('certificateNumberField');

        const toggleCertField = () => {
            if (yesRadio.checked) {
                certField.style.display = 'block';
            } else {
                certField.style.display = 'none';
                document.getElementById('disability_certificate_number').value = '';
            }
        };

        yesRadio.addEventListener('change', toggleCertField);
        noRadio.addEventListener('change', toggleCertField);

        toggleCertField(); // Run on load in case of browser re-fill
    });
</script>

  <script>
  // Prefill with today's date
  document.getElementById('dob').valueAsDate = new Date();
</script>
<script>
function validatePasswordStrength(password) {
  // Regex for strong password:
  // Minimum 8 chars, at least 1 uppercase, 1 lowercase, 1 number, 1 special char
  const strongPasswordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
  return strongPasswordRegex.test(password);
}

function handleRegistration(event) {
  event.preventDefault(); // Prevent form submit by default

  const password = document.getElementById('psw').value;
  const confirmPassword = document.getElementById('psw_confirmation').value;

  // Validate password strength
  if (!validatePasswordStrength(password)) {
    showToast(
      'Password must be at least 8 characters long, with uppercase, lowercase, number, and special character.',
      false
    );
    return false; // stop submission
  }

  // Check if passwords match
  if (password !== confirmPassword) {
    showToast('Passwords do not match.', false);
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
        showToast('Registration successful! Redirecting to login...', true);
        setTimeout(() => {
          window.location.href = '/auth/login';
        }, 2000);
      } else {
        let errorMessage = 'Registration failed:\n';
        for (const [key, value] of Object.entries(data.errors)) {
          errorMessage += `${value.join(', ')}\n`;
        }
        showToast(errorMessage, false);
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showToast('An error occurred. Please try again.', false);
    });
}
</script>
<script>
  const subCountiesByCounty = {
   
  "Mombasa": ["Changamwe", "Jomvu", "Kisauni", "Nyali", "Likoni", "Mvita"],
  "Kwale": ["Kinango", "Lunga Lunga", "Matuga", "Msambweni", "Kaloleni"],
  "Kilifi": ["Kilifi North", "Kilifi South", "Rabai", "Malindi", "Ganze", "Magarini"],
  "Tana River": ["Galole", "Garsen", "Bura"],
  "Lamu": ["Lamu East", "Lamu West"],
  "Taita-Taveta": ["Mwatate", "Voi", "Wundanyi"],
  "Garissa": ["Balambala", "Dadaab", "Fafi", "Garissa Township", "Ijara", "Lagdera"],
  "Wajir": ["Eldas", "Tarba", "Wajir East", "Wajir North", "Wajir South", "Wajir West", "Habaswein"],
  "Mandera": ["Banissa", "Mandera East", "Mandera North", "Mandera South", "Mandera West", "Lafey"],
  "Marsabit": ["North Horr", "Saku", "Laisamis", "Moyale"],
  "Isiolo": ["Isiolo North", "Isiolo South"],
  "Meru": ["Imenti North",'Imenti Central', "Imenti South", "Igembe Central", "Igembe North", "Igembe South", "Tigania East", "Tigania West"],
  "Tharaka-Nithi": ["Chuka", "Maara", "Tharaka"],
  "Embu": ["Runyenjes", "Manyatta", "Mbeere North", "Mbeere South"],
  "Kitui": ["Kitui Central", "Kitui East", "Kitui Rural", "Kitui South", "Kitui West", "Mwingi Central", "Mwingi North", "Mwingi West"],
  "Machakos": ["Machakos Town", "Mwala", "Yatta", "Mavoko", "Kangundo", "Kathiani", "Matungulu"],
  "Makueni": ["Kaiti", "Kilome", "Makueni", "Mbooni", "Kibwezi East", "Kibwezi West"],
  "Nyandarua": ["Kinangop", "Kipipiri", "Ndaragwa", "Ol Kalou", "Njabini"],
  "Nyeri": ["Tetu", "Mathira", "Kieni", "Othaya", "Nyeri Town"],
  "Kirinyaga": ["Gichugu", "Kirinyaga Central", "Kirinyaga East", "Mwea", "Ndia"],
  "Murang'a": ["Kiharu", "Kigumo", "Mathioya", "Kandara", "Maragwa", "Kigumo"],
  "Kiambu": ["Gatundu North", "Gatundu South", "Juja", "Kiambu", "Lari", "Thika East", "Thika West", "Ruiru", "Kabete", "Kiambaa"],
  "Turkana": ["Turkana Central", "Turkana East", "Turkana North", "Turkana South", "Turkana West", "Loima"],
  "West Pokot": ["Kacheliba", "Kapenguria", "Sigor", "Pokot South", "Tiaty"],
  "Samburu": ["Samburu East", "Samburu North", "Samburu West"],
  "Trans Nzoia": ["Cherangany", "Kwanza", "Saboti", "Endebess"],
  "Uasin Gishu": ["Eldoret East", "Eldoret West", "Soy", "Moiben", "Turbo"],
  "Elgeyo-Marakwet": ["Keiyo North", "Keiyo South", "Marakwet East", "Marakwet West"],
  "Nandi": ["Aldai", "Chesumei", "Emgwen", "Mosop", "Tinderet"],
  "Baringo": ["Baringo Central", "Baringo North", "Baringo South", "Mogotio", "Tiaty", "Eldama Ravine"],
  "Laikipia": ["Laikipia East", "Laikipia North", "Laikipia West"],
  "Nakuru": ["Nakuru Town East", "Nakuru Town West", "Gilgil", "Naivasha", "Molo", "Kuresoi North", "Kuresoi South", "Rongai", "Subukia", "Bahati", "Njoro"],
  "Narok": ["Narok East", "Narok North", "Narok South", "Emurua Dikirr", "Kilgoris", "Loita"],
  "Kajiado": ["Kajiado Central", "Kajiado North", "Kajiado South", "Kajiado East", "Kajiado West", "Ngong"],
  "Kericho": ["Bureti", "Ainamoi", "Kipkelion East", "Kipkelion West", "Sigowet-Soin"],
  "Bomet": ["Bomet Central", "Chepalungu", "Sotik","Konoin", "Bomet East"],
  "Kakamega": ["Lugari", "Likuyani", "Malava", "Matungu", "Butere", "Shinyalu", "Ikolomani", "Mumias East", "Mumias West", "Navakholo"],
  "Vihiga": ["Emuhaya", "Luanda", "Sabatia", "Vihiga", "Hamisi"],
  "Bungoma": ["Bungoma East", "Bungoma North", "Bungoma South", "Bungoma West", "Mt. Elgon", "Kimilili", "Webuye East", "Webuye West"],
  "Busia": ["Nambale", "Matayos", "Budalang'i", "Butula", "Funyula", "Teso North", "Teso South"],
  "Siaya": ["Gem", "Ugenya", "Rarieda", "Bondo", "Alego Usonga"],
  "Kisumu": ["Kisumu East", "Kisumu West", "Kisumu Central", "Seme", "Nyando", "Muhoroni", "Nyakach"],
  "Homa Bay": ["Homa Bay Town", "Ndhiwa", "Rachuonyo North", "Rachuonyo South", "Suba North", "Suba South", "Kabondo Kasipul"],
  "Migori": ["Suna East", "Suna West", "Rongo", "Awendo", "Nyatike", "Uriri", "Kuria West", "Kuria East"],
  "Kisii": ["Bonchari", "Kitutu Chache", "Nyaribari Chache", "Nyaribari Masaba", "South Mugirango", "Kitutu Masaba", "Marani"],
  "Nyamira": ["Borabu", "Nyamira", "West Mugirango"],
  "Nairobi": ["Westlands",
    "Kibra",
    "Lang'ata",
    "Dagoretti North",
    "Dagoretti South",
    "Embakasi Central",
    "Embakasi East",
    "Embakasi North",
    "Embakasi South",
    "Embakasi West",
    "Roysambu",
    "Kasarani",
    "Makadara",
    "Starehe",
    "Kamukunji",
    "Mathare",
    "Ruaraka"]
}

    // Add more counties and their sub-counties

  function loadSubCounties() {
    const county = document.getElementById('county').value;
    const subCountySelect = document.getElementById('subcounty');
    subCountySelect.innerHTML = '<option value="">Select Sub-County</option>';

    if (county && subCountiesByCounty[county]) {
      subCountiesByCounty[county].forEach(function(subCounty) {
        const option = document.createElement('option');
        option.value = subCounty;
        option.textContent = subCounty;
        subCountySelect.appendChild(option);
      });
    }
  }
</script>
<script>
  function loadSubCounties() {
    const countySelect = document.getElementById("county");
    const subcountySelect = document.getElementById("subcounty");
    const selectedCounty = countySelect.value;

    // Clear out old sub-counties
    subcountySelect.innerHTML = '<option value="">Select Sub-County</option>';

    // Get the relevant sub-counties
    const subCounties = subCountiesByCounty[selectedCounty];

    if (subCounties) {
      subCounties.forEach(subcounty => {
        const option = document.createElement("option");
        option.value = subcounty;
        option.textContent = subcounty;
        subcountySelect.appendChild(option);
      });
    }
  }
</script>

<script>
  const phoneInput = document.getElementById('phone');

  phoneInput.addEventListener('input', function () {
    // Replace any non-digit characters with empty string
    this.value = this.value.replace(/\D/g, '');
  });
</script>
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

<!-- Registration form container -->
<div id="registrationForm" style="display:none; margin-top:20px;">
  <h3>Registration Form</h3>
  <form id="registerForm">
    <input type="text" name="fullname" placeholder="Full Name" required><br><br>
    <input type="email" name="email" placeholder="Email" required><br><br>
    <button type="submit" id="registerSubmit" class="btn btn-primary">Register</button>
  </form>
</div>

<script>
  const termsModal = document.getElementById('termsModal');
  const registrationForm = document.getElementById('registrationForm');

  const acceptBtn = document.getElementById('acceptBtn');
  const declineBtn = document.getElementById('declineBtn');

  acceptBtn.addEventListener('click', () => {
    termsModal.style.display = 'none';
    registrationForm.style.display = 'block';
    alert('Thank you for accepting the terms. You may now complete your registration.');
  });

  declineBtn.addEventListener('click', () => {
    termsModal.style.display = 'none';
    alert('You must accept the Terms and Privacy Statement to register.');
  });
</script>


</body>

</html>