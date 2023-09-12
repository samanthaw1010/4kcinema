<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\User;
use App\Models\User_Package;
use App\Models\ViewPage;
use Illuminate\Http\Request;
use App\Models\Revenue;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $viewData = ViewPage::all();
        // //lấy ngày và số lượt view)
        // $labels = $viewData->pluck('created_at');
        // $data = $viewData->pluck('view_count');

        $today = Carbon::now('Asia/Ho_Chi_Minh')->subDays(0);
        $yesterday = Carbon::now('Asia/Ho_Chi_Minh')->subDays(1);
        $seven_days_ago = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7);

        // Lượt xem trang chủ
        $view_0_day = ViewPage::whereDate('created_at', '>=', $today)->sum('view_count');
        $view_1_day = ViewPage::whereDate('created_at', '=', $yesterday)->sum('view_count');
        $view_7_day = ViewPage::whereDate('created_at', '>=', $seven_days_ago)->sum('view_count');

        // Doanh thu
        $revenue_0_day = Revenue::whereDate('purchase_date', '>=', $today)->sum('purchase_total');
        $revenue_1_day = Revenue::whereDate('purchase_date', '=', $yesterday)->sum('purchase_total');
        $revenue_7_day = Revenue::whereDate('purchase_date', '>=', $seven_days_ago)->sum('purchase_total');
        $revenue_all_day = Revenue::sum('purchase_total');

        // Lượt mua gói Gold
        $gold_0_day = User_Package::where('name', 'GOLD')
            ->whereDate('purchase_date', '>=', $today)
            ->count();

        $gold_1_day = User_Package::where('name', 'GOLD')
            ->whereDate('purchase_date', '=', $yesterday)
            ->count();

        $gold_7_day = User_Package::where('name', 'GOLD')
            ->whereDate('purchase_date', '>=', $seven_days_ago)
            ->count();

        // Lượt mua gói Platinum
        $platinum_0_day = User_Package::where('name', 'PLATINUM')
            ->whereDate('purchase_date', '>=', $today)
            ->count();

        $platinum_1_day = User_Package::where('name', 'PLATINUM')
            ->whereDate('purchase_date', '=', $yesterday)
            ->count();

        $platinum_7_day = User_Package::where('name', 'PLATINUM')
            ->whereDate('purchase_date', '>=', $seven_days_ago)
            ->count();

        // Top phim được xem nhiều
        $hotMovie = Movie::where('isHotMovie', 1)
            ->join('viewmovies', 'movies.id', '=', 'viewmovies.movie_id')
            ->select('movies.id', 'movies.title', 'movies.poster', 'viewmovies.view_count')
            ->get();
        return view('dashboard', compact('view_0_day', 'view_1_day', 'view_7_day', 'revenue_0_day', 'revenue_1_day', 'revenue_7_day', 'revenue_all_day', 'hotMovie', 'gold_0_day', 'gold_1_day', 'gold_7_day', 'platinum_0_day', 'platinum_1_day', 'platinum_7_day'));
    }
    public function check_email(Request $request)
    {
        $email = $request->input('email');
        dd($email);
        $user = User::where('email', $email)->first();

        if ($user) {
            return response()->json(['exists' => true]);
        }

        return response()->json(['exists' => false]);
    }




}