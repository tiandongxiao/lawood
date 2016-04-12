@extends('base.master')
@section('content')
<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    创建新的地图数据
                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">
                <form action="/gdmap" method="post">
                    {{ csrf_field() }}
                    {!! \Nvd\Crud\Form::input('name','text')->show() !!}
                    {!! \Nvd\Crud\Form::input('address','text')->show() !!}
                    {!! \Nvd\Crud\Form::input('category','text')->show() !!}
                    <button type="submit" class="btn btn-primary">创建</button>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection