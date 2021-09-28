<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\ViewController;

class UserController extends Controller
{
    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {

        $code = rand(1111, 9999);
        $user = new User();
        $user->phone = $request->phone;
        $user->code = $code;
        $user->save();

        $nexmo = app('Nexmo\Client');
        $nexmo->message()->send([
            'to' => '+880' . (int) $request->phone,
            'from' => 'Asif Ul Islam',
            'text' => 'verify Code: ' . $code,

        ]);

        return redirect('/verify');
    }

    public function getVerify()
    {
        return view('backend.user.verify');
    }

    public function postVerify(Request $request)
    {
        $check = User::where('code', $request->code)->first();
        if ($check) {
            $check->code = "";
            $check->save();
            return redirect('/');
        } else {
            return back()->withMessage('phone verify not match');
        }
    }
}
