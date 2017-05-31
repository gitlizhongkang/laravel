@extends('layouts.admin-header')


@section('content')
    <style>
        #tabbar-div {
            background: black;
            padding-left: 20px;
            height: 25px;
            padding-top: 1px;
            border-radius: 4px;
        }

        .tab-front {
            background: #8c8c8c;
            line-height: 25px;
            padding: 2px 10px;
            border: 1px solid #FFF;
            cursor: hand;
            cursor: pointer;
        }

        .tab-back {
            color: #FFF;
            line-height: 25px;
            padding: 2px 10px;
            border-right: 1px solid #FFF;
            cursor: hand;
            cursor: pointer;
        }
    </style>

    <div>
        <nav class="breadcrumb">
            <i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 产品管理 <span class="c-gray en">&gt;</span>
            产品列表
            <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px"
               href="javascript:location.replace(location.href);" title="刷新">
                <i class="Hui-iconfont">&#xe68f;</i>
            </a>
        </nav>
        <form action="{{url('/admin-goods-add')}}" method="post" enctype="multipart/form-data">
            <div class="page-container">
                <div class="cl pd-5 bg-1 bk-gray mt-20">
                    <span class="l">
                        <input type="submit" value="添 加" class="btn btn-primary radius">
                        <input type="reset" value="重 置" class="btn btn-danger radius">
                    </span>
                </div>

                <!-- tab bar -->
                <div id="tabbar-div">
                    <p>
                        <span class="tab-front" id="general-tab">基本信息</span>
                        <span class="tab-back" id="properties-tab">商品属性</span>
                        <span class="tab-back" id="etalon-tab">商品规格</span>
                        <span class="tab-back" id="gallery-tab">商品相册</span>
                        <span class="tab-back" id="detail-tab">详细描述</span>
                    </p>
                </div>
                <!-- tab bar -->

                <center>
                    <div>
                        <input type="hidden" name="_token" value="{{csrf_token()}}">

                        <!-- 通用信息 -->
                        <table id="general-table" style="margin-left:20%" class="table table-bg">
                            <tr><td>
                                    <label>商品名称：</label>
                                    <input type="text" name="goods_name" size="30" required>
                                </td></tr>
                            <tr><td>
                                    <label>商品最低价：</label>
                                    <input type="text" name="goods_low_price" size="20" placeholder="int" required>
                                </td></tr>
                            <tr><td>
                                    <label>商品分类：</label>
                                    <select name="category_info" required></select>
                                </td></tr>
                            <tr><td>
                                    <label>商品品牌：</label>
                                    <select name="brand_info" required></select>
                                </td></tr>
                            <tr><td>
                                    <label>商品主图：</label>
                                    <input type="file" name="goods_img" required>
                                </td></tr>
                            <tr><td>
                                    <label>商品特性：</label>
                                    <input type="checkbox" name="is_on_sale" value="1" checked>上架商品
                                    <input type="checkbox" name="is_point" value="1">积分商品
                                    <input type="checkbox" name="is_second" value="1">秒杀商品
                                    <input type="checkbox" name="is_hot" value="1">热卖商品
                                </td></tr>
                        </table>

                        <!--商品属性-->
                        <table id="properties-table" style="display: none; margin-left:20%" class="table table-bg">
                            <tr><td>
                                    <label>商品类型：</label>
                                    <select id="goods_type" required></select>
                                    <br>
                                    <span class="notice-span" style="display:block" id="noticeGoodsType">请选择商品的所属类型，进而完善此商品的属性</span>
                                </td></tr>
                            <tr><td align="center">
                                    <tbody width="80%" id="attr_table">

                                    </tbody>
                                </td></tr>
                        </table>

                        <!-- 商品规格 -->
                        <table id="etalon-table" style="display: none; margin-left:20%" class="table table-bg">
                            <tr class="norms_info"><td>
                                    <a href="javascript:void(0)" class="copy">[ + ]</a>
                                    <select id="norms_select" required></select>
                                    <span></span>
                                </td></tr>
                            <tr><td>
                                    <input type="button" id="sku" value="生成SKU" class="btn btn-primary radius">
                                </td></tr>
                        </table>
                        <div id="box" class="list-div" style="display: none"></div>

                        <!-- 商品相册 -->
                        <table id="gallery-table" style="display: none; margin-left:20%" class="table table-bg">
                            <tr><td>
                                    <div style="float:left; margin: 4px; padding:2px;">
                                        <img id="img" src="" width="100" height="100" border="0">
                                    </div>
                                </td></tr>
                            <tr><td>
                                    <a href="javascript:void(0)" class="copy">[ + ]</a>
                                    上传文件 <input type="file" name="img_url[]" class="img" required>
                                    <input type="text" name="img_desc[]" placeholder="文件描述" required>
                                </td></tr>
                        </table>

                        <!-- 详细描述 -->
                        <table id="detail-table" style="display: none;">
                            <tr>
                                <td align="center"><textarea name="goods_desc" id="editor"></textarea></td>
                            </tr>
                        </table>
                    </div>
                </center>
            </div>
        </form>

    </div>

