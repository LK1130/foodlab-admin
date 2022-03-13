<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\ContactMail;
use App\Mail\ReportMail;
use App\Mail\SuggestMail;
use App\Models\M_CU_Customer_Login;
use App\Models\T_AD_Contact;
use App\Models\T_AD_Report;
use App\Models\T_AD_Suggest;
use App\Models\T_CU_Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
}
