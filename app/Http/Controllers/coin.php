<?php

namespace App\Http\Controllers;

use App\Blocks;
use Validator, Input, Redirect, View, Auth;
use App\Mnl;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\elasticSearch;

class coin extends Controller
{
    public static $sort = 'roi';

    public function index()
    {
        $data = $this->generateData();
        
        return view('main.welcome', $data);

        // return view('main.welcome', '');
    }

    private function generateData()
    {
        $url = "https://api.coinmarketcap.com/v1/ticker/";

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

        $coinList = json_decode($response, true); //because of true, it's in an array

        $data = [];
        $data['coinList'] = $coinList;

        /*foreach ($coinList['Data'] as $key => $coin) {
            $coinDetail = [];
            $coinDetail['price_usd'] = 1;
            $coinDetail['totalMasterNodes'] = $coin['TotalCoinSupply'];
            $coinDetail['masterNodeCoinsRequired'] = 'masterNodeCoinsRequired';
            $coinDetail['income'] = 'income';
            $coinDetail['lastUpdated'] = 'lastUpdated';
            $coinDetail['cmc'] = [];
            $coinDetail['cmc']['price_usd'] = 1;
            $coinDetail['cmc']['percent_change_24h'] = 1;
            $coinDetail['cmc']['market_cap_usd'] = 'market_cap_usd';
            $coinDetail['market_cap'] = 'market_cap';
            $coinDetail['coin_supply'] = 'coin_supply';
            $coinDetail['percent_change_24h'] = 'percent_change_24h';
            $coinDetail['coinLocked'] = 'coinLocked';
            $coinDetail['coinLockedPercent'] = 'coinLockedPercent';
            $coinDetail['dailyRev'] = 'dailyRev';
            $coinDetail['weeklyRev'] = 'weeklyRev';
            $coinDetail['monthlyRev'] = 'monthlyRev';
            $coinDetail['yearlyRev'] = 'yearlyRev';
            $coinDetail['coin'] = $coin['Name'];
            $coinDetail['name'] = $coin['CoinName'];
            $coinDetail['roi'] = 'roi';
            $coinDetail['realRoi'] = 'realRoi';
            $coinDetail['logo'] = 'imageurl';
            $coinDetail['ads'] = 'ads';
            $coinDetail['url'] = 'url';
            $coinDetail['roi'] = 'offline';
            $coinDetail['dailyRev'] = 'offline';
            $coinDetail['weeklyRev'] = 'offline';
            $coinDetail['monthlyRev'] = 'offline';
            $coinDetail['yearlyRev'] = 'offline';
            $coinDetail['realRoi'] = -1;
            $coinDetail['disabled'] = 'disabled';
            $coinDetail['mnpstat'] = 'mnpstat';
            $coinDetail['realRoi'] = -1;

            $data['coinList'][$key] = $coinDetail;
        }*/
        
        // return $data;
        return $data;
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