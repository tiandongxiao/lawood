@extends('vendor.crud.single-page-templates.common.app')

@section('content')

	<h2>Receipts</h2>

	@include('receipt.create')

	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','receipt.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('order_id','receipt.index','Order Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('receiver','receipt.index','Receiver')!!}
			{!!\Nvd\Crud\Html::sortableTh('title','receipt.index','Title')!!}
			{!!\Nvd\Crud\Html::sortableTh('address','receipt.index','Address')!!}
			{!!\Nvd\Crud\Html::sortableTh('code','receipt.index','Code')!!}
			{!!\Nvd\Crud\Html::sortableTh('phone','receipt.index','Phone')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','receipt.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','receipt.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="order_id" value="{{Request::input("order_id")}}"></td>
				<td><input type="text" class="form-control" name="receiver" value="{{Request::input("receiver")}}"></td>
				<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
				<td><input type="text" class="form-control" name="address" value="{{Request::input("address")}}"></td>
				<td><input type="text" class="form-control" name="code" value="{{Request::input("code")}}"></td>
				<td><input type="text" class="form-control" name="phone" value="{{Request::input("phone")}}"></td>
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
							  data-name="order_id"
							  data-value="{{ $record->order_id }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->order_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="receiver"
							  data-value="{{ $record->receiver }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->receiver }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="title"
							  data-value="{{ $record->title }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->title }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="address"
							  data-value="{{ $record->address }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->address }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="code"
							  data-value="{{ $record->code }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->code }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="phone"
							  data-value="{{ $record->phone }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/receipt/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->phone }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'receipt', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 10])
	    	@endforelse
	    </tbody>

	</table>

	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )

<script>
	$(".editable").editable({ajaxOptions:{method:'PUT'}});
</script>
@endsection