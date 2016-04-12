@extends('base.master')
@section('content')
    <div class="box box-info">
        <div class="box-header">
            <h3 class="box-title">Color &amp; Time Picker</h3>
        </div>
        <div class="box-body">
            <form action="/location" method="post">

                {{ csrf_field() }}

                {!! \Nvd\Crud\Form::input('type','text')->show() !!}

                {!! \Nvd\Crud\Form::input('address','text')->show() !!}

                <button type="submit" class="btn btn-primary">Create</button>

            </form>
        </div>
        <!-- /.box-body -->
    </div>
@endsection