
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">App图文列表</h3>

                    <div class="btn-group pull-right">
                        @if($count<4)
                        <a href="{{ route('admin::appinfos.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                        @endif
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>标题</th>
                            <th>封面图</th>
                            <th>内容</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        @foreach($appinfos as $appinfo)
                            <tr>
                                <td>{{ $appinfo->id }}</td>
                                <td>{{$appinfo->title}}</td>
                                <td><img src ="{{ $appinfo->image }}" height="50" width="100" class="img-bordered"/></td>
                                <td>{{$appinfo->content}}</td>
                                <td>{{$appinfo->sort}}</td>
                                <td>
                                    <a href="{{ route('admin::appinfos.edit',$appinfo->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $appinfo->id }}" class="grid-row-delete">
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
    @include('admin::js.grid-row-delete', ['url' => route('admin::appinfos.index')])
@endsection
