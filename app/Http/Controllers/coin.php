<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blocks;
use Validator, Input, Redirect, View, Auth;
use App\Mnl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\elasticSearch;
use App\Model\MasterNodesCoin;
use Illuminate\Support\Facades\DB;

require_once dirname(__FILE__).'/simple_html_dom.php';
class coin extends Controller
{
    public static $sort = 'roi';

    public function index()
    {
        $data = $this->getcoininfolist('USD');
        return view('main.welcome')->with('coinList', $data);
    }
  
    
    public function indexBTC()
    {
        $data = $this->getcoininfolist('BTC');
        return view('main.welcome')->with('coinList',$data);
    }
  
    public function indexUSD()
    {
        $data = $this->getcoininfolist('USD');

        return view('main.welcome')->with('coinList',$data);
    }
  
    public function vote()
    {
        $data = $this->getcoininfolist('USD');
        $vote_coin = DB::table('vote')
                      ->orderby('votes', 'DESC')
                      ->get();
        $id = \Auth::user()->id;
        $checkvote = DB::table('vote_history')
                      ->where('user_id',$id)
                      ->get();
        $indexcheck = 0;
        if(count($checkvote) >0)
        {
            foreach ($checkvote as $vote)
            {
              $check_vote[$indexcheck] = $vote->coin_id;
              $indexcheck++;
            }
            $index = 0;
            foreach ($vote_coin as $votecoin)
            {
              $coin_vote[$index]['coinID'] = $votecoin->id;
              $coin_vote[$index]['url'] = $votecoin->icon_url;
              $coin_vote[$index]['coin'] = $votecoin->coin;
              $coin_vote[$index]['sysmbol'] = $votecoin->coin_symbol;
              $coin_vote[$index]['votes'] = $votecoin->votes;
              $index++;

            }
            return view('main.vote')->with(array('votecoinList'=> $coin_vote, 'checked_vote'=>$check_vote,'coinList'=> $data));
        }else{
            $index = 0;
            foreach ($vote_coin as $votecoin)
            {
              $coin_vote[$index]['coinID'] = $votecoin->id;
              $coin_vote[$index]['url'] = $votecoin->icon_url;
              $coin_vote[$index]['coin'] = $votecoin->coin;
              $coin_vote[$index]['sysmbol'] = $votecoin->coin_symbol;
              $coin_vote[$index]['votes'] = $votecoin->votes;
              $index++;

            }
            return view('main.vote')->with(array('votecoinList'=> $coin_vote,'coinList'=> $data));
        }
        
    }
    
    public function addvote(request $request)
    {
        $userID = $request->userID;
        $coinID = $request->coinID;
        $num = $request->vote;
        $valid = MasterNodesCoin::getvotebyuserID($userID, $coinID);
        if(count($valid) >0 ){
          echo json_encode(array('response'=>'false'));  
        } else {
          $return = MasterNodesCoin::registervote($userID, $coinID);
          MasterNodesCoin::updatevotenum($coinID,$num);
          echo json_encode(array('response'=>'true'));
        }
    }
  
