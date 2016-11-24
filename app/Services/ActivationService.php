<?php

namespace App\Services;

use App\User;
use App\Repositories\ActivationRepository;

class ActivationService
{

    protected $activationRepo;

    protected $resendAfter = 24;

    public function __construct(ActivationRepository $activationRepo)
    {
        $this->activationRepo = $activationRepo;
    }

    public function sendActivationMail($user)
    {

        if ($user->activated || !$this->shouldSend($user)) {
            return;
        }

        $token = $this->activationRepo->createActivation($user);

        $link = route('user.activate', $token);
        $message = sprintf('Activate account <a href="%s">%s</a>', $link, $link);

        $mail = new \PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->CharSet = "utf-8";
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = "tls";
            $mail->Host = config('mail.host');
            $mail->Port = config('mail.port');;
            $mail->Username = config('mail.username');
            $mail->Password = config('mail.password');
            $mail->setFrom('noreply@gmail.com', "noreply");
            $mail->Subject = "News Application Registration Confirmation";
            $mail->MsgHTML($message);
            $mail->addAddress($user->email, $user->name);
            $mail->send();
        } catch (phpmailerException $e) {
            dd($e);
        } catch (Exception $e) {
            dd($e);
        }

    }

    public function activateUser($token)
    {
        $activation = $this->activationRepo->getActivationByToken($token);

        if ($activation === null) {
            return null;
        }

        $user = User::find($activation->user_id);

        $user->activated = true;

        $user->save();

        $this->activationRepo->deleteActivation($token);

        return $user;

    }

    private function shouldSend($user)
    {
        $activation = $this->activationRepo->getActivation($user);
        return $activation === null || strtotime($activation->created_at) + 60 * 60 * $this->resendAfter < time();
    }

}