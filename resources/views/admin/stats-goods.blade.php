@extends('layouts.admin-header')


@section('content')

<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 统计管理 <span class="c-gray en">&gt;</span> 商品销量 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="f-14 c-error"></div>
    <div>
        <form method="post">
                {{csrf_field()}}
                <div class="text-c"> 日期范围：
                    <input type="text" name="strt_time" onfocus="WdatePicker({ maxDate:'#F{$dp.$D(\'logmax\')||\'%y-%M-%d\'}' })" id="logmin" class="input-text Wdate" style="width:120px;">
                    -
                    <input type="text" name="end_time" onfocus="WdatePicker({ minDate:'#F{$dp.$D(\'logmin\')}',maxDate:'%y-%M-%d' })" id="logmax" class="input-text Wdate" style="width:120px;">
                    <input type="text" id="goods_name"  placeholder="商品名称或货号" style="width:220px" class="input-text">
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
    if (start_time > end_time) {
        alert('开始时间不能大于结束时间');
        return false;
    }
    if (start_time == end_time) {
        alert('开始时间不能等于结束时间');
        return false;
    }
    if (goods_name == '') {
        alert('请输入商品名称或货号');
        return false;
    }
    $.ajax({
        type:'post',
        url:'admin-stats-getGoods',
        data:{
            start_time:start_time,
            end_time:end_time,
            goods_name:goods_name
        },
        dataType:'json',
        success:function(msg){

        }
    })

})
$(function () {
    Highcharts.chart('container', {
        title: {
            text: '销量',
            x: -20 //center
        },
        subtitle: {
            text: 'Source: WorldClimate.com',
            x: -20
        },
        xAxis: {
            categories: ['一月', '二月', '三月', '四月', '五月', '六月','七月', '八月', '九月', '十月', '十一月', '十二月']
        },
        yAxis: {
            title: {
                text: 'Temperature (°C)'
            },
            plotLines: [{
                value: 0,
                width: 1,
                color: '#808080'
            }]
        },
        tooltip: {
            valueSuffix: '°C'
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'middle',
            borderWidth: 0
        },
        series: [{
            name: 'Tokyo',
            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
        }, {
            name: 'New York',
            data: [-0.2, 0.8, 5.7, 11.3, 17.0, 22.0, 24.8, 24.1, 20.1, 14.1, 8.6, 2.5]
        }, {
            name: 'Berlin',
            data: [-0.9, 0.6, 3.5, 8.4, 13.5, 17.0, 18.6, 17.9, 14.3, 9.0, 3.9, 1.0]
        }, {
            name: 'London',
            data: [3.9, 4.2, 5.7, 8.5, 11.9, 15.2, 17.0, 16.6, 14.2, 10.3, 6.6, 4.8]
        }]
    });
});
</script>
@stop