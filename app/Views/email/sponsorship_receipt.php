<table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="font-family: 'Poppins', Arial, sans-serif; background:#f7f9fb; padding:24px 0;">
    <tr>
        <td align="center">
            <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="background:#ffffff; border-radius:18px; overflow:hidden; box-shadow:0 12px 40px rgba(0,0,0,0.05);">
                <tr>
                    <td style="padding:32px; background:#5c8c2a;">
                        <h1 style="margin:0; color:#ffffff; font-size:24px; font-weight:600;">Thank you, <?= esc($sponsorName ?? 'Partner'); ?>!</h1>
                        <p style="margin:8px 0 0; color:#e6ffd4; font-size:15px;">
                            We've received your sponsorship proposal for <strong><?= esc($charityName ?? 'the selected organisation'); ?></strong>.
                        </p>
                    </td>
                </tr>
                <tr>
                    <td style="padding:32px;">
                        <p style="font-size:15px; color:#4a4a4a; margin:0 0 16px;">
                            Attached is your Social Purchase Order (SPO) PDF for reference. Below is a quick summary for your records:
                        </p>
                        <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="border-collapse:separate; border-spacing:0 12px;">
                            <tr>
                                <td style="background:#f5f9f0; border-radius:12px; padding:16px;">
                                    <strong style="display:block; color:#728f23; font-size:13px;">Sponsorship Reference</strong>
                                    <span style="font-size:16px; color:#1c1c1c;"><?= esc($sponsorshipRef ?? 'Pending'); ?></span>
                                </td>
                                <td style="background:#f5f9f0; border-radius:12px; padding:16px;">
                                    <strong style="display:block; color:#728f23; font-size:13px;">Submitted</strong>
                                    <span style="font-size:16px; color:#1c1c1c;"><?= esc($submittedAt ?? date('j M Y, H:i')); ?></span>
                                </td>
                            </tr>
                        </table>

                        <div style="margin:28px 0 12px;">
                            <h2 style="margin:0 0 12px; color:#1b3a21; font-size:18px;">Project Snapshot</h2>
                            <div style="border:1px solid #eef2ea; border-radius:14px; padding:18px;">
                                <p style="margin:0; font-size:14px; color:#4a4a4a;">
                                    <strong>Charity:</strong> <?= esc($charityName ?? '') ?><br>
                                    <strong>Project:</strong> <?= esc($projectName ?? '') ?><br>
                                    <strong>Purpose:</strong> <?= esc($projectPurpose ?? 'N/A'); ?>
                                </p>
                            </div>
                        </div>

                        <div style="margin:28px 0 0;">
                            <h2 style="margin:0 0 12px; color:#1b3a21; font-size:18px;">Next Steps</h2>
                            <ol style="margin:0; padding-left:18px; font-size:14px; color:#4a4a4a; line-height:1.6;">
                                <li>Use this PDF to submit your social value in your bid.</li>
                                <li>If your bid is successful this will convert to a Collaboration Agreement.</li>
                                <li>We will contact you to formalise this with the public buyer and project provider.</li>
                            </ol>
                        </div>

                        <p style="font-size:13px; color:#7a7a7a; margin:28px 0 0;">
                            Need any help? Reach our Membership Team at <a href="mailto:<?= esc($supportEmail ?? 'membership_team@pluggin.org'); ?>" style="color:#5c8c2a; text-decoration:none;"><?= esc($supportEmail ?? 'membership_team@pluggin.org'); ?></a>
                        </p>

                        <p style="font-size:14px; color:#1b3a21; margin:20px 0 0;">
                            Warm regards,<br>
                            <strong>The Pluggin Ecosystem Team</strong>
                        </p>
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
