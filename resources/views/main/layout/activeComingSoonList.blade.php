<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Active Coin grid -->
    <div class="coin-grid">

        <?php 

        $list_header = array(
            '#', 
            //'master-cap', 
            'Icon', 
            'Name', 
            'ROI', 
            'Price', 
            'Change',
            'Volume', 
            'MarketCap', 
            'Total MasterNodes', 
            'Required Coins', 
            'Node Worth'
        );
        $header_class = array(
            'ranking', 
            'master-cap', 
            'icon', 
            'name', 
            'roi', 
            'price', 
            'total-masternodes', 
            'required-coins', 
            'node-worth', 
            'daily', 
            'weekly', 
            'month'
        );

        ?>

        <?php 
        //echo($addCoin);exit;
        $cnt = 0;
//         foreach ($coinList as $coinRecord) 
//         {
//             if (!($cnt%2)) {
//                 echo '<div class="row">';
//             }
//             echo '<div class="col-md-6 col-xs-12 coin-box">';

//             echo    '<div class="row">';
//             echo        '<div class="col-md-2 col-xs-12">';
//             /*if (array_key_exists('ImageUrl', $coinRecord)) 
//             {
//                 echo        '<img src="'. $coinRecord['ImageUrl'] . '" alt="' . $coinRecord['symbol'] . '">';
//             }
//             else
//             {
//                 echo        '<img src="'. '' . '" alt="' . $coinRecord['symbol'] . '">';
//             }*/
//             echo        '<img src="'. $coinRecord['url'] . '" alt="' . $coinRecord['url'] . '">';
//             echo        '</div>';
//             echo        '<div class="col-md-6 col-xs-12">';
//             echo            '<p><span>Coin Name - Symbol</span></p>';
//             echo            '<p class="g_name">'.$coinRecord['title'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-4 col-xs-12">';
//             echo            '<p><span>Market Cap (USD)</span></p>';
//             echo            '<p>'.$coinRecord['marketcap'].'</p>';
//             echo        '</div>';
//             echo    '</div>';

//             echo    '<div class="row text-center">';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>ROI</span></p>';
//             echo            '<p>'.$coinRecord['marketcap'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6 g_pri">';
//             echo            '<p><span>PRICE</span></p>';
//             echo            '<p class="prc_usd">'.$coinRecord['price_usd'].'</p><p class="prc_btc hid">'. $coinRecord['price_usd'] .'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Total Masternodes</span></p>';
//             echo            '<p>'.$coinRecord['change'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Required Coins</span></p>';
//             echo            '<p>'.$coinRecord['volume'].'</p>';
//             echo        '</div>';
//             echo    '</div>';

//             echo    '<div class="row text-center">';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Node Worth</span></p>';
//             echo            '<p class="g_perh">'.$coinRecord['roi'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Daily</span></p>';
//             echo            '<p class="g_perh">'.$coinRecord['nodes'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Weekly</span></p>';
//             echo            '<p class="g_perh">'.$coinRecord['require'].'</p>';
//             echo        '</div>';
//             echo        '<div class="col-md-3 col-xs-6">';
//             echo            '<p><span>Monthly</span></p>';
//             echo            '<p class="g_perh">'.$coinRecord['mnworth'].'</p>';
//             echo        '</div>';
//             echo    '</div>';

//             echo    '<div class="row text-center">';
//             echo        '<div class="col-xs-12">';
//             echo            '<p><span>Last Updated</span></p>';
//             echo            '<p>'.date("Y-m-d H:i:s", $coinRecord['mnworth']).'</p>';
//             echo        '</div>';
//             echo    '</div>';
//             echo '</div>';

//             if ($cnt%2) {
//                 echo '</div>'; // row
//             }

//             $cnt++;
//         }

        ?>

    </div>
    <!-- /.active coin grid -->
</div>

<?php //exit; ?> 