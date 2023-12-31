<?php

namespace App\DataTables\Settings;

use App\Helpers\Enum\RoleType;
use App\Models\Role;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use App\Services\Role\RoleService;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;

class RoleDataTable extends DataTable
{
  /**
   * Create a new datatables instance.
   *
   * @return void
   */
  public function __construct(
    protected RoleService $roleService,
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
      ->addColumn('user_count', function ($row) {
        return "{$row->users->count()} Akun";
      })
      ->addColumn('permission_count', fn ($row) => $row->definePermissionCount())
      ->addColumn('action', 'settings.roles.action')
      ->rawColumns([
        'permission_count',
        'action',
      ]);
  }

  /**
   * Get the query source of dataTable.
   */
  public function query(): QueryBuilder
  {
    return $this->roleService->selectRoleWhereIn(RoleType::toArray(0, 1))->oldest('name');
  }

  /**
   * Optional method if you want to use the html builder.
   */
  public function html(): HtmlBuilder
  {
    return $this->builder()
      ->setTableId('role-table')
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
        ->title(trans('Role'))
        ->addClass('text-center'),
      Column::make('user_count')
        ->title(trans('Jumlah Pengguna'))
        ->addClass('text-center'),
      Column::make('permission_count')
        ->title(trans('Jumlah Hak Akses'))
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
    return 'Role_' . date('YmdHis');
  }
}
