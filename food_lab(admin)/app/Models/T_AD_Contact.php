<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class T_AD_Contact extends Model
{
    public $table = 't_ad_contact';
    use HasFactory;

    /*
   * Create:Zar Ni(2022/01/22)
   * Update:
   * This function is Show data of Customer Contact List.
   */
    public function customerContactList()
    {

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'Start customerContactList'
        ]);

        $cusC = T_AD_Contact::select('*', DB::raw('t_ad_contact.id AS ID'))
            ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_contact.customer_id')
            ->where('t_ad_contact.del_flg', 0)
            ->paginate(10);

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'End customerContactList'
        ]);

        return $cusC;
    }

    /*
   * Create:Zar Ni(2022/01/22)
   * Update:
   * This function is Show data of Customer Contact Count.
   */
    public function contactCount()
    {

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'Start contactCount'
        ]);

        $conCount = T_AD_Contact::where('t_ad_contact.reply', null)
            ->where('t_ad_contact.del_flg', 0)
            ->count('t_ad_contact.id');

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'End contactCount'
        ]);

        return $conCount;
    }

    /*
   * Create:Zar Ni(2022/01/22)
   * Update:
   * This function is Show data of Customer Contact Reply.
   */
    public function contactReply($id)
    {

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'Start contactReply'
        ]);

        $conreply = T_AD_Contact::select('*', DB::raw('t_ad_contact.id AS ID'))
            ->join('t_cu_customer', 't_cu_customer.id', '=', 't_ad_contact.customer_id')
            ->where('t_ad_contact.id', '=', $id)
            ->where('t_ad_contact.del_flg', 0)
            ->first();

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'End contactReply'
        ]);

        return $conreply;
    }

    /*
   * Create:Zar Ni(2022/01/25)
   * Update:
   * This function is for reply to customer.
   */
    public function cuscontactrp($id, $request)
    {

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'Start cuscontactrp'
        ]);

        $cont = T_AD_Contact::where('id', $id)
            ->update(['reply' => $request]);

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'End cuscontactrp'
        ]);

        return $cont;
    }
    /*
   * Create:Zar Ni(2022/01/25)
   * Update:
   * This function is for reply to customer.
   */
    public function cuscontactMail($id)
    {
        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'Start cuscontactMail'
        ]);

        $contactmail = T_AD_Contact::select(['customer_id', 'reply', 'message'])
            ->where('id', $id)
            ->first();

        Log::channel('adminlog')->info("T_AD_Contact Model", [
            'End cuscontactMail'
        ]);
        return $contactmail;
    }
}
