
	<header class="leftNavigation ps{{Auth::user()->id}}_2">
	<nav>
		<h4>
			<a href="/tabusapo_lb/public">

				<img width="70" alt="" src="/shinsei2/public/img/shinsei.jpg">タブサポ君

			</a>
		</h4>
		<div class="navbar_menu">
		 @if (Route::has('login'))
		 	@auth
				<div id='account'>
					<table>
						<tr>
							<th width='22'>ID</th>
							<th>ユーザー</th>
							<td rowspan='2' width='45'>
								<form method="POST" action="{{ route('logout') }}">
								@csrf
								<a href="route('logout')" onclick="event.preventDefault();this.closest('form').submit();">
									{{ __('LogOut') }}
                                </a>
                        </form>
							</td>
						</tr>
						<tr>
							<td>{{ Auth::user()->id }}</td>
							<td>{{ Auth::user()->name }}</td>
						</tr>
					</table>
				</div>




			@endauth
		@endif


		</div>
	</nav>
	</header>
