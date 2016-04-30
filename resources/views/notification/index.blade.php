@extends('tpl.base.app')

@section('content')

	<h2>Notifications</h2>
	<table class="table table-striped grid-view-tbl">
	    
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('id','notification.index','Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('user_id','notification.index','User Id')!!}
			{!!\Nvd\Crud\Html::sortableTh('type','notification.index','Type')!!}
			{!!\Nvd\Crud\Html::sortableTh('title','notification.index','Title')!!}
			{!!\Nvd\Crud\Html::sortableTh('url','notification.index','Url')!!}
			{!!\Nvd\Crud\Html::sortableTh('read','notification.index','Read')!!}
			{!!\Nvd\Crud\Html::sortableTh('content','notification.index','Content')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','notification.index','Created At')!!}
			{!!\Nvd\Crud\Html::sortableTh('updated_at','notification.index','Updated At')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="id" value="{{Request::input("id")}}"></td>
				<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
				<td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
				<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
				<td><input type="text" class="form-control" name="url" value="{{Request::input("url")}}"></td>
				<td><input type="text" class="form-control" name="read" value="{{Request::input("read")}}"></td>
				<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
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
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->user_id }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="type"
							  data-value="{{ $record->type }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->type }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="title"
							  data-value="{{ $record->title }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->title }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="url"
							  data-value="{{ $record->url }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->url }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="read"
							  data-value="{{ $record->read }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->read }}</span>
						</td>
					<td>
						<span class="editable"
							  data-type="text"
							  data-name="content"
							  data-value="{{ $record->content }}"
							  data-pk="{{ $record->{$record->getKeyName()} }}"
							  data-url="/notification/{{ $record->{$record->getKeyName()} }}"
							  >{{ $record->content }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					<td>
						{{ $record->updated_at }}
						</td>
					@include( 'vendor.crud.single-page-templates.common.actions', [ 'url' => 'notification', 'record' => $record ] )
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