<?php
$palette = [
    'forest' => '#476029',
    'leaf'   => '#7FB341',
    'ash'    => '#F5F9F0',
    'ink'    => '#1F2A1C',
];
$type      = esc($type ?? 'New Submission');
$org       = esc($organisation ?? 'Unknown organisation');
$contact   = esc($contact_name ?? 'Unknown contact');
$contactEmail = esc($contact_email ?? 'N/A');
$submitted = esc($submitted_at ?? date('j M Y, H:i T'));
$adminLink = esc($admin_link ?? base_url('admin'));
$adminName = esc($admin_name ?? 'Admin');
$recordId  = isset($record_id) ? esc((string)$record_id) : 'N/A';
$userId    = isset($user_id) ? esc((string)$user_id) : 'N/A';
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>New <?= $type ?> Submitted</title>
</head>
<body style="margin:0;padding:32px;background-color:<?= $palette['ash']; ?>;font-family:'Helvetica Neue',Arial,sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width:640px;background:#ffffff;border-radius:20px;overflow:hidden;border:1px solid #e3eadb;">
                    <tr>
                        <td style="padding:28px 32px;background:<?= $palette['forest']; ?>;">
                            <p style="margin:0;color:#E5FFD2;text-transform:uppercase;letter-spacing:0.25em;font-size:11px;">Action Required</p>
                            <h1 style="margin:8px 0 0 0;color:#ffffff;font-size:22px;">New <?= $type ?> Submitted</h1>
                            <p style="margin:8px 0 0 0;color:#dceacf;font-size:14px;">Hi <?= $adminName ?>, please review and approve this dataset when ready.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px 32px;color:<?= $palette['ink']; ?>;font-size:15px;line-height:1.7;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate;border-spacing:0 12px;">
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Organisation</strong>
                                        <span style="font-size:17px;font-weight:600;"><?= $org ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Contact</strong>
                                        <span><?= $contact ?> &bull; <?= $contactEmail ?></span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="background:#f7fbf2;border-radius:16px;padding:16px;">
                                        <strong style="display:block;color:<?= $palette['leaf']; ?>;text-transform:uppercase;font-size:11px;letter-spacing:0.18em;">Reference</strong>
                                        <span>User ID: <?= $userId ?> &nbsp;|&nbsp; Record ID: <?= $recordId ?></span>
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
                                <a href="<?= $adminLink ?>" style="display:inline-block;padding:14px 28px;border-radius:999px;background:<?= $palette['leaf']; ?>;color:#ffffff;text-decoration:none;font-weight:600;">Review in Admin</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 32px;background:#f8f9f5;text-align:center;font-size:13px;color:#6a7562;">
                            This notification is automated by the Social Impact Register.<br>
                            Please ensure approvals follow due diligence procedures.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
