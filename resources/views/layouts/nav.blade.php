
	<header class="leftNavigation ps{{Auth::user()->id}}_2">
	<nav>
		<h4>
			<a href="/tabusapo_lb/public">

				<img width="70" alt="" src="/shinsei2/public/img/shinsei.jpg">申請つーる

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
				<div class='side_label'>
					<span>勤務申請</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" >休暇申請(未実装)</a></li>
					<li><a href="/shinsei2/public/user" >時間外・振替申請(未実装)</a></li>
					<li><a href="/shinsei2/public/user" >テレワーク申請(未実装)</a></li>

					<li><a href="/tabusapo_lb/public/category" >申請一覧(未実装)</a></li>
				</ul>
				<div class='side_label'>
					<span>貸出申請</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" >貸出申請(未実装)</a></li>
					<li><a href="/shinsei2/public/user" >備品一覧(未実装)</a></li>
					<li><a href="/tabusapo_lb/public/category" >申請一覧(未実装)</a></li>
					<li><a href="/tabusapo_lb/public/category" >貸出履歴(未実装)</a></li>
				</ul>
				<div class='side_label'>
					<span>購入申請</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" >購入申請(未実装)</a></li>

				</ul>
				<div class='side_label'>
					<span>データ</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" active="request()->routeIs('device')">ユーザー</a></li>

					<li><a href="/tabusapo_lb/public/category" >カテゴリー(未実装)</a></li>
				</ul>




			@endauth
		@endif


		</div>
	</nav>
	</header>
