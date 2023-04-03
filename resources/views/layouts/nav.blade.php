
	<header class="leftNavigation ps{{Auth::user()->id}}_2">
	<nav>
		<h4>
			<a href="/shinsei2/public">

				<img width="70" alt="" src="/shinsei2/public/img/shinsei.jpg">申請2号

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
					@if($userdata->rest)

<br>
					<div class='side_label'>
						<span>休暇申請情報</span>
					</div>
					<table>
						<tr>
							<th>勤務時間</th><td>{{(int)$userdata->worktype->def_allotted/60}}時間</td>
						</tr>
						<tr>
							<th width='80'>付与有給</th>
							<th>{{$userdata->rest->rest_allotted_day}}日</th>
						</tr>
						<tr>
							<th width='80'>持越有給</th>
							<th>{{$userdata->rest->co_day}}日</th>
						</tr>

					</table>
						<table>
							<tr>
							<th width='80'>取得有給</th>
							<th>{{$used_rest_day}}日</th>
						</tr>
						<tr>
							<th>取得時間給</th>
							<td>{{$used_rest_time.'('.ceil($used_rest_time/8).'日分)'}}</td>
						</tr>

						<tr>
							<th>消化半休</th>

							<td>{{$used_harf_rest.'回('.ceil($used_harf_rest/2).'日分)'}}</td>
						</tr>
					</table>
					<table>
						<tr>
							<th>残有給</th>
							<td>{{$residue_rest_day}}日</td>
						</tr>
						<tr>
							<th width='100'>残持越有給</th>
							<th>{{max($residue_co_day,0)}}日</th>
						</tr>
						<tr>
							<th>残時間給</th>
							<td>{{40-$used_rest_time}}時間</td>
						</tr>
					</table>
					@else
					<label>有給データが設定されていません</label>
					@endif
				</div>
				<div class='side_label'>
					<span>勤務申請</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/create_pa" >休暇申請</a></li>
					<li><a href="/shinsei2/public/create_ov" >振替申請</a></li>
					<li><a href="/shinsei2/public/create_te" >テレワーク申請</a></li>

					<li><a href="/shinsei2/public/matter_search">申請一覧</a></li>
					@if(Auth::user()->role<=2)
					<li ><a href="/shinsei2/public/matter_ruling">全申請一覧</a>　<a class="double" href="/shinsei2/public/matter_ruling?mode=search&search_type=3">申請{{$order_count}}件</a></li>
					@endif
				</ul>
				<div class='side_label'>
					<span>休暇申請(改修中)</span>
				</div>
				<ul>
					<li><a href="/shinsei2/public/create_pa" >新規登録</a></li>
					<li><a href="/shinsei2/public/matter_search">申請一覧</a></li>
					@if(Auth::user()->role<=2)
					<li ><a href="/shinsei2/public/matter_ruling">全申請一覧</a>　<a class="double" href="/shinsei2/public/matter_ruling?mode=search&search_type=3">申請{{$order_count}}件</a></li>
					@endif
				</ul>
				<div class='side_label'>
					<span>振替申請(改修中)</span>
				</div>
				<ul>
					<li><a href="/shinsei2/public/create_ov" >新規登録</a></li>
					<li><a href="/shinsei2/public/matter_search">申請一覧</a></li>
					@if(Auth::user()->role<=2)
					<li ><a href="/shinsei2/public/matter_ruling">全申請一覧</a>　<a class="double" href="/shinsei2/public/matter_ruling?mode=search&search_type=3">申請{{$order_count}}件</a></li>
					@endif
				</ul>
				<div class='side_label'>
					<span>テレワーク申請(改修中)</span>
				</div>
				<ul>
					<li><a href="/shinsei2/public/create_te" >新規登録</a></li>
					<li><a href="/shinsei2/public/matter_search">申請一覧</a></li>
					@if(Auth::user()->role<=2)
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
				@if(Auth::user()->role<=2)
				<div class='side_label'>
					<span>データ</span>
				</div>
				<ul>

					<li><a href="/shinsei2/public/user" active="request()->routeIs('device')">ユーザー</a></li>

					<li><a href="/tabusapo_lb/public/category" >カテゴリー(未実装)</a></li>
				</ul>

					@endif


			@endauth
		@endif


		</div>
	</nav>
	</header>
