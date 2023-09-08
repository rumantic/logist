<div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{ __('bap.verify') }}: {{ $verify->first_name }} {{ $verify->first_name }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="{{ __('bap.close') }}"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label" for="first_name">{{ __('bap.first_name') }}</label>
                            <input type="text" wire:model="first_name" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="{{ __('bap.first_name') }}">
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="last_name">{{ __('bap.last_name') }}</label>
                            <input type="text" wire:model="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="{{ __('bap.last_name') }}">
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <label class="form-label" for="national_code">{{ __('bap.national_code') }}</label>
                            <input type="text" wire:model="national_code" class="form-control @error('national_code') is-invalid @enderror" name="national_code" placeholder="{{ __('bap.national_code') }}">
                            @error('national_code')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="birth_at">{{ __('bap.birth_at') }}</label>
                            <input type="text" wire:model="birth_at" class="form-control @error('birth_at') is-invalid @enderror" name="birth_at" placeholder="{{ __('bap.birth_at') }}">
                            @error('birth_at')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="random_string">{{ __('bap.random_string') }}</label>
                            <intput class="form-control @error('random_string') is-invalid @enderror" wire:model="random_string">
                                {{ $verify->random_string }}
                            @error('random_string')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="mb-3">
                            <label class="form-label" for="note">{{ __('bap.note') }}</label>
                            <textarea class="form-control @error('note') is-invalid @enderror" wire:model="note">
                                {{ $verify->note }}
                            </textarea>
                            @error('note')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="card-img-bottom img-responsive img-responsive-16by9" style="background-image: url('{{ route('user.verify.id_card_file', [$verify->id]) }}')"></div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="mb-3">
                            <div class="card-img-bottom img-responsive img-responsive-16by9" style="background-image: url('{{ route('user.verify.verify_file', [$verify->id]) }}')"></div>
                        </div>
                    </div>
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('bap.close') }}</button>
                <button type="button" class="btn btn-warning" wire:click="inquiry">{{ __('bap.inquiry') }}</button>
                <button type="button" class="btn btn-success" wire:click="accept">{{ __('bap.accept') }}</button>
                <button type="button" class="btn btn-danger" wire:click="reject">{{ __('bap.reject') }}</button>
            </div>
        </div>
</div>
