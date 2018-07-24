<?php

namespace App\Http\Controllers\Account;

use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

/**
 * Class SecuritySettingsController
 *
 * @package App\Http\Controllers\Account
 */
class SecuritySettingsController extends Controller
{
    /** @var \App\Interfaces\AccountRepositoryInterface $accountRepository */
    protected $accountRepository;

    /**
     * SecuritySettingsController constructor.
     *
     * @param  AccountRepositoryInterface $accountRepository
     * @return void
     */
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->middleware(['auth']);
        $this->accountRepository = $accountRepository;
    }

    /**
     * View for the account security settings.
     *
     * @return View
     */
    public function index(): View
    {
        return view('account.settings-security');
    }
}
