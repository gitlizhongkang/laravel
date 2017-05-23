<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>SHOP 管理中心 - 商品管理 </title>
	<link href="css/general.css" rel="stylesheet" type="text/css" />
	<link href="css/main.css" rel="stylesheet" type="text/css" />
	<script src="js/jquery-1.9.1.min.js"></script>
	<!--编辑器插件-->
	<script src="plug/ueditor/ueditor.config.js"></script>
	<script src="plug/ueditor/ueditor.all.min.js"></script>
	<script src="plug/ueditor/lang/zh-cn/zh-cn.js"></script>
	<script>
		$(function () {
		    //生成规格下拉列表
            var url = '{{url('/admin-goods-normsName')}}';
            var str = '<option value="">请选择商品规格</option>';
            $.getJSON(url,function (response) {
                $.each(response, function (k, v) {
                    str += '<option value="'+ k +'">'+ v +'</option>';
                });
                $('#norms_select').html(str);
            })
        });


		$(function(){

            //编辑器
            var ue = UE.getEditor('editor');


			//选项卡
			$('#tabbar-div p span').click(function(){
				$(this).removeClass('tab-back').addClass('tab-front').siblings().removeClass('tab-front').addClass('tab-back');
				var name = $(this).attr('id');
				$('#'+name+'le').show().siblings('table').hide();
				if(name == 'etalon-tab') {
					$('#box').show()
				} else {
					$('#box').hide()
				}
			});



			//添加规格节点
			$('.copy').click(function(){
				//克隆方法
				var _self = $(this).parents('tr');
				var clone = _self.clone();
                _self.after(clone);
                _self.next().find('a').html('[	-	]').removeClass('copy').addClass('remove');
                _self.next().find('span').html('');
			});
			$(document).on('click','.remove',function(){
				$(this).parents('tr').remove();
			});

			//选择规格生成规格值
			$(document).on('change','#norms_select',function(){
				var _self = $(this);
				var norms_id = _self.val();
                var str = '';
                var url = '{{url('/admin-goods-normsValue')}}';
				//如果是没有选择
				if(!norms_id)
				{
                    _self.next().html('');
					return false;
				}
				//选择
                $.getJSON(url, {norms_id: norms_id}, function(response) {
                    if (response.code == 1)
                    {
                        $.each(response.data, function(k, v){
                            str += '<input type="checkbox" name="normsValue['+ norms_id +'][]" value="'+ v +'">'+ v;
                        });
                        _self.next().html(str);
                    }
                    else if (response.code == 0)
					{
					    alert('数据失效 请重新选择规格');
					}
				})
			});



			//生成SKU表
			$('#sku').click(function(){
			    var url = "{{url('/admin-goods-createSku')}}";
				var str = '';
				//sku表字段名
				var norms = $('.norms_info select option:selected');

				//获取选中的所有的规格值（即选中的input）
				var sku = $(this).parents('tr').prevAll().find('input:checked');

                //将数据拼接成一个好处理的字符串传到后台
				for(var i = 0; i < sku.size(); i++)
				{
					var id = sku.eq(i).parent().prev().val();//规格id
					str += '|' + id + ',' + sku.eq(i).val();
				}
				str = str.substr(1);

                $.getJSON(url, {info: str}, function (response) {
                    $('#box').html(create(response,norms));
                });
			});

			//拼接sku表函数
			function create(data,norms)
			{
				var str = '';

				str +=  '<center><table style="width: 60%;"><tr>';
				//循环拼接表字段
				for (var i = 0; i < norms.length; i++)
				{
					str += '<th>' + norms.eq(i).html()+'</th>'
				}
				str +=  '<th>价格</th>'+
                    	'<th>库存</th>'+
						'<th>图片</th></tr>';
				//循环拼接表数据
				$.each(data,function(k,v){
				    str += '<tr align="center">';
					//本层循环和表字段循环相同
					$.each(v,function(e,a){
						str += '<td>'+a+'<input type="hidden" name="norms_value['+k+'][]" value="'+a+'"></td>';
					});

					str +=  '<td><input type="text" name="sku_price[] size="8"></td>'+
                        	'<td><input type="text" name="sku_num[] size="8"></td>'+
							'<td><input type="file"><input type="hidden" name="sku_img[]"></td></tr>';
				});
				str += '</table><center>';

				return str;
			}



            //商品属性改变事件生成属性值
            $('select[name="goods_type"]').change(function(){
                var cat_id = $(this).val();
                var str = '';
                $.ajax({
                    url:'',
                    data:{cat_id:cat_id},
                    dataType:'json',
                    success:function(data)
                    {
                        $.each(data,function(k,v){
                            if(v.attr_input_type == 0)
                            {
                                str +=  '<tr>'+
                                    '<td class="label">'+v.attr_name+'</td>'+
                                    '<td>'+
                                    '<input name="attr_values['+v.attr_id+']['+v.attr_name+']" type="text" size="40">'+
                                    '</td></tr>';
                            }
                            else
                            {
                                str +=  '<tr>'+
                                    '<td class="label">'+v.attr_name+'</td>'+
                                    '<td>'+
                                    '<select name="attr_values['+v.attr_id+']['+v.attr_name+']">';
                                $.each(v.attr_values,function(e,a){
                                    str += '<option>'+ a +'</option>';
                                });
                                str +=  '</select></td></tr>';
                            }
                        });
                        $('#attrTable').html(str);
                    }
                })
            });



            //图片预览
			$(document).on('change','.img',function(){
				var url = window.URL.createObjectURL(this.files[0]);
				if(url) {
					$('#img').attr('src',url);
				}
			});


		})
	</script>
