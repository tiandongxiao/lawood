@extends('tpl.admin.app')

@section('content')
	<h2>Bills</h2>
	<table class="table table-striped grid-view-tbl">
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','bill.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('user_id','bill.index','User Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('amount','bill.index','amount')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','bill.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','bill.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
				<td><input type="text" class="form-control" name="amount" value="{{Request::input("amount")}}"></td>
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
							  data-url="/bill/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->user_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="amount"
							  data-value="{{ $record->amount }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/bill/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->amount }}</span>
					</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'bill', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 5])
	    	@endforelse
	    </tbody>
	</table>
	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
@endsection