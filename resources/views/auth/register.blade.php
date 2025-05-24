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
					@foreach($worktype as $type)
						<option value={{$type->id}}>{{$type->worktype}}</option>
					@endforeach
				</select>
				<br>
               	勤務地<select name="areas[]"  class="areas">
        			@foreach($areas as $area)
            			<option value="{{ $area->id }}">{{ $area->name }}</option>
        			@endforeach
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
