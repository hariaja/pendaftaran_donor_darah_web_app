<?php

namespace App\DataTables\Agendas;

use App\Models\Event;
use App\Services\Event\EventService;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class EventDataTable extends DataTable
{
  /**
   * Create a new datatables instance.
   *
   * @return void
   */
  public function __construct(
    protected EventService $eventService,
  ) {
    // 
  }

  /**
   * Build the DataTable class.
   *
   * @param QueryBuilder $query Results from query() method.
   */
  public function dataTable(QueryBuilder $query): EloquentDataTable
  {
    return (new EloquentDataTable($query))
      ->addIndexColumn()
      ->editColumn('status', fn ($row) => $row->getEventStatus())
      ->addColumn('action', 'agendas.events.action')
      ->rawColumns([
        'status',
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Event $model): QueryBuilder
  {
    return $this->eventService->query()->latest();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('event-table')
      ->columns($this->getColumns())
      ->minifiedAjax()
      ->addTableClass([
        'table',
        'table-striped',
        'table-bordered',
        'table-hover',
        'table-vcenter',
      ])
      ->processing(true)
      ->retrieve(true)
      ->serverSide(true)
      ->autoWidth(false)
      ->pageLength(5)
      ->responsive(true)
      ->lengthMenu([5, 10, 20])
      ->orderBy(1);
  }

  /**
   * Get the dataTable columns definition.
   */
  public function getColumns(): array
  {
    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('10%')
        ->addClass('text-center'),
      Column::make('name')
        ->title(trans('Nama Event'))
        ->addClass('text-center'),
      Column::make('organizer')
        ->title(trans('Penyelenggara'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status Event'))
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('10%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Event_' . date('YmdHis');
  }
}
