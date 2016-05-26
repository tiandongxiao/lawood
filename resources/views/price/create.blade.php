<div class="panel-group col-md-6 col-sm-12" id="accordion" style="padding-left: 0">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                    <i class="fa fa-plus"></i>
                    Add a New Price                </a>
            </h4>
        </div>
        <div id="collapseOne" class="panel-collapse collapse">
            <div class="panel-body">

                <form action="/price" method="post">

                    {{ csrf_field() }}

                    {!! \Nvd\Crud\Form::input('user_id','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('category_id','text')->show() !!}

                    {!! \Nvd\Crud\Form::input('price','text')->show() !!}

                    <button type="submit" class="btn btn-primary">Create</button>

                </form>

            </div>
        </div>
    </div>
</div>