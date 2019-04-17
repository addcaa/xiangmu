<div class="prolist" id="show">
    @foreach($goodsInfo as $v)
        <dl brand_id="{{$v->brand_id}}" goods_sales="{{$v->goods_sales}}">
            <dt><a href="proinfo{{$v->goods_id}}"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" width="100" height="100" /></a></dt>
            <dd>
                <h3><a href="proinfo{{$v->goods_id}}">{{$v->goods_name}}</a></h3>
                <div class="prolist-price"><strong>¥{{$v->goods_price}}</strong> <span>¥{{$v->market_price}}</span></div>
                <div class="prolist-yishou"><span>5.0折</span> <em>已售：{{$v->goods_sales}}</em></div>
            </dd>
            <div class="clearfix"></div>
        </dl>
    @endforeach
</div>
