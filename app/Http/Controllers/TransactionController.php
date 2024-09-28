<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    // Store transaction
    public function store(Request $request)
    {
        $request->validate([
            'contact_number' => 'required|string|max:15',
            'transaction_type' => 'required|in:Cash In,Cash Out',
            'amount' => 'required|numeric',
            'transaction_date' => 'nullable|date'
        ]);

        $service_fee = 0;
        $currentBalance = Transaction::sum('amount');

        switch (true) {
            case $request->amount <= 100:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_100');
                break;
            case $request->amount > 100 && $request->amount <= 500:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_500');
                break;
            case $request->amount > 500 && $request->amount <= 1000:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_1000');
                break;
            case $request->amount > 1000 && $request->amount <= 1500:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_1500');
                break;
            case $request->amount > 1500 && $request->amount <= 2000:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_2000');
                break;
            default:
                $service_fee = config('greatjab.gcash.service_fee.BELOW_2500');
                break;
        }

        $newBalance = $request->transaction_type === 'Cash In'
            ? $currentBalance - $request->amount
            : $currentBalance + $request->amount;

        Transaction::create([
            'contact_number' => $request->contact_number,
            'transaction_type' => $request->transaction_type,
            'amount' => $request->amount,
            'service_fee' => $service_fee,
            'balance' => $newBalance,
            'transaction_date' => $request->transaction_date ?? now(),
        ]);

        return response()->json(['message' => 'Transaction saved successfully!'], 201);
    }

    // Get transactions
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 10);  // Default to 10 items per page
        $transactions = Transaction::orderBy('transaction_date', 'desc')->paginate($perPage);
        
        return response()->json($transactions);
    }
}
