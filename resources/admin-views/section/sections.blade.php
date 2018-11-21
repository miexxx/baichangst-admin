
@extends('admin::layouts.main')

@section('content')


    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">部门列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::sections.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>部门名称</th>
                            <th>部门联系人</th>
                            <th>部门联系电话</th>
                            <th>部门联系邮箱</th>
                            <th>排序</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{$section->title}}</td>
                                <td>{{$section->contacts}}</td>
                                <td>{{$section->tel}}</td>
                                <td>{{$section->email}}</td>
                                <td>{{$section->sort}}</td>
                                <td>{{ $section->created_at }}</td>
                                <td>
                                    <a href="{{ route('admin::sections.edit',$section->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $section->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $sections->appends($data)->links('admin::widgets.pagination') }}

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::sections.index')])
@endsection
