<div>
    @if($field['states']['visibility'] == true)
        <div class="mb-3" style="{{ $styles['parent'] }}">
        
            @if ($field['states']['stage'] === 'verifying')
                <div class="row mb-1 required">
                    <label for="{{ $field['models']['otp'] }}" class="col-md-3 col-form-label">OTP number(6 digits)</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="number" wire:model.live="{{ $field['models']['otp'] }}" name="otp" id="{{ $field['models']['otp'] }}" class="form-control" placeholder="OTP number" style="font-size: 14px;">
                        @error($field['models']['otp'])
                            <div style="color: red;background: none;">{{ $message }}</div>
                        @enderror

                        @if($field['properties']['countdown'] && $field['states']['countdown'])
                            <div class="text-xs font-medium text-gray-500 mt-1 mb-1">
                                Resend in <span wire:ignore id="counter_{{ $field['id'] }}" class="text-gray-900"></span>
                            </div> 
                        @else
                            <div class="text-xs font-medium text-gray-900 mt-1 mb-1">
                                Didn't receive yet? <a class="text-blue-600 hover:underline dark:text-blue-500" wire:click="resendOTP('{{ $field['id'] }}')">Resend OTP</a>
                            </div>
                        @endif

                    </div>
                </div>

                <div class="row mb-1 required">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 col-lg-6">
                        <button wire:loading.remove wire:target="verify('{{ $field['id'] }}')" type="button" wire:click="verify('{{ $field['id'] }}')" class="btn btn-secondary btn-sm">
                            <span class="block" style="width: max-content;">Verify now</span>
                        </button>

                        <button wire:loading.inline-flex wire:target="verify('{{ $field['id'] }}')" type="button" class="btn btn-secondary btn-sm">
                            <div role="status">
                                <svg aria-hidden="true" style="height: 12px; width: auto; margin-right: 8px;" class="inline text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            Verifying
                        </button>

                        @include('livewire.inc.user-update.inc.change', ['field_id' => $field['id']])

                        @if($field['properties']['permanent'] == false)
                            @include('livewire.inc.user-update.inc.remove', ['field_id' => $field['id']])
                        @endif
                    </div>
                </div>

            @elseif ($field['states']['stage'] === 'success')
                <div class="row mb-1 required">
                    <label for="{{ $field['values']['contact_number'] }}.verified" class="col-md-3 col-form-label">Your {{ $title }}</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="tel" value="{{ $field['values']['contact_number'] }}" name="verified-phone" id="{{ $field['values']['contact_number'] }}.verified" class="form-control" readonly style="font-size: 14px;">
                        <div class="text-xs my-2" style="color: green;">
                            Verified!
                        </div>

                        @include('livewire.inc.user-update.inc.change', ['field_id' => $field['id']])

                        @if($field['properties']['permanent'] == false)
                            @include('livewire.inc.user-update.inc.remove', ['field_id' => $field['id']])
                        @endif

                    </div>
                </div>
            @else        
                <div class="row required">
                    <label for="{{ $field['models']['contact_number'] }}" class="col-md-3 col-form-label">Your {{ $title }}</label>
                    <div class="col-md-9 col-lg-6">
                        <input type="tel" wire:model.blur="{{ $field['models']['contact_number'] }}" id="{{ $field['models']['contact_number'] }}" placeholder="07XXXXXXXX" name="tel-national" class="form-control">
                        @error($field['models']['contact_number'])
                            <div style="color: red;background: none;">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row required mb-1">
                    <div class="col-md-3"></div>
                    <div class="col-md-9 col-lg-6">

                        <button wire:loading.remove wire:target="send('{{ $field['id'] }}')" type="button" wire:click="send('{{ $field['id'] }}')" class="btn btn-secondary btn-sm">
                            <span class="block" style="width: max-content;">Send OTP</span>
                        </button>
                                
                        <button wire:loading.inline-flex wire:target="send('{{ $field['id'] }}')" type="button" class="btn btn-secondary btn-sm">
                            <div role="status">
                                <svg aria-hidden="true" style="height: 12px; width: auto; margin-right: 8px;" class="inline text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor" />
                                    <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill" />
                                </svg>
                                <span class="sr-only">Loading...</span>
                            </div>
                            Sending
                        </button>

                        @if($field['properties']['permanent'] == false)
                            @include('livewire.inc.user-update.inc.remove', ['field_id' => $field['id']])
                        @endif

                    </div>
                </div>
            @endif

        </div>
    @endif

    @if($field['properties']['toggle_visibility'] == true)
        <div class="row required">
            <div class="col-md-3"></div>
            <div class="col-md-9 col-lg-6">
                <div class="form-check mt-3 text-green-500">
                    <input wire:model.live="{{ $field['models']['toggle_visibility'] }}" class="form-check-input border-2 border-green-400 mr-2" type="checkbox" id="{{ $field['models']['contact_number'] }}_toggle_visibility">
                    <label class="form-check-label" for="{{ $field['models']['contact_number'] }}_toggle_visibility" style="font-weight: 400;">
                        Add {{ strtolower($title) }}
                    </label>
                </div>
            </div>
        </div>
    @endif

</div>