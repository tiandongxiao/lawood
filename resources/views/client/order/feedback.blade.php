@extends('tpl.lawyer.app')
@section('content')
    <div>
        <h4>律师印象</h4>
        准时：<a class="btn btn-success">提前</a> <a class="btn btn-warning">按时</a> <a class="btn btn-danger">迟到</a>
        <hr/>
        穿着：<a class="btn btn-success">职业</a> <a class="btn btn-warning">随意</a> <a class="btn btn-danger">邋遢</a>
        <hr/>
        专业：<a class="btn btn-success">点赞</a> <a class="btn btn-warning">一般</a> <a class="btn btn-danger">差劲</a>
        <hr/>
        礼貌：<a class="btn btn-success">点赞</a> <a class="btn btn-warning">一般</a> <a class="btn btn-danger">差劲</a>
    </div>
    <br/>

    <div class="box box-info">
        <div class="box-header with-border">
            <h3 class="box-title">律师印象</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{URL('client/order/feedback')}}" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="hidden" name="order_id" value="{{ $id }}">
            <div class="box-body">
                <div class="form-group">
                    <label for="rating" class="col-sm-2 control-label">星级评价</label>

                    <div class="col-sm-10">
                        <input type="input" class="form-control" name="rating" id="rating" placeholder="rating">
                    </div>
                </div>
                <h4 style="padding-left: 50px">准时</h4>
                <div class="form-group" style="padding-left: 150px;">
                    <div class="radio">
                        <label>
                            <input type="radio" name="timing"  value="5" checked="">
                            提前
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="timing"  value="3">
                            准时
                        </label>
                    </div>
                    <div class="radio">
                        <label>
                            <input type="radio" name="timing"  value="1" >
                            迟到
                        </label>
                    </div>
                </div>
            </div>

            <h4 style="padding-left: 50px">穿着</h4>
            <div class="form-group" style="padding-left: 150px;">
                <div class="radio">
                    <label>
                        <input type="radio" name="dressing"  value="5" checked="">
                        提前
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="dressing"  value="3">
                        准时
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="dressing"  value="1" >
                        迟到
                    </label>
                </div>
            </div>

            <h4 style="padding-left: 50px">专业</h4>
            <div class="form-group" style="padding-left: 150px;">
                <div class="radio">
                    <label>
                        <input type="radio" name="major"  value="5" checked="">
                        专业
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="major"  value="3">
                        一般
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="major"  value="1" >
                        业余
                    </label>
                </div>
            </div>
            <h4 style="padding-left: 50px">礼貌</h4>
            <div class="form-group" style="padding-left: 150px;">
                <div class="radio">
                    <label>
                        <input type="radio" name="polite"  value="5" checked="">
                        礼貌
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="polite"  value="3">
                        一般
                    </label>
                </div>
                <div class="radio">
                    <label>
                        <input type="radio" name="polite"  value="1" >
                        粗鲁
                    </label>
                </div>
            </div>
            <h4>其他评论</h4>
            <div class="form-group" style="padding-left: 150px;">
                <div>
                    <input type="input" name="comment" />
                </div>
            </div>

            <!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">提交</button>
            </div>
            <!-- /.box-footer -->
        </form>
    </div>
@endsection