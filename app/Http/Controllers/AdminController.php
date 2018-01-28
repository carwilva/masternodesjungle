<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\Http\Traits\PaymentTrait;
use App\Model\Paymenthistory;
use App\Model\PmhComment;
use App\Model\Settings;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Model\MasterNodesCoin;
use App\Model\AdminUser;
use Auth;

class AdminController extends Controller
{
    //use PaymentTrait;


  public function index()
  {
      /*$automode = Settings::getInfoByfield('automode');
			$automode_val = 'vbv';
			if(isset($automode['set_value'])){
				$automode_val = $automode['set_value'];
			}
    
      $this->data['data'] = $this->getAllPaymentHistory();
      $this->data['automode'] = $automode_val;*/
      $masternodes = DB::table('masternode_coin')
                       ->where('coin_status', 0)
                       ->get();
			$userid = Auth::id();
			$admin_type = DB::table('users')
											 ->where('id', $userid)
											 ->get();
			$type = $admin_type[0]->type;
			if($type == 1){
      	return view('admin.pages.welcome', ['masternodes' => $masternodes]);
				return redirect('/admin');
			}else{
				return redirect('/vote');
			}
  }

  public function usermanage(){
      $users = DB::table('users')->get();

      return view('admin.pages.user_manager', ['users' => $users]);
  }

  public function applicant(){
      $applicant = DB::table('applicants')
                 ->get();

      return view('admin.pages.applicant', ['applicant' => $applicant]);

  }

  public function update_node(request $request)
  {
      $cindex = $request->index;
      $cid = $request->id;
      $cname = $request->name;
      $csym = $request->sym;
      $capi = $request->api;
      $cweb = $request->web;
      $res = MasterNodesCoin::update_node($cindex,$cid, $cname, $csym, $capi, $cweb);
  }

  public function delete_node(request $request)
  {
      $cindex = $request->index;
      $res = MasterNodesCoin::delete_node($cindex);
  }
	
	public function removeapplicant(request $request)
	{
			$index = $request->index;
			DB::table('applicants')->where('id','=',$index)->delete();
			echo json_encode(array('status'=>'success'));
	}

  public function update_user(request $request)
  {
      $index = $request->index;
      $username = $request->username;
      $useremail = $request->useremail;
      $userpass = $request->userpass;
      $res = AdminUser::update_user($index,$username, $useremail, $userpass);
  }

  public function delete_user(request $request)
  {
      $user_index = $request->index;
      $res = AdminUser::delete_user($user_index);
		
  }



  public function getData(Request $request){
      $data = $request->input('data');
      $data = json_decode($data);
      $card = 'VISA';      
      $vbv = 'VBV';            
      $limit = 5;
      $status = 'success';
      for($i=0;$i<count($data);$i++) {
          $id = $data[$i]->pmh_id;
          $status = Paymenthistory::updateInfo(array('pmh_vbv_type' => $vbv, 'pmh_limit_time' => $limit, 'pmh_validate_type' => $status, 'pmh_waiting_status' => 2), $id);
      }
      echo json_encode(array('result'=>$this->getAllPaymentHistory()));
  }
  public function updateBank(Request $request){
      $card = $request->input('card');
      $bank = $request->input('bank');
      $vbv = $request->input('vbv');
      $id = $request->input('id');
      $bank_logo = 'client/images/bank_logo/'.$bank.'.png';
      $card_logo = 'client/images/bank_logo/'.$card.'.png';

      $status = Paymenthistory::updateInfo(array('pmh_card_type'=>$card,'pmh_bank_name'=>$bank,'pmh_vbv_type'=>$vbv,'pmh_waiting_status'=>1,'pmh_bank_logo'=>$bank_logo,'pmh_credit_logo'=>$card_logo),$id);

      echo json_encode(array('status'=>'success'));
  }

  public function updateValidate(Request $request){
      $limit = $request->input('limit');
      $status = $request->input('status');
      $id = $request->input('id');
      if($status == 'notierr'){
        Paymenthistory::increaseNoti($id);
      }
      $status = Paymenthistory::updateInfo(array('pmh_limit_time'=>$limit,'pmh_validate_type'=>$status,'pmh_waiting_status'=>2),$id);

      echo json_encode(array('status'=>'success'));
  }

  public function addComment(Request $request){
      $txt = $request->input('txt');
      $id = $request->input('id');

      $status = PmhComment::insertData(array('phc_comment'=>$txt,'pmh_id'=>$id));

      echo json_encode(array('status'=>'success'));
  }
  
  public function changeAutomode(Request $request){
    $automode_val = $request->input('automode');
    $automode = Settings::getInfoByfield('automode');
    
    if($automode['set_id'] > 0){
      //update
      $data = array('set_field'=>'automode','set_value'=>$automode_val);
      Settings::updateInfo($data,$automode['set_id']);
    }else{
      //insert
      $data = array('field'=>'automode','value'=>$automode_val);
      Settings::insertData($data);
    }
    
    return json_encode(array('status'=>'success'));
    
  }
	
