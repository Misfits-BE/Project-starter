<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\InformationValidation;
use App\Interfaces\AccountRepositoryInterface;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

/**
 * Class InformationSettingsController
 *
 * @package App\Http\Controllers\Account
 */
class InformationSettingsController extends Controller
{
    /** @var \App\Interfaces\AccountRepositoryInterface $accountRepository */
    protected $accountRepository;

    /**
     * InformationSettingsController constructor.
     *
     * @param  AccountRepositoryInterface $accountRepository Abstraction layer for accounts between controller and db.
     * @return void
     */
    public function __construct(AccountRepositoryInterface $accountRepository)
    {
        $this->middleware(['auth']);
        $this->accountRepository = $accountRepository;
    }

    /**
     * View for the account information settings.
     *
     * @return View
     */
    public function index(): View
    {
        return view('account.settings-info');
    }

    /**
     * Update the account information in the storage.
     *
     * @param  InformationValidation $input The form request that handles the input validation.
     * @return RedirectResponse
     */
    public function update(InformationValidation $input): RedirectResponse
    {
        if ($this->accountRepository->getUser()->update($input->all())) {
            flash("Your account information has been updated in the application.")->success()->important();
        }

        return redirect()->route('account.info');
    }
}
