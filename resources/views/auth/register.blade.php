<x-guest-layout>

        <x-slot name="logo">
            <a href="/">

            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        	<div class="create_logo">
        		<h2 class="create_header"><img width="50" alt="" src="/shinsei2/public/img/shinsei.jpg">申請2号</h2>
        	</div>

        <form class="create_user_form" method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <h4>新規登録</h4>
            <div>

				  <x-label for="employee" :value="__('社員番号')" />

                <x-input id="employee" class="block mt-1 w-full" type="text" name="employee" :value="old('employee')" required autofocus />


               <br> <x-label for="name" :value="__('氏名')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />

                 <br><x-label for="name2" :value="__('表示名(名字のみ)')" />

                <x-input id="name2" class="block mt-1 w-full" type="text" name="name2" :value="old('name2')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('パスワード')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('もういっかい')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>
            <div class="mt-4">
            	勤務時間
                <select name="worktype_id">


					<option value=3 >9時-17時</option>
					<option value=4 >10時-18時</option>
					<option value=5 >8時半-16時半</option>
					<option value=1 >9時-18時</option>
					<option value=2 >8時半-17時</option>
					<option value=6 >8時半-17時半</option>
					<option value=7 >9時-17時半</option>
				</select>
				<br>
               	勤務地<select name="area">
					<option value=0 >江越</option>
					<option value=1 >八代</option>
					<option value=2 >熊本市</option>
					<option value=3 >玉名</option>
					<option value=4 >荒尾</option>
					<option value=5 >天草</option>
					<option value=6 >市町村A</option>
					<option value=7 >市町村B</option>
					<option value=8 >熊本県</option>


					</select>
				<br>
               	契約開始<select name="hiring_period">
					<option value=0 >４月～３月</option>
					<option value=1 >１０月～９月</option>



					</select>
            </div>
            <br>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('既にアカウントがある方') }}
                </a>

                <x-button class="ml-4">
                    {{ __('新規登録') }}
                </x-button>
            </div>
        </form>

</x-guest-layout>
