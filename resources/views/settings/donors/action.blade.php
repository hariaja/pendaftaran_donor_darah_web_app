@can('donations.show')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-modern me-2 show-donations" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.donations.show') }}"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('donations.destroy')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-2 delete-donations" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.donations.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/tooltip.js')