<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Insurance Quote Status - KiboAuto</title>
</head>
<body style="margin:0;padding:0;font-family:Arial,sans-serif;background-color:#f5f5f5;color:#333;">
  <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f5f5f5;padding:0;margin:0;">
    <tr>
      <td align="center">
        <table width="600" cellpadding="0" cellspacing="0" style="max-width:600px;background:#fff;border-radius:10px;overflow:hidden;">

          <!-- Header -->
          <tr>
            <td align="center" style="background-color:#046b40;padding:12px;">
              <img src="{{ $logo }}" alt="KiboAuto" style="max-width:200px;height:auto;display:inline-block;">
            </td>
          </tr>

          <!-- Status Update Section -->
          <tr>
            <td style="padding:28px 22px;">
              <h2 style="color:#111;font-size:20px;margin:0 0 16px 0;">Insurance Quote Status Update</h2>
              <p style="font-size:14px;color:#555;line-height:1.6;margin:0 0 12px 0;">
                Hello <strong>{{ $name }}</strong>,
              </p>
              @if($status === 'approved')
                <p style="font-size:14px;color:#555;line-height:1.6;margin:0 0 18px 0;">
                  Great news! Your insurance quotation request has been <strong>approved</strong>. Our team will contact you shortly to finalize details.
                </p>
              @else
                <p style="font-size:14px;color:#555;line-height:1.6;margin:0 0 18px 0;">
                  Your insurance quotation request has been updated to:
                </p>
              @endif

              <!-- Status Badge -->
              <div style="display:inline-block;background:#f8f9fa;border:2px solid #046b40;border-radius:10px;padding:12px 18px;margin:10px 0;">
                <span style="font-size:16px;font-weight:bold;color:#046b40;text-transform:capitalize;">
                  {{ str_replace('_', ' ', $status) }}
                </span>
              </div>

              <!-- Request Summary -->
              <div style="background:#fafafa;border:1px solid #eee;border-radius:8px;padding:16px;margin:20px 0;">
                <div style="font-size:14px;color:#333;margin-bottom:8px;"><strong>Request #{{ $req->id }}</strong></div>
                <table width="100%" cellpadding="0" cellspacing="0" style="font-size:13px;color:#555;">
                  <tr>
                    <td style="padding:6px 0;">Vehicle Class:</td>
                    <td style="padding:6px 0;"><strong>{{ $req->vehicle_class ?? '-' }}</strong></td>
                  </tr>
                  <tr>
                    <td style="padding:6px 0;">Coverage:</td>
                    <td style="padding:6px 0;"><strong>{{ $req->type_of_cover ?? '-' }}</strong></td>
                  </tr>
                  <tr>
                    <td style="padding:6px 0;">Claim Status:</td>
                    <td style="padding:6px 0;"><strong>{{ $req->claim_status ?? '-' }}</strong></td>
                  </tr>
                  <tr>
                    <td style="padding:6px 0;">Total Premium:</td>
                    <td style="padding:6px 0;"><strong>
                      @if(!is_null($req->total_premium))
                        TSh {{ number_format($req->total_premium) }}
                      @else
                        -
                      @endif
                    </strong></td>
                  </tr>
                  <tr>
                    <td style="padding:6px 0;">Submitted on:</td>
                    <td style="padding:6px 0;"><strong>{{ optional($req->created_at)->format('Y-m-d H:i') }}</strong></td>
                  </tr>
                </table>
              </div>

              <p style="font-size:13px;color:#666;line-height:1.6;margin:18px 0 0 0;">
                If you have any questions, reply to this email or contact us at <strong>+255 757 330 260</strong>.
              </p>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="background:#eeecec;text-align:center;padding:16px 20px;">
              <div style="font-size:12px;color:#666;">
                © {{ date('Y') }} KiboAuto. All rights reserved.
              </div>
            </td>
          </tr>

        </table>
      </td>
    </tr>
  </table>
</body>
</html>


