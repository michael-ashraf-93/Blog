<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Tymon\JWTAuth\JWTAuth;

class AuthController extends AppBaseController
{


    use AuthenticatesUsers;
    private $jwtauth;
    private $user;


    /**
     * Constructor to inialize attributes
     * @param [User user, JWTAuth jwtauth, Organization team]
     * contains middleware to make exception for (login, newUserWizard, resetPassword) methods
     */
    public function __construct(User $user, JWTAuth $jwtauth)
    {
        $this->jwtauth = $jwtauth;
        $this->user = $user;
        $this->middleware('jwt.auth', ['except' => ['login', 'newUserWizard', 'resetPassword',
            'registerInvitedUsers'
        ]]);
    }

    /**
     * Register new user via wizard
     * @param Request
     * @return JsonResponse contains [string jwtToken, object user ]
     */
    public function newUserWizard(Request $userAPIRequest)
    {
        $newUser = $this->user->create([
            'role_id' => 0,
            'name' => $userAPIRequest->name,
            'email' => $userAPIRequest->email,
            'password' => bcrypt($userAPIRequest->password),
        ]);


        if (!$newUser) {
            return response()->json([trans('api.failed_to_create_new_user')], 500);
        }
        return response()
            ->json([
                'token' => $this->jwtauth->fromUser($newUser),
                'user' => $newUser
            ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        // get user credentials: email, password
        $credentials = $request->only('email', 'password');
        $token = null;
        try {
            $token = $this->jwtauth->attempt($credentials);
            if (!$token) {
                return $this->sendError('Invalid email or password', 400);
            }
        } catch (JWTAuthException $e) {
            return $this->sendError('Failed to create token', 500);

        }
//        return response()->json(compact('token', 'user'));
        return response()->json(compact("token", "user"));

    }

    /** completing user info after accepting invitation mail
     * @param Request
     * @return sendError in case of update failure
     * @return success sendResponse in case of success
     */

    public function logout()
    {
        $this->jwtauth->invalidate($this->jwtauth->getToken());
        return $this->sendResponse(true, "Come back soon :)");
    }


}