     public function removevote(request $request)
     {
        $userID = $request->userID;
        $coinID = $request->coinID;
        $num = $request->vote;
        $valid = MasterNodesCoin::getvotebyuserID($userID, $coinID);
        $ID = $valid->id;
        if(count($valid) >0 ){
          $return = MasterNodesCoin::removevote($ID);
          MasterNodesCoin::updatevotenum($coinID,$num);
          echo json_encode(array('response'=>'true'));  
        } else {
          echo json_encode(array('response'=>'false'));
        }
     }
  
  
    public function registernode(request $request)
    {   
        $coin = $request->name;
        $detail = $request->detail;
//         $new_api_vol = $request->new_api_vol;
//         $new_api_market = $request->new_api_market;
//         $new_api_tnode = $request->new_api_tnode;
        $new_recoin = $request->new_require_coin;
        $new_api_nw = $request->new_api_nw;
        $new_web = $request->new_web;
        $new_web_icon = $request->new_web_icon;
        $new_api1 = $request->new_api1;
        $new_api2 = $request->new_api2;
        
      
        //$EmailTo = "cooleric826@outlook.com";
        $EmailTo = "masternodesjungle@gmail.com";
        $Body = '<br><div style="width: 100%; max-width: 800px; margin: 0 auto;">';
        $headers = "From: Masternodesjungle <portal@masternodesjungle.com>\r\n";
        $headers .= "Reply-To: <" . $EmailTo . ">\r\n";
        $headers .= "BCC: lee@hallenmedia.net\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $headers .= "X-Priority: 1 (Highest)\r\n";
        $headers .= "X-MSMail-Priority: High\r\n";
        $headers .= "Importance: High\r\n";
        
        $Subject = "New Regsiter MasterNode From Masternodejungle.com";
        $Body .= "<h3><strong>Coin name:   </strong>". $coin . '</h3><br><h3><strong>Symbol:   </strong>'. $detail;//."</h3><br><h3>     
        $Body .= "<h3><strong>Coin Api:   </strong>". $new_api_nw."</h3><br><h3><strong>Website Url:   </strong>". $new_web ."</h3><br><h3><strong>Coin Icon Url:   </strong>". $new_web_icon;
        $Body .= "<h3><strong>Api1:   </strong>". $new_api1 . "</h3><br><h3><strong>NApi2:   </strong>". $new_api2;
        $success = mail($EmailTo, $Subject, $Body, $headers);
        $vali_coin = DB::table('masternode_coin')
                      ->where('coin_name', $coin)
                      ->get();
        if(count($vali_coin) >0){
          echo json_encode(false);
          
        }else{
          $return = MasterNodesCoin::registerapplicant($coin,$detail,$new_recoin,$new_api_nw,$new_web,$new_web_icon,$new_api1,$new_api2,0);
          echo json_encode(true);
          //return view('main.layout.activeComingSoonList')->with('addCoin', $addcoin);
        }
        
    }
  
//     public function griddetail(request $request){
//       $coinname = $request->coinname;
//       $pos_sta = strpos($coinname, '(', 1);
//       $pos_end = strpos($coinname, ')', 1);
//       $new_symbol = substr($coinname,$pos_sta+1,$pos_end-$pos_sta-1);
//       $url = 'https://masternodes.online/currencies/' . $new_symbol;
//       $html = file_get_html($url);
           
//       $title = array();
//       $info = array();
//       for($i = 0;$i<4; $i++)
//       {
//         $title[$i] = $html->find('h3.panel-title',$i)->innertext();
//         $info[$i] = $html->find('.bs-component .panel-body',$i)->innertext();
//       }
      
//       echo json_encode(array('title'=>$title, 'info'=>$info));
      
//     }
  
    public function detailinfo(request $request)
    {
      $det_url = $request->detail_url;
      $url = 'https://masternodes.online/currencies/' . $det_url;
      $html = file_get_html($url);
           
      $title = array();
      $info = array();
      for($i = 0;$i<4; $i++)
      {
        $title[$i] = $html->find('h3.panel-title',$i)->innertext();
        $info[$i] = $html->find('.bs-component .panel-body',$i)->innertext();
      }
      
      $table = $html->find('table.table.table-striped',0)->innertext();
      $pos_sta = strpos($table, '<td>ROI (annual):</td>', 1);
      $pos_end = strpos($table, '<td>Paid', 1);
      $detailcoin = substr($table,$pos_sta+23,50);
      $pos_sta1 = strpos($detailcoin, '<td>', 1);
      $pos_end1 = strpos($detailcoin, 'days</td>', 1);
      $detailcoin1 = substr($detailcoin,$pos_sta1+4,$pos_end1-$pos_sta1);
      echo json_encode(array('title'=>$title, 'info'=>$info, 'roi_det'=>$detailcoin1));
    }
  
    public function readmore(request $request)
    {
      $data = $this->getcoininfolist('USD', 2);
    
      echo json_encode(array('detailinfo'=> $data));
      
    }
  