@stop


@section('js')
    <!--编辑器插件-->
    <script src="plug/ueditor/ueditor.config.js"></script>
    <script src="plug/ueditor/ueditor.all.min.js"></script>
    <script src="plug/ueditor/lang/zh-cn/zh-cn.js"></script>

    <script>
        //生成分类下拉表
        $(function () {
            var url = '{{url('/admin-goods-category')}}';
            var str = '<option value="">请选择商品分类</option>';
            $.getJSON(url, function (response) {
                $.each(response, function (k, v) {
                    str += '<option value="' + v.category_id + '|' + v.category_name + '">' + v.category_name + '</option>';
                });
                $('select[name="category_info"]').html(str);
            })
        });

        //生成品牌下拉表
        $(function () {
            var url = '{{url('/admin-goods-brand')}}';
            var str = '<option value="">请选择商品品牌</option>';
            $.getJSON(url, function (response) {
                $.each(response, function (k, v) {
                    str += '<option value="' + v.brand_id + '|' + v.brand_name + '">' + v.brand_name + '</option>';
                });
                $('select[name="brand_info"]').html(str);
            })
        });

        //生成规格下拉表
        $(function () {
            var url = '{{url('/admin-goods-normsName')}}';
            var str = '<option value="">请选择商品规格</option>';
            $.getJSON(url, function (response) {
                $.each(response, function (k, v) {
                    str += '<option value="' + k + '">' + v + '</option>';
                });
                $('#norms_select').html(str);
            })
        });

        //生成属性类型下拉表
        $(function () {
            var url = '{{url('/admin-goods-attributesType')}}';
            var str = '<option value="">请选择属性类型</option>';
            $.getJSON(url, function (response) {
                $.each(response, function (k, v) {
                    str += '<option value="' + k + '">' + v + '</option>';
                });
                $('#goods_type').html(str);
            })
        });


        $(function () {
            //编辑器
            var ue = UE.getEditor('editor');

            //选项卡
            $('#tabbar-div p span').click(function () {
                $(this).removeClass('tab-back').addClass('tab-front').siblings().removeClass('tab-front').addClass('tab-back');
                var name = $(this).attr('id');
                $('#' + name + 'le').show().siblings('table').hide();
                if (name == 'etalon-tab') {
                    $('#box').show()
                } else {
                    $('#box').hide()
                }
            });


            //添加规格节点
            $('.copy').click(function () {
                //克隆方法
                var _self = $(this).parents('tr');
                var clone = _self.clone();
                _self.after(clone);
                _self.next().find('a').html('[	-	]').removeClass('copy').addClass('remove');
                _self.next().find('span').html('');
            });

            $(document).on('click', '.remove', function () {
                $(this).parents('tr').remove();
            });

            //选择规格生成规格值
            $(document).on('change', '#norms_select', function () {
                var _self = $(this);
                var norms_id = _self.val();
                var str = '';
                var url = '{{url('/admin-goods-normsValue')}}';

                //如果是没有选择
                if (!norms_id) {
                    _self.next().html('');
                    return false;
                }

                //选择
                $.getJSON(url, {norms_id: norms_id}, function (response) {
                    if (response.code == 1) {
                        $.each(response.norms_value, function (k, v) {

                            str += '<input type="checkbox" name="norms_value[' + response.norms_name + '][]" value="' + v + '">' + v + '   ';

                        });
                        _self.next().html(str);
                    }
                    else if (response.code == 0) {
                        alert('数据失效 请重新选择规格');
                    }
                })
            });


            //生成SKU表
            $('#sku').click(function () {
                var url = "{{url('/admin-goods-createSku')}}";
                var str = '';

                //sku表字段名
                var norms = $('.norms_info select option:selected');

                //获取选中的所有的规格值（即选中的input）
                var sku = $(this).parents('tr').prevAll().find('input:checked');

                //将数据拼接成一个好处理的字符串传到后台
                for (var i = 0; i < sku.size(); i++) {
                    var id = sku.eq(i).parent().prev().val();//规格id
                    str += '|' + id + ',' + sku.eq(i).val();
                }
                str = str.substr(1);

                $.getJSON(url, {info: str}, function (response) {
                    $('#box').html(create(response, norms));
                });
            });

            //拼接sku表函数
            function create(data, norms) {
                var str = '';

                str += '<center><table style="width: 60%;" class="table table-bg table-hover table-sort"><tr>';
                //循环拼接表字段
                for (var i = 0; i < norms.length; i++) {
                    str += '<th>' + norms.eq(i).html() + '</th>'
                }
                str += '<th>价格</th>' +
                    '<th>库存</th>' +
                    '<th>规格图片</th></tr>';
                //循环拼接表数据
                $.each(data, function (k, v) {

                    str += '<tr align="center">';
                    //本层循环和表字段循环相同
                    $.each(v, function (e, a) {
                        str += '<td>' + a + '<input type="hidden" name="sku_norms[' + k + '][]" value="' + a + '"></td>';
                    });

                    str += '<td><input type="text" name="sku_price[] size="8" required></td>' +
                        '<td><input type="text" name="sku_num[] size="8" required></td>' +
                        '<td><input type="file" class="ajax_upload"><input type="hidden" name="sku_img[]" id="sku' + k + '"></td></tr>';
                });
                str += '</table><center>';

                return str;
            }

            //ajax上传sku图片
            $(document).on('change', '.ajax_upload', function () {
                var id = $(this).next().attr('id');

                var img = new FormData();
                img.append("file", $(this).get(0).files[0]);
                img.append("_token", "{{csrf_token()}}");
                $.ajax({
                    type: 'post',
                    url: "{{url('/admin-goods-skuImg')}}",
                    processData: false,
                    contentType: false,
                    data: img,
                    dataType: 'json',
                    success: function (responses) {
                        if (responses.code == 1) {
                            $("#" + id).attr("value", responses.file)
                        }
                        else if (responses.code == 0) {
                            alert(responses.msg);
                        }
                    }
                })


            });


            //商品属性改变事件生成属性值
            $('#goods_type').change(function () {
                var str = '';
                var category_id = $(this).val();
                var url = "{{url('/admin-goods-attributes')}}";

                if (category_id == '')    return false;

                $.getJSON(url, {category_id: category_id}, function (response) {
                    $.each(response, function (k, v) {
                        if (v.attr_value == '') {
                            str += '<tr>' +
                                '<td>' +
                                '<label">' + v.attr_name + ': </label>' +
                                '<input name="attr_value[' + v.attr_name + ']" type="text" size="40" required>' +
                                '</td></tr>';
                        }
                        else {
                            str += '<tr>' +
                                '<td>' +
                                '<label">' + v.attr_name + ': </label>' +
                                '<select name="attr_value[' + v.attr_name + ']" required>';
                            $.each(v.attr_value, function (e, a) {
                                str += '<option>' + a + '</option>';
                            });
                            str += '</select></td></tr>';
                        }
                    });
                    $('#attr_table').html(str);
                });
            });


            //图片预览
            $(document).on('change', '.img', function () {
                var url = window.URL.createObjectURL(this.files[0]);
                if (url) {
                    $('#img').attr('src', url);
                }
            });//方法结束

        })
    </script>

@stop

