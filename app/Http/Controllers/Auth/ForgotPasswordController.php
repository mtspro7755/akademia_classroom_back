<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPasswordRequest;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(ForgotPasswordRequest $request)
    {
        try{
            $status = Password::broker('apprenants')->sendResetLink(
                $request->only('email')
            );

            return $status === Password::RESET_LINK_SENT
                ? response()->json(['message' => 'Lien de réinitialisation envoyé.'])
                : response()->json(['message' => 'Erreur lors de l’envoi du mail.'], 500);
        }catch (\Exception $e){
            Log::debug($e->getMessage());
            return response()->json(['error' => 'Erreur'], 500);
        }
    }
}
