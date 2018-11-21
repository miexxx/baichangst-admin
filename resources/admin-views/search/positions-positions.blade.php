<div class="modal fade" id="filter-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">筛选</h4>
            </div>
            <form action="{{ route('admin::positions.index') }}" method="get" pjax-container>
                <div class="modal-body">
                    <div class="form">
                        <div class="form-group">
                            <div class="form-group">
                                <label>职位标题</label>
                                <input type="text" class="form-control" placeholder="职位标题" name="title" value="{{ request('title') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group">
                                <label>截止时间</label>
                                <input type="text" class="form-control" id="endtime" placeholder="截止时间" name="endtime" value="{{ request('endtime') }}">
                            </div>
                        </div>



                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary submit">提交</button>
                    <button type="reset" class="btn btn-warning pull-left">撤销</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $("#filter-modal .submit").click(function () {
        $("#filter-modal").modal('toggle');
        $('body').removeClass('modal-open');
        $('.modal-backdrop').remove();
    });
    $('#endtime').datetimepicker({"format":"YYYY-MM-DD ","locale":"zh-CN"});
    var t =setInterval(function (){
        var time= document.getElementsByTagName("audio")[0];
        if(typeof(time)!="undefined") {
            time = time.duration;
            time = parseInt(time);
            var m = parseInt(time / 60);
            var s = parseInt(time % 60);
            if (s < 10)
                s = '0' + s;
            if (m < 10)
                m = '0'+m;
            time = m + ":" + s;
            $('#lasttime').val(time);
        }
        else{
            $('#lasttime').val('');
        }

    },1000);

</script>