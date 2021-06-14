<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgotPasswordRequest;
use App\Managers\PasswordResetManagerInterface;
use Illuminate\Http\JsonResponse;

class PasswordResetController extends Controller
{
    /**
     * @var PasswordResetManagerInterface
     */
    private PasswordResetManagerInterface $manager;

    /**
     * PasswordResetController constructor.
     * @param PasswordResetManagerInterface $manager
     */
    public function __construct(PasswordResetManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param UserForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgot(UserForgotPasswordRequest $request): JsonResponse
    {
        $resource = $this->manager->forgot($request->get('email'));

        return $resource->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
