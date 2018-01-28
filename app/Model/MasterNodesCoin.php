<?php

namespace App\Model;

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

    public static function update_node($coinid, $cid, $cname, $csym, $capi, $cweb)
    {
        return Static::where('id', $coinid) -> update(['coin_id' => $cid,'coin_name' => $cname, 'coin_symbol' => $csym, 'coin_api' => $capi , 'website_url' => $cweb]);
    }

    public static function delete_node($id)
    {
        return Static::where('id', $id)->delete();
    }
  
    static function registermnode($icon, $name, $symbol, $api, $weburl)
    {
      DB::table('masternode_coin')->insert(
      ['icon_url'=>$icon,'coin_name' => $name, 'coin_symbol'=>$symbol,'coin_api'=>$api,'website_url'=>$weburl]
      );
      return 'true';
    }
  
    static function registerapplicant($name, $symbol,$requirecoin,$api,$weburl,$iconurl,$api1,$api2,$staus = 0)
    {
      DB::table('applicants')->insert(
      ['coin_name' => $name, 'coin_symbol'=>$symbol,'coin_api'=>$api,'website_url'=>$weburl,'icon_url'=>$iconurl,'required_coin'=>$requirecoin,'api1'=>$api1,'api2'=>$api2, 'status' =>0]
      );
      return 'true';
    }

    public static function registervote($user, $coin)
    {
      DB::table('vote_history')->insert([
      'user_id' => $user, 'coin_id' =>$coin  
      ]);
      return 'true';
    }
  
    public static function removevote($id)
    {
      DB::table('vote_history')->where('id', '='  ,$id)->delete();
      return 'true';
    }
  
    public static function updatevotenum($coinid, $num)
    {
      DB::table('vote')->where('id', $coinid)->update(['votes'=>$num]);
    }
  
    public static function addvotecoin($iconUrl,$coinname,$coinsymbol)
    {
      DB::table('vote')->insert([
        'icon_url' => $iconUrl, 'coin'=>$coinname, 'coin_symbol'=> $coinsymbol, 'votes' => 0
      ]);
    }
  
    public static function getvotebyuserID($user, $coin)
    {
      $return = DB::table('vote_history')->select('*')
               ->where('user_id', $user)
               ->where('coin_id', $coin)
               ->first();
      return $return;
    }
  
    public static function getsymbol()
    {
      $return  = DB::table('masternode_coin')->select('coin_symbol')->get();
      $symbolarr = [];
      $index = 0;
      foreach($return as $item)
      {
        $symbolarr[$index] = $item->coin_symbol;
        $index++;
      }
      return $symbolarr;
    }
  
    public static function updateapplicant($coinid)
    {
      DB::table('applicants')->where('id',$coinid)->update(['status'=>1]);
    }
  
    public static function updatepreview($coinID,$coinname,$coinsymbol,$coinapi,$coinurl,$coinicon,$coinpriapi,$coinpripara,$coinmnapi,$coinmnpara,$coinrequire,$coinnw,$coinsupapi,$coinsuppara,$coinchapi,$coinchpara,$coinvolapi,$coinvolpara,$coinroiapi,$coinroipara,$coinapi1,$coinapi2)
    {
      $return = DB::table('applicants')->where('id',$coinID)->update([
                'coin_name'=>$coinname, 'coin_symbol'=>$coinsymbol,'coin_api'=>$coinapi,'website_url'=>$coinurl,'icon_url'=>$coinicon,'price_api'=>$coinpriapi,'price_para'=>$coinpripara,'mn_api'=>$coinmnapi,'mn_para'=>$coinmnpara,'required_coin'=>$coinrequire,'node_worth'=>$coinnw,'supply_api'=>$coinsupapi,'supply_para'=>$coinsuppara,'change_api'=>$coinchapi,'change_para'=>$coinchpara,'volume_api'=>$coinvolapi,'volume_para'=>$coinvolpara,'roi_api'=>$coinroiapi,'roi_para'=>$coinroipara,'api1'=>$coinapi1,'api2'=>$coinapi2
      ]);
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