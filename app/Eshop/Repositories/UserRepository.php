<?php

namespace App\Eshop\Repositories;

use App\Eshop\Models\User;
use Illuminate\Http\Request;

/**
 * Class UserRepository
 * @package App\Eshop\Repositories\Backend
 */
class UserRepository
{
    /**
     * @var User
     */
    protected $user;

    /**
     * UserRepository constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * get the paginated users result
     *
     * @param $paginationLimit
     * @param Request $request
     * @return Collection
     */
    public function getPaginatedCustomers($paginationLimit, Request $request)
    {
        $query = $this->user->where('role','customer')->orderBy('id', 'asc');

        if ($request->exists('filter')) {
            $query->where(function($q) use($request) {
                $value = "%{$request->filter}%";
                $q->where('name', 'like', $value)
                    ->orWhere('email', 'like', $value);
            });
        }

        return $query->paginate($paginationLimit);
    }

    /**
     * get the collection of admins.
     *
     * @return Collection
     */
    public function getAdmins()
    {
        return $this->user->where('role', 'admin')->get();
    }
}
