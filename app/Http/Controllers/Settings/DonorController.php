<?php

namespace App\Http\Controllers\Settings;

use App\Models\Donor;
use Illuminate\Http\Request;
use App\Helpers\Global\Helper;
use App\Services\User\UserService;
use App\Http\Controllers\Controller;
use App\Services\Donor\DonorService;
use App\Helpers\Enum\StatusActiveType;
use App\DataTables\Settings\DonorDataTable;
use App\DataTables\Scopes\StatusDonorFilter;

class DonorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected UserService $userService,
    protected DonorService $donorService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index(DonorDataTable $dataTable, Request $request)
  {
    $statusUserTypes = StatusActiveType::toArray();
    return $dataTable
      ->addScope(new StatusDonorFilter($request))
      ->render('settings.donors.index', compact(
        'statusUserTypes'
      ));
  }

  /**
   * Display the specified resource.
   */
  public function show(Donor $donor)
  {
    $donor->dateBrith = Helper::parseDateTime($donor->dob, true);
    $donor->ageDonor = "{$donor->age} Tahun";
    $donor->status = $donor->user->status ? "Active" : "Inactive";
    $donor->avatar = $donor->user->getUserAvatar();

    return response()->json($donor);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Donor $donor)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Donor $donor)
  {
    $this->donorService->handleDeletePendonor($donor->id);
    return response()->json([
      'message' => trans('session.delete')
    ]);
  }
}
