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
        if ($employeeId == 0) {
            return redirect('/attendance/search');
        }elseif ($employeeId == 'out'){
            Auth::logout();
            return redirect('/')->with('status', 'Logged out successfully.');
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
        // フィルター条件
        $userFilter = $request->input('user');
        $areaFilter = $request->input('area');
        $dateFilter = $request->input('date', now()->toDateString());

        // クエリビルダー
        $query = Attendance::query()->with(['user.area']);

        if ($userFilter) {
            $query->whereHas('user', function ($q) use ($userFilter) {
                $q->where('name', 'LIKE', "%{$userFilter}%")
                ->orWhere('employee_number', 'LIKE', "%{$userFilter}%");
            });
        }

        if ($areaFilter) {
            $query->whereHas('user.area', function ($q) use ($areaFilter) {
                $q->where('id', $areaFilter);
            });
        }

        if ($dateFilter) {
            $query->whereDate('check_in', $dateFilter);
        }

        // 結果取得
        $results = $query->get();

        // エリアデータを再取得してビューに渡す
        $areas = AreaData::all();

        return view('attendance.management', [
                'areas' => $areas,
                'results' => $results,
        ]);
    }

}
