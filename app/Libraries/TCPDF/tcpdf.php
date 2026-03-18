<?php

require_once APPPATH . 'ThirdParty/tcpdf/tcpdf.php';

class SponsorshipPDF extends TCPDF
{
    public function Header()
    {
        $image_file = base_url('assets/logo.png');
        $this->Image($image_file, 10, 10, 30, '', 'PNG');
        $this->SetFont('helvetica', 'B', 16);
        $this->Cell(0, 15, 'Social Purchase Order', 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Ln(10);
    }

    public function Footer()
    {
        $this->SetY(-15);
        $image_file = base_url('assets/logo.png');
        $this->Image($image_file, 10, $this->GetY(), 30, '', 'PNG');
        $this->SetFont('helvetica', 'I', 10);
        $this->Cell(0, 10, 'Brought to you by Pluggin Ecosystem', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        $this->Image($image_file, 170, $this->GetY(), 30, '', 'PNG');
    }
}

/**
 * Generate the sponsorship PDF.
 *
 * @param array  $sponsorshipData
 * @param string $destination TCPDF destination flag. Defaults to 'S' (return as string)
 *
 * @return array|bool Returns ['filename' => string, 'content' => string] when destination is 'S' or 'E'. Otherwise bool.
 */
function generateSponsorshipPDF(array $sponsorshipData, string $destination = 'S')
{
    $pdf = new SponsorshipPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Pluggin Ecosystem');
    $pdf->SetTitle('Sponsorship Details');
    $pdf->SetMargins(15, 25, 15);
    $pdf->SetAutoPageBreak(true, 25);
    $pdf->AddPage();
    $pdf->SetFont('helvetica', '', 11);

    $html = '<h2 style="color: #007B55; border-bottom: 1px solid #e0e0e0; padding-bottom: 4px;">Sponsorship Overview</h2>';
    $html .= '<table border="0" cellspacing="3" cellpadding="2">
                <tr><td width="45%"><strong>Reference:</strong></td><td>' . esc($sponsorshipData['spo_ref']) . '</td></tr>
                <tr><td><strong>Status:</strong></td><td>' . esc($sponsorshipData['status'] ?? 'Proposal') . '</td></tr>
                <tr><td><strong>Submitted:</strong></td><td>' . esc($sponsorshipData['created_at'] ?? date('Y-m-d H:i')) . '</td></tr>
            </table><br>';

    $html .= '<h3 style="color: #4a9746;">Charity</h3>
            <table border="0" cellspacing="3" cellpadding="2">
                <tr><td width="45%"><strong>Name:</strong></td><td>' . esc($sponsorshipData['charity_name']) . '</td></tr>
                <tr><td><strong>Unique ID:</strong></td><td>' . esc($sponsorshipData['charity_unique_id'] ?? 'N/A') . '</td></tr>
                <tr><td><strong>Project:</strong></td><td>' . esc($sponsorshipData['project_name']) . '</td></tr>
                <tr><td><strong>Purpose:</strong></td><td>' . esc($sponsorshipData['project_purpose']) . '</td></tr>
            </table><br>';

    $html .= '<h3 style="color: #0c63e4;">Sponsor</h3>
            <table border="0" cellspacing="3" cellpadding="2">
                <tr><td width="45%"><strong>Name:</strong></td><td>' . esc($sponsorshipData['sponsor_name']) . '</td></tr>
                <tr><td><strong>Username:</strong></td><td>' . esc($sponsorshipData['sponsor_username']) . '</td></tr>
                <tr><td><strong>Email:</strong></td><td>' . esc($sponsorshipData['sponsor_email'] ?? 'N/A') . '</td></tr>
            </table><br>';

    $formatCurrency = static fn ($value) => '£' . number_format((float) $value, 2);

    $html .= '<h3 style="color: #a46900;">Funding Summary</h3>
            <table border="1" cellpadding="4" cellspacing="0">
                <tr>
                    <th width="50%">Metric</th>
                    <th>Amount</th>
                </tr>
                <tr><td>Required Sponsorship</td><td>' . $formatCurrency($sponsorshipData['required_sponsorship']) . '</td></tr>
                <tr><td>Your Offer</td><td>' . $formatCurrency($sponsorshipData['sponsorship_offer']) . '</td></tr>
                <tr><td>Monetary Contribution</td><td>' . $formatCurrency($sponsorshipData['monetary_value']) . '</td></tr>
                <tr><td>Goods Contribution</td><td>' . $formatCurrency($sponsorshipData['goods_value']) . '</td></tr>
                <tr><td>Volunteering Contribution</td><td>' . $formatCurrency($sponsorshipData['volunteering_value']) . '</td></tr>
            </table><br>';

    $html .= '<h3 style="color: #4a4a4a;">Additional Notes</h3>
            <p><strong>Buyer Reference:</strong> ' . esc($sponsorshipData['sponsorship_breference'] ?? 'N/A') . '</p>
            <p><strong>Sponsorship Summary:</strong> ' . esc($sponsorshipData['sponsorship_summary'] ?? 'N/A') . '</p>
            <p><strong>Additional Resources:</strong> ' . esc($sponsorshipData['additional_resources'] ?? 'N/A') . '</p>';

    $pdf->writeHTML($html, true, false, true, false, '');

    $pdfFileName = 'SPO-' . $sponsorshipData['spo_ref'] . '.pdf';
    $output = $pdf->Output($pdfFileName, $destination);

    if (in_array($destination, ['S', 'E'], true)) {
        return [
            'filename' => $pdfFileName,
            'content'  => $output,
        ];
    }

    return true;
}

?>
