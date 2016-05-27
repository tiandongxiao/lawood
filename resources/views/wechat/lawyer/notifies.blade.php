@extends('wechat.base.app')
@section('content')
    <section class="xxtz-main pad-0-10">
        {!! csrf_field() !!}
        <input type="hidden" name="uri" value="{{url('/')}}">
        @if($notifies)
            @foreach($notifies as $notify)
                @if($notify->read)
                    <div class="itms bg-fff-box hui">
                        <div class="top">
                            <div class="f-right">已读</div>
                            <div class="bt">{{$notify->title}}</div>
                        </div>
                        <div class="con">{{$notify->content}}</div>
                        <div class="pad-0-10">
                            <div class="bottom">
                                <a  href="#" class="more" data-no="{{$notify->id}}" data-do="unread">设为未读</a>
                                <span class="time">{{$notify->created_at}}</span>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="itms bg-fff-box">
                        <div class="top">
                            <div class="f-right">未读</div>
                            <div class="bt">{{$notify->title}}</div>
                        </div>
                        <div class="con">{{$notify->content}}</div>
                        <div class="pad-0-10">
                            <div class="bottom">
                                <a  href="#" class="more" data-notify="{{$notify->id}}" data-do="read">设为已读</a>
                                <span class="time">{{$notify->created_at}}</span>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
    </section>
@stop
@section('script')
    <script>
        $(function () {
            $('.more').tap(function () {
                var address = $('input[name=uri]').val();
                var notify = $(this).data("notify");
                var option = $(this).data("do");

                if(option == 'read'){
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/notify/read',
                        data: {
                            'notify' : notify,
                            '_token':$('input[name=_token]').val()
                        },
                        success: function(data){
                            alert(data)
                        }
                    });
                }
                if(option == 'unread'){
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/notify/unread',
                        data: {
                            'notify' : notify,
                            '_token':$('input[name=_token]').val()
                        },
                        success: function(data){
                            alert(data)
                        }
                    });
                }
            })
        })
    </script>
@stop