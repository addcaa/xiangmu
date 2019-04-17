@foreach($arr as $v)
        <div goods_id="{{$v->goods_id}}" class="dingdanlist" onClick="window.location.href='proinfo.html'">
            <table>
            <tr>
                <td colspan="2" width="65%">订单号：<strong>{{$v->order_no}}</strong></td>
                <td width="35%" align="right"><div class="qingqu"><a href="javascript:;" class="orange">订单取消</a></div></td>
            </tr>
            <tr>
                <td class="dingimg" width="15%"><img src="http://www.uploads.com/uploads/{{$v->goods_img}}" /></td>
                <td width="50%">
                <h3>{{$v->goods_name}}</h3>
                <time>下单时间：2015-08-11  13:51</time>
                </td>
                <td align="right"><img src="/index/images/jian-new.png" /></td>
            </tr>
            <tr>
                <th colspan="3"><strong class="orange">¥{{$v->order_num}}</strong></th>
            </tr>
            </table>
        </div><!--dingdanlist/-->
    @endforeach
