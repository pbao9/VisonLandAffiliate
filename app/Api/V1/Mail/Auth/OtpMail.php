<?php

namespace App\Api\V1\Mail\Auth;

use Carbon\Traits\Serialization;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

class OtpMail extends Mailable
{
    use Queueable, Serialization;
    public $otp;
    public function __construct($otp)
    {
        $this->otp = $otp;
    }
    public function build()
    {
        return $this->view('mails.otp')->with(['otp' => $this->otp])->subject('Mã xác nhận đăng ký tài khoản!');
    }
}
