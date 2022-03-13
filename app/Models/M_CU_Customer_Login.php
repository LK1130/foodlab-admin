<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class M_CU_Customer_Login extends Model
{
    public $table = 'm_cu_customer_login';
    use HasFactory;

    /*
      * Create : Min Khant(15/1/2022)
      * Update :
      * Explain of function :
      * Prarameter : no
      * return :
    */
    public function customer()
    {
        return $this->belongsTo('App\Models\T_CU_Customer');
    }

    public function suggestMail($id)
    {
        Log::channel('adminlog')->info("M_CU_Customer_Login Model", [
            'Start suggestMail'
        ]);

        $suggest = M_CU_Customer_Login::select('email')
            ->where('customer_id', $id)
            ->first();

        Log::channel('adminlog')->info("M_CU_Customer_Login Model", [
            'End suggestMail'
        ]);
        return $suggest;
    }
}
