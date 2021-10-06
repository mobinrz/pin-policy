<?php

namespace Mobin\PinPolicy\Service;

use Illuminate\Support\Facades\Hash;
use Mobin\PinPolicy\Models\PinHistory;

trait PinPolicyService
{
    protected $pinMustBeExpiredAfterEveryXDays = 90;
    protected $pinMustBeDifferentFromXPreviousPin = 5;

    protected function isPinExpired(User $user)
    {
        $pinHistory = PinHistory::whereUserId($user->id)->latest()->firstOrFail();

        $expiresAt = Carbon::parse($pinHistory->created_at)->addDays($this->pinMustBeExpiredAfterEveryXDays);

        return Carbon::now() > $expiresAt;
    }

    protected function passwordUpdateUponFirstLoginMessage()
    {
        return $this->passwordUpdateUponFirstLoginMessage;
    }


    public function isPinMatchesWithXPreviousPin(User $user, $newPin){
        $matches = false;

        $pinHistories = PinHistory::whereUserId($user->id)
            ->latest()
            ->limit($this->pinMustBeDifferentFromXPreviousPin)
            ->get();

        foreach ($pinHistories as $pinHistory) {
            if (Hash::check($newPin, $pinHistory->pin)) {
                $matches = true;
                break;
            }
        }

        return $matches;
    }
}