<?php
$palette = [
    'forest' => '#476029',
    'leaf'   => '#7FB341',
    'ash'    => '#F5F9F0',
    'ink'    => '#1F2A1C',
];
$adminName   = esc($admin_name ?? 'Admin');
$typeLabel   = esc($type ?? 'Sponsorship Proposal');
$charity     = esc($charity_name ?? 'Unknown charity');
$charityUid  = esc($charity_unique ?? 'N/A');
$project     = esc($project_name ?? 'N/A');
$sponsor     = esc($sponsor_name ?? 'N/A');
$sponsorMail = esc($sponsor_email ?? 'N/A');
$offer       = esc($offer_amount ?? '0.00');
$required    = esc($required_amount ?? '0.00');
$ref         = esc($spo_ref ?? 'N/A');
$submitted   = esc($submitted_at ?? date('j M Y, H:i T'));
$status      = esc($status ?? 'PROP');
$adminLink   = esc($admin_link ?? base_url('admin'));
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New Sponsorship Alert</title>
</head>
<body style="margin:0;padding:32px;background-color:<?= $palette['ash']; ?>;font-family:'Helvetica Neue',Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background:#ffffff;border-radius:20px;overflow:hidden;border:1px solid #e3eadb;">
                    <tr>
                        <td style="padding:28px 32px;background:<?= $palette['forest']; ?>;">
                            <p style="margin:0;color:#E5FFD2;text-transform:uppercase;letter-spacing:0.25em;font-size:11px;">New Submission</p>
                            <h1 style="margin:8px 0 0 0;color:#ffffff;font-size:22px;"><?= $typeLabel ?></h1>
                            <p style="margin:8px 0 0 0;color:#dceacf;font-size:14px;">Hi <?= $adminName ?>, a new sponsorship request needs attention.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 32px;color:<?= $palette['ink']; ?>;font-size:15px;line-height:1.7;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate;border-spacing:0 12px;">
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Reference</strong>
                                        <span><?= $ref ?> &bull; Status: <?= $status ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Charity</strong>
                                        <span><?= $charity ?> &mdash; <?= $charityUid ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Project</strong>
                                        <span><?= $project ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Sponsor</strong>
                                        <span><?= $sponsor ?> &bull; <?= $sponsorMail ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Financials</strong>
                                        <span>Offer: £<?= $offer ?> &mdash; Required: £<?= $required ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Submitted</strong>
                                        <span><?= $submitted ?></span>
                                    </td>
                                </tr>
                            </table>

                            <div style="margin-top:28px;text-align:center;">
                                <a href="<?= $adminLink ?>" style="display:inline-block;padding:14px 28px;border-radius:999px;background:<?= $palette['leaf']; ?>;color:#ffffff;text-decoration:none;font-weight:600;">Review Sponsorships</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 32px;background:#f8f9f5;text-align:center;font-size:13px;color:#6a7562;">
                            Automated alert from the Social Impact Register.<br>
                            Please follow due diligence before approving.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
