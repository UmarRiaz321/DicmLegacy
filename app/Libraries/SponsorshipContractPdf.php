<?php

namespace App\Libraries;

use Dompdf\Dompdf;
use Dompdf\Options;

class SponsorshipContractPdf
{
    private array $statusMap = [
        'PROP' => 'Proposal',
        'OFBP' => 'SPO Submitted',
        'OAAS' => 'SPO Accepted',
        'SIGN-U' => 'Signed Unpaid',
        'CONF' => 'Sponsorship Confirmed',
    ];

    public function render(array $record): array
    {
        $data = $this->normalize($record);
        $html = view('pdf/new_template', ['d' => $data]);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isRemoteEnabled', true);
        $options->set('isPhpEnabled', false);
        $options->set('defaultFont', 'DejaVu Sans');
        $options->set('chroot', ROOTPATH);

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html, 'UTF-8');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        $filename = ($data['spo_ref'] !== '' ? $data['spo_ref'] : 'SPO-Contract') . '.pdf';

        return [
            'filename' => $filename,
            'content'  => $dompdf->output(),
        ];
    }

    private function normalize(array $record): array
    {
        $required = (float) ($record['required_sponsorship'] ?? 0);
        $offer = (float) ($record['sponsorship_offer'] ?? 0);
        $monetary = (float) ($record['monetary_value'] ?? 0);
        $goods = (float) ($record['goods_value'] ?? 0);
        $volunteering = (float) ($record['volunteering_value'] ?? 0);
        $statusCode = (string) ($record['status'] ?? 'PROP');

        return [
            'document_title' => 'Social Purchase Order',
            'spo_ref' => $this->clean($record['spo_ref'] ?? ''),
            'status_code' => $statusCode,
            'status_label' => $this->statusMap[$statusCode] ?? $statusCode,
            'charity_name' => $this->clean($record['charity_name'] ?? 'N/A'),
            'charity_unique_id' => $this->clean($record['charity_unique_id'] ?? 'N/A'),
            'sponsor_name' => $this->clean($record['sponsor_name'] ?? 'N/A'),
            'sponsor_unique_id' => $this->clean($record['sponsor_username'] ?? 'N/A'),
            'buyer_reference' => $this->clean($record['sponsorship_breference'] ?? 'N/A'),
            'project_name' => $this->clean($record['project_name'] ?? 'N/A'),
            'project_purpose' => $this->clean($record['project_purpose'] ?? 'N/A'),
            'key_objectives' => $this->clean($record['key_objectives'] ?? 'N/A'),
            'funding_usage' => $this->clean($record['additional_resources'] ?? 'N/A'),
            'sponsorship_summary' => $this->clean($record['sponsorship_summary'] ?? 'N/A'),
            'monetary_details' => $this->clean($record['monetary_details'] ?? 'N/A'),
            'goods_details' => $this->clean($record['goods_details'] ?? 'N/A'),
            'volunteering_details' => $this->clean($record['volunteering_details'] ?? 'N/A'),
            'required_sponsorship' => $this->currency($required),
            'social_value_offer' => $this->currency($offer),
            'monetary_value' => $this->currency($monetary),
            'goods_value' => $this->currency($goods),
            'volunteering_value' => $this->currency($volunteering),
            'total' => $this->currency($offer),
            'balance' => $this->currency($required - $offer),
            'logo_data_uri' => $this->logoDataUri(),
        ];
    }

    private function currency(float $amount): string
    {
        return 'GBP ' . number_format($amount, 2, '.', ',');
    }

    private function clean($value): string
    {
        $text = trim((string) $value);
        if ($text === '') {
            return 'N/A';
        }
        return preg_replace("/[\r\n]+/", "\n", $text) ?? $text;
    }

    private function logoDataUri(): ?string
    {
        $candidates = [
            FCPATH . 'images/swirlwhite.png',
            FCPATH . 'public/images/swirlwhite.png',
            FCPATH . 'images/SIRNewLogo.png',
            FCPATH . 'public/images/SIRNewLogo.png',
            FCPATH . 'images/WhiteNewSIRlogo.png',
            FCPATH . 'public/images/WhiteNewSIRlogo.png',
        ];

        foreach ($candidates as $path) {
            if (is_file($path)) {
                $binary = @file_get_contents($path);
                if ($binary !== false) {
                    return 'data:image/png;base64,' . base64_encode($binary);
                }
            }
        }

        return null;
    }
}
