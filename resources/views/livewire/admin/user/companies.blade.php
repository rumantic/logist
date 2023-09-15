<div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">{{ __('Прикрепить пользователя к компании') }}</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
        </div>
        <div class="modal-body">

            <div class="row">
                <div class="col">
                    {{ __('Закреплены') }}
                    <ul class="list-group" style="max-height: 54vh; overflow: auto;">
                        @foreach($user->companies as $company)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $company->name }} (ИНН: {{ $company->inn }})
                            <button wire:click="deleteCompany({{ $company->id }})" class="btn btn-danger btn-icon btn-sm">
                                <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                            </button>
                        </li>
                        @endforeach
                    </ul>
                </div>
                <div class="col">
                    <div class="mb-3">
                        <label class="form-label" for="search">{{ __('ИНН или название компании') }}</label>
                        <input type="text" wire:model="search" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="{{ __('Фильтровать') }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <ul class="list-group" style="max-height: 50vh; overflow: auto;">
                        @foreach($companies as $company)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $company->name }} (ИНН: {{ $company->inn }})
                            @if( $company->users->contains('id', $user->id) )
                                <button wire:click="deleteCompany({{ $company->id }})" class="btn btn-danger btn-icon btn-sm">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/trash -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="4" y1="7" x2="20" y2="7" /><line x1="10" y1="11" x2="10" y2="17" /><line x1="14" y1="11" x2="14" y2="17" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg>
                                </button>
                            @else
                                <button wire:click="assign({{ $company->id }})" class="btn btn-primary btn-icon btn-sm">
                                    <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><line x1="12" y1="5" x2="12" y2="19" /><line x1="5" y1="12" x2="19" y2="12" /></svg>
                                </button>
                            @endif
                        </li>
                        @endforeach
                        @if($search == "")
                            <li class="list-group-item d-flex justify-content-between align-items-center fw-bold">
                                Для уточнения выполните поиск по ключевому слову
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

