<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use App\Models\AreaData;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        // 現在出勤中の社員を取得（出勤時刻も含む）
        $currentEmployees = Attendance::whereNull('check_out')
        ->with('user')
        ->get()
        ->map(function ($attendance) {
            $attendance->user->attendance = $attendance;
            return $attendance->user;
        });

            return view('attendance.index', compact('currentEmployees'));
    }
    public function check(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $action = $request->input('action');

        // 管理者IDの場合は検索ページにリダイレクト
        if ($employeeId == 'out'){
            Auth::logout();
            return redirect('/')->with('status', 'Logged out successfully.');
        }elseif($employeeId == 'search'){
            return redirect('/attendance/admin/search');
        }

        // 社員を取得
        $user = User::where('employee', $employeeId)->first();

        if (!$user) {
            return back()->withErrors(['employee_id' => 'Invalid Employee Number.']);
        }

        if ($action === 'check-in') {
            return $this->checkIn($user);
        } elseif ($action === 'check-out') {
            return $this->checkOut($user);
        }

        return back()->withErrors(['action' => 'Invalid Action.']);
    }


    private function checkIn(User $user)
    {
        // 既に出勤中の状態か確認
        $existingAttendance = Attendance::where('user_id', $user->id)
        ->whereNull('check_out')
        ->first();

        if ($existingAttendance) {
            return back()->withErrors(['employee_id' => 'Employee is already checked in.']);
        }

        // 新規レコード作成
        Attendance::create([
                'user_id' => $user->id,
                'check_in' => now(),
        ]);

        return back()->with('status', 'Check-in successful.');
    }

    private function checkOut(User $user)
    {
        // 出勤中のレコードを取得
        $attendance = Attendance::where('user_id', $user->id)
        ->whereNull('check_out')
        ->first();

        if (!$attendance) {
            return back()->withErrors(['employee_id' => 'No active check-in found.']);
        }

        // 退出時刻を更新
        $attendance->update(['check_out' => now()]);

        return back()->with('status', 'Check-out successful.');
    }

    public function search(Request $request)
    {

        if ($request->employee_id == 'out'){
            Auth::logout();
            return redirect('/')->with('status', 'Logged out successfully.');
        }
        // 初期状態では何も表示しない
        $results = null;


        // エリアリストを取得
        $areas = AreaData::all();

        // 検索実行
        if ($request->hasAny(['employee_id', 'area_id', 'date_from', 'date_to'])) {
            $query = Attendance::query()->with(['user.areas']);

            // 社員番号でフィルター
            if ($request->filled('employee_id')) {
                $query->whereHas('user', function ($q) use ($request) {
                    $q->where('employee', $request->input('employee_id'));
                });
            }

            // 担当地域でフィルター
            if ($request->filled('area_id')) {
                $query->whereHas('user.areas', function ($q) use ($request) {
                    $q->where('area_data.id', $request->input('area_id'));
                });
            }

            // 日付範囲でフィルター
            if ($request->filled('date_from')) {
                $query->where('check_in', '>=', $request->input('date_from'));
            }

            if ($request->filled('date_to')) {
                $dateTo = $request->input('date_to') . ' 23:59:59'; // 終了時刻を23:59:59に設定
                $query->where('check_in', '<=', $dateTo);
            }

            $results = $query->orderBy('check_in', 'desc')->get();
        }

        return view('attendance.admin', compact('results', 'areas'));
    }

}
