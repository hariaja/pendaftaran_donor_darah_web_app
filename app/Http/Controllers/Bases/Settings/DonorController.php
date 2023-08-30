<?php

namespace App\Http\Controllers\Bases\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\Settings\DonorRequest;
use App\Models\Donor;
use App\Services\Donor\DonorService;
use Illuminate\Http\Request;

class DonorController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected DonorService $donorService,
  ) {
    // 
  }

  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    //
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Donor $donor)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Donor $donor)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(DonorRequest $request, Donor $donor)
  {
    $this->donorService->handleUpdatePendonor($request, $donor->id);
    return redirect(route('donors.users.show', $donor->user->uuid))->withSuccess(trans('session.update'));
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Donor $donor)
  {
    //
  }
}
