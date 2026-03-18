<?php
$d = $d ?? [];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title><?= esc($d['document_title'] ?? 'Social Purchase Order') ?></title>
    <style>
        @page { margin: 72px 18px 34px 18px; }
        * { box-sizing: border-box; }

        body {
            margin: 0;
            font-family: Arial, DejaVu Sans, sans-serif;
            font-size: 11px;
            color: #1f2e18;
            background: #ffffff;
        }

        .pdf-header {
            position: fixed;
            top: -72px;
            left: -18px;
            right: -18px;
            height: 66px;
            background: #70bec7;
            border-bottom: 1px solid #5eaeb7;
            padding: 4px 18px 1px;
        }
        .header-table {
            width: 100%;
            border-collapse: collapse;
        }
        .header-logo {
            width: 62px;
            vertical-align: middle;
        }
        .header-logo img {
            max-height: 42px;
            width: auto;
            display: block;
        }
        .header-title {
            text-align: right;
            vertical-align: middle;
        }
        .header-title h1 {
            margin: 0;
            color: #fff;
            font-size: 21px;
            line-height: 1.1;
            font-weight: 600;
            letter-spacing: 0.2px;
        }
        .header-title p {
            margin: 3px 0 0;
            color: #eaf4dd;
            font-size: 8px;
            text-transform: uppercase;
            letter-spacing: 0.65px;
        }

        .pdf-footer {
            position: fixed;
            bottom: -24px;
            left: 0;
            right: 0;
            border-top: 1px solid #d2dfc3;
            color: #617053;
            font-size: 8.7px;
            padding-top: 3px;
            height: 18px;
        }
        .footer-table {
            width: 100%;
            border-collapse: collapse;
        }
        .footer-left { text-align: left; }
        .footer-right { text-align: right; }
        .page-number:before { content: "Page " counter(page); }

        .hard-break {
            page-break-after: always;
            clear: both;
            display: block;
            height: 0;
            margin: 0;
            padding: 0;
            border: 0;
            font-size: 0;
            line-height: 0;
        }

        .page {
            margin: 0;
            padding: 0;
            position: relative;
        }
        .page:after {
            content: "";
            display: table;
            clear: both;
        }

        .row {
            width: 100%;
            margin: 0 0 8px;
            page-break-inside: avoid;
        }
        .row:after {
            content: "";
            display: table;
            clear: both;
        }

        .meta-row {
            margin-top: 14px;
            margin-bottom: 10px;
        }

        .col-2 {
            float: left;
            width: 49.2%;
        }
        .col-2 + .col-2 {
            margin-left: 1.6%;
        }

        .col-4 {
            float: left;
            width: 24%;
        }
        .col-4 + .col-4 {
            margin-left: 1.3333%;
        }

        .card {
            border: 1px solid #d7dde6;
            border-radius: 8px;
            background: #ffffff;
            padding: 8px 9px;
            margin: 0 0 8px;
            page-break-inside: auto;
        }
        .page .card:last-child { margin-bottom: 0; }

        .meta-card {
            background: #ffffff;
            border-color: #d7dde6;
            border-left: 3px solid #70bec7;
            padding: 6px 8px;
        }
        .meta-card .value-strong {
            font-size: 11px;
            line-height: 1.2;
        }

        .title {
            margin: 0 0 3px;
            color: #70bec7;
            font-size: 9.5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 700;
            text-align: left;
        }

        .value {
            margin: 0;
            color: #1f2937;
            font-size: 11px;
            line-height: 1.34;
            text-align: left;
            white-space: pre-line;
        }

        .value-strong {
            margin: 0;
            color: #111827;
            font-size: 12.5px;
            line-height: 1.24;
            font-weight: 700;
            text-align: left;
            white-space: pre-line;
        }

        .subtle {
            margin: 2px 0 0;
            color: #5b714e;
            font-size: 9px;
            line-height: 1.25;
            text-align: left;
        }

        .between {
            margin: 0 0 5px;
            text-align: center;
            font-family: Arial, DejaVu Sans, sans-serif;
            font-size: 26px;
            line-height: 1;
            color: #1a1a1a;
        }

        .party-col {
            float: left;
            width: 45.5%;
        }
        .and-col {
            float: left;
            width: 9%;
            text-align: center;
            padding-top: 26px;
        }
        .and-inline {
            margin: 0;
            font-family: Arial, DejaVu Sans, sans-serif;
            font-size: 18px;
            line-height: 1;
            font-style: italic;
            color: #1a1a1a;
        }

        .metric-card {
            min-height: 56px;
            page-break-inside: avoid;
        }

        .highlight {
            background: #ffffff;
            border-top: 2px solid #70bec7;
        }
    </style>
