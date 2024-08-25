<?php

use Carbon\Carbon;
use App\Models\UserFunds;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Psy\Readline\Userland;

if (!function_exists('getAccountbalances')) {
    function getAccountbalances($user_id)
    {
        $today = Carbon::today();
        $spent = UserFunds::where('flag', 'credit')->where('user_id', $user_id)->sum('amount');
        $earnt = UserFunds::where('flag', 'debit')->where('user_id', $user_id)->sum('amount');
        $bal = $earnt - $spent;
        $earntToday = UserFunds::where('flag', 'debit')->where('user_id', $user_id)->where('description', '!=', 'Wallet Funding')
            ->whereDate('created_at', $today)
            ->sum('amount');

        $spentToday = UserFunds::where('flag', 'credit')->where('user_id', $user_id)
            ->whereDate('created_at', $today)
            ->sum('amount');

        return ['balance' => $bal, 'earningsToday' => $earntToday, 'spentToday' => $spentToday];
    }
}

if (!function_exists('updateAccountBalance')) {

    function updateAccountBalance($user_id, $amount, $id, $flag = 'debit', $description = '', $currency = 'EUR')
    {
        try {
            $u = new UserFunds;
            $u->user_id = $user_id;
            $u->amount = $amount;
            $u->flag = $flag;
            $u->transId = $id;
            $u->description = $description;
            $u->currency = $currency;
            $u->save();
            return $u;
        } catch (Exception $e) {
            Log::error("Failed to update account balance: " . $e->getMessage(), [$e]);
            return false;
        }
    }
}

if (!function_exists('accountTxExists')) {

    function accountTxExists($transId)
    {
        $r = UserFunds::where('transId', $transId)->first();
        if ($r) {
            return $r;
        } else {
            return false;
        }
    }
}