    private function getcoininfolist($sele, $morenumber = 1)
    {   

        $registered_masternodes_symbol = MasterNodesCoin::getsymbol();
        
        $html = file_get_html('https://masternodes.online/');
      
        $coinList[0]['total_node'] = $html->find('#banner.col-lg-9>strong', 0)->innertext();
        $coinList[0]['total_online'] = $html->find('#banner.col-lg-9>strong', 1)->innertext();
        $coinList[0]['total_wrth_usd'] = $html->find('#banner.col-lg-9>strong', 2)->innertext();
        $coinList[0]['total_wrth_btc'] = $html->find('#banner.col-lg-9>strong', 3)->innertext();
        $coinList[0]['total_vol_usd'] = $html->find('#banner.col-lg-9>strong', 4)->innertext();
        $coinList[0]['total_vol_btc'] = $html->find('#banner.col-lg-9>strong', 5)->innertext();
        $coinList[0]['total_mcp_usd'] = $html->find('#banner.col-lg-9>strong', 6)->innertext();
        $coinList[0]['total_mcp_btc'] = $html->find('#banner.col-lg-9>strong', 7)->innertext();
        $coinList[0]['usd_btc'] = $html->find('#banner.col-lg-9>strong', 8)->innertext();
        $total_number = (float)($html->find('#banner.col-lg-9>strong', 0)->innertext());
      
        $i = 1;
        $index = 1;

        do {
            $row = $html->find('#masternodes_table>tbody>tr', $i);
            $title = $row->find('a', 0)->innertext();
            $pos_sta = strpos($title, '(', 1);
            $pos_end = strpos($title, ')', 1);
            $new_symbol = substr($title,$pos_sta+1,$pos_end-$pos_sta-1);
            if(in_array($new_symbol, $registered_masternodes_symbol)){
              $coinList[$index-1]['title'] = $row->find('a', 0)->innertext();
              $coinList[$index-1]['url'] = 'https://masternodes.online/';
              $coinList[$index-1]['url'] .=$row->find('img', 0)->attr["src"];
              if($sele == 'USD'){
                $coinList[$index-1]['price_usd'] = '$'.$row->find('span',0)->attr["title"];
                $coinList[0]['trans_cur'] = 'USD';
              }else {
                $coinList[$index-1]['price_usd'] = number_format((float)($row->find('span',0)->attr["title"])/(str_replace(',','',(ltrim($coinList[0]['usd_btc'], '$')))), 7, '.', '').'BTC';
                $coinList[0]['trans_cur'] = 'BTC';
              }
              $coinList[$index-1]['change'] = $row->find('span',1)->innertext();
              $coinList[$index-1]['volume'] = number_format((float)($row->find('span',2)->attr["title"]));
              $coinList[$index-1]['marketcap'] = number_format((float)($row->find('span',3)->attr["title"]));
              $coinList[$index-1]['roi'] = $row->find('strong>span.text-info',0)->attr["title"];
              $coinList[$index-1]['nodes'] = number_format((float)($row->find('span',5)->attr["title"]));
              $coinList[$index-1]['require'] = number_format((float)($row->find('span',6)->attr["title"]));
              $coinList[$index-1]['mnworth'] = number_format((float)($row->find('span',7)->attr["title"]));
              if($morenumber == 1){
                  if($index < 7){
                    $urlinfo = 'https://masternodes.online/currencies/' . $new_symbol;
                    $htmlinfo = file_get_html($urlinfo);

                     for($j = 0;$j<4; $j++)
                     {
                       $gridinfo = 'gridinfo'.$j;
                       $coinList[$index-1][$gridinfo] = $htmlinfo->find('.bs-component .panel-body',$j)->innertext();
                     }
                  }else{
                    for($j = 0;$j<4; $j++)
                     {
                       $gridinfo = 'gridinfo'.$j;
                       $coinList[$index-1][$gridinfo] = '';
                     }
                  }
              }else{
                  $urlinfo = 'https://masternodes.online/currencies/' . $new_symbol;
                  $htmlinfo = file_get_html($urlinfo);

                   for($j = 0;$j<4; $j++)
                   {
                     $gridinfo = 'gridinfo'.$j;
                     $coinList[$index-1][$gridinfo] = $htmlinfo->find('.bs-component .panel-body',$j)->innertext();
                   }
              }
              $index++;
            }
          $i++;
        } while ($i <= $total_number);  
        $appli_coin = DB::table('applicants')
          ->where('status', 1)
          ->get();

        foreach ($appli_coin as $coinitem)
        {
          $coinList[$index-1]['title'] = $coinitem->coin_name.'('.$coinitem->coin_symbol.')';
          $coinList[$index-1]['url'] = $coinitem->icon_url;
          if($sele == 'USD'){
            $json = $this->_getCryptoInfo($coinitem->price_api);
            $para = $coinitem->price_para;
            $validation = count($json);
            if($validation >0){
              if(!$json[0]){
                $coinList[$index-1]['price_usd'] = '?';
              }else{
                $coinList[$index-1]['price_usd'] = $json[0][$para];
              }
            }
            $coinList[0]['trans_cur'] = 'USD';
          }else {
            $json = $this->_getCryptoInfo($coinitem->price_api);
            $validation = count($json);
            $coinList[$index-1]['price_usd'] = (float)($json[0][$para])/((float)($coinList[0]['usd_btc']));
            $coinList[0]['trans_cur'] = 'BTC';
          }
          
          $json = $this->_getCryptoInfo($coinitem->mn_api);
          if($coinitem->mn_para){
            $para = $coinitem->mn_para;
            if($json[0][$para]){
              $coinList[$index-1]['nodes'] = $json[0][$para];
            }else{
              $coinList[$index-1]['nodes'] = '?';
            }
          }else{
            $coinList[$index-1]['nodes'] = '?';
          }
          
          
          $json = $this->_getCryptoInfo($coinitem->change_api);
          if($coinitem->change_para){
            $para = $coinitem->change_para;
            if($json[0][$para]){
              $coinList[$index-1]['change'] = $json[0][$para].'%';
            }else{
              $coinList[$index-1]['change'] = '?';
            }
          }else{
            $coinList[$index-1]['change'] = '?';
          }
          
          $json = $this->_getCryptoInfo($coinitem->volume_api);
          if($coinitem->volume_para){
            $para = $coinitem->volume_para;
            if($json[0][$para]){
              $coinList[$index-1]['volume'] = $json[0][$para];
            }else{
              $coinList[$index-1]['volume'] = '?';
            }
          }else{
            $coinList[$index-1]['volume'] = '?';
          }
          
          $json = $this->_getCryptoInfo($coinitem->supply_api);
          if($coinitem->supply_para){
            $para = $coinitem->supply_para;
            if($json[0][$para]){
              $coinList[$index-1]['marketcap'] = number_format(intval((float)$json[0][$para] * (float)($coinList[$index-1]['price_usd'])));
            }else{
              $coinList[$index-1]['marketcap'] = '?';
            }
          }else{
            $coinList[$index-1]['marketcap'] = '?';
          }
          
          $coinList[$index-1]['require'] = $coinitem->required_coin;
          
          $coinList[$index-1]['roi'] = '?';
          $coinList[$index-1]['mnworth'] = number_format(intval((float)($coinitem->required_coin)*(float)($coinList[$index-1]['price_usd'])));
          $index++;
        }
        $bannerinfo = DB::table('banner')->get();
        $coinList[0]['banner_url'] = $bannerinfo[0]->banner_url;
        $coinList[0]['banner_link'] = $bannerinfo[0]->banner_link;
        $coinList[0]['footer_url'] = $bannerinfo[0]->footer_url;
        $coinList[0]['footer_link'] = $bannerinfo[0]->footer_link;
        
        return $coinList;
      
    }
  