</head>
<body>
    <div class="pdf-header">
        <table class="header-table">
            <tr>
                <td class="header-logo">
                    <?php if (!empty($d['logo_data_uri'])): ?>
                        <img src="<?= esc($d['logo_data_uri']) ?>" alt="Pluggin">
                    <?php endif; ?>
                </td>
                <td class="header-title">
                    <h1><?= esc($d['document_title'] ?? 'Social Purchase Order') ?></h1>
                    <p>Pluggin Marketplace</p>
                </td>
            </tr>
        </table>
    </div>

    <div class="pdf-footer">
        <table class="footer-table">
            <tr>
                <td class="footer-left">Pluggin Marketplace</td>
                <td class="footer-right"><span class="page-number"></span> | Generated contract document</td>
            </tr>
        </table>
    </div>

    <section class="page">
        <div class="row meta-row">
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Reference</p>
                    <p class="value-strong"><?= esc($d['spo_ref'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Status</p>
                    <p class="value-strong"><?= esc($d['status_label'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <p class="between">Between</p>
        <div class="row">
            <div class="party-col">
                <div class="card">
                    <p class="title">Charity</p>
                    <p class="value"><?= esc($d['charity_name'] ?? 'N/A') ?></p>
                    <p class="subtle"><?= esc($d['charity_unique_id'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="and-col">
                <p class="and-inline">And</p>
            </div>
            <div class="party-col">
                <div class="card">
                    <p class="title">Business</p>
                    <p class="value"><?= esc($d['sponsor_name'] ?? 'N/A') ?></p>
                    <p class="subtle"><?= esc($d['sponsor_unique_id'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="card">
                    <p class="title">Buyer Reference</p>
                    <p class="value-strong"><?= esc($d['buyer_reference'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card">
                    <p class="title">Charity Ask</p>
                    <p class="value-strong"><?= esc($d['required_sponsorship'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <p class="title">Project Name</p>
            <p class="value-strong"><?= esc($d['project_name'] ?? 'N/A') ?></p>
            <p class="title" style="margin-top:5px;">Purpose of Project / Service</p>
            <p class="value"><?= esc($d['project_purpose'] ?? 'N/A') ?></p>
        </div>
    </section>

    <div class="hard-break"></div>

    <section class="page">
        <div class="row meta-row">
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Reference</p>
                    <p class="value-strong"><?= esc($d['spo_ref'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Status</p>
                    <p class="value-strong"><?= esc($d['status_label'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <p class="title">Key Objectives of Project</p>
            <p class="value"><?= esc($d['key_objectives'] ?? 'N/A') ?></p>
        </div>

        <div class="card">
            <p class="title">How Organisation Intends to Use Social Value Offered</p>
            <p class="value"><?= esc($d['funding_usage'] ?? 'N/A') ?></p>
        </div>
    </section>

    <div class="hard-break"></div>

    <section class="page">
        <div class="row meta-row">
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Reference</p>
                    <p class="value-strong"><?= esc($d['spo_ref'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Status</p>
                    <p class="value-strong"><?= esc($d['status_label'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-4">
                <div class="card metric-card">
                    <p class="title">Social Value Offer</p>
                    <p class="value-strong"><?= esc($d['social_value_offer'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-4">
                <div class="card metric-card">
                    <p class="title">Monetary Value</p>
                    <p class="value-strong"><?= esc($d['monetary_value'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-4">
                <div class="card metric-card">
                    <p class="title">Goods & Services</p>
                    <p class="value-strong"><?= esc($d['goods_value'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-4">
                <div class="card metric-card">
                    <p class="title">Volunteering</p>
                    <p class="value-strong"><?= esc($d['volunteering_value'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <p class="title">Detail of Monetary Value</p>
            <p class="value"><?= esc($d['monetary_details'] ?? 'N/A') ?></p>
            <p class="title" style="margin-top:6px;">Value of Goods and Services Details</p>
            <p class="value"><?= esc($d['goods_details'] ?? 'N/A') ?></p>
            <p class="title" style="margin-top:6px;">Volunteering Detail</p>
            <p class="value"><?= esc($d['volunteering_details'] ?? 'N/A') ?></p>
        </div>

        <div class="row">
            <div class="col-2">
                <div class="card highlight">
                    <p class="title">Total</p>
                    <p class="value-strong" style="font-size:18px;line-height:1.2;"><?= esc($d['total'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card highlight">
                    <p class="title">Balance</p>
                    <p class="value-strong" style="font-size:18px;line-height:1.2;"><?= esc($d['balance'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>
    </section>

    <div class="hard-break"></div>

    <section class="page">
        <div class="row meta-row">
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Reference</p>
                    <p class="value-strong"><?= esc($d['spo_ref'] ?? 'N/A') ?></p>
                </div>
            </div>
            <div class="col-2">
                <div class="card meta-card">
                    <p class="title">Status</p>
                    <p class="value-strong"><?= esc($d['status_label'] ?? 'N/A') ?></p>
                </div>
            </div>
        </div>

        <div class="card">
            <p class="title">Sponsorship Summary</p>
            <p class="value"><?= esc($d['sponsorship_summary'] ?? 'N/A') ?></p>
        </div>
    </section>
</body>
</html>
