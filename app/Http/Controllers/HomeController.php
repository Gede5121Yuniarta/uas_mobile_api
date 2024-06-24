<?php

namespace App\Http\Controllers;

use App\Models\Kost;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Property;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function indexSA()
    {
        return view('superAdmin.dashboard');
    }

    public function userDashboard()
    {
        return view('user.dashboard'); // Pastikan view ini ada
    }

    public function indexHP()
    {
        $kosts = Kost::whereIn('status', ['confirm'])
            ->with('admin') // eager load the admin relationship
            ->latest()
            ->paginate(10);
        return view('homepage', compact('kosts'));
    }
}
