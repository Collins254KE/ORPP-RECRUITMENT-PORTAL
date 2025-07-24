<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>{{ config('app.name') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <meta name="color-scheme" content="light">
  <meta name="supported-color-schemes" content="light">
  <style>
    @media only screen and (max-width: 600px) {
      .inner-body, .footer {
        width: 100% !important;
      }
    }
    @media only screen and (max-width: 500px) {
      .button {
        width: 100% !important;
      }
    }
  </style>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f5f5f5; margin: 0; padding: 0;">

  <table class="wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation">
    <tr>
      <td align="center">
        <table class="content" width="100%" cellpadding="0" cellspacing="0" role="presentation">
          
          <!-- ORPP Header -->
          <tr>
            <td style="background-color: #0b4f6c; padding: 30px 0; text-align: center;">
              
<img src="https://orpp e-Recruitment.or.ke/assets/img/images.jpg" alt="ORPP Logo" height="60" style="display:block; margin:0 auto;">

              <h1 style="color: #ffffff; font-size: 20px; margin-top: 10px;">ORPP e-Recruitment Portal</h1>
            </td>
          </tr>

          <!-- Email Body -->
          <tr>
            <td class="body" width="100%" cellpadding="0" cellspacing="0" style="border: hidden !important;">
              <table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="background-color: #ffffff; padding: 30px; border-radius: 6px;">
                <!-- Body content -->
                <tr>
                  <td class="content-cell">
                    {{ Illuminate\Mail\Markdown::parse($slot) }}
                    {{ $subcopy ?? '' }}
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td>
              <table class="footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation">
                <tr>
                  <td class="content-cell" align="center" style="padding: 20px; font-size: 12px; color: #999;">
                    © {{ date('Y') }} Office of the Registrar of Political Parties. All rights reserved.
                  </td>
                </tr>
              </table>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>
