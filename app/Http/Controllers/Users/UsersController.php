<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Contracts\View\View;

/**
 * Class UsersController
 *
 * @package App\Http\Controllers\Users
 */
class UsersController extends Controller
{
    /** @var \App\Interfaces\AccountRepositoryInterface $usersRepository */
    protected $usersRepository;

    /**
     * UsersController constructor.
     *
     * @param  AccountRepositoryInterface $usersRepository Abstraction layer for the users storage.
     * @return void
     */
    public function __construct(AccountRepositoryInterface $usersRepository)
    {
        $this->middleware(['auth']);
        $this->usersRepository = $usersRepository;
    }

    /**
     * Get the management console for the users.
     *
     * @return View
     */
    public function index(): View
    {
        $users = $this->usersRepository->getUsersByRole('User');
        return view('users.index', compact('users'));
    }
}
