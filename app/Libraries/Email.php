<?php
/**
 * @author Umar Riaz
 * Created at 10/09/2023
 * Library to send emails 
 */
namespace App\Libraries;

use App\Models\PluginModel;
use Config\Services;
use CodeIgniter\HTTP\RequestInterface;

class Email{

    protected $email;
    protected $load;
    protected $lastError = '';
    // protected $from, $to, $subject,$message

    function __construct(){

        $this->email = service('email');
    }

public function passEmail(string $to, string $login, string $password): bool
{
    $subject = 'Your Pluggin Ecosystem Login Details';
    $message = view('email/passemail', [
        'login'    => $login,
        'password' => $password,
    ]);

    // Config using sendmail/ssmtp
    $this->email->initialize($this->AllConfig());
    $this->email->setTo($to);
    $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem');
    $this->email->setSubject($subject);
    $this->email->setMessage($message);

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }

        // Log error if sending fails
        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
}

    function userUpdateEmail($email, $username){
        $data =[
            'login' =>  $email,
            'username' => $username
        ];

        $this->email->initialize($this->membershipMailConfig());
        $this->email->setFrom('membership_team@pluggin.org', 'Pluggin Ecosystem Membership Team');
        $this->email->setTo($email);
        $this->email->setSubject('Social Impact Register');
        $this->email->setMessage(view('email/updateuser',$data));
        $this->email->send();

    }


    public function review_email($rname,$message)
    {

        $data =[
            'message' =>  $message
        ];

        $this->email->initialize($this->AllConfig());
        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem Membership Team');
        $this->email->setTo($rname);
        $this->email->setSubject('Social Impact Register');
        $this->email->setMessage(view('email/reviewmail',$data));
        $this->email->send();
        
    }

     public function sendAccessLink(string $to, string $name, string $accessLink): bool
    {
        $subject = 'Reset your password';
        $message = view('email/accesslink', [
            'accessLink' => $accessLink,
            'userName'   => $name,
        ]);

        // Your provided config (works with local sendmail/ssmtp wrapper)
        $this->email->initialize($this->AllConfig());
        $this->email->setTo($to);
        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem');
        $this->email->setSubject($subject);
        $this->email->setMessage($message);

        if ($this->email->send()) {
            return true;
        }

        log_message('error', $this->email->printDebugger(['headers']));
        return false;
    }


 

    public function sendEmailToSponsor($to, $name, $subject, $message, $pdfContent, $filename) {
        $data = [
            'message' => $message
        ];
        $config['SMTPUser'] = '';
    
        $this->email->initialize($config);
        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'SIR');
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage(view('email/emailtosponsor', $data));
        $this->email->attach($pdfContent, 'attachment', $filename, 'application/pdf');
    
        if ($this->email->send()) {
            $this->lastError = '';
            return [
                'status' => 'success',
                'message' => 'Email sent successfully!'
            ];
        } else {
            // Capture email error details
            $errorMessage = $this->email->printDebugger(['headers']);
            $this->lastError = $errorMessage;
            log_message('error', 'Email failed to send: ' . $errorMessage);
    
            return [
                'status' => 'error',
                'error' => 'Email sending failed. Please check the log for more details.',
                'debug_info' => $errorMessage
            ];
        }
    }

    public function sendSponsorMarketingWelcome(string $to, string $contactName = '', string $organisation = ''): bool
    {
        $displayName = trim($contactName) !== '' ? $contactName : 'there';

        $data = [
            'contactName' => $displayName,
            'organisation' => $organisation,
        ];

        $this->email->clear(true);
        $this->email->initialize($this->membershipMailConfig());
        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem Membership Team');
        $this->email->setTo($to);
        $this->email->setSubject('Your Pluggin Ecosystem Marketing Support');
        $this->email->setMessage(view('email/sponsor_marketing', $data));

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }
        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
    }

    public function sendSponsorshipReceipt(string $to, array $payload, string $pdfBinary, string $filename): bool
    {
        $this->email->clear(true);
        $this->email->initialize($this->AllConfig());
        $subject = 'Your Sponsorship Proposal ' . ($payload['sponsorshipRef'] ?? '');

        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem');
        $this->email->setTo($to);
        $this->email->setSubject(trim($subject));
        $this->email->setMessage(view('email/sponsorship_receipt', $payload));
        $this->email->attach($pdfBinary, 'attachment', $filename, 'application/pdf');

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }

        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
    }

    public function sendAdminJoinAlert(string $to, array $payload): bool
    {
        $this->email->clear(true);
        $this->email->initialize($this->AllConfig());

        $subject = sprintf('[Action Required] %s submission awaiting review', $payload['type'] ?? 'New');

        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem');
        $this->email->setTo($to);
        $this->email->setSubject($subject);
        $this->email->setMessage(view('email/admin_join_alert', $payload));

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }

        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
    }

    public function sendSponsorshipAdminAlert(string $to, array $payload): bool
    {
        $this->email->clear(true);
        $this->email->initialize($this->AllConfig());

        $subject = sprintf('[Sponsorship] New proposal %s', $payload['spo_ref'] ?? '');

        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem');
        $this->email->setTo($to);
        $this->email->setSubject(trim($subject));
        $this->email->setMessage(view('email/admin_sponsorship_alert', $payload));

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }

        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
    }

    public function sendSponsorMarketingCustom(
        string $to,
        string $contactName = '',
        string $organisation = '',
        string $subject = 'Message from Pluggin Ecosystem',
        string $customMessage = ''
    ): bool {
        $displayName = trim($contactName) !== '' ? $contactName : 'there';

        $safeMessage = nl2br(htmlspecialchars($customMessage, ENT_QUOTES, 'UTF-8'));

        $this->email->initialize($this->membershipMailConfig());
        $this->email->setFrom('no-reply@pluggin-ecosystem.org', 'Pluggin Ecosystem Membership Team');
        $this->email->setTo($to);
        $this->email->setSubject($subject !== '' ? $subject : 'Message from Pluggin Ecosystem');
        $this->email->setMessage(view('email/sponsor_marketing_custom', [
            'contactName' => $displayName,
            'organisation' => $organisation,
            'customMessage' => $safeMessage,
        ]));

        if ($this->email->send()) {
            $this->lastError = '';
            return true;
        }

        $this->lastError = $this->email->printDebugger(['headers']);
        log_message('error', $this->lastError);
        return false;
    }

    public function getLastError(): string
    {
        return (string) $this->lastError;
    }

    private function AllConfig(): array
    {
        return [
            'protocol' => 'ssmtp', // If fails, change to 'sendmail'
            'mailpath' => '/usr/sbin/sendmail',
            'charset'  => 'UTF-8',
            'wordwrap' => true,
            'SMTPUser' => 'no-reply@pluggin-ecosystem.org', // Harmless with sendmail
            'SMTPPass' => '',
            'SMTPPort' => '465',
            'mailType' => 'html',
        ];
    }

        private function membershipMailConfig(): array
    {
        return [
            'protocol' => 'ssmtp', // If fails, change to 'sendmail'
            'mailpath' => '/usr/sbin/sendmail',
            'charset'  => 'UTF-8',
            'wordwrap' => true,
            'SMTPUser' => 'no-reply@pluggin-ecosystem.org', // Harmless with sendmail
            'SMTPPass' => '',
            'SMTPPort' => '465',
            'mailType' => 'html',
        ];
    }
    
}
?>
