@extends('base.master')

@section('content')
	<h2>Locations</h2>
	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','location.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('type','location.index','Type')!!}
			{!!\Nvd\Crud\Html::sortableTh('address','location.index','Address')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
				<td><input type="text" class="form-control" name="address" value="{{Request::input("address")}}"></td>
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
							  data-name="type"
							  data-value="{{ $record->type }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/location/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->type }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="address"
							  data-value="{{ $record->address }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/location/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->address }}</span>
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'location', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 4])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection