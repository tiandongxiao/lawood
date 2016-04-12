@extends('tpl.lawyer.app')

@section('content')

	<h2>Pois</h2>

	<table class="table table-striped grid-view-tbl">
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','pois.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('poi_id','pois.index','Poi Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','pois.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','pois.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="poi_id" value="{{Request::input("poi_id")}}"></td>
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
							  data-name="poi_id"
							  data-value="{{ $record->poi_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/pois/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->poi_id }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'pois', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection