<?php

namespace App\Http\Controllers\Backend;

use App\Eshop\Models\User;
use App\Eshop\Repositories\UserRepository;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserCreateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class UserController
 * @package App\Http\Controllers\Backend
 */
class UserController extends Controller
{
    /**
     * @var UserRepository
     */
    protected $user;

    /**
     * UserController constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->middleware(['auth', 'admin']);
        $this->user = $user;
    }
    /**
     * get the customer users index page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function customer()
    {
        return view('backend.users.customer');
    }

    /**
     * get the admin users index page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function admin()
    {
        return view('backend.users.admin');
    }

    /**
     * create the new admin.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.users.create');
    }

    public function register(UserCreateRequest $request)
    {
        $data = $request->all();
        // Needs to be implement dependency injection in this section
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'role' => 'admin'
        ]);

        return redirect(route('admins.index'))->with('message', 'Admin Created Successfully');
    }
}
