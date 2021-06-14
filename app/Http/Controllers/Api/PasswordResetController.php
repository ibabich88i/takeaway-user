<?php

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\Factories\ResetPasswordDTOFactoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserForgotPasswordRequest;
use App\Http\Requests\UserResetPasswordRequest;
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

    /**
     * @param UserResetPasswordRequest $request
     * @param ResetPasswordDTOFactoryInterface $factory
     * @return JsonResponse
     */
    public function reset(UserResetPasswordRequest $request, ResetPasswordDTOFactoryInterface $factory): JsonResponse
    {
        $resetPasswordDTO = $factory->create($request->all());
        $this->manager->reset($resetPasswordDTO);

        return new JsonResponse(null, JsonResponse::HTTP_ACCEPTED);
    }
}
