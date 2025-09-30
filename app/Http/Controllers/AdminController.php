<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function promote($id){
        
        $user=User::find($id);

        $user->role='admin';
        $user->save();
        return redirect()->back()->with('success', 'تم ترقية المستخدم لأدمن بنجاح.');
        }

        public function destroy($id)
        {
            $user=User::find($id);
            $user->delete();
            return redirect()->back()->with('success', 'تم حذف المستخدم بنجاح.');

        }

        public function admin_delete($id)
     {
        $admin=User::find($id);

        $admin->role='user';
        $admin->save();
         return redirect()->back()->with('success', 'تم حذف الأدمن بنجاح.');
       
     }
}
