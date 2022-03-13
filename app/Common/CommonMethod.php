<?php

namespace App\Common;

use Illuminate\Support\Facades\Log;

/**
 * This method is used for common method for all function and method
 */

class Method
{
    //PUBLIC METHOD

    /*
    * Create : Min Khant(22/2/2022)
    * Update :
    * Explain of function : easy control customer coin in first create state
    * Prarameter : no
    * return : customer Coin
  */
    public  function  customerCoin()
    {
        Log::channel('customerlog')->info('Common Method', [
            'start customerCoin'
        ]);

        $customerCoin = 0;

        Log::channel('customerlog')->info('Common Method', [
            'end customerCoin'
        ]);
        return $customerCoin;
    }






    //PRIVATE METHOD




}
