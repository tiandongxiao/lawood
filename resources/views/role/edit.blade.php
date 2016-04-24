@extends('tpl.admin.app')
@section('content')
    <div class="box box-warning">
        <div class="box-header with-border">
            <h3 class="box-title">编辑角色</h3>
        </div><!-- /.box-header -->
        <!-- form start -->
        <form class="form-horizontal" action="{{ URL('role/'.$role->id) }}" method="POST">
            <input name="_method" type="hidden" value="PUT">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="box-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label">显示名称</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" class="form-control"  value="{{ $role->name }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">机读名称</label>
                    <div class="col-sm-10">
                        <input type="text" name="slug" class="form-control"  value="{{ $role->slug }}">
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label">角色描述</label>
                    <div class="col-sm-10">
                        <textarea name="desc" rows="10" class="form-control" required="required">{{ $role->description }}</textarea>
                    </div>
                </div>
            </div><!-- /.box-body -->
            <div class="box-footer">
                <button type="submit" class="btn btn-lg btn-warning pull-right">更新</button>
            </div><!-- /.box-footer -->
        </form>
    </div>

@stop
@section('script')
    <script src="/js/app.min.js"></script>
@stop