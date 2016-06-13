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
                                <a  href="#" class="more" data-notify="{{$notify->id}}" data-do="unread">设为未读</a>
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
        @else
            <div style="text-align:center;margin-top: 60%">没有任何通告消息</div>
            <div class="bottom-btn">
                <div class="blank100" style="height:120px;"></div>
                <div class="con te-cen">
                    <input type="button" class="In-btn In-btn-1 bg-lan1 fc-fff mar-top-10" value="返回首页" id="back-home">
                </div>
            </div>
        @endif
    </section>
@stop
@section('script')
    <script>
        $(function () {
            $('.back-home').tap(function () {
                window.location.href="/wechat";
            });

            $('.more').tap(function () {
                var address = $('input[name=uri]').val();
                var notify = $(this).data("notify");
                var option = $(this).data("do");
                var _this = $(this);

                if(option == 'read'){
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/read',
                        data: {
                            'notify' : notify,
                            '_token':$('input[name=_token]').val()
                        },
                        success: function(data){
                            if(data == 'Y'){
                                _this.text('设为未读');
                                _this.data('do','unread');
                                _this.parents('.itms').addClass('hui');
                                _this.parents('.itms').find('.f-right').html('已读');
                            }
                        }
                    });
                    return;
                }

                if(option == 'unread'){
                    $.ajax({
                        type: 'POST',
                        url: address+'/ajax/unread',
                        data: {
                            'notify' : notify,
                            '_token':$('input[name=_token]').val()
                        },
                        success: function(data){
                            if(data == 'Y'){
                                _this.text('设为已读');
                                _this.data('do','read');
                                _this.parents('.itms').removeClass('hui');
                                _this.parents('.itms').find('.f-right').html('未读');
                            }
                        }
                    });
                }
            })
        })
    </script>
@stop