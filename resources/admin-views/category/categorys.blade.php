
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">新闻栏目列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::categorys.create') }}" class="btn btn-sm btn-success">
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
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($categorys as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{$category->title}}</td>
                                <td>{{ $category->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin::categorys.edit',$category->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $category->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $categorys->appends($data)->links('admin::widgets.pagination') }}

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::categorys.index')])
@endsection
