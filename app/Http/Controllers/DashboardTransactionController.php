<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionDetail;
use Illuminate\Support\Facades\Auth;

class DashboardTransactionController extends Controller
{
    public function index()
    {
        $sellTransactions = TransactionDetail::with(['transaction.user','product.galleries'])->whereHas('product', function($product){
            $product->where('users_id', Auth::user()->id);
        })->get();

        $buyTransactions = TransactionDetail::with(['transaction.user','product.galleries'])->whereHas('transaction', function($transaction){
            $transaction->where('users_id', Auth::user()->id);
        })->get();
        return view('pages/dashboard-transaction', compact('sellTransactions','buyTransactions'));
    }

    public function details(Request $request, $id)
    {
        $transaction = TransactionDetail::with(['transaction.user','product.galleries'])->findOrFail($id);

        return view('pages/dashboard-transaction-details', compact('transaction'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->all();
        $item = TransactionDetail::findOrFail($id);
        $item->update($data);
        return redirect()->route('dashboard-transactions-details', $id);
    }
}
