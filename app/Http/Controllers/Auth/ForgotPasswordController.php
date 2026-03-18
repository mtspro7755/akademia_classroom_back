<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Validator;

class ForgotPasswordController extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'email'=>'required|email|exists:apprenants,email'
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'Email non trouvé'],422);
        }

        $status = Password::broker('apprenants')->sendResetLink(
            $request->only('email')
        );

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Lien de réinitialisation envoyé par mail.'])
            : response()->json(['message' => 'Impossible d\'envoyer le mail.'], 500);
    }
}