    private function generateData()
    {
        // get masternode coin list from db
        $coinList = MasterNodesCoin::getCoinList();
        $coins = '';
        foreach ($coinList as $coin) {
            $coins .= $coin['coin_symbol'] . ',';
        }

        $url_marketcap = "https://api.coinmarketcap.com/v1/ticker/?start=0&limit=2000";

        $json = $this->_getCryptoInfo($url_marketcap);
        //var_dump($json);exit;
        $detail_marketcap = array();
        foreach ($json as $detail) {
            $detail_marketcap[$detail['symbol']] = $detail;
        }
        
        $url_cryptocompare = "https://min-api.cryptocompare.com/data/pricemultifull?fsyms=%s&tsyms=USD";
        $detail_cryptocompare = $this->_getCryptoInfo(sprintf($url_cryptocompare, $coins));

        // get full list of coins
        $url_cryptocompare_full = "https://www.cryptocompare.com/api/data/coinlist/";
        $full_list = $this->_getCryptoInfo($url_cryptocompare_full);

        $coinDetail = array();

        foreach ($coinList as $coin) 
        {
            $symbol = $coin['coin_symbol'];
            $coinDetail[$symbol] = array();
            if (array_key_exists($symbol, $detail_marketcap))
                $coinDetail[$symbol] += $detail_marketcap[$symbol];
            if (array_key_exists($symbol, $detail_cryptocompare['RAW']))
                $coinDetail[$symbol] += $detail_cryptocompare['RAW'][$symbol]['USD'];
            if (array_key_exists($symbol, $detail_cryptocompare['DISPLAY']))
                $coinDetail[$symbol]['DISPLAY'] = $detail_cryptocompare['DISPLAY'][$symbol]['USD'];
            if (array_key_exists($symbol, $full_list['Data']))
                $coinDetail[$symbol]['ImageUrl'] = $full_list['BaseImageUrl'] . $full_list['Data'][$symbol]['ImageUrl'];
        }

        return $coinDetail;
    }

