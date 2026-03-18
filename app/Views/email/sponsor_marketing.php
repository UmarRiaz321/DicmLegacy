<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome to the Pluggin Ecosystem</title>
</head>
<body style="margin:0;padding:32px;background-color:#f2f7f1;font-family:'Helvetica Neue',Arial,sans-serif;">
<table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse:collapse;">
    <tr>
        <td align="center">
            <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width:640px;background-color:#ffffff;border-radius:18px;border:1px solid #d6ecca;box-shadow:0 14px 32px rgba(39,67,26,.12);overflow:hidden;">
                <tr>
                    <td style="padding:32px 40px 20px 40px;border-bottom:4px solid #8cb61d;">
                        <table role="presentation" width="100%" cellspacing="0" cellpadding="0" style="border-collapse:collapse;">
                            <tr>
                                <td style="width:68px;padding-right:16px;">
                                    <a href="<?= base_url(); ?>" style="display:inline-block;">
                                        <img src="<?= base_url('public/images/swirlgreen.png'); ?>" alt="Pluggin Ecosystem" style="display:block;width:60px;height:auto;">
                                    </a>
                                </td>
                                <td style="text-align:left;vertical-align:middle;">
                                    <p style="margin:0;font-size:13px;letter-spacing:2px;font-weight:600;color:#6a8d1e;text-transform:uppercase;">Pluggin Ecosystem</p>
                                    <h1 style="margin:6px 0 0 0;font-size:22px;color:#203314;">Marketing Welcome</h1>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td style="padding:32px 40px 20px 40px;color:#1f2e11;font-size:15px;line-height:1.7;">
                        <p style="margin:0 0 18px 0;">Hi <?= esc($contactName ?? 'there') ?>,</p>

                        <p style="margin:0 0 18px 0;">
                            Great news, <?= esc($organisation ?: 'your business') ?> has just joined the Pluggin Ecosystem.
                            This now provides significant marketing and sales support opportunities, completely free of charge.
                        </p>

                        <p style="margin:0 0 18px 0;">
                            Our Dual Impact Collaboration Marketplace (DICM) was built with and for UK public procurement bodies —
                            it’s the UK’s first social value marketplace where social value is the brand differentiator buyers are looking for.
                        </p>

                        <p style="margin:0 0 18px 0;">
                            As the named marketing contact for your business membership, we’ll help your digital marketing operations extend into the DICM
                            and promote real-time social value within contracts, directly to our public buyer audience across 44 marketplace areas.
                        </p>

                        <p style="margin:0 0 18px 0;font-weight:600;">Always-On Service</p>
                        <p style="margin:0 0 18px 0;">
                            I lead our dedicated support for business member marketing teams, delivered via the Always-On Service.
                            This regular e-newsletter and set of digital tools provide insights, tips, and updates that will help you shape your social value marketing for the DICM.
                            It’s designed to help your sales, contract, and social value colleagues visually demonstrate your social value—within live contracts and across UK communities.
                        </p>

                        <table role="presentation" cellspacing="0" cellpadding="0" border="0" style="margin:0 0 28px 0;">
                            <tr>
                                <td>
                                    <a href="https://pluggin.org/always-on" style="background:#8cb61d;color:#ffffff;text-decoration:none;font-weight:600;padding:12px 24px;border-radius:24px;display:inline-block;">
                                        Explore the Always-On Service
                                    </a>
                                </td>
                            </tr>
                        </table>

                        <p style="margin:0 0 18px 0;">
                            I’m looking forward to seeing more about your brand’s social value going forward.
                        </p>

                        <p style="margin:0 0 4px 0;">Best regards,</p>
                        <p style="margin:0;font-weight:600;">Jay Baughan</p>
                        <p style="margin:4px 0 0 0;">Chief Executive, Pluggin Ecosystem</p>
                        <p style="margin:12px 0 0 0;font-size:13px;color:#658037;">membership_team@pluggin.org</p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:18px 24px;background-color:#f6fbf3;text-align:center;color:#6c7d4c;font-size:12px;">
                        &copy; <?= date('Y'); ?> Pluggin Ecosystem. Building UK community health, safety &amp; resilience.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
