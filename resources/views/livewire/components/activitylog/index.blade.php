<div>
    <x-slot name="title">
        {{ __('Журнал событий') }}
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('admin.activitylog.index') }}">{{ __('Журнал событий') }}</a></li>
        </ol>
    </x-slot>

    <livewire:components.activity-log.activity-log-table />

</div>