    private function _getCryptoInfo($url) 
    {
        $curl = curl_init();

        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_TIMEOUT, 30);
        curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("cache-control: no-cache"));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return json_decode($response, TRUE);
    }

    private function coinLockedPercent($total, $supply)
    {
        $return = 0;
        if ($total > 0) {
            if ($supply > 0) {
                $return = $total / $supply * 100;
            }
        }
        return $return;
    }

    public function sortActiveView()
    {
        $data = $this->generateData();
        $type = isset($_GET['sort']) ? $_GET['sort'] : 'roi';
        if ($type === 'roi') $sort = 'roi';
        if ($type === 'marketCap') $sort = 'market_cap';
        if ($type === 'coinSupply') $sort = 'coin_supply';
        if ($type === 'totalMasterNodes') $sort = 'totalMasterNodes';
        if ($type === 'coinsLocked') $sort = 'coinLocked';
        if ($type === 'coinsLockedPercent') $sort = 'coinLockedPercent';
        if ($type === 'dailyRev') $sort = 'dailyRev';
        if ($type === 'weeklyRev') $sort = 'weeklyRev';
        if ($type === 'monthlyRev') $sort = 'monthlyRev';
        if ($type === 'yearlyRev') $sort = 'yearlyRev';
        usort(
            $data['coinList'], function ($a, $b) use ($sort) {
            return $a[$sort] < $b[$sort];
        }
        );

        return view('main.layout.activeCoinList', $data);
    }

    public function active()
    {
        $data = null;
        $coinList = $this->coinList();
        foreach ($coinList as $one) {
            if (Storage::exists('' . strtolower($one['coin']) . '.json')) {
                $coinData = json_decode(Storage::get('' . strtolower($one['coin']) . '.json'), true);
                $data['coinList'][$one['coin']] = $coinData;
                $data['coinList'][$one['coin']]['cmc'] = json_decode(Storage::get('' . strtolower($one['coin']) . '-CMC.json'), true);
                $data['coinList'][$one['coin']]['coin'] = $one['coin'];
                $data['coinList'][$one['coin']]['name'] = $one['name'];
                $data['coinList'][$one['coin']]['roi'] = $coinData['income']['yearly'] / number_format($coinData['currentUSDPrice'] * $coinData['masterNodeCoinsRequired'], 2, '.', '') * 100;
                $data['coinList'][$one['coin']]['logo'] = $one['logo'];
            }
        }
        usort(
            $data['coinList'], function ($a, $b) {
            return $a['roi'] < $b['roi'];
        }
        );
        return view('active', $data);
    }

    public function activeCoin($coin)
    {
        $data = null;
        $coinList = $this->coinList();
        foreach ($coinList as $one) {
            if (Storage::exists('' . $one['coin'] . '.json')) {
                $coinData = json_decode(Storage::get('' . strtolower($one['coin']) . '.json'), true);
                $data['coinList'][$one['coin']] = $coinData;
                $data['coinList'][$one['coin']]['coin'] = $one['coin'];
                $data['coinList'][$one['coin']]['name'] = $one['name'];
                $data['coinList'][$one['coin']]['roi'] = $coinData['income']['yearly'] / number_format($coinData['currentUSDPrice'] * $coinData['masterNodeCoinsRequired'], 2, '.', '') * 100;
                $data['coinList'][$one['coin']]['logo'] = $one['logo'];
            }
        }
        $data = null;
        $coinList = $this->coinList();
        foreach ($coinList as $value) {
            if (strtolower($value['coin']) === strtolower($coin) || strtolower($value['name']) === strtolower($coin)) {
                $one = json_decode(Storage::get('' . strtolower($value['coin']) . '.json'), true);
                $one['coin'] = $value['coin'];
                $one['name'] = $value['name'];
                $one['roi'] = ($one['income']['yearly'] / number_format($one['currentUSDPrice'] * $one['masterNodeCoinsRequired'], 2, '.', '')) * 100;
                $one['logo'] = $value['logo'];
                $data['coinList'][0] = $one;
            }
        }
        return view('active', $data);
    }

    public function soon()
    {
        $data = null;

        $data['ComingSoonCoinList'] = $this->ComingSoonCoinList();
        return view('soon', $data);
    }

    public function soonCoin($coin)
    {
        $data = null;
        $coinList = $this->ComingSoonCoinList();
        foreach ($coinList as $value) {
            if (strtolower($value['coin']) === strtolower($coin)) {
                $data['ComingSoonCoinList'][0] = $value;
            }
            if (strtolower($value['name']) === strtolower($coin)) {
                $data['ComingSoonCoinList'][0] = $value;
            }
        }
        return view('soon', $data);
    }

    public function donate()
    {
        $data = null;
        $data['donateCoinList'] = json_decode(Storage::get('donateCoins.json'), true);
        usort(
            $data['donateCoinList'], function ($a, $b) {
            return $a['balance'] > $b['balance'];
        }
        );
        return view('donate', $data);
    }

    public function donateCoin($coin)
    {
        $data = null;
        $coinList = json_decode(Storage::get('donateCoins.json'), true);
        foreach ($coinList as $value) {
            if (strtolower($value['coin']) === strtolower($coin)) {
                $data['donateCoinList'][0] = $value;
            }
            if (strtolower($value['name']) === strtolower($coin)) {
                $data['donateCoinList'][0] = $value;
            }
        }
        return view('donate', $data);
    }

    public function getBalance($donate)
    {
        $client = new Client();
        $total = 0;
        foreach ($donate as $key => $value) {
            if ($key === 'bitcoin') {
                try {
                    $res = $client->request(
                        'GET', 'https://blockchain.info/q/getreceivedbyaddress/' . $value . '?api_code=4721538e-899d-456e-890b-0967fffac802'
                    );
                    $contentCMC = (float)$res->getBody()->getContents();
                } catch (\Exception $e) {
                    $contentCMC = 0;
                }
                if ($contentCMC === 0) {
                    try {
                        $res = $client->request(
                            'GET', 'https://blockexplorer.com/api/addr/' . $value . '/totalReceived'
                        );
                        $contentCMC = (float)$res->getBody()->getContents();
                    } catch (\Exception $e) {
                        $contentCMC = 0;
                    }
                }
                $total = $total + ($contentCMC / 100000000);
            } else {
                $url = 'http://chainz.cryptoid.info/' . $key . '/api.dws?q=ticker.btc';
                $res = $client->request(
                    'GET', $url
                );
                $tickerBTC = (float)$res->getBody()->getContents();
                $url = 'http://chainz.cryptoid.info/' . $key . '/api.dws?q=getreceivedbyaddress&a=' . $value;
                $res = $client->request(
                    'GET', $url
                );
                $cointotal = (float)$res->getBody()->getContents();
                $coin2btc = number_format($cointotal * $tickerBTC, '8', '.', '');
                $total = $total + $coin2btc;
            }
        }
        return $total;
    }


    // COIN LISTS

    public function ComingSoonCoinList()
    {
        $i = 0;


        $coin = [];
        $coin['name'] = 'AmsterdamCoin';
        $coin['coin'] = 'AMS';
        $coin['url'] = 'https://bitcointalk.org/index.php?topic=1152947.0';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/amsterdamcoin.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'GanjaCoin';
        $coin['coin'] = 'mrja';
        $coin['url'] = 'https://bitcointalk.org/index.php?topic=2144531.0';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/ganjacoin.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'Bitcloud';
        $coin['coin'] = 'BTDX';
        $coin['url'] = 'https://bit-cloud.info/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/bitcloud.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'masternodecoin';
        $coin['coin'] = 'MTNC';
        $coin['url'] = 'https://bitcointalk.org/index.php?topic=2056867.0';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/masternodecoin.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'FootyCash';
        $coin['coin'] = 'xft';
        $coin['url'] = 'http://footycash.com/';
        $coin['logo'] = 'https://i.imgur.com/dzOnf2S.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'Memetic';
        $coin['coin'] = 'meme';
        $coin['url'] = 'https://bitcointalk.org/index.php?topic=1391598.0';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/memetic.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'Diamond';
        $coin['coin'] = 'DMD';
        $coin['url'] = 'http://bit.diamonds/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/diamond.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;


        $coin = [];
        $coin['name'] = 'Flaxscript';
        $coin['coin'] = 'flax';
        $coin['url'] = 'http://flaxscript.org/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/flaxscript.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'TerraCoin';
        $coin['coin'] = 'trc';
        $coin['url'] = 'http://www.terracoin.info/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/terracoin.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'ColossusCoinXT';
        $coin['coin'] = 'COLX';
        $coin['url'] = 'https://colossuscoin.org/index.php/colx';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/colossuscoinxt.png';
        $coin['notes'] = 'Updating DataBase';
        $coins[$i] = $coin;
        $i++;


        $coin = [];
        $coin['name'] = 'PIECoin';
        $coin['coin'] = 'PIE';
        $coin['url'] = 'http://piecoin.info/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/piecoin.png';
        $coin['notes'] = 'ONHOLD Waiting for HardFork to enable MasterNodes';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'Wagerr';
        $coin['coin'] = 'wgr';
        $coin['notes'] = 'ONHOLD Per request from CoinDev';
        $coin['url'] = 'http://www.wagerr.com/';
        $coin['logo'] = '/img/wager.png';
        $coins[$i] = $coin;
        $i++;
        foreach ($coins as $one) {
            $data[$one['coin']] = $one;
        }
        return $data;
    }

    public function donateCoinList()
    {
        $client = new Client();
        $resCMCCORE = $client->request(
            'GET', 'https://blockchain.info/ticker'
        );
        $i = 0;
        $ticker = json_decode($resCMCCORE->getBody()->getContents(), true);

        $coin = [];
        $coin['name'] = 'Bitradio';
        $coin['coin'] = 'BRO';
        $coin['url'] = 'http://www.bitrad.io/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/bitradio.png';
        $coin['donate']['bitcoin'] = '1G44YGKSx1V61NS4tZbZysHwKBY6PRh1x4';
        $coin['current'] = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']);
        $coin['need'] = 400;
        $coin['balance'] = $coin['need'] - $coin['current'];
        $coins[$i] = $coin;
        $i++;

        // Old coin $200 credit
        $coin = [];
        $coin['name'] = 'TransferCoin';
        $coin['coin'] = 'TX';
        $coin['url'] = 'http://txproject.io/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/transfercoin.png';
        $coin['donate']['bitcoin'] = '1K6MDNuNs3p8QfJVwhipS7YG1Mh2ekfkZ5';
        $coin['current'] = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']) + 200;
        $coin['need'] = 400;
        $coin['balance'] = $coin['need'] - $coin['current'];
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = '8Bit';
        $coin['coin'] = '8bit';
        $coin['url'] = 'http://www.8-bit.ga/';
        $coin['logo'] = 'https://files.coinmarketcap.com/static/img/coins/128x128/8bit.png';
        $coin['donate']['bitcoin'] = '17oi1eAEak2PgADLUKKUDvPrvynxXsSgXE';
        $coin['current'] = (float)($this->getBalance($coin['donate']) * $ticker['USD']['15m']) + 200;
        $coin['need'] = 400;
        $coin['balance'] = $coin['need'] - $coin['current'];
        $coins[$i] = $coin;
        $i++;
        foreach ($coins as $one) {
            $data[$one['coin']] = $one;
        }
        Storage::put('donateCoins.json', json_encode($data));
    }

    public function coinList()
    {
        $i = 0;


        $coin = [];
        $coin['name'] = 'VIVO';
        $coin['coin'] = 'vivo';
        $coin['url'] = 'https://www.vivocrypto.com/';
        $coin['ws'] = '10.99.0.24';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'MonacoCoin';
        $coin['coin'] = 'XMCC';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['name'] = 'MarteXcoin';
        $coin['coin'] = 'mxt';
        $coin['ws'] = '10.99.0.23';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'InsaneCoin';
        $coin['coin'] = 'INSN';
        $coin['ws'] = '10.99.0.23';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'Vsync';
        $coin['cmc'] = 'vsync-vsx';
        $coin['coin'] = 'VSX';
        $coin['ws'] = '10.99.0.23';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'CoinonatX';
        $coin['coin'] = 'xcxt';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'ION';
        $coin['coin'] = 'ion';
        $coin['listed'] = '05/01/2016';
        $coin['ws'] = '10.99.0.41';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'DigitalPrice';
        $coin['coin'] = 'DP';
        $coin['listed'] = '09/04/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Braincoin';
        $coin['coin'] = 'BRAIN';
        $coin['listed'] = '08/15/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Cream';
        $coin['coin'] = 'crm';
        $coin['listed'] = '08/14/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'DAS';
        $coin['coin'] = 'das';
        $coin['listed'] = '08/08/2017';
        $coins[$i] = $coin;
        $i++;

        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'SIBCoin';
        $coin['coin'] = 'SIB';
        $coin['listed'] = '08/01/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Linda';
        $coin['coin'] = 'linda';
        $coin['listed'] = '08/01/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Crown';
        $coin['coin'] = 'CRW';
        $coin['listed'] = '07/31/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Renos';
        $coin['coin'] = 'RNS';
        $coin['listed'] = '07/27/2017';
        $ads['start'] = '07/27/2017';
        $ads['end'] = '08/28/2017';
        $ads['cost'] = '5000RNS';
        $ads['location'] = 'top';
        $ads['type'] = 'list';
        $coin['ads'] = $ads;
        $coin['url'] = 'https://renoscoin.com/?track=MNP';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'ChainCoin';
        $coin['coin'] = 'chc';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'PIVX';
        $coin['coin'] = 'pivx';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Neutron';
        $coin['coin'] = 'ntrn';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'ArcticCoin';
        $coin['coin'] = 'arc';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'CRAVE';
        $coin['coin'] = 'crave';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
//		$coin['disabled'] = true;
        $coin['name'] = 'MonetaryUnit';
        $coin['coin'] = 'MUE';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'ExclusiveCoin';
        $coin['coin'] = 'EXCL';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['name'] = 'DASH';
        $coin['coin'] = 'DASH';
        $coin['listed'] = '07/27/2017';
        $coin['ws'] = '10.99.0.41';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Syndicate';
        $coin['coin'] = 'SYNX';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Eternity';
        $coin['coin'] = 'ent';
        $coin['listed'] = '07/27/2017';
        $coins[$i] = $coin;
        $i++;
        $coin = [];
        $coin['mnpstat'] = 'maint';
        $coin['name'] = 'Bitsend';
        $coin['coin'] = 'bsd';
        $coins[$i] = $coin;
        $i++;
        return $coins;
    }

    // END COIN LISTS

    public function callCoinAPIS()
    {
        $this->CallCoinMarketCap();
        $coinList = $this->coinList();
        foreach ($coinList as $one) {
            $this->coinApi($one['coin']);
        }
//		$coinDonateList = $this->donateCoinList();
    }

    public function coinApi($name)
    {
        $stats = new stats();
//		$client = new Client();
//		try {
//			$res = $client->request(
//				'GET', 'http://masternodes.pro/stats/' . strtolower($name) . '/api/datapack'
//			);
//		}
//		catch (\Exception $ex) {
//			echo "http://masternodes.pro/stats/".strtolower($name)."/api/datapack AGH!<br>";
//		}
//		if (isset($res)) {
//			$content = $res->getBody();
        $content = $stats->DataPackCore(strtolower($name));
//			if ($this->isJson($content)) {
        echo 'GOT THIS ' . strtolower($name) . '<br>';
        Storage::put('' . strtolower($name) . '.json', $content);
//			}
//		}
    }

    function isJson($string)
    {
        return is_string($string) && is_array(json_decode($string, true)) && (json_last_error() == JSON_ERROR_NONE) ? true : false;
    }

    public function GetPrice($coin)
    {
        return Storage::get('' . strtolower($coin) . '-CMC.json');
    }

    public function CallCoinMarketCap()
    {
        $es = new elasticSearch();
        $client = new Client();
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/'
        );
        $contentCMC = $resCMCCORE->getBody();
        $CORE = json_decode($contentCMC, true);
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=GBP'
        );
        $contentCMC = $resCMCCORE->getBody();
        $GBP = json_decode($contentCMC, true);
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=AUD'
        );
        $contentCMC = $resCMCCORE->getBody();
        $AUD = json_decode($contentCMC, true);
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=CAD'
        );
        $contentCMC = $resCMCCORE->getBody();
        $CAD = json_decode($contentCMC, true);
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=CNY'
        );
        $contentCMC = $resCMCCORE->getBody();
        $CNY = json_decode($contentCMC, true);
        $resCMCCORE = $client->request(
            'GET', 'https://api.coinmarketcap.com/v1/ticker/?convert=RUB'
        );
        $contentCMC = $resCMCCORE->getBody();
        $RUB = json_decode($contentCMC, true);

        $coinList = $this->coinList();
        $ComingSoonCoinList = $this->ComingSoonCoinList();
        $NewCore = [];
        foreach ($CORE as $key => $coin) {
            foreach ($GBP as $ALTcoin) {
                if ($ALTcoin['symbol'] === $coin['symbol']) {
                    $coin['price_gbp'] = $ALTcoin['price_gbp'];
                }
            }
            foreach ($AUD as $ALTcoin) {
                if ($ALTcoin['symbol'] === $coin['symbol']) {
                    $coin['price_aud'] = $ALTcoin['price_aud'];
                }
            }
            foreach ($CAD as $ALTcoin) {
                if ($ALTcoin['symbol'] === $coin['symbol']) {
                    $coin['price_cad'] = $ALTcoin['price_cad'];
                }
            }
            foreach ($CNY as $ALTcoin) {
                if ($ALTcoin['symbol'] === $coin['symbol']) {
                    $coin['price_cny'] = $ALTcoin['price_cny'];
                }
            }
            foreach ($RUB as $ALTcoin) {
                if ($ALTcoin['symbol'] === $coin['symbol']) {
                    $coin['price_rub'] = $ALTcoin['price_rub'];
                }
            }
            foreach ($coinList as $one) {
                if (strtoupper($coin['name']) === strtoupper($one['name'])) {
                    if (strtoupper($coin['symbol']) === strtoupper($one['coin'])) {
                        $coin['lastUpdate'] = (float)time();
                        $config['ES_coin'] = strtolower($one['coin']);
                        $config['ES_type'] = 'coinmarketcap';
                        $config['ES_id'] = time();
                        $es->esPUT($coin, $config);
                        Storage::put('' . strtolower($one['coin']) . '-CMC.json', json_encode($coin));
                        $NewCore[] = $coin;
                    }
                }
            }
            foreach ($ComingSoonCoinList as $one) {
                if (strtoupper($coin['name']) === strtoupper($one['name'])) {
                    if (strtoupper($coin['symbol']) === strtoupper($one['coin'])) {
                        $coin['lastUpdate'] = (float)time();
                        $config['ES_coin'] = strtolower($one['coin']);
                        $config['ES_type'] = 'coinmarketcap';
                        $config['ES_id'] = time();
                        $es->esPUT($coin, $config);
                        Storage::put('' . strtolower($one['coin']) . '-CMC.json', json_encode($coin));
                        $NewCore[] = $coin;
                    }
                }
            }
        }
        $Data = $NewCore;
        return "<pre>" . json_encode($Data, JSON_PRETTY_PRINT) . "</pre>";
    }

}