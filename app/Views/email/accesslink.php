<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Password Reset</title>
</head>
<body style="margin:0;padding:32px;background-color:#f4f9f1;font-family:'Helvetica Neue', Arial, sans-serif;">
  <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
    <tr>
      <td align="center">
        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:620px;background-color:#ffffff;border-radius:18px;border:1px solid #d7ebc4;box-shadow:0 14px 32px rgba(53, 87, 35, 0.12);overflow:hidden;">
          <tr>
            <td style="padding:36px 40px 8px 40px;border-bottom:4px solid #8cb61d;">
              <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:collapse;">
                <tr>
                  <td style="width:72px;padding-right:16px;">
                    <a href="<?= base_url(); ?>" style="display:inline-block;">
                      <img src="<?= base_url('public/images/plugin.png'); ?>" alt="Pluggin Ecosystem" style="display:block;width:60px;height:auto;">
                    </a>
                  </td>
                  <td style="text-align:left;vertical-align:middle;">
                    <h1 style="margin:0;font-size:22px;color:#1f3813;letter-spacing:0.4px;">Reset your password</h1>
                    <p style="margin:6px 0 0 0;font-size:14px;color:#4c6a2a;">Securing your access to the Pluggin Ecosystem</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding:28px 40px 36px 40px;color:#21321a;font-size:15px;line-height:1.7;">
              <p style="margin:0 0 18px 0;">Hi <?= esc($userName) ?>,</p>

              <p style="margin:0 0 18px 0;">We received a request to reset the password linked to your account. Click the button below to choose a new password. This link will expire shortly.</p>

              <p style="margin:0 0 24px 0;">
                <a href="<?= esc($accessLink) ?>" style="display:inline-block;padding:12px 24px;background:#2f8a1c;color:#ffffff;text-decoration:none;border-radius:6px;font-weight:600;">Reset Password</a>
              </p>

              <p style="margin:0 0 18px 0;">If you did not request this change, you can safely ignore this email—your current password will continue to work.</p>

              <p style="margin:0;">Stay secure,<br>The Pluggin Ecosystem Team</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
