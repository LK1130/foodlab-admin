<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\ReportMail;
use App\Mail\SuggestMail;
use App\Models\M_AD_Login;
use App\Models\M_CU_Customer_Login;
use App\Models\M_Payment;
use App\Models\M_Product;
use App\Models\M_Product_Detail;
use App\Models\T_AD_CoinCharge;
use App\Models\T_AD_CoinCharge_Finance;
use App\Models\T_AD_Contact;
use App\Models\T_AD_Order;
use App\Models\T_AD_OrderDetail;
use App\Models\T_AD_Report;
use App\Models\T_AD_Suggest;
use App\Models\T_CU_Coin_Customer;
use App\Models\T_CU_Customer;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use ZipArchive;

class NotificationController extends Controller
{
    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Suggest List.
   * Return :view('admin.suggest.customersuggest')
   */
    public function customerSuggest()
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customerSuggest'
        ]);

        $cussuggest = new T_AD_Suggest();
        $suggest = $cussuggest->customerSuggestList();
        $sugcount = $cussuggest->suggestcount();

        $cuscontact = new T_AD_Contact();
        $conCount = $cuscontact->contactCount();

        $cusreport = new T_AD_Report();
        $rpcount = $cusreport->reportCount();

        Log::channel('adminlog')->info("NotificationController", [
            'End customerSuggest'
        ]);

        return view('admin.suggest.customersuggest', ['suggest' => $suggest, 'sugcount' => $sugcount, 'concount' => $conCount, 'rpcount' => $rpcount]);
    }
    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Suggest Reply.
   */
    public function customersuggestReply(Request $request)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customersuggestReply'
        ]);

        $sugreply = new T_AD_Suggest();
        $reply = $sugreply->suggestReply($request->input('id'));

        Log::channel('adminlog')->info("NotificationController", [
            'End customersuggestReply'
        ]);

        return view('admin.suggest.suggestreply', ['reply' => $reply]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is reply suggest to customer and send email.
   * return view : redirect('customerSuggest')
   */
    public function cusRpy(Request $request, $id)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start cusRpy'
        ]);

        $rpy = new T_AD_Suggest();
        $data = $request->input('reply');
        $rp = $rpy->sugRpy($id, $data);
        //for Email
        $customersuggest = new M_CU_Customer_Login();
        $mailsuggest = $rpy->cussuggestMail($id);
        $sugmail = $customersuggest->suggestMail($mailsuggest['customer_id']);
        //for Customername
        $name = new T_CU_Customer();
        $customername = $name->suggestmailnickname($mailsuggest['customer_id']);
        // return $customername;
        $mail = [
            'title' => 'food labs',
            'body' => $customername['nickname'],
            'reply' => $mailsuggest['reply'],
            'cusmessage' => $mailsuggest['message'],
        ];
        Mail::to($sugmail)->send(new SuggestMail($mail));

        Log::channel('adminlog')->info("NotificationController", [
            'End cusRpy'
        ]);

        return redirect('customerSuggest');
    }

    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Contact List.
   *  view('admin.contact.customercontact')
   */
    public function customerContact()
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customerContact'
        ]);

        $cuscontact = new T_AD_Contact();
        $contact = $cuscontact->customerContactList();
        $conCount = $cuscontact->contactCount();

        $cussuggest = new T_AD_Suggest();
        $sugcount = $cussuggest->suggestcount();

        $cusreport = new T_AD_Report();
        $rpcount = $cusreport->reportCount();

        Log::channel('adminlog')->info("NotificationController", [
            'End customerContact'
        ]);

        return view('admin.contact.customercontact', ['contact' => $contact, 'sugcount' => $sugcount, 'concount' => $conCount, 'rpcount' => $rpcount]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is to show Cotact Detail of Customer.
   * view('admin.contact.contactreply')
   */
    public function customercontactReply(Request $request)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customercontactReply'
        ]);

        $conreply = new T_AD_Contact();
        $reply = $conreply->contactReply($request->input('id'));

        Log::channel('adminlog')->info("NotificationController", [
            'End customercontactReply'
        ]);

        return view('admin.contact.contactreply', ['reply' => $reply]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is reply to customer and send email.
   * return view : redirect('customerContact')
   */
    public function contrpy(Request $request, $id)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start contrpy'
        ]);

        $rpy = new T_AD_Contact();
        $data = $request->input('reply');
        $rp = $rpy->cuscontactrp($id, $data);
        //for email
        $mailcontact = $rpy->cuscontactMail($id);
        $customersuggest = new M_CU_Customer_Login();
        $sugmail = $customersuggest->suggestMail($mailcontact['customer_id']);
        //for Customer Name
        $name = new T_CU_Customer();
        $customername = $name->suggestmailnickname($mailcontact['customer_id']);
        $mail2 = [
            'title' => 'food labs',
            'reply' => $mailcontact['reply'],
            'name' => $customername['nickname'],
            'cusmessage' => $mailcontact['message'],
        ];
        Mail::to($sugmail)->send(new ContactMail($mail2));

        Log::channel('adminlog')->info("NotificationController", [
            'End contrpy'
        ]);

        return redirect('customerContact');
    }

    /*
   * Create:Zar Ni(2022/01/22) 
   * Update: 
   * This function is Show data of Customer Report List.
   * view('admin.report.customerreport')
   */
    public function customerReport()
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customerReport'
        ]);

        $cusreport = new T_AD_Report();
        $report = $cusreport->customerReportlist();
        $rpcount = $cusreport->reportCount();

        $cussuggest = new T_AD_Suggest();
        $sugcount = $cussuggest->suggestcount();

        $cuscontact = new T_AD_Contact();
        $conCount = $cuscontact->contactCount();

        Log::channel('adminlog')->info("NotificationController", [
            'End customerReport'
        ]);

        return view('admin.report.customerreport', ['report' => $report, 'rpcount' => $rpcount, 'sugcount' => $sugcount, 'concount' => $conCount]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is for Reply Customer Report.
   * view('admin.report.reportreply')
   */
    public function customerreportReply(Request $request)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start customerreportReply'
        ]);

        $rpreport = new T_AD_Report();
        $reply = $rpreport->cusreportReply($request->input('id'));

        Log::channel('adminlog')->info("NotificationController", [
            'End customerreportReply'
        ]);

        return view('admin.report.reportreply', ['reply' => $reply]);
    }

    /*
   * Create:Zar Ni(2022/01/25) 
   * Update: 
   * This function is reply to customer and send email.
   * return view :redirect('customerReport')
   */
    public function reportRp(Request $request, $id)
    {

        Log::channel('adminlog')->info("NotificationController", [
            'Start reportRp'
        ]);

        $replyrp = new T_AD_Report();
        $rpdata = $request->input('reply');
        $rep = $replyrp->repRpy($id, $rpdata);
        //For Email
        $customeremail = new M_CU_Customer_Login();
        $mailreport = $replyrp->customerreportMail($id);

        $email = $customeremail->suggestMail($mailreport['customer_id']);
        //for customername
        $name = new T_CU_Customer();
        $customernamerp = $name->suggestmailnickname($mailreport['customer_id']);
        $mail1 = [
            'title' => 'food labs',
            'name' => $customernamerp['nickname'],
            'reply' => $mailreport['reply'],
            'cusmessage' => $mailreport['message'],
        ];
        Mail::to($email)->send(new ReportMail($mail1));

        Log::channel('adminlog')->info("NotificationController", [
            'End reportRp'
        ]);

        return redirect('customerReport');
    }
    /*
   * Create:zayar(2022/04/16) 
   * Update: 
   * This function is to doenload csv file
   * return view :redirect('customerReport')
   */
    public function   downloadCsvFile(Request $request)
    {
        // some data to be used in the csv files
        $customerDatasColumn = array('id', 'customerID', 'bio', 'nickname', 'phone', 'address1', 'address2', 'address3', 'login_by_facebook', 'login_by_gmail', 'dob', 'gender', 'fav_type', 'taste', 'allergic', 'del_flg', 'created_at', 'updated_at');
        $customerDatas = T_CU_Customer::all();
        $customerDatasArrays = $customerDatas->toArray();

        $customerCoinDatasColumn = array('id', 'customer_id', 'remain_coin', 'del_flg', 'created_at', 'updated_at');
        $customerCoinDatas = T_CU_Coin_Customer::all();
        $customerCoinDatasArrays = $customerCoinDatas->toArray();

        $customerLoginDatasColumn = array('id', 'email', 'password', 'verify', 'verify_code', 'customer_id ', 'last_login_time',  'del_flg', 'created_at', 'updated_at');
        $customerLoginDatas = M_CU_Customer_Login::all();
        $customerLoginDatasArrays = $customerLoginDatas->toArray();

        $productDatasColumn = array('id', 'product_name', 'product_type', 'product_taste', 'coin', 'amount ', 'list', 'description', 'avaliable', 'del_flg', 'created_at', 'updated_at');
        $productDatas = M_Product::all();
        $productDatasArrays = $productDatas->toArray();

        $productDetailDatasColumn = array('id', 'product_id', 'category', 'label', 'order', 'value ', 'del_flg', 'created_at', 'updated_at');
        $productDetailDatas = M_Product_Detail::all();
        $productDetailDatasArrays = $productDetailDatas->toArray();

        $adminLoginDatasColumn = array('id', 'ad_name', 'ad_password', 'ad_role', 'ad_valid',  'ad_login_dt', 'del_flg', 'created_at', 'updated_at');
        $adminLoginDatas = M_AD_Login::all();
        $adminLoginDatasArrays = $adminLoginDatas->toArray();

        $coinChargeDatasColumn = array('id', 'customer_id ', 'request_coin', 'request_evd_ID ', 'request_datetime', 'decision_status', 're_decision', 'decision_by', 'del_flg', 'created_at', 'updated_at');
        $coinChargeDatas = T_AD_CoinCharge::all();
        $coinChargeDatasArrays = $coinChargeDatas->toArray();

        $coinChargeFinanceDatasColumn = array('id', 'charge_id', 'payment_type', 'amount', 'del_flg', 'created_at', 'updated_at');
        $coinChargeFinanceDatas = T_AD_CoinCharge_Finance::all();
        $coinChargeFinanceDatasArrays = $coinChargeFinanceDatas->toArray();

        $contactDatasColumn = array('id', 'message', 'reply', 'customer_id', 'del_flg', 'created_at', 'updated_at');
        $contactDatas = T_AD_Contact::all();
        $contactDatasArrays = $contactDatas->toArray();

        $orderDatasColumn = array('id', 'customer_id ', 'payment', 'township_id', 'ph_number', 'grandtotal_coin ', 'grandtotal_cash', 'order_status', 'order_date', 'order_time ', 'last_control_by ', 'del_flg', 'created_at', 'updated_at');
        $orderDatas = T_AD_Order::all();
        $orderDatasArrays = $orderDatas->toArray();

        $orderDetailDatasColumn = array('id', 'order_id', 'product_id', 'quantity', 'total_coin', 'total_cash', 'note', 'del_flg', 'created_at', 'updated_at');
        $orderDetailDatas = T_AD_OrderDetail::all();
        $orderDetailDatasArrays = $orderDetailDatas->toArray();

        $reportDatasColumn = array('id', 'order_id', 'product_id', 'quantity', 'total_coin', 'total_cash', 'note', 'del_flg', 'created_at', 'updated_at');
        $reportDatas = T_AD_Report::all();
        $reportDatasArrays = $reportDatas->toArray();

        $suggestDatasColumn = array('id', 'suggest_type', 'message', 'reply', 'customer_id',  'del_flg', 'created_at', 'updated_at');
        $suggestDatas = T_AD_Suggest::all();
        $suggestDatasArrays = $suggestDatas->toArray();
        // create your zip file
        $zipname = 'foodlab_Confidential.zip';
        $zip = new ZipArchive;
        $zip->open($zipname, ZipArchive::CREATE);

        $filename = "";
        // loop to create 3 csv files
        for ($i = 0; $i <= 12; $i++) {

            // create a temporary file
            $fd = fopen('php://temp/maxmemory:1048576', 'w');
            if (false === $fd) {
                die('Failed to create temporary file');
            }

            // write the data to csv
            if ($i == 0) {
                fputcsv($fd, $customerDatasColumn);
                foreach ($customerDatasArrays as $customerDatasArray) {
                    fputcsv($fd, $customerDatasArray);
                }
                $filename = "Customer Datas";
            }
            if ($i == 1) {
                fputcsv($fd, $customerCoinDatasColumn);
                foreach ($customerCoinDatasArrays as $customerCoinDatasArray) {
                    fputcsv($fd, $customerCoinDatasArray);
                }
                $filename = "Customer Coin Datas";
            }
            if ($i == 2) {
                fputcsv($fd, $customerLoginDatasColumn);
                foreach ($customerLoginDatasArrays as $customerLoginDatasArray) {
                    fputcsv($fd, $customerLoginDatasArray);
                }
                $filename = "Customer Login Datas";
            }
            if ($i == 3) {
                fputcsv($fd, $productDatasColumn);
                foreach ($productDatasArrays as $productDatasArray) {
                    fputcsv($fd, $productDatasArray);
                }
                $filename = "Products Datas";
            }
            if ($i == 4) {
                fputcsv($fd, $productDetailDatasColumn);
                foreach ($productDetailDatasArrays as $productDetailDatasArray) {
                    fputcsv($fd, $productDetailDatasArray);
                }
                $filename = "Products Detail Datas";
            }
            if ($i == 5) {
                fputcsv($fd, $adminLoginDatasColumn);
                foreach ($adminLoginDatasArrays as $adminLoginDatasArray) {
                    fputcsv($fd, $adminLoginDatasArray);
                }
                $filename = "Admin Login Datas";
            }
            if ($i == 6) {
                fputcsv($fd, $coinChargeDatasColumn);
                foreach ($coinChargeDatasArrays as $coinChargeDatasArray) {
                    fputcsv($fd, $coinChargeDatasArray);
                }
                $filename = "Coin Charge Datas";
            }
            if ($i == 7) {
                fputcsv($fd, $coinChargeFinanceDatasColumn);
                foreach ($coinChargeFinanceDatasArrays as $coinChargeFinanceDatasArray) {
                    fputcsv($fd, $coinChargeFinanceDatasArray);
                }
                $filename = "Coin Charge Finance Datas";
            }

            if ($i == 8) {
                fputcsv($fd, $contactDatasColumn);
                foreach ($contactDatasArrays as $contactDatasArray) {
                    fputcsv($fd, $contactDatasArray);
                }
                $filename = "Contact Datas";
            }
            if ($i == 9) {
                fputcsv($fd, $orderDatasColumn);
                foreach ($orderDatasArrays as $orderDatasArray) {
                    fputcsv($fd, $orderDatasArray);
                }
                $filename = "Order Datas";
            }
            if ($i == 10) {
                fputcsv($fd, $orderDetailDatasColumn);
                foreach ($orderDetailDatasArrays as $orderDetailDatasArray) {
                    fputcsv($fd, $orderDetailDatasArray);
                }
                $filename = "Order Detail Datas";
            }
            if ($i == 11) {
                fputcsv($fd, $reportDatasColumn);
                foreach ($reportDatasArrays as $reportDatasArrays) {
                    fputcsv($fd, $reportDatasArrays);
                }
                $filename = "Report Datas";
            }
            if ($i == 12) {
                fputcsv($fd, $suggestDatasColumn);
                foreach ($suggestDatasArrays as $suggestDatasArrays) {
                    fputcsv($fd, $suggestDatasArrays);
                }
                $filename = "Suggest Datas";
            }
            // return to the start of the stream
            rewind($fd);

            // add the in-memory file to the archive, giving a name
            $zip->addFromString($filename . '.csv', stream_get_contents($fd));
            //close the file
            fclose($fd);
        }
        // close the archive
        $zip->close();


        header('Content-Type: application/zip');
        header('Content-disposition: attachment; filename=' . $zipname);
        header('Content-Length: ' . filesize($zipname));
        readfile($zipname);

        // remove the zip archive
        // you could also use the temp file method above for this.
        unlink($zipname);
        // $fileName1 = 'customerData.csv';
        // $customerDatas = T_CU_Customer::all();

        // $headers1 = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName1",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );
        // $columns1 = array(
        //     'id', 'customerID', 'bio', 'nickname', 'phone', 'address1', 'address2', 'address3', 'login_by_facebook', 'login_by_gmail', 'dob', 'gender', 'fav_type', 'taste', 'allergic', 'del_flg', 'created_at', 'updated_at'
        // );

        // $callback1 = function () use ($customerDatas, $columns1) {
        //     $file1 = fopen('php://output', 'w');
        //     fputcsv($file1, $columns1);

        //     foreach ($customerDatas as $customerData) {
        //         $row['id']  = $customerData->id;
        //         $row['customerID']    = $customerData->customerID;
        //         $row['bio']    = $customerData->bio;
        //         $row['nickname']  = $customerData->nickname;
        //         $row['phone']  =  $customerData->phone;
        //         // $phoneArray = explode("'", $row['phone']);
        //         $row['address1']  = $customerData->address1;
        //         $row['address2']    = $customerData->address2;
        //         $row['address3']    = $customerData->address3;
        //         $row['login_by_facebook']  = $customerData->login_by_facebook;
        //         $row['login_by_gmail']  = $customerData->login_by_gmail;
        //         $row['dob']  = $customerData->dob;
        //         $row['gender']    = $customerData->gender;
        //         $row['fav_type']    = $customerData->fav_type;
        //         $row['taste']  = $customerData->taste;
        //         $row['allergic']  = $customerData->allergic;
        //         $row['del_flg']    = $customerData->del_flg;
        //         $row['created_at']  = $customerData->created_at;
        //         $row['updated_at']  = $customerData->updated_at;

        //         fputcsv($file1, array($row['id'], $row['customerID'], $row['bio'], $row['nickname'], $row['phone'], $row['address1'], $row['address2'], $row['address3'], $row['login_by_facebook'], $row['login_by_gmail'], $row['dob'], $row['gender'], $row['fav_type'], $row['taste'], $row['allergic'], $row['del_flg'], $row['created_at'], $row['updated_at']));
        //     }

        //     fclose($file1);
        // };
        // return response()->streamDownload($callback1, "customerData.csv", $headers1);
        //customer download complete
        // $fileName2 = 'customerCoinDatas.csv';
        // $customerCoinDatas = T_CU_Coin_Customer::all();

        // $headers2 = array(
        //     "Content-type"        => "text/csv",
        //     "Content-Disposition" => "attachment; filename=$fileName2",
        //     "Pragma"              => "no-cache",
        //     "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
        //     "Expires"             => "0"
        // );
        // $columns2 = array(
        //     'id', 'customer_id', 'remain_coin', 'del_flg', 'created_at', 'updated_at'
        // );

        // $callback2 = function () use ($customerCoinDatas, $columns2) {
        //     $file2 = fopen('php://output', 'w');
        //     fputcsv($file2, $columns2);

        //     foreach ($customerCoinDatas as $customerCoinData) {
        //         $row['id']  = $customerCoinData->id;
        //         $row['customer_id']    = $customerCoinData->customer_id;
        //         $row['remain_coin']    = $customerCoinData->remain_coin;
        //         $row['del_flg']  = $customerCoinData->del_flg;
        //         $row['created_at']  = $customerCoinData->created_at;
        //         $row['updated_at']  = $customerCoinData->updated_at;

        //         fputcsv($file2, array($row['id'], $row['customer_id'], $row['remain_coin'], $row['del_flg'], $row['created_at'], $row['updated_at']));
        //     }

        //     fclose($file2);
        // };

    }
}
