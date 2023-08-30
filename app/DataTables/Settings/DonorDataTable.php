<?php

namespace App\DataTables\Settings;

use App\Models\Donor;
use App\Helpers\Enum\RoleType;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Services\Donor\DonorService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class DonorDataTable extends DataTable
{
  /**
   * Create a new datatables instance.
   *
   * @return void
   */
  public function __construct(
    protected DonorService $donorService,
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
      ->addColumn('name', fn ($row) => $row->user->name)
      ->addColumn('phone', fn ($row) => $row->user->phone)
      ->addColumn('status', fn ($row) => $row->getAccountStatus())
      ->editColumn('age', fn ($row) => "{$row->age} Tahun")
      ->addColumn('edit_status', 'settings.donors.status')
      ->addColumn('action', 'settings.donors.action')
      ->rawColumns([
        'action',
        'edit_status',
        'roles',
        'status'
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(Donor $model): QueryBuilder
  {
    return $this->donorService->query()->latest();
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('donor-table')
      ->columns($this->getColumns())
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
    $visibility = isRoleName() === RoleType::ADMIN->value ? true : false;

    return [
      Column::make('DT_RowIndex')
        ->title(trans('#'))
        ->orderable(false)
        ->searchable(false)
        ->width('5%')
        ->addClass('text-center'),
      Column::make('name')
        ->title(trans('Nama'))
        ->addClass('text-center'),
      Column::make('phone')
        ->title(trans('Telepon'))
        ->addClass('text-center'),
      Column::make('age')
        ->title(trans('Usia'))
        ->addClass('text-center'),
      Column::make('status')
        ->title(trans('Status'))
        ->addClass('text-center'),
      Column::make('edit_status')
        ->title(trans('Ubah Status'))
        ->visible($visibility)
        ->addClass('text-center'),
      Column::computed('action')
        ->exportable(false)
        ->printable(false)
        ->width('5%')
        ->addClass('text-center'),
    ];
  }

  /**
   * Get the filename for export.
   */
  protected function filename(): string
  {
    return 'Donor_' . date('YmdHis');
  }
}
