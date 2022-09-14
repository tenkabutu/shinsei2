
	<header class="leftNavigation ps{{Auth::user()->id}}_2">
	<nav>
		<h4>
			<a href="/tabusapo_lb/public">
			@if(isset(Auth::user()->id))
				@if(Auth::user()->id==7)
				<link href="https://fonts.googleapis.com/earlyaccess/nicomoji.css" rel="stylesheet">
				<img width="50" alt="" src="/tabusapo_lb/public/img/tabsapo2.png"><span class="helpdesk_title" style="font-family:'Nico Moji'";>ヘルプデスク<br>シエンツール</span>
				@else
				<img width="70" alt="" src="/tabusapo_lb/public/img/tabsapo.png">タブサポ君
				@endif
			@else
				<img width="70" alt="" src="/tabusapo_lb/public/img/tabsapo.png">タブサポ君
			@endif
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
				<div id="delivery_check">
				@if(Auth::user()->id==8)

					@if($delivery_check!=0)
					<div id="delivery_check4">
						<a href="/tabusapo_lb/public/matter/agent"><label>本日　:{{$delivery_check}}件</label></a>
					</div>
					@endif
					@if($delivery_check2!=0)
					<div id="delivery_check5">
						<a href="/tabusapo_lb/public/matter/agent"><label>翌朝　:{{$delivery_check2}}件</label></a>
					</div>
					@endif
					@if($delivery_check3!=0)
					<div id="delivery_check6">
						<a href="/tabusapo_lb/public/matter/agent"><label>未定　:{{$delivery_check3}}件</label></a>
					</div>
					@endif
					@if($delivery_check5!=0)
					<div id="delivery_check9">
						<a href="/tabusapo_lb/public/matter/agent"><label>今朝🏃‍♀️💨:{{$delivery_check5}}件</label></a>
					</div>
					@endif

				@else

					@if($delivery_check!=0)
					<div id="delivery_check1">
						<a href="/tabusapo_lb/public/matter/agent"><label>本日　:{{$delivery_check}}件</label></a>
					</div>
					@endif
					@if($delivery_check2!=0)
					<div id="delivery_check2">
						<a href="/tabusapo_lb/public/matter/agent"><label>翌朝　:{{$delivery_check2}}件</label></a>
					</div>
					@endif
					@if($delivery_check3!=0)
					<div id="delivery_check3">
						<a href="/tabusapo_lb/public/matter/agent"><label>未定　:{{$delivery_check3}}件</label></a>
					</div>
					@endif
					@if($delivery_check5!=0)
					<div id="delivery_check8">
						<a href="/tabusapo_lb/public/matter/agent"><label>今朝🏃‍♀️💨:{{$delivery_check5}}件</label></a>
					</div>
					@endif

				@endif
				@if($delivery_check4!=0)
					<div id="delivery_check7">
						<a href="/tabusapo_lb/public/matter/agent"><label>謝罪💀:{{$delivery_check4}}件</label></a>
					</div>
				@endif


				</div>
				<div class='side_label'>
					<span>案件</span>
				</div>
				<ul>
					<li><a href="/tabusapo_lb/public/matter" active="request()->routeIs('dashboard2')">新規登録</a></li>
					<li><a href="/tabusapo_lb/public/matter/search?search_type1=2">一覧<span class="position_right">({{$matter_count}})</span></a></li>

				</ul>
				<div class='side_label'>
					<span>タスク</span>
					</div>
					<ul>
					<li @if($usertask_count >0) class="task_exist" @endif><a href="/tabusapo_lb/public/matter/user">タスク確認<span class="position_right">(<span class="font_bold">{{$usertask_count}}</span>)</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/agent">訪問予定<span class="position_right">({{$delivery_count.":".$agent_count}})</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/device">キッティング<span class="position_right">({{$six.":".$seven}})</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/inside_work">作業中<span class="position_right">({{$inside_count}})</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/call">こうかんでんわ<span class="position_right">({{$call_count}})</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/spare">貸出機待ち案件<span class="position_right">({{$spare_count}})</span></a></li>
					<li><a href="/tabusapo_lb/public/matter/contact">連絡待ち案件<span class="position_right">({{$contact_count}})</span></a></li>

				</ul>
				@if(Auth::user()->id==2||Auth::user()->id==3||Auth::user()->id==4||Auth::user()->id==5||Auth::user()->id==12)
				<div class='side_label'>
					<span>端末</span>
				</div>
				<ul>

<!-- 					<li><a>新規追加(未実装)</a></li> -->
					<li><a href="/tabusapo_lb/public/device" >１つの端末いじる奴</a></li>
					<li><a href="/tabusapo_lb/public/device/change" >２つの端末交換する奴</a></li>

					<li><a href="/tabusapo_lb/public/device/devicelog" >りれき</a></li>
					<li><a href="/tabusapo_lb/public/device/send6" >送るときの表v6<span class="position_right">({{$send6_count.":".$send6_count2}})</span></a></li>
					<li><a href="/tabusapo_lb/public/device/send7" >送るときの表v7<span class="position_right">({{$send7_count.":".$send7_count2}})</span></a></li>
					<li><a href="/tabusapo_lb/public/device/return" >おかえりれき</a></li>



				</ul>
				@endif
				<div class='side_label'>
					<span>データ</span>
				</div>
				<ul>
					<li><a href="/tabusapo_lb/public/device/sparelist" >貸出機なう<span class="position_right">({{$spare_count2}})</span></a></li>
					<li><a href="/tabusapo_lb/public/total/work_count">作業検索</a></li>
					<li><a href="/tabusapo_lb/public/user" active="request()->routeIs('device')">ユーザー</a></li>
					<li><a href="/tabusapo_lb/public/school" active="request()->routeIs('device')">学校</a></li>
					<li><a href="/tabusapo_lb/public/teacher" >教員</a></li>
					<li><a href="/tabusapo_lb/public/supporter" >支援員</a></li>
					<li><a href="/tabusapo_lb/public/category" >カテゴリー(未実装)</a></li>
				</ul>
				<div class='side_label'>
					<span>集計(作成中)</span>
				</div>
				<ul>

					<li><a href="/tabusapo_lb/public/total/change">交換ランキング</a></li>
					<li><a href="/tabusapo_lb/public/total/work_total">カテゴリー集計</a></li>
					<li><a href="/tabusapo_lb/public/total/matter_confirmation">案件一覧(確認用)</a></li>
					<li><a href="/tabusapo_lb/public/total/matter_report">案件一覧(提出用)</a></li>
					<li><a href="/tabusapo_lb/public/total/matter_report2">受付区分集計(提出用)</a></li>
					<li><a href="/tabusapo_lb/public/total/break">破壊ランキング(未実装)</a></li>

					<li><a href="/tabusapo_lb/public/total/work_count">月別作業集計(未実装)</a></li>
					<li><a href="/tabusapo_lb/public/total/device_count">月別交換集計(未実装)</a></li>
				</ul>
			@endauth
		@endif


		</div>
	</nav>
	</header>
