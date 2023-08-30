<?php

namespace App\Http\Controllers\Settings;

use App\DataTables\Scopes\RoleTypeFilter;
use App\DataTables\Scopes\StatusActiveFilter;
use App\Models\User;
use Illuminate\Http\Request;
use App\Helpers\Enum\RoleType;
use App\Helpers\Global\Helper;
use App\Services\Role\RoleService;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Helpers\Enum\StatusActiveType;
use App\DataTables\Settings\UserDataTable;
use App\Http\Requests\Settings\UserRequest;

class UserController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
    protected UserService $userService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(UserDataTable $dataTable, Request $request)
  {
    $roleTypes = RoleType::toArray();
    $statusUserTypes = StatusActiveType::toArray();

    return $dataTable
      ->addScope(new RoleTypeFilter($request))
      ->addScope(new StatusActiveFilter($request))
      ->render('settings.users.index', compact(
        'roleTypes',
        'statusUserTypes'
      ));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    $roles = $this->roleService->selectRoleWhereIn([
      RoleType::OFFICER->value
    ])->first();

    return view('settings.users.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(UserRequest $request)
  {
    $this->userService->handleCreateOfficer($request);
    return redirect(route('users.index'))->withSuccess(trans('session.create'));
  }

  /**
   * Display the specified resource.
   */
  public function show(User $user)
  {
    return Helper::getProfileView($user);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(UserRequest $request, User $user)
  {
    $this->userService->handleUpdateOfficer($request, $user->id);
    return Helper::getRedirectUpdateUser($user);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(User $user)
  {
    $this->userService->handleDeleteUser($user->id);
    return response()->json([
      'message' => trans('session.delete'),
    ]);
  }

  /**
   * Change the specified status account from storage.
   */
  public function status(User $user)
  {
    $this->userService->updateStatusAccount($user->id);
    return response()->json([
      'message' => trans('session.status'),
    ]);
  }
}
