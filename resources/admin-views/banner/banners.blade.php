
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">轮播图列表</h3>

                    <div class="btn-group pull-right">
                        @if($count<4)
                        <a href="{{ route('admin::banners.create') }}" class="btn btn-sm btn-success">
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
                            <th>轮播图标题</th>
                            <th>轮播图封面图</th>
                            <th>轮播图链接地址</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        @foreach($banners as $banner)
                            <tr>
                                <td>{{ $banner->id }}</td>
                                <td>{{$banner->title}}</td>
                                <td><img src ="{{ $banner->image }}" height="50" width="100" class="img-bordered"/></td>
                                <td>{{$banner->url}}</td>
                                <td>{{$banner->sort}}</td>
                                <td>
                                    <a href="{{ route('admin::banners.edit',$banner->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $banner->id }}" class="grid-row-delete">
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
    @include('admin::js.grid-row-delete', ['url' => route('admin::banners.index')])
@endsection
