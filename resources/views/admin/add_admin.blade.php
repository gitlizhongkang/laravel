@include('h_layouts.left')
<body>
<div class="route_bg">
    <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="#">权限管理</a>
</div>
<div class="content_box">
	<div class="content form_content">
		<form action="{{url('/admin-index-begin_add')}}"  method="post" >
			<table>
				<col width="150px" /><col/>
				<tr>
					<th>用户名：</th>
					<td>
						<input type='text' name='admin_name'>
					</td>
				</tr>
				<tr name="pwd">
					<th>密码：</th>
					<td>
						<input type='password' name='admin_pwd' >
					</td>
				</tr>
				<tr>
					<th>角色：</th>
					<td>
						<select name='part'  alt='请选择一个角色'>
							<?php foreach ($data as $key => $value): ?>
							<option value='<?php echo $value['name']?>'><?php echo $value['name']?></option>	
							<?php endforeach ?>
						</select>
					</td>
				</tr>
				<tr><td></td>
					<td><button class="submit" type="submit"><span>保 存</span></button></td>
				</tr>
			</table>
		</form>
	</div>
</div>
		</div>
	</div>
</body>
@include('h_layouts.next')
