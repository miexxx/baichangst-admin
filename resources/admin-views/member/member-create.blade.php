@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">创建</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="{{ route('admin::members.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                        </div> <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::members.store') }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">加盟企业名</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="name" name="name" value="" class="form-control" placeholder="输入 加盟企业名">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">企业联系人</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="contacts" name="contacts" value="" class="form-control" placeholder="输入 企业联系人">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">企业联系方式：tel</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="tel" name="tel" value="" class="form-control" placeholder="输入 企业tel">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">企业联系方式：email</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="email" name="email" value="" class="form-control" placeholder="输入 企业email">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">企业邮编</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="postcode" name="postcode" value="" class="form-control" placeholder="输入 企业邮编">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">排序</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="sort" name="sort" value="" class="form-control" placeholder="输入 排序">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="covers" class="col-sm-2 control-label">Logo</label>
                                <div class="col-sm-8">
                                    <input type="file" class="logo" name="logo" id="covers" multiple accept="image/*">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="category_id" class="col-sm-2 control-label">企业地区</label>
                                <div class="col-sm-2">
                                    <select class="form-control province" style="width: 100%;" name="province" data-placeholder="选择 省份"  >
                                        <option value="">请选择</option>
                                        @foreach($provinces as $province)
                                            <option value="{{ $province->address_id }}" >{{ $province->address_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control city" style="width: 100%;" name="city" data-placeholder="选择 市区"  >

                                        <option value="">请选择</option>
                                    </select>
                                </div>
                                <div class="col-sm-2">
                                    <select class="form-control county" style="width: 100%;" name="county" data-placeholder="选择 县城"  >
                                        <option value="">请选择</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">企业详细地址</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="adrdetail" name="adrdetail" value="" class="form-control" placeholder="输入 企业详细地址">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="sn" class="col-sm-2 control-label">经纬度</label>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="xpoint" name="xpoint" value="" class="form-control" placeholder="输入经度 可选">
                                    </div>
                                </div>
                                <div class="col-sm-3">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="ypoint" name="ypoint" value="" class="form-control" placeholder="输入纬度 可选">
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                    <div class="box-footer">
                        <div class="btn-group pull-left">
                            <button type="reset" class="btn btn-warning">重置</button>
                        </div>
                        <div class="btn-group pull-right">
                            <button type="submit" id="submit-btn" class="btn btn-info pull-right" data-loading-text="<i class='fa fa-spinner fa-spin'></i> 提交">提交</button>
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
                history.back();
            });


            $(".logo").fileinput({
                initialPreviewAsData: true,
                browseLabel: "浏览",
                showRemove: false,
                showUpload: false,
                allowedFileTypes: [
                    "image"
                ]
            });

            function Init(node) {
                return node.html("<option value=\"\">请选择</option>");
            }



            $(".province").change(function () {
                //清空二三级
                Init($(".city"));
                Init($(".county"));
                var id = $(this).val();
                $.ajax({
                    type:"get",
                    dataType:"json",
                    url:"/addresss/"+id,
                    success: function(data){
                        var str=" <option value=\"\">请选择</option>";
                        for(var i=0;i<data.length;i++){
                            str = str+" <option value='"+data[i].address_id+"'>"+data[i].address_name+"</option>"
                        }
                        $(".city").html(str);
                    }
                });

            });


            $(".city").change(function () {
                var id = $(this).val();
                $.ajax({
                    type:"get",
                    dataType:"json",
                    url:"/addresss/"+id,
                    success: function(data){
                        var str=" <option value=\"\">请选择</option>";
                        for(var i=0;i<data.length;i++){
                            str = str+" <option value='"+data[i].address_id+"'>"+data[i].address_name+"</option>"
                        }
                        $(".county").html(str);
                    }
                });
            });

            $("#submit-btn").click(function () {
                var $form = $("#post-form");

                $form.bootstrapValidator('validate');
                if ($form.data('bootstrapValidator').isValid()) {
                    $form.submit();
                }
            })
        });
    </script>
@endsection