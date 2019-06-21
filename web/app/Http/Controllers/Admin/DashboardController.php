<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth.admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $top = \App\Log::groupBy('postal_code')
            ->select(\DB::raw('count(*) as pc_count, postal_code'))
            ->orderBy('pc_count', 'desc')
            ->take(10)
            ->get()
            ->toArray();
        return view('admin.dashboard', [
            'top' => $top
        ]);
    }
}
