<div>
    <x-slot name="title">
        {{ __('Компании') }}
    </x-slot>
    <x-slot name="actions">
        @can('admin_order_create')
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <button onclick="Livewire.emit('showModal', 'components.company.create')" class="btn btn-primary d-none d-sm-inline-block">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        {{ __('Добавить компанию') }}
                    </button>
                    <button onclick="Livewire.emit('showModal', 'panel.order.create')" class="btn btn-primary d-sm-none btn-icon" aria-label="__('Добавить компанию')">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                    </button>
                </div>
            </div>
        @endcan
    </x-slot>
    <x-slot name="breadcrumb">
        <ol class="breadcrumb breadcrumb-arrows" aria-label="breadcrumbs">
            <li class="breadcrumb-item"><a href="{{ route('panel.dashboard.index') }}">{{ __('bap.dashboard') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('panel.company.index') }}">{{ __('Компании') }}</a></li>
        </ol>
    </x-slot>

    <livewire:components.company.company-table />

</div>
