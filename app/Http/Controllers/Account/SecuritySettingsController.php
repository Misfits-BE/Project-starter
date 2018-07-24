<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\SecurityValidation;
use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
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

    /**
     * Update the account security in the application.
     *
     * @param  SecurityValidation $input The form request that handles the input validation.
     * @return RedirectResponse
     */
    public function update(SecurityValidation $input): RedirectResponse
    {
        if ($this->accountRepository->getUser()->update($input->all())) {
            flash('Your account security has been updated in the application.')->success()->important();
        }

        return redirect()->route('account.security');
    }
}
