@extends('layouts.admin-header')


@section('content')

    <div>
        <div class="page-container">
            <span class="r">共有数据：<strong>{{count($dataGoodsSku)}}</strong> 条</span>
        </div>

        <div class="mt-20">
                <table class="table table-border table-bordered table-bg table-hover table-sort">
                    <thead>
                    <tr class="text-c">
                        <th><input name="" type="checkbox" value=""></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataGoodsSku as $val)
                        <tr class="text-c va-m" id="{{$val->sku_id}}">
                            <td><input type="checkbox"></td>
                            <td>{{$val->sku_id}}</td>
                            <td>{{$val->goods_id}}</td>
                            <td>{{$val->sku_sn}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
    </div>

@stop


@section('js')
    @permission('update')
    @endpermission
@endsection
