<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::count();
        $transactions = Transaction::count();
        $revenue = Transaction::sum('total_price');
        return view('pages/admin/dashboard', compact(
            'users',
            'transactions',
            'revenue'
        ));
    }
}
