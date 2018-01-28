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

        $cnt = 0;
        $index = 1;
        foreach ($coinList as $coinRecord) 
        {
            //if($index<9){
                if (!($cnt%2)) {
                    echo '<div class="row">';
                }
                if($index>6){
                  echo '<div class="col-md-6 col-xs-12 coin-box readmore'.$index.' hidden">';
                }else{
                  echo '<div class="col-md-6 col-xs-12 coin-box readmore'.$index.'">';
                }

                echo    '<div class="row">';
                echo        '<div class="col-md-1 col-xs-12"></div>';
                echo        '<div class="col-md-2 col-xs-12">';
                /*if (array_key_exists('ImageUrl', $coinRecord)) 
                {
                    echo        '<img src="'. $coinRecord['ImageUrl'] . '" alt="' . $coinRecord['symbol'] . '">';
                }
                else
                {
                    echo        '<img src="'. '' . '" alt="' . $coinRecord['symbol'] . '">';
                }*/
                echo        '<img src="'. $coinRecord['url'] . '" alt="' . $coinRecord['url'] . '">';
                echo        '</div>';
                echo        '<div class="col-md-5 col-xs-12">';
                echo            '<p><span>Name</span></p>';
                echo            '<p class="g_name grid'. $index.'">'.$coinRecord['title'].'</p>';
                echo        '</div>';
                echo        '<div class="col-md-4 col-xs-12">';
                echo            '<p><span>ROI</span></p>';
                echo            '<p class="grid_roi">'.$coinRecord['roi'].'%</p>';
                echo        '</div>';
                echo    '</div>';

                echo    '<div class="row text-center">';
                echo        '<div class="col-md-3 col-xs-6">';
                echo            '<p><span>PRICE</span></p>';
                echo            '<p class="grid_price">'.$coinRecord['price_usd'].'</p>';
                echo        '</div>';
                echo        '<div class="col-md-3 col-xs-6">';
                echo            '<p><span>CHANGE</span></p>';
                if(substr($coinRecord['change'], 0, 1) == '-'){
                  echo            '<p class="grid_change" style="color:red!important;">'.$coinRecord['change'].'</p>';  
                }else{
                  echo            '<p class="grid_change">'.$coinRecord['change'].'</p>';
                }
                echo        '</div>';
                echo        '<div class="col-md-3 col-xs-6">';
                echo            '<p><span>VOLUME</span></p>';
                echo            '<p>$'.$coinRecord['volume'].'</p>';
                echo        '</div>';
                echo        '<div class="col-md-3 col-xs-6">';
                echo            '<p><span>MARKETCAP</span></p>';
                echo            '<p>'.$coinRecord['marketcap'].'</p>';
                echo        '</div>';
                echo    '</div>';

                echo    '<div class="row text-center">';
                echo        '<div class="col-md-4 col-xs-6">';
                echo            '<p><span>TOTAL MASTERNODES</span></p>';
                echo            '<p class="g_perh">'.$coinRecord['nodes'].'</p>';
                echo        '</div>';
                 echo        '<div class="col-md-4 col-xs-6">';
                 echo            '<p><span>Required Coins</span></p>';
                 echo            '<p class="g_perh">'.$coinRecord['require'].'</p>';
                 echo        '</div>';
                 echo        '<div class="col-md-4 col-xs-6">';
                 echo            '<p><span>NODE WORTH</span></p>';
                 echo            '<p class="g_perh">'.$coinRecord['mnworth'].'</p>';
                 echo        '</div>';
    //             echo        '<div class="col-md-3 col-xs-6">';
    //             echo            '<p><span>Monthly</span></p>';
    //             echo            '<p class="g_perh">'.$coinRecord['mnworth'].'</p>';
    //             echo        '</div>';
                 echo    '</div>';
                 if( $index < 9){
                   echo    '<div class="row text-center">';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Daily</span></p>';
                   echo            '<p class="gridday">'.$coinRecord['gridinfo0'].'</p>';
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Weekly</span></p>';
                   echo            '<p class="gridweek">'.$coinRecord['gridinfo1'].'</p>';          
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Monthly</span></p>';
                   echo            '<p class="gridmon">'.$coinRecord['gridinfo2'].'</p>';          
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Yearyl</span></p>';
                   echo            '<p class="gridyear">'.$coinRecord['gridinfo3'].'</p>';          
                   echo        '</div>';
                   echo     '</div>';
                 }else{
                   echo    '<div class="row text-center">';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Daily</span></p>';
                   echo            '<p class="gridday"></p>';
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Weekly</span></p>';
                   echo            '<p class="gridweek"></p>';          
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Monthly</span></p>';
                   echo            '<p class="gridmon"></p>';          
                   echo        '</div>';
                   echo        '<div class="col-md-3 col-xs-6">';
                   echo            '<p><span>Yearyl</span></p>';
                   echo            '<p class="gridyear"></p>';          
                   echo        '</div>';
                   echo     '</div>';  
                 }
                 echo     '</div>';

                if ($cnt%2) {
                    echo '</div>'; // row
                }

                $cnt++;
                $index++;
            //}
        }

        ?>
    <button class="showmorebtn" style="background-color:black;">Show All</button>
    <input type="hidden" value="0" class="increasenumber"/>
    </div>
    <!-- /.active coin grid -->
</div>
<script> 
  $('.showmorebtn').click(function(){
    $(".page-load").removeClass('hidden');
    var value = parseInt($('.increasenumber').val(),10);
    value = isNaN(value) ? 0 : value;
    value++;
    $('.increasenumber').val(value);
    $.ajax({
      url: 'readmore',
      type: "get",
      data: { 
        incnumber:value
      },success: function(response){ 
        var result = JSON.parse(response);
        var len = result['detailinfo'].length;
        for(i=6;i<len;i++){
          var gridinfo0 = result['detailinfo'][i]['gridinfo0'];
          var gridinfo1 = result['detailinfo'][i]['gridinfo1'];
          var gridinfo2 = result['detailinfo'][i]['gridinfo2'];
          var gridinfo3 = result['detailinfo'][i]['gridinfo3'];
          var info1 = '.readmore'+(i+1)+' .gridday';
          var info2 = '.readmore'+(i+1)+' .gridweek';
          var info3 = '.readmore'+(i+1)+' .gridmon';
          var info4 = '.readmore'+(i+1)+' .gridyear';
          console.log(info1);

         
          $(info1).html(gridinfo0);
          $(info2).html(gridinfo1);
          $(info3).html(gridinfo2);
          $(info4).html(gridinfo3);
          $('.showmorebtn').addClass('hidden');
        }

        $(".page-load").addClass('hidden');
        var classname = '.coin-box';
        $(classname).removeClass('hidden');
      }
    });
  })
  
 
  
</script>
<?php //exit; ?> 