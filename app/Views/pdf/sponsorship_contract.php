<?php
$page = (int) ($page ?? 1);
$d = $d ?? [];

$cardOpen = '<div style="border:1px solid #dbe4d1;background-color:#f8fbf4;border-radius:10px;padding:12px;">';
$cardClose = '</div>';

$metric = static function (string $title, string $value): string {
    return '<td style="width:24%;border:1px solid #dbe4d1;background-color:#f8fbf4;border-radius:9px;padding:10px 10px;">
        <div style="font-size:8.8px;color:#6f8b49;letter-spacing:0.7px;text-transform:uppercase;font-weight:bold;">' . esc($title) . '</div>
        <div style="font-size:11.2px;color:#22311b;font-weight:bold;margin-top:4px;">' . esc($value) . '</div>
    </td>';
};
?>
<div style="font-family:helvetica,arial,sans-serif;font-size:10.5px;color:#1f2a1c;line-height:1.5;">
    <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom:12px;">
        <tr>
            <td style="width:49%;border:1px solid #cfe0bd;background-color:#eef7e5;border-radius:9px;padding:10px 12px;">
                <span style="font-size:8.6px;color:#6f8b49;letter-spacing:0.7px;text-transform:uppercase;font-weight:bold;">Reference</span><br>
                <span style="font-size:12.8px;color:#22311b;font-weight:bold;"><?= esc($d['spo_ref'] ?? 'N/A') ?></span>
            </td>
            <td style="width:2%;"></td>
            <td style="width:49%;border:1px solid #cfe0bd;background-color:#eef7e5;border-radius:9px;padding:10px 12px;">
                <span style="font-size:8.6px;color:#6f8b49;letter-spacing:0.7px;text-transform:uppercase;font-weight:bold;">Status</span><br>
                <span style="font-size:12.8px;color:#22311b;font-weight:bold;"><?= esc($d['status_label'] ?? 'N/A') ?> (<?= esc($d['status_code'] ?? 'N/A') ?>)</span>
            </td>
        </tr>
    </table>

    <?php if ($page === 1): ?>
        <div style="font-size:16px;font-weight:bold;color:#2d4722;margin-bottom:6px;">Contract Page 1 - Core Details</div>
        <div style="font-size:10px;color:#5f7550;margin-bottom:10px;">This contract captures agreed social value sponsorship terms between the participating parties.</div>

        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom:10px;">
            <tr>
                <?= $metric('CSE Identifier', $d['charity_unique_id'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Business Identifier', $d['sponsor_unique_id'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Buyer Reference', $d['buyer_reference'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Sponsorship Ask', $d['required_sponsorship'] ?? 'N/A') ?>
            </tr>
        </table>

        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">Parties to Agreement</div>
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-top:7px;">
            <tr>
                <td style="width:49%;border:1px solid #dbe4d1;background-color:#ffffff;border-radius:9px;padding:10px;">
                    <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;font-weight:bold;">Charity / CSE</div>
                    <div style="font-size:13px;font-weight:bold;color:#203018;"><?= esc($d['charity_name'] ?? 'N/A') ?></div>
                    <div style="font-size:10px;color:#526947;">ID: <?= esc($d['charity_unique_id'] ?? 'N/A') ?></div>
                </td>
                <td style="width:2%;"></td>
                <td style="width:49%;border:1px solid #dbe4d1;background-color:#ffffff;border-radius:9px;padding:10px;">
                    <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;font-weight:bold;">Business / Sponsor</div>
                    <div style="font-size:13px;font-weight:bold;color:#203018;"><?= esc($d['sponsor_name'] ?? 'N/A') ?></div>
                    <div style="font-size:10px;color:#526947;">ID: <?= esc($d['sponsor_unique_id'] ?? 'N/A') ?></div>
                </td>
            </tr>
        </table>
        <?= $cardClose ?>

        <div style="height:8px;"></div>

        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">Project Name</div>
        <div style="font-size:13px;font-weight:bold;color:#203018;margin-top:4px;"><?= esc($d['project_name'] ?? 'N/A') ?></div>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;margin-top:10px;">Purpose of Project / Service</div>
        <div style="white-space:pre-line;font-size:10.7px;color:#25371c;margin-top:4px;min-height:220px;"><?= esc($d['project_purpose'] ?? 'N/A') ?></div>
        <?= $cardClose ?>
    <?php endif; ?>

    <?php if ($page === 2): ?>
        <div style="font-size:16px;font-weight:bold;color:#2d4722;margin-bottom:8px;">Contract Page 2 - Objectives & Delivery</div>
        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">Key Objectives of Project</div>
        <div style="white-space:pre-line;font-size:10.8px;color:#25371c;margin-top:4px;min-height:290px;"><?= esc($d['key_objectives'] ?? 'N/A') ?></div>
        <?= $cardClose ?>

        <div style="height:10px;"></div>

        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">How Business Intends to Use Funding</div>
        <div style="white-space:pre-line;font-size:10.8px;color:#25371c;margin-top:4px;min-height:290px;"><?= esc($d['funding_usage'] ?? 'N/A') ?></div>
        <?= $cardClose ?>
    <?php endif; ?>

    <?php if ($page === 3): ?>
        <div style="font-size:16px;font-weight:bold;color:#2d4722;margin-bottom:8px;">Contract Page 3 - Financial Offer Breakdown</div>
        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;margin-bottom:10px;">
            <tr>
                <?= $metric('Social Value Offer', $d['social_value_offer'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Monetary Value', $d['monetary_value'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Goods & Services Value', $d['goods_value'] ?? 'N/A') ?>
                <td style="width:1.33%;"></td>
                <?= $metric('Volunteering Value', $d['volunteering_value'] ?? 'N/A') ?>
            </tr>
        </table>

        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">Monetary Detail</div>
        <div style="white-space:pre-line;font-size:10.7px;color:#25371c;margin-top:4px;min-height:110px;"><?= esc($d['monetary_details'] ?? 'N/A') ?></div>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;margin-top:8px;">Goods & Services Detail</div>
        <div style="white-space:pre-line;font-size:10.7px;color:#25371c;margin-top:4px;min-height:110px;"><?= esc($d['goods_details'] ?? 'N/A') ?></div>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;margin-top:8px;">Volunteering Detail</div>
        <div style="white-space:pre-line;font-size:10.7px;color:#25371c;margin-top:4px;min-height:110px;"><?= esc($d['volunteering_details'] ?? 'N/A') ?></div>
        <?= $cardClose ?>

        <div style="height:9px;"></div>

        <table cellpadding="0" cellspacing="0" border="0" style="width:100%;">
            <tr>
                <td style="width:49%;border:1px solid #dbe4d1;background-color:#edf6e5;border-radius:9px;padding:10px;">
                    <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;font-weight:bold;">Total</div>
                    <div style="font-size:16px;font-weight:bold;color:#203018;"><?= esc($d['total'] ?? 'N/A') ?></div>
                </td>
                <td style="width:2%;"></td>
                <td style="width:49%;border:1px solid #dbe4d1;background-color:#edf6e5;border-radius:9px;padding:10px;">
                    <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;font-weight:bold;">Balance</div>
                    <div style="font-size:16px;font-weight:bold;color:#203018;"><?= esc($d['balance'] ?? 'N/A') ?></div>
                </td>
            </tr>
        </table>
    <?php endif; ?>

    <?php if ($page === 4): ?>
        <div style="font-size:16px;font-weight:bold;color:#2d4722;margin-bottom:8px;">Contract Page 4 - Sponsorship Summary</div>
        <?= $cardOpen ?>
        <div style="font-size:9px;color:#6f8b49;text-transform:uppercase;letter-spacing:0.7px;font-weight:bold;">Final Contract Summary</div>
        <div style="white-space:pre-line;font-size:10.9px;color:#25371c;margin-top:4px;min-height:610px;"><?= esc($d['sponsorship_summary'] ?? 'N/A') ?></div>
        <?= $cardClose ?>
    <?php endif; ?>
</div>
