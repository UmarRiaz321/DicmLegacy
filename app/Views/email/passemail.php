<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Welcome to the Pluggin Ecosystem</title>
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
                      <img src="<?= base_url('public/images/swirlgreen.png'); ?>" alt="Pluggin Ecosystem" style="display:block;width:60px;height:auto;">
                    </a>
                  </td>
                  <td style="text-align:left;vertical-align:middle;">
                    <h1 style="margin:0;font-size:22px;color:#1f3813;letter-spacing:0.4px;">Welcome to the Pluggin Ecosystem</h1>
                    <p style="margin:6px 0 0 0;font-size:14px;color:#4c6a2a;">Building UK community health, safety and resilience</p>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <tr>
            <td style="padding:28px 40px 36px 40px;color:#21321a;font-size:15px;line-height:1.7;">
              <p style="margin:0 0 18px 0;color:#1f3813;font-size:16px;font-weight:600;">Thank you for joining us in support of building UK community health, safety and resilience.</p>

              <p style="margin:0 0 18px 0;">Having signed up to be a member, we will now help you quickly set-up and get into the ecosystem.</p>

              <p style="margin:0 0 12px 0;font-weight:600;color:#1f3813;">Firstly, let&rsquo;s set-up your Profile password:</p>
              <ul style="margin:0 0 22px 25px;padding:0;color:#21321a;">
                <li style="margin-bottom:12px;">
                  Follow this URL:
                  <a href="https://pluggin-ecosystem.org/login" style="color:#2f8a1c;text-decoration:none;font-weight:600;">https://pluggin-ecosystem.org/login</a>
                </li>
              </ul>

              <div style="margin:0 0 24px 0;padding:16px;border:1px dashed #b8cfa5;border-radius:16px;background:#fbfff7;text-align:center;">
                 <img src="<?= base_url('public/images/loginscreen.png'); ?>" alt="Login Screen" style="display:block;width:100%;height:auto;margin:0 auto 12px auto;">
              </div>  

              <p style="margin:0 0 12px 0;">To login:</p>
              <ul style="margin:0 0 22px 25px;padding:0;color:#21321a;">
                <li style="margin-bottom:8px;">Your email: <span style="font-weight:600;color:#1f3813;"><?= isset($login) ? esc($login) : 'your email'; ?></span></li>
                <li style="margin-bottom:0;">Password <span style="font-size:13px;">(this is a temporary one and you will be prompted to reset this &mdash; PLEASE SAVE IT)</span>: <span style="font-weight:600;color:#1f3813;"><?= isset($password) ? esc($password) : 'temporary password'; ?></span></li>
              </ul>

              <p style="margin:0 0 12px 0;">Once you&rsquo;ve reset and set-up, now we need to get you over to the main ecosystem area.<br>Look at the main menu, and click on <strong>ECOSYSTEM</strong>.</p>

              <ol style="margin:0 0 22px 20px;padding:0;color:#21321a;">
                <li style="margin-bottom:10px;">Once there, you can login using your email and new password.</li>
                <li style="margin-bottom:10px;">You&rsquo;ll then see the main home page and in the menu is a <strong>Members Area</strong>.</li>
                <li style="margin-bottom:0;">Check your inbox again, our Membership Team will send you another email designed to help you settle in.</li>
              </ol>

              <p style="margin:0 0 18px 0;font-weight:600;color:#1f3813;">Ongoing Support:</p>
              <p style="margin:0 0 24px 0;">Should you have any need for support, our Membership Team can be reached via email: <a href="mailto:membership_team@pluggin.org" style="color:#2f8a1c;text-decoration:none;font-weight:600;">membership_team@pluggin.org</a>.</p>

              <p style="margin:0 0 4px 0;">Welcome aboard.</p>
              <p style="margin:0 0 20px 0;">Best regards,</p>

              <p style="margin:0;font-weight:600;">Jay Baughan FRSA</p>
              <p style="margin:4px 0 0 0;">Chief Executive</p>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
