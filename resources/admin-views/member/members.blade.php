
@extends('admin::layouts.main')

@section('content')

    @include('admin::search.members-members')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">加盟成员列表</h3>

                    <div class="btn-group pull-right">
                        <a href="{{ route('admin::members.create') }}" class="btn btn-sm btn-success">
                            <i class="fa fa-save"></i>&nbsp;&nbsp;新增
                        </a>
                    </div>
                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::members.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Logo</th>
                            <th>企业名</th>
                            <th>企业联系人</th>
                            <th>企业联系:tel</th>
                            <th>企业详细地址</th>
                            <th>排序</th>
                            <th>操作</th>
                        </tr>
                        @foreach($members as $member)
                            <tr>
                                <td>{{ $member->id }}</td>
                                <td><img src ="{{ $member->logo }}" height="50" width="50" class="img-bordered"/></td>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->contacts }}</td>
                                <td>{{ $member->tel }}</td>
                                <td>{{ $member->adrdetail }}</td>
                                <td>{{$member->sort}}</td>
                                <td>
                                    <a href="{{ route('admin::members.edit',$member->id)}}">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{ $member->id }}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $members->appends($data)->links('admin::widgets.pagination') }}

                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::members.index')])
@endsection
