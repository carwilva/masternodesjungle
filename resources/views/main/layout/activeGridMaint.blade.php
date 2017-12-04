<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 active-grid-blade">
    <div class="mstr-coin-wrapper">
        <div class="row text-center">
            <div class="col-sm-3 col-xs-3 mstr-coin-icon mstr-top-quad">
                <a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}"><img src="{!! $one['logo'] !!}" width="50vw"></a>
            </div>
            <div class="col-sm-6 col-xs-6">
                <div class="col-sm-12 col-xs-12">
                    <a href="https://masternodes.pro/stats/{!! strtolower($one['coin']) !!}" style="text-decoration: none; color: rgb(66, 139, 202);">{!! $one['name'] !!} ({!! strtoupper($one['coin']) !!})</a>
                </div>
                <div class="col-sm-12">
                    <span class="mstr-coin-current-value text-right">$@if ($one['cmc']['price_usd'] < 0.01) {!! $one['cmc']['price_usd'] !!} @else {!!  number_format($one['cmc']['price_usd'],2,'.','') !!} @endif USD</span>
                    <span class="mstr-coin-pct-chg text-right" style=" color: @if($one['cmc']['percent_change_24h'] > 0) #009933 @else #D44836 @endif">({!! number_format($one['cmc']['percent_change_24h'],2,'.','') !!}%)</span>
                </div>
            </div>
            <div class="col-sm-3 col-xs-3 mstr-top-quad" style="padding-top: 2em;">
            </div>
        </div>
        <div class="row mstr-coin-stats">
            <div class="col-sm-12 text-center">
                Coin Currently Under Maintenance
            </div>
        </div>

        <div class="row mstr-node-stats">
            <div class="col-sm-12 text-center">
                Updating Database For Better Stats
            </div>
        </div>


        <div class="row mstr-coin-returns">
            <div class="col-sm-3 col-xs-3 text-center mstr-coin-table">
            </div>
        </div>
        <div class="row mstr-updated">
            <div class="col-sm-12 text-center">
                <br/>
                <label>{!! ucwords(__('main.lastUpdated')) !!}: October 9 2017 1:59:00 am EST</label>
            </div>
            {{--<div class="col-sm-12 text-center">--}}
                {{--@if ($one['tagable']['active'] === true)--}}
                    {{--<label>Notes: {!! $one['notes'] !!} </label>--}}
                {{--@endif--}}
            {{--</div>--}}
        </div>
    </div>
</div>
