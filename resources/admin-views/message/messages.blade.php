
@extends('admin::layouts.main')

@section('content')

    @include('admin::search.messages-messages')

    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">申请列表</h3>

                    @include('admin::widgets.filter-btn-group', ['resetUrl' => route('admin::messages.index')])
                </div>

                <div class="box-body table-responsive no-padding">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>申请人姓名</th>
                            <th>申请人性别</th>
                            <th>申请人联系方式:tel</th>
                            <th>加盟形式</th>
                            <th>查看状态</th>
                            <th>申请时间</th>
                            <th>操作</th>
                        </tr>
                        @foreach($messages as $message)
                            <tr>
                                <td>{{ $message->id }}</td>
                                <td>{{ $message->name }}</td>
                                <td>{{ $message->sex }}</td>
                                <td>{{ $message->tel }}</td>
                                <td>@if($message->type == 1)个人@elseif($message->type==2)企业@endif</td>
                                <td><span class="badge bg-red">@if($message->state ==0) 未查看@elseif($message->state==1)已查看 @endif</span></td>
                                <td>{{$message->created_at}}</td>
                                <td>
                                    <a href="{{route('admin::messages.show',$message->id)}}">
                                        <i class="fa fa-eye"></i>
                                    </a>
                                    <a href="javascript:void(0);" data-id="{{$message->id}}" class="grid-row-delete">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="box-footer">
                    {{ $messages->appends($data)->links('admin::widgets.pagination') }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('script')
    @include('admin::js.grid-row-delete', ['url' => route('admin::messages.index')])
@endsection
