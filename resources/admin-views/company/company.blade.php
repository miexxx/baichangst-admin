@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">公司简介</h3>
                    <div class="box-tools">

                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::company.update', $company->id) }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">关于我们</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div id="editor">
                                            {!! $company->content !!}
                                        </div>
                                        <textarea name="content" id="content" cols="30" rows="10" hidden>{{ $company->content }}</textarea>
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

            ///
            var menus = [
                'head',  // 标题
                'bold',  // 粗体
                'fontSize',  // 字号
                'fontName',  // 字体
                'italic',  // 斜体
                'underline',  // 下划线
                'strikeThrough',  // 删除线
                'foreColor',  // 文字颜色
                'backColor',  // 背景颜色
                'link',  // 插入链接
                'list',  // 列表
                'justify',  // 对齐方式
                'quote',  // 引用
                'emoticon',  // 表情
                'image',  // 插入图片
                'code',  // 插入代码
                'undo',  // 撤销
                'redo'  // 重复
            ];

            var $details = $("#content");
            var editor = new wangEditor('#editor');
            editor.customConfig.pasteFilterStyle = false;
            editor.customConfig.zIndex = 100;
            editor.customConfig.menus = menus;
            editor.customConfig.uploadImgShowBase64 = true;
            editor.customConfig.uploadFileName = 'imgs[]';
            editor.customConfig.showLinkImg = false;
            editor.customConfig.uploadImgServer = "{{ route('admin::upload.image') }}";
            editor.customConfig.uploadImgParams = {
                _token:LA.token
            };
            editor.customConfig.onchange = function (html) {
                $details.val(html);
            };

            editor.create();
            $('#submit-btn').on('click', function (event) {
                $('#post-form').submit();

            });
            @if (count($errors) > 0)

            swal("提交失败！","请检查提交数据是否正确！","error");
            @endif


        });
    </script>
@endsection