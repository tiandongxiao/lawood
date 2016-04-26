@extends('tpl.base.app')

@section('content')
	<h2>Places</h2>
	<table class="table table-striped grid-view-tbl">
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','place.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','place.index','Name')!!}
			{!!\Nvd\Crud\Html::sortableTh('price','place.index','Price')!!}
			{!!\Nvd\Crud\Html::sortableTh('avatar','place.index','Avatar')!!}
			{!!\Nvd\Crud\Html::sortableTh('desc','place.index','Desc')!!}
			{!!\Nvd\Crud\Html::sortableTh('address','place.index','Address')!!}
			{!!\Nvd\Crud\Html::sortableTh('attach','place.index','Attach')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','place.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','place.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="price" value="{{Request::input("price")}}"></td>
				<td><input type="text" class="form-control" name="avatar" value="{{Request::input("avatar")}}"></td>
				<td><input type="text" class="form-control" name="desc" value="{{Request::input("desc")}}"></td>
				<td><input type="text" class="form-control" name="address" value="{{Request::input("address")}}"></td>
				<td><input type="text" class="form-control" name="attach" value="{{Request::input("attach")}}"></td>
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
							  data-type="text"
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->name }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="price"
							  data-value="{{ $record->price }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->price }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="avatar"
							  data-value="{{ $record->avatar }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->avatar }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="desc"
							  data-value="{{ $record->desc }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->desc }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="address"
							  data-value="{{ $record->address }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->address }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="attach"
							  data-value="{{ $record->attach }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/place/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->attach }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'place', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 10])
	    	@endforelse
	    </tbody>
	</table>
	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
@endsection

@section('script')
	<script>
		$(".editable").editable({ajaxOptions:{method:'PUT'}});
	</script>
@endsection