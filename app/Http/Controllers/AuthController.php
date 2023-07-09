<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUser;
use App\Http\Requests\UpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Register a new user.
     *
     * @param RegisterUser $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterUser $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'private' => $request->private ?? true,
        ]);

        $user->makeVisible(['email', 'email_verified_at']);

        $token = $user->createToken('apptoken')->plainTextToken;

        $user->sendEmailVerificationNotification();

        $response = [
            'user' => $user,
            'token' => $token,
        ];

        return response()->json($response, 201);
    }

    public function verifyEmail(int $id, string $hash)
    {
        $user = User::withoutGlobalScope('private')->where('id', $id)->first();

        if (! hash_equals($hash, sha1($user->getEmailForVerification()))) {
            return response()->json(['message' => 'Invalid verification link'], 400);
        }

        if ($user->hasVerifiedEmail()) {
            return response()->json(['message' => 'Email already verified.'], 200);
        }

        $user->markEmailAsVerified();

        return response()->json(['message' => 'Email verified.'], 200);
    }

    public function resendVerificationEmail(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();

        return response()->json(['message' => 'Verification link sent!'], 200);
    }

    public function update(UpdateUser $request, int $id)
    {
        $user = User::where('id', $id)->first();

        if (Auth::id() !== $user->id) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'private' => $request->private ?? true,
        ]);

        $user->makeVisible(['email', 'email_verified_at']);

        return response()->json($user, 201);
    }

    public function destroy(int $id)
    {
        $user = User::where('id', $id)->first();

        if (Auth::id() !== $user->id) {
            return response()->json(['message' => 'Unauthorized. ' . $user->id . ' | ' . Auth::id()], 403);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted.'], 201);
    }
}
