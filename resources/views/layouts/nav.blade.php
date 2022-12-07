
	<header class="leftNavigation ps{{Auth::user()->id}}_2">
	<nav>
		<h4>
			<a href="/shinsei2/public">

				<img width="70" alt="" src="/shinsei2/public/img/shinsei.jpg">申請つーる

			</a>
		</h4>
		<div class="navbar_menu">
		 @if (Route::has('login'))
		 	@auth
				<div id='account'>
					<table>
						<tr>
							<th width='22'>No</th>
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
							<td>{{ Auth::user()->employee }}</td>
							<td>{{ Auth::user()->name }}</td>
						</tr>
					</table>
					<table>
						<tr>
							<th colspan='2'>残有給(持越5日)</th>
						</tr>
						<tr>
							<th width='100'>10日</th>
							<th>2時間</th>
						</tr>
					</table>
					<table>
						<tr>
							<th colspan='2'>未振替</th>
						</tr>
						<tr>
							<th width='30'>9/10</th>
							<th>5時間</th>
						</tr>
					</table>
				</div>
				<div class='side_label'>
					<span>勤務申請</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" >休暇申請(未実装)</a></li>
					<li><a href="/shinsei2/public/create_ov" >振替申請</a></li>
					<li><a href="/shinsei2/public/create_te" >テレワーク申請</a></li>

					<li><a href="/shinsei2/public/matter_search">申請一覧</a></li>
					@if(Auth::user()->role==1)
					<li ><a href="/shinsei2/public/matter_ruling">全申請一覧</a>　<a class="double" href="/shinsei2/public/matter_ruling?mode=search&search_type=3">申請{{$order_count}}件</a></li>
					@endif
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
