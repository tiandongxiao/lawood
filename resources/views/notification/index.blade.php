@extends('tpl.admin.app')
@section('content')
	<h2>Notifications</h2>
	<table class="table table-striped grid-view-tbl">
	    <thead>
		<tr class="header-row">
			{!!\Nvd\Crud\Html::sortableTh('user_id','notification.index','用户ID')!!}
			{!!\Nvd\Crud\Html::sortableTh('type','notification.index','类型')!!}
			{!!\Nvd\Crud\Html::sortableTh('title','notification.index','标题')!!}
			{!!\Nvd\Crud\Html::sortableTh('url','notification.index','详情链接')!!}
			{!!\Nvd\Crud\Html::sortableTh('read','notification.index','已读')!!}
			{!!\Nvd\Crud\Html::sortableTh('content','notification.index','内容')!!}
			{!!\Nvd\Crud\Html::sortableTh('created_at','notification.index','创建日期')!!}
			<th></th>
		</tr>
		<tr class="search-row">
			<form class="search-form">
				<td><input type="text" class="form-control" name="user_id" value="{{Request::input("user_id")}}"></td>
				<td><input type="text" class="form-control" name="type" value="{{Request::input("type")}}"></td>
				<td><input type="text" class="form-control" name="title" value="{{Request::input("title")}}"></td>
				<td><input type="text" class="form-control" name="url" value="{{Request::input("url")}}"></td>
				<td><input type="text" class="form-control" name="read" value="{{Request::input("read")}}"></td>
				<td><input type="text" class="form-control" name="content" value="{{Request::input("content")}}"></td>
				<td><input type="text" class="form-control" name="created_at" value="{{Request::input("created_at")}}"></td>
				<td style="min-width: 6em;">@include('vendor.crud.single-page-templates.common.search-btn')</td>
			</form>
		</tr>
	    </thead>

	    <tbody>
	    	@forelse ( $records as $record )
		    	<tr>
					<td>
						<span>{{ $record->user_id }}</span>
						</td>
					<td>
						<span>{{ $record->type }}</span>
						</td>
					<td>
						<span>{{ $record->title }}</span>
						</td>
					<td>
						<span>{{ $record->url }}</span>
						</td>
					<td>
						<span>{{ $record->read }}</span>
						</td>
					<td>
						<span>{{ $record->content }}</span>
						</td>
					<td>
						{{ $record->created_at }}
						</td>
					@include( 'notification.action', [ 'url' => 'notification', 'record' => $record ] )
		    	</tr>
			@empty
				@include ('vendor.crud.single-page-templates.common.not-found-tr',['colspan' => 10])
	    	@endforelse
	    </tbody>
	</table>
	@include('vendor.crud.single-page-templates.common.pagination', [ 'records' => $records ] )
@endsection