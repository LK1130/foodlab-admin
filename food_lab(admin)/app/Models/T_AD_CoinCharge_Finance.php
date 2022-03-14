<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Requests\RangeChart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class T_AD_CoinCharge_Finance extends Model
{
    public $table = 't_ad_coincharge_finance';
    use HasFactory;

    // admin 
    public function coinDaily()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinDaily'
        ]);

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw(('day(created_at) as day')),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->where(DB::raw('month(created_at)'), $currentMonth)
            ->where(DB::raw('year(created_at)'), $currentYear)
            ->orderBy(DB::raw('created_at'), 'ASC')
            ->groupBy('day')
            ->get();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinDaily'
        ]);

        return $coin;
    }

    // admin 
    public function coinMonthly()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinMonthly'
        ]);
        $current = Carbon::now()->year;
        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw('year(created_at) as year'),
            DB::raw('monthname(created_at)as month'),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->where(DB::raw('year(created_at)'), $current)
            ->groupBy('year')
            ->groupBy('month')
            ->get();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinMonthly'
        ]);

        return $coin;
    }

    // admin 
    public function coinYearly()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinYearly'
        ]);

        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw('year(created_at) as year'),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->orderBy(DB::raw('year(created_at)'), 'ASC')
            ->groupBy('year')
            ->get();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinYearly'
        ]);

        return $coin;
    }

    // admin 
    public function coinRange($request)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinRange'
        ]);

        $fromDate = $request['fromDate'];
        $toDate = $request['toDate'];

        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw('date(created_at) as date '),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->where(DB::raw('date(created_at)'), '>=', $fromDate)
            ->where(DB::raw('date(created_at)'), '<=', $toDate)
            ->orderBy(DB::raw('created_at'), 'ASC')
            ->groupBy('date')
            ->get();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinRange'
        ]);
        return $coin;
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function setChargeFinance($chargeid, $amount, $payment)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start setChargeFinance'
        ]);

        $result = T_AD_CoinCharge_Finance::where('del_flg', 0)
            ->where('charge_id', $chargeid)
            ->get();

        if (count($result) == 0) {
            $coin_finance = new T_AD_CoinCharge_Finance();
            $coin_finance->charge_id = $chargeid;
            $coin_finance->payment_type = $payment;
            $coin_finance->amount = $amount;
            $coin_finance->save();
        } else {
            T_AD_CoinCharge_Finance::where('del_flg', 0)
                ->where('charge_id', $chargeid)
                ->update([
                    'payment_type' => $payment,
                    'amount' => $amount
                ]);
        }

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End setChargeFinance'
        ]);
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function reSetFinance($chargeid)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start reSetFinance'
        ]);

        T_AD_CoinCharge_Finance::where('charge_id', $chargeid)
            ->update([
                'amount' => 0,
                'del_flg' => 1
            ]);

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End reSetFinance'
        ]);
    }

    /*
    * Create : linn(2022/01/16) 
    * Update : 
    * This function is use to set coin finance.
    * Parameters : no
    * Return : photo path
    */
    public function getFinance($chargeid)
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start getFinance'
        ]);

        $result = T_AD_CoinCharge_Finance::where('charge_id', $chargeid)
            ->where('del_flg', 0)
            ->first();

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End getFinance'
        ]);

        return $result;
    }

    /* admin
    * Create : Zaw(2022/02/22) 
    * Update : 
    * This function is use to 
    * Parameters :
    * Return : 
    */

    public function dailyCointable()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start dailyCointable'
        ]);

        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $coinTable = T_AD_CoinCharge_Finance::select(
            DB::raw(('date(created_at) as date')),
            DB::raw(('day(created_at) as day')),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->where(DB::raw('month(created_at)'), $currentMonth)
            ->where(DB::raw('year(created_at)'), $currentYear)
            ->orderBy(DB::raw('created_at'), 'ASC')
            ->groupBy('date')
            ->paginate(10);

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End dailyCointable'
        ]);

        return $coinTable;
    }

    /* admin 
    * Create : Zaw(2022/02/22) 
    * Update : 
    * This function is use to 
    * Parameters :
    * Return : 
    */

    public function coinmonthlyTable()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinmonthlyTable'
        ]);
        $current = Carbon::now()->year;
        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw('year(created_at) as year'),
            DB::raw('monthname(created_at)as month'),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->where(DB::raw('year(created_at)'), $current)
            ->groupBy('year')
            ->groupBy('month')
            ->paginate(10);

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinmonthlyTable'
        ]);

        return $coin;
    }

    /*admin 
    * Create : Zaw(2022/02/22) 
    * Update : 
    * This function is use to 
    * Parameters :
    * Return : 
    */

    public function coinyearlyTable()
    {
        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'Start coinyearlyTable'
        ]);

        $coin = T_AD_CoinCharge_Finance::select(
            DB::raw('year(created_at) as year'),
            DB::raw('sum(amount) as totalAmount'),
        )
            ->orderBy(DB::raw('year(created_at)'), 'ASC')
            ->groupBy('year')
            ->paginate(10);

        Log::channel('adminlog')->info("T_AD_CoinCharge_Finance Model", [
            'End coinyearlyTable'
        ]);

        return $coin;
    }
}
