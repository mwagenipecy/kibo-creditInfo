<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Email Verification - KiboAuto</title>
</head>
<body style="margin:0;padding:0;font-family:Arial,sans-serif;background-color:#f5f5f5;color:#333;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5;padding:0;margin:0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#fff;border-radius:10px;overflow:hidden;">

          <!-- Header -->
          <tr>
            <td align="center" style="background-color:#046b40;padding:8px;">
              <img src="{{asset('/InstitutionLogo/carLogo.png')}}" alt="KiboAuto" style="max-width:200px;height:auto;display:inline-block;">
            </td>
          </tr>

          <!-- Email Verification Section -->
          <tr>
            <td style="padding:30px 20px;text-align:center;">
              <h2 style="color:#111;font-size:22px;margin:0 0 15px 0;">Email Verification Required</h2>
              <p style="font-size:15px;color:#555;line-height:1.6;margin:0 0 20px 0;">
                Hello <strong>{{ $name }}</strong>,
              </p>
              <p style="font-size:15px;color:#555;line-height:1.6;margin:0 0 30px 0;">
                Thank you for registering with KiboAuto! To complete your account setup and access our premium automotive services, please verify your email address using the code below.
              </p>
              
              <!-- OTP Code -->
              <div style="background:#f8f9fa;border:2px solid #046b40;border-radius:10px;padding:25px;margin:30px 0;display:inline-block;">
                <div style="font-size:36px;font-weight:bold;color:#046b40;letter-spacing:6px;margin:0;">{{ $otp }}</div>
              </div>
              
              <!-- Verify Button -->
              <a href="{{ $link }}" style="display:inline-block;background:#046b40;color:#fff;padding:12px 30px;border-radius:6px;text-decoration:none;font-weight:bold;margin:20px 0;">Verify Email & Access Account</a>
              
              <p style="font-size:13px;color:#666;margin:20px 0 0 0;">
                Having trouble with the button above? Copy and paste this link into your browser:<br>
                <a href="{{ $link }}" style="color:#046b40;text-decoration:none;word-break:break-all;">{{ $link }}</a>
              </p>
            </td>
          </tr>

          <!-- Car Shopping Promotional Section -->
          <tr>
            <td style="background:#eeecec;text-align:center;padding:40px 20px;">
              <h2 style="color:#111;margin-bottom:15px;">Your Dream Car Awaits!</h2>
              <p style="font-size:15px;color:#555;line-height:1.6;margin-bottom:20px;">
                Ready to drive your perfect vehicle home? Browse our extensive car inventory and find your ideal match.
              </p>
              <img src="{{asset('/promosion/imah.png')}}" 
                   onerror="this.src='{{asset('/promosion/imah.png')}}'; this.onerror='this.src=\'http://localhost:8000/promosion/imahd.png\'; this.onerror=\'this.src=\'http://localhost:8000/promosion/mlx.png\'; this.onerror=null;\'"
                   alt="Dream Car" 
                   style="max-width:300px;height:auto;border-radius:10px;margin:20px 0;">
            </td>
          </tr>

          <!-- Why Choose KiboAuto -->
          <tr>
            <td style="background:#046b40;color:#fff;text-align:center;padding:40px 20px;">
              <h3 style="text-transform:uppercase;font-size:14px;margin:0;">Why Choose KiboAuto</h3>
              <h2 style="font-size:22px;margin:10px 0 20px 0;">Easy Financing & Quick Approval</h2>
              <p style="font-size:15px;color:#E1D9F1;line-height:1.5;margin-bottom:30px;">
                Get approved for vehicle financing in minutes with our low interest rates and fast processing.
              </p>
              
              <!-- Features -->
              <table width="100%" cellpadding="0" cellspacing="0" style="margin:20px 0;">
                <tr>
                  <td width="33%" style="text-align:center;padding:10px;">
                    <div style="font-size:24px;margin-bottom:10px;"></div>
                    <h4 style="margin:0;font-size:16px;">Easy Financing</h4>
                    <p style="font-size:14px;color:#E1D9F1;margin:5px 0;">Low interest rates</p>
                  </td>
                  <td width="33%" style="text-align:center;padding:10px;">
                    <div style="font-size:24px;margin-bottom:10px;"></div>
                    <h4 style="margin:0;font-size:16px;">Quick Approval</h4>
                    <p style="font-size:14px;color:#E1D9F1;margin:5px 0;">Fast processing</p>
                  </td>
                  <td width="33%" style="text-align:center;padding:10px;">
                    <div style="font-size:24px;margin-bottom:10px;"></div>
                    <h4 style="margin:0;font-size:16px;">Trusted Service</h4>
                    <p style="font-size:14px;color:#E1D9F1;margin:5px 0;">Reliable support</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Get Started Section -->
          <tr>
            <td style="padding:30px 20px;background:#fafafa;text-align:center;">
              <h2 style="color:#111;margin-bottom:15px;">Ready to Get Started?</h2>
              <p style="font-size:15px;color:#555;line-height:1.6;margin-bottom:20px;">
                After verifying your email, you can browse our car inventory, apply for financing, or make direct purchases.
              </p>
              
              <a href="#" style="display:inline-block;background:#046b40;color:#fff;padding:10px 25px;border-radius:6px;text-decoration:none;font-weight:bold;margin:5px;">Browse Cars</a>
              <a href="#" style="display:inline-block;background:#fff;color:#046b40;padding:10px 25px;border-radius:6px;text-decoration:none;font-weight:bold;margin:5px;border:2px solid #046b40;">Apply for Loan</a>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#fff;border-top:1px solid #ddd;padding:25px;text-align:center;font-size:13px;color:#555;">
              <p style="margin:6px 0;">KiboAuto — Simplifying Car Ownership</p>
              <p style="margin:6px 0;">
                Email: info@kiboauto.com | Phone: +255 XXX XXX XXX
              </p>
              <p style="margin:6px 0;">Address: Your Business Address, Tanzania</p>
              <small style="display:block;font-size:12px;color:#999;margin-top:10px;">
                This email was sent from KiboAuto. If you have any questions, please contact our support team.
              </small>
              <small style="display:block;font-size:12px;color:#999;margin-top:5px;">
                © 2025 KiboAuto. All rights reserved.
              </small>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>