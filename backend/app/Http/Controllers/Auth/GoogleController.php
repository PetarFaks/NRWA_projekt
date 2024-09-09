<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Google_Client;
use Google_Service_Oauth2;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class GoogleController extends Controller
{
    protected $client;

    public function __construct()
    {
        $this->client = new Google_Client();
        $this->client->setClientId(env('GOOGLE_CLIENT_ID'));
        $this->client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
        $this->client->setRedirectUri(env('GOOGLE_REDIRECT_URL'));
        $this->client->addScope('email');
        $this->client->addScope('profile');
    }

    public function redirectToGoogle()
    {
        return redirect()->away($this->client->createAuthUrl());
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $this->client->authenticate($request->get('code'));
            $token = $this->client->getAccessToken();
            $this->client->setAccessToken($token);

            $oauth2 = new Google_Service_Oauth2($this->client);
            $googleUser = $oauth2->userinfo->get();

            $user = User::where('email', $googleUser->email)->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->name,
                    'email' => $googleUser->email,
                    'google_id' => $googleUser->id,
                    'password' => Hash::make(Str::random(24)), // Random password
                ]);
            }

            // Generate token for API access
            $apiToken = $user->createToken('authToken')->plainTextToken;

            // Redirect to a specific route with token and role in query parameters
            return redirect()->to('http://localhost:5173/google-callback?token=' . $apiToken . '&role=' . $user->role);

        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Google login error', ['exception' => $e]);
            return response()->json(['error' => 'Unable to authenticate user'], 500);
        }
    }
}
