<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\AreaData;
use App\Models\User;
use App\Models\WorkType;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $areas = AreaData::all();
        $worktype=WorkType::all();

        return view('auth.register',compact('areas','worktype'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'name2' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'confirmed','min:4'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'name2' => $request->name2,
            'email' => $request->email,
            'employee' => $request->employee,
            'worktype_id' => $request->worktype_id,
            'password' => Hash::make($request->password),
        ]);
        if ($request->has('areas')) {
            // 複数選択されたエリアを同期
            $user->areas()->sync($request->areas);
        }else {
            // areas が存在しない場合、全てのエリアを解除
            $user->areas()->detach();
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
