<x-layouts.auth>
    <x-authentication-card>
        <x-slot name="logo">
            <img src="{{ asset('images/CTP_DN_Logo.jpg') }}" alt="logo" class="w-20 rounded-xl">
        </x-slot>

        <div x-data="{ recovery: false }">
            <div class="mb-4 text-sm text-gray-600 dark:text-gray-200" x-show="! recovery">
                {{ __('Please confirm access to your account by entering the authentication code provided by your authenticator application.') }}
            </div>

            <div class="mb-4 text-sm text-gray-600 dark:text-gray-200" x-cloak x-show="recovery">
                {{ __('Please confirm access to your account by entering one of your emergency recovery codes.') }}
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('two-factor.login') }}">
                @csrf

                <div x-show="! recovery">
                    <x-mary-input label="{{ __('Code') }}" id="code" name="code" inputmode="numeric"
                        type="text" x-ref="code" autocomplete="one-time-code" autofocus icon="o-lock-closed" />
                </div>

                <div x-cloak x-show="recovery">
                    <x-mary-input label="{{ __('Recovery Code') }}" id="recovery_code" name="recovery_code"
                        type="text" x-ref="recovery_code" autocomplete="one-time-code" icon="o-key" />
                </div>

                <div class="flex flex-col md:flex-row items-center justify-between mt-4 gap-4">
                    <div>
                        <button type="button" class="text-sm text-primary hover:underline" x-show="! recovery"
                            x-on:click="
                                            recovery = true;
                                            $nextTick(() => { $refs.recovery_code.focus() })
                                        ">
                            {{ __('Use a recovery code') }}
                        </button>

                        <button type="button" class="text-sm text-primary hover:underline" x-cloak x-show="recovery"
                            x-on:click="
                                            recovery = false;
                                            $nextTick(() => { $refs.code.focus() })
                                        ">
                            {{ __('Use an authentication code') }}
                        </button>
                    </div>

                    <x-mary-button type="submit" class="btn-primary" icon="o-paper-airplane">
                        {{ __('Log in') }}
                    </x-mary-button>
                </div>
            </form>
        </div>
    </x-authentication-card>
</x-layouts.auth>
