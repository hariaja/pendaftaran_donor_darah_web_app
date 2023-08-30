<?php

namespace App\Http\Controllers\Auth;

use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Helpers\Enum\RoleType;
use App\Helpers\Enum\GenderType;
use App\Helpers\Enum\RhesusType;
use Illuminate\Http\JsonResponse;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use App\Services\BloodType\BloodTypeService;
use Illuminate\Foundation\Auth\RedirectsUsers;
use App\Http\Requests\Credentials\RegisterRequest;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RedirectsUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected RoleService $roleService,
    protected BloodTypeService $bloodTypeService,
  ) {
    $this->middleware('guest');
  }

  /**
   * Show the application registration form.
   *
   * @return \Illuminate\View\View
   */
  public function showRegistrationForm(): View
  {
    $genders = GenderType::toArray();
    $rhesus = RhesusType::toArray();
    $bloods = $this->bloodTypeService->query()->oldest('type')->get();

    return view('auth.register', compact('genders', 'rhesus', 'bloods'));
  }

  /**
   * Handle a registration request for the application.
   */
  public function register(RegisterRequest $request): RedirectResponse
  {
    event(
      new Registered(
        $user = $this->userService->handleCreateDonor($request)
      )
    );

    $this->guard()->login($user);
    if ($response = $this->registered($request, $user)) {
      return $response;
    }

    return $request->wantsJson() ? new JsonResponse([], 201) : redirect($this->redirectPath());
  }

  /**
   * Get the guard to be used during registration.
   *
   * @return \Illuminate\Contracts\Auth\StatefulGuard
   */
  protected function guard()
  {
    return Auth::guard();
  }

  /**
   * The user has been registered.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  mixed  $user
   * @return mixed
   */
  protected function registered(Request $request, $user)
  {
    if ($user->hasRole(RoleType::DONOR->value)) {
      return redirect()->route('donors.home');
    }
  }
}
