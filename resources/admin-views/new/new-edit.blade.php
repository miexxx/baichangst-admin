@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">编辑新闻</h3>
                    <div class="box-tools">
                        <div class="btn-group pull-right" style="margin-right: 10px">
                            <a href="{{ route('admin::news.index') }}" class="btn btn-sm btn-default"><i class="fa fa-list"></i>&nbsp;列表</a>
                        </div> <div class="btn-group pull-right" style="margin-right: 10px">
                            <a class="btn btn-sm btn-default form-history-back"><i class="fa fa-arrow-left"></i>&nbsp;返回</a>
                        </div>
                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{route('admin::news.update',$new->id)}}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">新闻标题</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="title" name="title" value="{{$new->title}}" class="form-control" placeholder="输入 新闻标题">
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">新闻发布者</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="fa fa-pencil"></i></span>
                                        <input type="text" id="host" name="host" value="{{$new->host}}" class="form-control" placeholder="输入 新闻发布者">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                              <label for="category_id" class="col-sm-2 control-label">新闻栏目选择</label>
                             <div class="col-sm-8">
                                <select class="form-control province" style="width: 100%;" name="category_id" data-placeholder="选择 栏目"  >
                                    <option value="">请选择</option>
                                    @foreach($categorys as $category)
                                        <option value="{{ $category->id }}"  @if($new->category_id == $category->id) selected @endif >{{ $category->title }}</option>
                                    @endforeach
                                </select>
                             </div>
                            </div>

                            <div class="form-group">
                                <label for="covers" class="col-sm-2 control-label">新闻封面图</label>
                                <div class="col-sm-8">
                                    <input type="file" class="image" name="image" id="image" multiple accept="image/*">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">新闻内容</label>
                                <div class="col-sm-8">
                                    <div class="input-group">
                                        <div id="editor">
                                            {!! $new->content !!}
                                        </div>
                                        <textarea name="content" id="content" cols="30" rows="10" hidden>{{$new->content}}</textarea>
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

            var previewConfigs = [];
            var urls = [];
            var j = {};
            j.downloadUrl = "{{ $new->image}}";
            j.key = "{{ $new->id }}";
            previewConfigs.push(j);
            urls.push(j.downloadUrl);


            $(".image").fileinput({
                overwriteInitial: false,
                initialPreviewAsData: true,
                initialPreview: urls,
                // initialPreviewConfig: previewConfigs,
                browseLabel: "浏览",
                showRemove: false,
                showUpload: false,
                allowedFileTypes: [
                    "image"
                ]
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