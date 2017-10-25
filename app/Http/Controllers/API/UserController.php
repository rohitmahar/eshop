<?php

namespace App\Http\Controllers\API;

use App\Eshop\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class UserController
 * @package App\Http\Controllers\API
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    public $users;

    /**
     * @var Auth
     */
    protected $auth;

    /**
     * UserController constructor.
     * @param UserRepository $users
     * @param Auth $auth
     */
    public function __construct(UserRepository $users, Auth $auth)
    {
        $this->users = $users;
        $this->auth = $auth;
        $this->middleware('ajax', ['except' => 'getCurrentUser']);
    }

    /**
     * get the paginated result of customers.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaginatedCustomers(Request $request)
    {
        $paginationLimit =  $request->get('per_page');

        return new JsonResponse(
            $this->users->getPaginatedCustomers($paginationLimit, $request)
        );
    }

    /**
     * get the collection of admins.
     *
     * @return \App\Eshop\Repositories\Collection
     */
    public function getAdmins()
    {
        return $this->users->getAdmins();
    }

    /**
     * @return JsonResponse
     */
    public function getCurrentUser() {
        return new JsonResponse(
          $this->auth->user()
        );
    }
}
