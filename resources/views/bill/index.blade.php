@extends('tpl.admin.app')
@section('content')
	<h2>Bills</h2>
	<table class="table table-striped grid-view-tbl">
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','bill.index','ID')!!}
			{!!\Nvd\Crud\Html::sortableTh('user_id','bill.index','用户ID')!!}
			{!!\Nvd\Crud\Html::sortableTh('name','bill.index','用户姓名')!!}
			{!!\Nvd\Crud\Html::sortableTh('amount','bill.index','金额')!!}
			{!!\Nvd\Crud\Html::sortableTh('account','bill.index','银行卡号')!!}
			{!!\Nvd\Crud\Html::sortableTh('done','bill.index','是否处理')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','bill.index','创建时间')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','bill.index','更新时间')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
				<td><input type="text" class="form-control" name="name" value="{{Request::input("name")}}"></td>
				<td><input type="text" class="form-control" name="amount" value="{{Request::input("amount")}}"></td>
				<td><input type="text" class="form-control" name="account" value="{{Request::input("account")}}"></td>
				<td><input type="text" class="form-control" name="done" value="{{Request::input("done")}}"></td>
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
							  data-type="string"
							  data-name="name"
							  data-value="{{ $record->name }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/bill/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->name }}</span>
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
						<span class="editable"
							  data-type="string"
							  data-name="account"
							  data-value="{{ $record->account }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/bill/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->account }}</span>
					</td>
					<td>
						<span class="editable"
							  data-type="number"
							  data-name="done"
							  data-value="{{ $record->done }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/bill/{{ $record->{$record->getKeyName()} }}"
						>{{ $record->done }}</span>
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