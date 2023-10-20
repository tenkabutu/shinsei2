<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">

            </a>
        </x-slot>




        	<div class="create_logo">
        		<h2 class="create_header"><img width="50" alt="" src="/shinsei2/public/img/shinsei.jpg">パスワードリセット申請</h2>
        	</div>

        <form class="create_user_form" method="POST" action="{{ route('password.email') }}">
            @csrf
             <div class="mb-4 text-sm text-gray-600">
            {{ __('登録時に設定したアドレスを入力してください') }}
        </div>


            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-button>
                    {{ __('Password Reset') }}
                </x-button>
            </div>
            	 <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        </form>
    </x-auth-card>
</x-guest-layout>
