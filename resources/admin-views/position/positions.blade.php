
@extends('admin::layouts.main')

@section('content')
    @include('admin::search.positions-positions')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">职位列表</h3>



                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::positions.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::positions.index')])

                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>职位标题</th>
                            <th>招聘人数</th>
                            <th>截止时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($positions as $position)
                            <tr>
                                <td>{{ $position->id }}</td>
                                <td>{{$position->title}}</td>
                                <td>{{$position->need}}</td>
                                <td>{{$position->endtime}}</td>
                                <td>
                                    <a href="{{ route('admin::positions.edit',$position->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $position->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $positions->appends($data)->links('admin::widgets.pagination') }}

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::positions.index')])
@endsection
