<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Model;

class MasterNodesCoin extends Model
{
    protected $table = 'masternode_coin';
    protected $fillable = [
        'coin_id', 'coin_name', 'coin_symbol','register_date', 'update_date'
    ];
    public $timestamps = false;
    
    static function getCoinList()
    {
        $return = Static::get();
        return $return;
    }
    // static function getExpireDate($account_id, $reportId)
    // {
    //     $return = DB::table('account_subscription as sub')->select('expires_at')->where('account_id', $account_id)->where('report_id', $reportId)->first();
        
    //     return $return->expires_at;
    // }

    // static function getSubscription($type = NULL, $account_id = NULL, $report_id = NULL)
    // {
    //     $where = ' ';
    //     $date = date('Y-m-d m-i-s');

    //     if($account_id)
    //     {
    //         $where .="account_id = ".$account_id.' AND ';
    //     }
    //     if($report_id)
    //     {
    //         $where .="report_id = ".$report_id.' AND ';
    //     }
    //     if($type == 'live')
    //     {
    //         $where .='expires_at >= "'.$date.'" AND ';
    //     }
    //     elseif($type == 'expire')
    //     {
    //         $where .='expires_at < "'.$date.'" AND ';
    //     }
    //     $where .= '1=1 ';

    //     $return = DB::table('account_subscription as ass')
    //     ->select('ass.id', 'ass.report_id','ass.account_id','accounts.business_title', 'accounts.description as account_description', 'reports.name as report_name','reports.description as report_description', 'reports.report_type','accounts.account_type','ass.expires_at')
    //     ->join('reports','reports.id','=','ass.report_id')
    //     ->join('accounts','accounts.id','=','ass.account_id')
    //     ->where('ass.is_active',1)
    //     ->whereRaw($where)
    //     ->orderby('ass.id', 'DESC')
    //     ->get();

    //     return $return;
    // }

    // static function getSubscriberByReportId($reportId)
    // {
    //     // $return = DB::table('account_subscription as sub')
    //     //             ->select('sub.account_id','sub.report_id','sub.expires_at',DB::raw('(select id from users where users.user_type = 2 and users.account_id = accounts.id) as user_id'),DB::raw('(select name from users where users.user_type = 2 and users.account_id = accounts.id) as user_name'),DB::raw('(select email from users where users.user_type = 2 and users.account_id = accounts.id) as user_email'))
    //     //             ->join('accounts','accounts.id','=','sub.account_id')
    //     //             ->where('is_active', 1)
    //     //             ->where('report_id',$reportId)
    //     //             ->get();

    //     $return = DB::table('account_subscription as sub')
    //                 ->select('sub.account_id','sub.report_id','sub.expires_at','accounts.business_title')
    //                 ->join('accounts','accounts.id','=','sub.account_id')
    //                 ->where('is_active', 1)
    //                 ->where('report_id',$reportId)
    //                 ->orderby('sub.id','asc')
    //                 ->get();

    //     return $return;
    // }
}