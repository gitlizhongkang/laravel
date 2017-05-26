@include('h_layouts.left')
<div class="route_bg">
    <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="#">数据统计</a>
</div>

<div class="operating">
<span><input class="Wdate" type="text" onClick="WdatePicker()" id="datek"> </span>————
<span><input class="Wdate" type="text" onClick="WdatePicker()" id="datez"> </span>
<span><button id='hunting'>搜索</button></span>
</div>

<div class="content">
	<form name='admin_list' method='post' action=''>
		<table class="list_table">
			<colgroup>
				<col width="80px" />
				<col width="80px" />
				<col />
			</colgroup>
			<div id='replace'>
					 
			</div>
		</table>
	</form>
</div>
		</div>
	</div>
 
<script>
$("#hunting").click(function()
{
	datek = $('#datek').val();
	datez = $('#datez').val();
	$.ajax({
            url  :  "admin-count-count",
            type :  'post',
            data :  {_token:'{{csrf_token()}}',datek:datek,datez:datez},
				
            success:function(data)
            {
				var str = '';
				str  += '<table>';
            	str += '<th>订单数量</th>';
            	str += '<th></th><th></th><th></th>';
				str += '<th>销售总额</th>';
            	str += '<tbody>';
				str += '<tr>';	
				str += '<td>'+data.indent+'</td>';	
				str += '<td></td><td></td><td></td>';		
				str += '<td>'+data.money+'</td>';					
				str += '</tr>';				
				str += '</tbody>';	
				str += '</table>';
            	
            	$("#replace").html(str)
            }
        })
})
</script>

@include('h_layouts.next')

			
			


