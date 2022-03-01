<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Dacha;
use App\Models\RentDacha;
use App\Models\User;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index() {
        $dacha_count = Dacha::query()->count();
        $location_count = Category::query()->count();
        $orders_count = RentDacha::query()->count();
        $admins_count = User::query()->count();

        $recent_dacha = Dacha::query()->orderByDesc('id')->take(8)->get();
        $recent_orders = RentDacha::query()->orderByDesc('id')->take(10)->get();
        return view('admin.pages.index',
            compact('dacha_count', 'location_count', 'orders_count', 'admins_count', 'recent_dacha', 'recent_orders'));
    }
}
