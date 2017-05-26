@include('h_layouts.left')
<div class="route_bg">
    <a href="#">主页</a><i class="glyph-icon icon-chevron-right"></i>
    <a href="#">权限管理</a>
</div>
<div class="operating">
		<a href="{{url('/admin-index-add_admin')}}"><button type="button"><span class="addition">添加管理员</span></button></a>
		<!-- <a href="javascript:void(0)" onclick="selectAll('id[]');"><button class="operating_btn" type="button"><span class="sel_all">全选</span></button></a>
		<a href="javascript:void(0)" onclick="delModel({msg:'是否把信息放到回收站内？'});"><button class="operating_btn" type="button"><span class="delete">批量删除</span></button></a>
		<a href="javascript:void(0)" onclick="event_link('/gs/max_one/iwebshop/index.php?controller=system&amp;action=admin_recycle')"><button class="operating_btn" type="button">
		<span class="recycle">回收站</span></button></a> -->
	</div>

<div class="content">
	<form name='admin_list' method='post' action=''>
		<table class="list_table">
			<colgroup>
				<col width="150px" />
				<col width="150px" />
				<col width="150px" />
				<col width="200px" />
				<col />
			</colgroup>
			<thead>
				<tr>
					<th>用户名</th>
					<th>角色</th>
					<th>上次登录IP</th>
					<th>上次登录时间</th>
					<th>操作</th>
				</tr>
			</thead>
			<tbody>
			@foreach($data as $val)
				<tr>
					<td>{{$val->admin_name}}</td>
					<td>{{$val->name}}</td>
					<td>{{$val->last_ip}}</td>
					<td>{{$val->last_time}}</td>
					<td>
						<a href='#'><img class="operator" src=" " alt="编辑" title="编辑" /></a>
						<a href='#'><img class="operator" src="" alt="删除" title="删除" /></a>
					</td>
				</tr>
			@endforeach
			</tbody>
		</table>
	</form>
</div>
		</div>
	</div>
 
@include('h_layouts.next')