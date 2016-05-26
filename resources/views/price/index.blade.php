@extends('vendor.crud.single-page-templates.common.app')

@section('content')

	<h2>Prices</h2>

	@include('price.create')

	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','price.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('user_id','price.index','User Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('category_id','price.index','Category Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('price','price.index','Price')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','price.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','price.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
				<td><input type="text" class="form-control" name="category_id" value="{{Request::input("category_id")}}"></td>
				<td><input type="text" class="form-control" name="price" value="{{Request::input("price")}}"></td>
				<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
				<td><input type="text" class="form-control" name="updated_at" value="{{Request::input("updated_at")}}"></td>
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
							  data-type="number"
							  data-name="user_id"
							  data-value="{{ $record->user_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/price/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->user_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="category_id"
							  data-value="{{ $record->category_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/price/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->category_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="price"
							  data-value="{{ $record->price }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/price/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->price }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'price', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 7])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection