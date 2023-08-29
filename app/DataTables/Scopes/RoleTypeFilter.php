<?php

namespace App\DataTables\Scopes;

use Illuminate\Http\Request;
use App\Helpers\Global\Helper;
use Yajra\DataTables\Contracts\DataTableScope;

class RoleTypeFilter implements DataTableScope
{
  public function __construct(
    protected Request $request
  ) {
    # code...
  }

  /**
   * Apply a query scope.
   *
   * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
   * @return mixed
   */
  public function apply($query)
  {
    $filters = ['roles'];

    foreach ($filters as $field) {
      if ($this->request->has($field) && $this->request->get($field) !== null) {
        if ($this->request->get($field) !== Helper::ALL) {
          $query->whereHas('roles', function ($query) use ($field) {
            $query->where('name', $this->request->get($field));
          });
        }
        // Handle the case when $this->request->get($field) === Helper::ALL
      }
    }

    return $query;
  }
}
