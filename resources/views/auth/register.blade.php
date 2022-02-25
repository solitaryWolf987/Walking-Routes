<style>
    .login 
    {
        text-align: center;
        border-style: double;
        margin: auto; 
        margin-top: 25vh;
        width: 400px; height: 400px;

    }
    input{ border: 1px solid; }
    td:first-child{ width: 100px; }
</style>

<div class="login">
    <x-guest-layout>
        <x-auth-card>
            <x-slot name="logo">
                <a href="/">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </x-slot>

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- First Name -->
                <div>
                    <x-label for="name" :value="__('First Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
                </div>

                <!-- Last Name -->
                <div>
                    <x-label for="LastName" :value="__('Last Name')" />

                    <x-input id="LastName" class="block mt-1 w-full" type="text" name="LastName" :value="old('LastName')" required autofocus />
                </div>

                <!-- Last Name -->
                <div>
                    <x-label for="age" :value="__('Age')" />

                    <x-input id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')" required autofocus />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                                    type="password"
                                    name="password_confirmation" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <x-button class="ml-4">
                        {{ __('Register') }}
                    </x-button>
                </div>
            </form>
        </x-auth-card>
    </x-guest-layout>
</div>