</head>


<body>
<h1>
	<span class="action-span"><a href="">商品列表</a></span>
	<span class="action-span1"><a href="">SHOP 管理中心 </a> </span>
	<span id="search_id" class="action-span1"> - 编辑商品信息 </span>
	<div style="clear:both"></div>
</h1>

<div class="tab-div">
	<!-- tab bar -->
	<div id="tabbar-div">
		<p>
			<span class="tab-front" id="general-tab">基本信息</span>
			<span class="tab-back" id="etalon-tab">商品规格</span>
			<span class="tab-back" id="properties-tab">商品属性</span>
			<span class="tab-back" id="gallery-tab">商品相册</span>
			<span class="tab-back" id="detail-tab">详细描述</span>
		</p>
	</div>

	<!-- tab body -->
	<div id="tabbody-div">
		<form action="" method="post" enctype="multipart/form-data">

			<!-- 通用信息 -->
			<table id="general-table" align="center">
				<tr>
					<td class="label">商品名称：</td>
					<td><input type="text" name="goods_name" size="30"><span class="require-field">*</span></td>
				</tr>
				<tr>
					<td class="label">商品最低价：</td>
					<td><input type="text" name="goods_low_price" size="20" placeholder="int"><span class="require-field">*</span></td>
				</tr>
				<tr>
					<td class="label">商品分类：</td>
					<td>
						<select name="category_id">
							<option value="">请选择...</option>

						</select>
					</td>
				</tr>
				<tr>
					<td class="label">商品品牌：</td>
					<td>
						<select name="brand_id">
							<option value="">请选择...</option>

						</select>
					</td>
				</tr>
				<tr>
					<td class="label">商品特性：</td>
					<td>
						<input type="checkbox" name="is_point" value="1">积分商品
						<input type="checkbox" name="is_second" value="1">秒杀商品
						<input type="checkbox" name="is_on_sale" value="1">秒杀商品
					</td>
				</tr>
			</table>

			<!-- 商品规格 -->
			<table id="etalon-table" style="display: none;" align="center">
				<tr class="norms_info">
					<td>
						<a href="javascript:void(0)" class="copy">[	+	]</a>
						<select id="norms_select"></select>
						<span></span>
					</td>
				</tr>
				<tr>
					<td>
						<input type="button" id="sku" value="生成SKU" class="button">
					</td>
				</tr>
			</table>
			<div id="box" class="list-div" style="display: none"></div>

			<!--商品属性-->
			<table id="properties-table" style="display: none;" align="center">
				<tr>
					<td class="label">商品类型：</td>
					<td>
						<select name="goods_type">
							<option value="">请选择商品类型</option>

						</select>
						<br>
						<span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<tbody width="80%" id="attrTable">

						</tbody>
					</td>
				</tr>
			</table>

			<!-- 商品相册 -->
			<table id="gallery-table" style="display: none;" align="center">
				<tr>
					<td>
						<div style="float:left; margin: 4px; padding:2px;">
							<img  id="img" src="" width="100" height="100" border="0" >
						</div>
					</td>
				</tr>
				<tr></tr>
				<tr>
					<td>
						<a href="javascript:void(0)" class="copy">[	+	]</a>
						图片描述 <input type="text" name="img_desc[]" size="30">
						上传文件 <input type="file" name="img_url[]" class="img">
					</td>
				</tr>
			</table>

			<!-- 详细描述 -->
			<table width="90%" id="detail-table" style="display: none;" align="center">
				<tr>
					<td align="center"><textarea name="goods_desc" id="editor"></textarea></td>
				</tr>
			</table>

			<!--提交-->
			<div class="button-div">
				<input type="submit" value=" 确定 " class="button">
				<input type="reset" value=" 重置 " class="button">
			</div>
		</form>
	</div>
</div>


<div id="footer">
	版权所有 &copy; 20015-2017
</div>

</body>
</html>