@extends('admin::layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="box-header with-border">
                    <h3 class="box-title">首页视频配置</h3>
                    <div class="box-tools">

                    </div>
                </div>
                <form id="post-form" class="form-horizontal" action="{{ route('admin::movie.update') }}" method="post" enctype="multipart/form-data" pjax-container>
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="fields-group">
                            <div class="form-group">
                                <label for="title" class="col-sm-2 control-label">首页视频</label>
                                <div class="col-sm-8">

                                        <input type="file" id="movie" name="movie"  class="form-control"  accept=video/*">

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



            var urls = [];
            var j = {};
            j.downloadUrl = "{{ getenv('MOVIE_PATH')}}";
            urls.push(j.downloadUrl);



           $('#movie').fileinput({
               "overwriteInitial": true,
               "initialPreviewAsData": true,
               "browseLabel": "浏览",
               "showRemove": false,
               initialPreviewFileType: 'video',
               initialPreview: urls,

               // previewFileType:'video',
               "showUpload": false,
               "allowedFileExtensions": [
                   'mp4','AVI','wma','rmvb','rm','flash','mid','3GP'
               ]
           });

            var source = document.getElementsByTagName('source')[0];
            source.type='audio/mp4';





        });
    </script>
@endsection