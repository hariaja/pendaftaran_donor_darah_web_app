@can('events.edit')
<a href="{{ route('events.edit', $uuid) }}" class="text-warning me-2" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.events.edit') }}"><i class="fa fa-sm fa-pencil"></i></a>
@endcan
@can('events.show')
  <a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-modern me-2 show-events" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.events.show') }}"><i class="fa fa-sm fa-eye"></i></a>
@endcan
@can('events.destroy')
<a href="javascript:void(0)" data-uuid="{{ $uuid }}" class="text-danger me-2 delete-events" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ trans('page.events.delete') }}"><i class="fa fa-sm fa-trash"></i></a>
@endcan

@vite('resources/js/tooltip.js')