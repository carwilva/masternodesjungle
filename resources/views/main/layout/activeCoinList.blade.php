<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <!-- Active Coin list -->
    <div class="coin-list">

        <?php 

        $list_header = array(
            '#', 
            'Master Cap', 
            'ICON',
            'NAME',
            'ROI',
            'PRICE',
            'Total MasterNodes',
            'Required Coins',
            'Node',
            'Worth',
            'Daily',
            'Weekly',
            'Month'
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
            'node', 
            'worth', 
            'daily', 
            'weekly', 
            'month'
        );

        // if ($options == "listview") {

        ?>

        <table id="active_coin_list" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
            <thead>
                <tr>
                    <?php 

                    foreach ($list_header as $key => $header) {
                        echo '<th class="' . $header_class[$key] . '">' . $header . '</th>';
                    }

                    ?>
                </tr>
            </thead>

            <tbody>
                <?php 

                $coinRow = '';

                foreach ($coinList as $coinRecord) {

                    $row = '<tr class="' . $coinRecord['id'] . '" onclick="coinDetailView(\'' . $coinRecord['id'] . '\')">';
                    $row .= '<td class="' . $header_class[0] . '">' . $coinRecord['rank'] . '</td>';
                    $row .= '<td class="' . $header_class[1] . '">' . $coinRecord['market_cap_usd'] . '</td>';
                    $row .= '<td class="' . $header_class[2] . '"><img src="'.'/img/dash_square_bevel_highres.png'/* . $coinRecord['rank']*/ . '" alt="' /*. $coinRecord['icon_url']*/ . '"></td>';
                    $row .= '<td class="' . $header_class[3] . '">' . $coinRecord['name'] . '</td>';
                    $row .= '<td class="' . $header_class[4] . '">' /*. $coinRecord['roi']*/ . '</td>';
                    $row .= '<td class="' . $header_class[5] . '">' . $coinRecord['price_usd'] . '</td>';
                    $row .= '<td class="' . $header_class[6] . '">' . $coinRecord['total_supply'] . '</td>';
                    $row .= '<td class="' . $header_class[7] . '">' . $coinRecord['price_btc'] . '</td>';
                    $row .= '<td class="' . $header_class[8] . '">' . $coinRecord['available_supply'] . '</td>';
                    $row .= '<td class="' . $header_class[9] . '">' . $coinRecord['percent_change_1h'] . '</td>';
                    $row .= '<td class="' . $header_class[10] . '">' . $coinRecord['percent_change_24h'] . '</td>';
                    $row .= '<td class="' . $header_class[11] . '">' . $coinRecord['percent_change_7d'] . '</td>';
                    $row .= '<td class="' . $header_class[12] . '"><img src="'.'/img/downtrend.png'/* . $coinRecord['rank']*/ . '" alt="' /*. $coinRecord['icon_url']*/ . '"></td>';
                    $row .= '</tr>';

                    echo $row;
                }

                ?>
            </tbody>
        </table>

        <?php 

        //} elseif ($options == "gridview") {

        ?>

        <!-- gridview -->

        <?php 

        //}

        ?>

    </div>
    <!-- /.active coin list -->
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $("#active_coin_list").DataTable();
    })

    function coinDetailView(coinID) {

        $('#coin_detail_modal .modal-title').html("Modal Testing.. :) ");

        var modal_content = '';
        modal_content += '<p>You selected <span style="color:red">' + coinID + '</span></p>';
        modal_content += '<h4>Detail Modal Coming Soon!!!</h4>';

        $('#coin_detail_modal .modal-body').html(modal_content);
        $('#coin_detail_modal').modal();
    }
</script>

<?php //exit; ?>