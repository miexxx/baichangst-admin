@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">站点配置</h3>
                    <div class="box-tools">

                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::base.update', $base->id) }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目一</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="cone" name="cone" value="{{$base->cone}}" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目二</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="ctwo" name="ctwo" value="{{$base->ctwo}}" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目一</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="stwof" name="stwof" value="{{$base->stwof}}" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目二</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="stwos" name="stwos" value="{{$base->stwos}}" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目三</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="stwot" name="stwot" value="{{$base->stwot}}" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目四</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="stwox" name="stwox" value="{{$base->stwox}}" class="form-control" >
                                    </div>
                                </div>

                            </div>


                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目三</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="cthree" name="cthree" value="{{$base->cthree}}" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目四</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="cfour" name="cfour" value="{{$base->cfour}}" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目五</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="cfive" name="cfive" value="{{$base->cfive}}" class="form-control" >
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页栏目六</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="csix" name="csix" value="{{$base->csix}}" class="form-control" >
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目一</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="ssixf" name="ssixf" value="{{$base->ssixf}}" class="form-control" >
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目二</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="ssixs" name="ssixs" value="{{$base->ssixs}}" class="form-control" >
                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-3 control-label">子栏目三</label>
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="ssixt" name="ssixt" value="{{$base->ssixt}}" class="form-control" >
                                    </div>
                                </div>

                            </div>





                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">重置
                                </button>
                        </div>

                        <div class="btn-group pull-right">
                            <span id="prompt-info" style="color:#f00;"></span>
                            <button type="button" id="submit-btn"  class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(function () {
            $('.form-history-back').on('click', function (event) {
                event.preventDefault();
                location.reload();
            });


            $('#submit-btn').on('click', function (event) {
                $('#post-form').submit();

            });
            @if (count($errors) > 0)

            swal("提交失败！","请检查提交数据是否正确！","error");
            @endif



        });
    </script>
@endsection