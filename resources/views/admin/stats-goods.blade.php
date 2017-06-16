@extends('layouts.admin-header')


@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 统计管理 <span class="c-gray en">&gt;</span> 商品销量 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="f-14 c-error"></div>
    <div>
        <form method="post">
                <div class="text-c"> 日期范围：
                    <input type="text" name="strt_time" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text" name="end_time" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" id="goods_name"  placeholder="商品名称" style="width:220px" class="input-text">
                    <button class="btn btn-success" type="button"><i class="Hui-iconfont">&#xe665;</i> 搜产品</button>
                </div>
        </form>
    </div>
	<div id="container" style="min-width:700px;height:400px;display: none"></div>
</div>
@stop


@section('js')
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="plug/hadmin/lib/hcharts/Highcharts/5.0.6/js/highcharts.js"></script>
<script type="text/javascript" src="plug/hadmin/lib/hcharts/Highcharts/5.0.6/js/modules/exporting.js"></script>
<script type="text/javascript" src="plug/hadmin/lib/My97DatePicker/4.8/WdatePicker.js"></script>
<script type="text/javascript">
$('button').click(function(){
    var start_time = $('#logmin').val();
    var end_time = $('#logmax').val();
    var goods_name = $('#goods_name').val();
    if (start_time == '' || end_time == '') {
        alert('请输入查询范围');
        return false;
    }
    if (goods_name == '') {
        alert('请输入商品名称');
        return false;
    }
    $.ajax({
        type:'post',
        url:'admin-stats-getGoods',
        data:{
            start_time:start_time,
            end_time:end_time,
            goods_name:goods_name,
            _token:"{{csrf_token()}}"
        },
        dataType:'json',
        success:function(msg){
            if (msg.error == 0) {
                
                $('#container').show();
                Highcharts.chart('container', {
                    title: {
                        text: goods_name+'销量',
                        x: -20 //center
                    },
                    subtitle: {
                        text: start_time + ' -- ' + end_time,
                        x: -20
                    },
                    xAxis: {
                        categories: msg.date
                    },
                    yAxis: {
                        title: {
                            text: 'num (件)'
                        },
                        tickInterval: 10000, //基线宽度
                        plotLines: [{
                            value: 0,
                            width: 1,
                            color: '#808080'
                        }]
                    },
                    tooltip: {
                        valueSuffix: '件'
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: msg.data
                });
            } else {
                alert(msg.message);
            }
        }
    })

})

</script>
@stop