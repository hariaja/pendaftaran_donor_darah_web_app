<?php

namespace App\Http\Controllers\Agendas;

use App\DataTables\Agendas\EventDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Agendas\EventRequest;
use App\Models\Event;
use App\Services\Event\EventService;
use Illuminate\Http\Request;

class EventController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct(
    protected EventService $eventService,
  ) {
    //
  }

  /**
   * Display a listing of the resource.
   */
  public function index(EventDataTable $dataTable)
  {
    return $dataTable->render('agendas.events.index');
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create()
  {
    return view('agendas.events.create');
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(EventRequest $request)
  {
    //
  }

  /**
   * Display the specified resource.
   */
  public function show(Event $event)
  {
    //
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(Event $event)
  {
    //
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, Event $event)
  {
    //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(Event $event)
  {
    //
  }
}
