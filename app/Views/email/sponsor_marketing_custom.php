<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Message from Pluggin Ecosystem</title>
</head>
<body style="margin:0;padding:32px;background:#f4f8f1;font-family:'Helvetica Neue',Arial,sans-serif;">
<table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
    <tr>
        <td align="center">
            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="max-width:640px;background:#ffffff;border-radius:18px;border:1px solid #d7ebc4;box-shadow:0 12px 28px rgba(32,51,20,.12);overflow:hidden;">
                <tr>
                    <td style="padding:28px 36px;border-bottom:4px solid #8cb61d;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0">
                            <tr>
                                <td style="width:64px;padding-right:16px;">
                                    <img src="<?= base_url('public/images/swirlgreen.png'); ?>" alt="Pluggin Ecosystem" style="display:block;width:56px;height:auto;">
                                </td>
                                <td>
                                    <p style="margin:0;font-size:13px;letter-spacing:2px;font-weight:600;color:#6a8d1e;text-transform:uppercase;">Pluggin Ecosystem</p>
                                    <h1 style="margin:6px 0 0 0;font-size:22px;color:#223517;">Membership Message</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:32px 36px 26px 36px;color:#1f2f13;font-size:15px;line-height:1.7;">
                        <p style="margin:0 0 16px 0;">Hi <?= esc($contactName ?? 'there') ?>,</p>
                        <p style="margin:0 0 18px 0;">
                            We are reaching out regarding <?= esc(($organisation ?? '') !== '' ? $organisation : 'your membership') ?> in the Pluggin Ecosystem.
                        </p>
                        <div style="margin:0 0 20px 0;color:#1f2f13;font-size:15px;line-height:1.7;">
                            <?= $customMessage ?? '' ?>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td style="padding:16px 24px;background:#f6fbf3;text-align:center;color:#6b7d4c;font-size:12px;">
                        &copy; <?= date('Y'); ?> Pluggin Ecosystem
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
