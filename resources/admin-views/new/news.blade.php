
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">新闻列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::news.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>新闻标题</th>
                            <th>所属栏目</th>
                            <th>新闻发布者</th>
                            <th>浏览次数</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($news as $new)
                            <tr>
                                <td>{{ $new->id }}</td>
                                <td>{{$new->title}}</td>
                                <td>{{$new->category->title}}</td>
                                <td>{{$new->host}}</td>
                                <td>{{$new->views}}</td>
                                <td>{{ $new->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin::news.edit',$new->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $new->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $news->appends($data)->links('admin::widgets.pagination') }}

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::news.index')])
@endsection
