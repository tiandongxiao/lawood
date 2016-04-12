@extends('base.master')

@section('content')

	<h2>云图数据中心</h2>

	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','gdmap.index','ID')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','gdmap.index','姓名')!!}
			{!!\Nvd\Crud\Html::sortableTh('address','gdmap.index','地址')!!}
			{!!\Nvd\Crud\Html::sortableTh('category','gdmap.index','业务')!!}
			{!!\Nvd\Crud\Html::sortableTh('yun_id','gdmap.index','云编号')!!}

			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="address" value="{{Request::input("address")}}"></td>
				<td><input type="text" class="form-control" name="category" value="{{Request::input("category")}}"></td>
				<td><input type="text" class="form-control" name="yun_id" value="{{Request::input("yun_id")}}"></td>
				<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
			</form>
		</tr>
	    </thead>

	    <tbody>
	    	@forelse ( $records as $record )
		    	<tr>
					<td>
						{{ $record->id }}
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/gdmap/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->name }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="address"
							  data-value="{{ $record->address }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/gdmap/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->address }}</span>
						</td>

					<td>
						<span class="editable"
							  data-type="text"
							  data-name="category"
							  data-value="{{ $record->category }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/gdmap/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->category }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="yun_id"
							  data-value="{{ $record->yun_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/gdmap/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->yun_id }}</span>
					</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'gdmap', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 10])
	    	@endforelse
	    </tbody>

	</table>
	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
@endsection