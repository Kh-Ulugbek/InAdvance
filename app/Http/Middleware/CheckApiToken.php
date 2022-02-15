<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckApiToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(Auth::guard('api')->check()){
            $is_exists = User::where('id' , Auth::guard('api')->id())->exists();
            if($is_exists){
                $user = Auth::guard('api')->user();
                if ($user->role_id == User::ROLE_ADMIN) {
                    $userRole = 'admin';
                } elseif ($user->role_id == User::ROLE_OWNER) {
                    $userRole = 'owner';
                } elseif ($user->role_id == User::ROLE_CUSTOMER) {
                    $userRole = 'customer';
                } else {
                    return response()->json('Invalid Token', 401);
                }
                if ($userRole) {
                    // Set scope as admin/moderator based on user role
                    $request->request->add([
                        'scope' => $userRole
                    ]);
                }
                return $next($request);
            }
        }
        return response()->json('Unauthorized', '401');
    }
}
