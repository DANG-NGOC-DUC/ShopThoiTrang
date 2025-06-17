<?php
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }

    public function update(Request $request, $id)
{
    $user = User::findOrFail($id);

    $user->fullname = $request->input('fullname');
    $user->email = $request->input('email');
    $user->phone_number = $request->input('phone_number');
    $user->address = $request->input('address');
    $user->save();

    return redirect()->route('user.profile')->with('success', 'Cập nhật thành công!');
}

}
