<?php

namespace App\Http\Services;

use App\Enums\VerificationTypeEnums;
use App\Mail\PasswordResetVerification;
use App\Mail\SendEmailVerificationCode;
use Illuminate\Support\Facades\Mail;

class VerficationService
{
    public function generateCode(): int
    {
        return random_int(100000, 999999);
    }

    public function sendEmailVerificationCode($user): void
    {
        $code = $this->generateCode();

        $user->verifications()
            ->where('type', VerificationTypeEnums::Email)
            ->where('uses', 0)
            ->update(['uses' => 1]);

        $user->verifications()->create([
            'code' => $code,
            'expired_at' => now()->addHour(),
            'type' => VerificationTypeEnums::Email,
            'uses' => 0,
        ]);

        Mail::to($user)->queue(new SendEmailVerificationCode($code));
    }

    public function sendResetPasswordVerificationCode($user): void
    {
        $code = $this->generateCode();

        $user->verifications()
            ->where('type', VerificationTypeEnums::Password)
            ->where('uses', 0)
            ->update(['uses' => 1]);

        $user->verifications()->create([
            'code' => $code,
            'expired_at' => now()->addHour(),
            'type' => VerificationTypeEnums::Password,
            'uses' => 0,
        ]);

        Mail::to($user)->queue(new PasswordResetVerification($code));
    }
}
