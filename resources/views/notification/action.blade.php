<?php
/* @var $url */
/* @var $record */
?>
<td class="actions-cell">
    <form class="form-inline" action="/{{$url}}/{{$record->id}}" method="POST">
        <a href="/{{$url}}/{{$record->id}}"><i class="fa fa-eye"></i></a>&nbsp;&nbsp;
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button style="outline: none;background: transparent;border: none;"
                onclick="return confirm('Are You Sure?')"
                type="submit" class="fa fa-remove text-danger"></button>
    </form>
</td>