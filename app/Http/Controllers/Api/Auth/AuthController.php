<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    //=====User Login =====
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);


        $user = User::where("email", $request->email)->first();

        if($user){

        if(Hash::check($request->password, $user->password)) {
            return $this->proceedToLogin($user);
        }

        return apiResponse(['message' => 'Wrong Credentials'], 401);

        }else{
            return apiResponse(['message' => 'Wrong Credentials'], 401);

        }
    }



    private function proceedToLogin($user)
    {
        try {
            Auth::login($user);
            $tokenResult = $user->createToken('API Token');
            $token = $tokenResult->token;
            $token->expires_at = Carbon::now()->addWeeks(1);
            $token->save();

            return apiResponse([
                'message' => "API_MESSAGE_PASS",
                'user' => auth()->user(),
                'token' => $tokenResult->accessToken,
                'token_type' => 'Bearer',
                'expires_at' => Carbon::parse(
                    $tokenResult->token->expires_at
                )->toDateTimeString()
            ]);
        } catch (\Exception $ex) {
            return $ex->getMessage();
        }
    }


      //=====User Registration =====
    public function register(Request $request)
    {

        $user =   User::create([
            'email' => $request->email,
            'name' => $request->name,
            'password' => Hash::make( $request->password),
        ]);

        $token = $user->createToken('API Token')->accessToken;
        return apiResponse(['user' => $user, 'token' => $token]);
    }


      //=====User Logout =====
    public function logout(Request $request)
    {
      $user = Auth::logout();
      return apiResponse("Successfully logged out");
    }
}
