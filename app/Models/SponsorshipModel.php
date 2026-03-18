<?php

namespace App\Models;

use CodeIgniter\Model;

class SponsorshipModel extends Model
{
    protected $table = 'sponsorships';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'spo_ref',
        'charity_id',
        'charity_name',
        'sponsor_username',
        'sponsor_name',
        'sponsor_email',
        'project_name',
        'project_purpose',
        'key_objectives',
        'required_sponsorship',
        'additional_resources',
        'sponsorship_offer',
        'monetary_value',
        'monetary_details',
        'goods_value',
        'goods_details',
        'volunteering_value',
        'volunteering_details',
        'sponsorship_summary',
        'sponsorship_breference',
        'created_at',
        'updated_at',
    ];

    /**
     * Get sponsorships by status for DataTables.
     */
    public function getSponsorshipsByStatus($status)
    {
        return $this->where('status', $status)
                    ->select('id, spo_ref, sponsorship_breference, charity_name, sponsor_name, sponsorship_offer, status')
                    ->findAll();
    }

    /**
     * Get sponsorship details by ID.
     */
    public function getSponsorshipById($id)
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Update sponsorship status.
     */
    public function updateStatus($sponsorshipId, $newStatus)
    {
        return $this->db->table($this->table)
            ->where('id', $sponsorshipId)
            ->update(['status' => $newStatus]);
    }

    public function getCharityAndProjectDetails($charity_id, ?int $projectId = null)
    {
        $builder = $this->db->table('CSE_ProjectDetail')
            ->select('
                Charities.cse_id AS charity_id,
                Charities.cse_OrgName AS charity_name,
                Charities.cse_RegisteredNo AS registered_no,
                CSE_ProjectDetail.pro_id AS project_id,
                CSE_ProjectDetail.pro_Name AS project_name,
                CSE_ProjectDetail.pro_Purpose AS project_purpose,
                CSE_ProjectDetail.pro_KeyObjectives AS key_objectives,
                CSE_ProjectDetail.pro_RequiredSponsorship AS required_sponsorship,
                CSE_ProjectDetail.pro_AdditionResourcesNeeded AS additional_resources,
                Unique_Identifiers.unique_id AS charity_unique_id
            ')
            ->join('Charities', 'CSE_ProjectDetail.cse_id = Charities.cse_id', 'inner')
            ->join('Unique_Identifiers', 'Charities.user_id = Unique_Identifiers.user_id', 'left')
            ->where('Charities.approved', 1);

        if ($projectId !== null) {
            $builder->where('CSE_ProjectDetail.pro_id', $projectId);
        } else {
            $builder->where('Charities.cse_id', $charity_id);
        }

        return $builder->orderBy('CSE_ProjectDetail.pro_id', 'ASC')
            ->get()
            ->getRowArray();
    }

    public function getSponsorOrganisationNameByUserId($userId)
    {
        $result = $this->db->table('Sponsors')
            ->select('spo_OrgName')
            ->where('user_id', $userId)
            ->get()
            ->getRowArray();

        return $result['spo_OrgName'] ?? null;
    }

    public function getSponsorshipPdfById($id){
        return $this->db->table('sponsorships')
            ->select('
                sponsorships.id,
                sponsorships.spo_ref,
                sponsorships.status,
                sponsorships.charity_id,
                Charities.user_id,
                Unique_Identifiers.unique_id AS charity_unique_id,
                sponsorships.charity_name,
                sponsorships.sponsor_username,
                sponsorships.sponsor_name,
                sponsorships.sponsor_email,
                sponsorships.project_name,
                sponsorships.project_purpose,
                sponsorships.key_objectives,
                sponsorships.required_sponsorship,
                sponsorships.additional_resources,
                sponsorships.sponsorship_offer,
                sponsorships.monetary_value,
                sponsorships.monetary_details,
                sponsorships.goods_value,
                sponsorships.goods_details,
                sponsorships.volunteering_value,
                sponsorships.volunteering_details,
                sponsorships.sponsorship_breference,
                sponsorships.sponsorship_summary,
                sponsorships.created_at,
                sponsorships.updated_at
            ')
            ->join('Charities', 'sponsorships.charity_id = Charities.cse_id', 'inner')
            ->join('Unique_Identifiers', 'Charities.user_id = Unique_Identifiers.user_id', 'left')
            ->where('sponsorships.id', $id)
            ->get()
            ->getRowArray();
    }
    

    public function insertSponsorship(array $data)
    {
        $data['spo_ref'] = $this->generateSpoRef(); // Generate unique reference
        $data['created_at'] = date('Y-m-d H:i:s');
        $data['updated_at'] = date('Y-m-d H:i:s');

        return $this->insert($data); // Securely insert into the database
    }

    public function generateSpoRef()
    {
        return 'SPO-' . date('Ymd') . '-' . strtoupper(bin2hex(random_bytes(4)));
    }
}
