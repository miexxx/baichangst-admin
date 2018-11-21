
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">foot列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::foots.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>url</th>
                            <th>类型</th>
                            <th>操作</th>
                        </tr>
                        @foreach($foots as $foot)
                            <tr>
                                <td>{{ $foot->id }}</td>
                                <td>{{$foot->title}}</td>
                                <td>{{$foot->url }}</td>
                                <td>@if($foot->type ==0)友情链接@else合作伙伴@endif</td>
                                <td>
                                    <a href="{{ route('admin::foots.edit',$foot->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $foot->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::foots.index')])
@endsection