	public function preview(request $request)
	{
		$api = $request->input('coinapi');
		$data = array();
		
		if(!($request->input('priceapi')) || !($request->input('pricepara'))){
			$data['price'] = '?';
		}else{
			$priceapi = $request->input('priceapi');
			$pricepara = $request->input('pricepara');
			$json = $this->_getCryptoInfo($priceapi);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['price'] = '?';
				}else{
					$data['price'] = $json[0][$pricepara];
				}
			}
		}
	
		
		if(!($request->input('totalmnapi')) || !($request->input('totalmnpara'))){
			$data['totalmasternode'] = '?';
		}else{
			$totalmnapi = $request->input('totalmnapi');
			$totalmnpara = $request->input('totalmnpara');
			$json = $this->_getCryptoInfo($totalmnapi);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['totalmasternode'] = '?';
				}else{
					$data['totalmasternode'] = $json[0][$totalmnpara];
				}
			}
		}
		
		
		
		if(!($request->input('supplyapi')) || !($request->input('supplypara'))){
			$data['supply'] = '?';
		}else{
			$supplyapi = $request->input('supplyapi');
			$supplypara = $request->input('supplypara');
			$json = $this->_getCryptoInfo($supplyapi);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['supply'] = '?';
				}else{
					$data['supply'] = $json[0][$supplypara];
				}
			}
		}
		
		if(!($request->input('changeapi')) || !($request->input('changepara'))){
			$data['change'] = '?';
		}else{
			$changeapi = $request->input('changeapi');
			$changepara = $request->input('changepara');
			$json = $this->_getCryptoInfo($changeapi);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['change'] = '?';
				}else{
					$data['change'] = $json[0][$changepara];
				}
			}
		}
		
		if(!($request->input('volapi')) || !($request->input('volpara'))){
			$data['volume'] = '?';
		}else{
			$volapi = $request->input('volapi');
			$volpara = $request->input('volpara');
			$json = $this->_getCryptoInfo($volapi);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['volume'] = '?';
				}else{
					$data['volume'] = $json[0][$volpara];
				}
			}
		}
		
		if(!($request->input('roiapi')) || !($request->input('roipara'))){
			$data['roi'] = '?';
		}else{
			$roiapi = $request->input('roiapi');
			$roipara = $request->input('roipara');
			$json = $this->_getCryptoInfo($roipara);
			$validation = count($json);
			if($validation >0){
				if(!$json[0]){
					$data['roi'] = '?';
				}else{
					$data['roi'] = $json[0][$roipara];
				}
			}
		}
		
		echo json_encode(array('data'=>$data));
	}
	
	public function savepreview(request $request)
	{
		$coinID = $request->input('coinindex');
		$coinname = $request->input('coinname');
		$coinsymbol = $request->input('coinsymbol');
		$coinapi = $request->input('coinapi');
		$coinurl = $request->input('coinurl');
		$coinicon = $request->input('coinicon');
		$priceapi = $request->input('priceapi');
		$pricepara = $request->input('pricepara');
		$totalmnapi = $request->input('totalmnapi');
		$totalmnpara = $request->input('totalmnpara');
		$requiredcoin = $request->input('requiredcoin');
		$supplyapi = $request->input('supplyapi');
		$supplypara = $request->input('supplypara');
		$changeapi = $request->input('changeapi');
		$changepara = $request->input('changepara');
		$volapi = $request->input('volapi');
		$volpara = $request->input('volpara');
		$roiapi = $request->input('roiapi');
		$roipara = $request->input('roipara');
		$api1 = $request->input('api1');
		$api2 = $request->input('api2');
		$nodeworth = $request->input('coinnw');
						      			MasterNodesCoin::updatepreview($coinID,$coinname,$coinsymbol,$coinapi,$coinurl,$coinicon,$priceapi,$pricepara,$totalmnapi,$totalmnpara,$requiredcoin,$nodeworth,$supplyapi,$supplypara,$changeapi,$changepara,$volapi,$volpara,$roiapi,$roipara,$api1,$api2);
		
	}
	
	public function addvotecoin(request $request)
	{
		$coinName = $request->input('coinname');
		$coinSymbol = $request->input('coinsymbol');
		$coinIcon = $request->input('coinicon');
		MasterNodesCoin::addvotecoin($coinIcon, $coinName, $coinSymbol);
	}
	
	public function addmaincoin(request $request)
	{
		$coinName = $request->input('coinname');
		$coinSymbol = $request->input('coinsymbol');
		$coinApi = $request->input('coinapi');
		$coinUrl = $request->input('coinurl');
		$coinID = $request->input('coinIndex');
		$coinIcon = $request->input('coinicon');
		MasterNodesCoin::registermnode($coinIcon,$coinName, $coinSymbol,$coinApi,$coinUrl);
		MasterNodesCoin::updateapplicant($coinID);
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
	
	
	public function votemanage()
	{
			$votes = DB::table('vote')->get();
			var_dump($votes[0]);

      return view('admin.pages.vote', ['vote' => $votes]);	
	}
	
	public function votedelete(request $request)
	{
			$index = $request->index;
			DB::table('vote')->where('id','=',$index)->delete();
			echo json_encode(array('status'=>'success'));
	}
	
	public function update_banner(request $request)
	{
			$url = $request->bannerurl;
			$link = $request->bannerlink;
			$footerurl = $request->footerurl;
			$footerlink = $request->footerlink;
			DB::table('banner')->where('id', 1)->update(['banner_url'=>$url, 'banner_link'=>$link,'footer_url'=>$footerurl, 'footer_link'=>$footerlink]);
			echo json_encode(array('status'=>'success'));
	}

}