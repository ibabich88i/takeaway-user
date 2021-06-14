<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\DataTransferObjects\Factories\UserStoreDTOFactoryInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Managers\UserManagerInterface;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    /**
     * @var UserManagerInterface
     */
    private UserManagerInterface $userManager;

    /**
     * UserController constructor.
     * @param UserManagerInterface $userManager
     */
    public function __construct(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    /**
     * @param UserStoreRequest $request
     * @param UserStoreDTOFactoryInterface $factory
     * @return JsonResponse
     */
    public function store(UserStoreRequest $request, UserStoreDTOFactoryInterface $factory): JsonResponse
    {
        $userStoreDTO = $factory->create($request->all());
        $resource = $this->userManager->store($userStoreDTO);

        return $resource->response()->setStatusCode(JsonResponse::HTTP_CREATED);
    }
}
