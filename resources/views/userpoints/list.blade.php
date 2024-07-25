
@foreach ($userpoints as $idx => $userpoint)
    <tr>
        <td>{{++$idx}}</td>
        <td>{{$userpoint->user_id}}</td>
        <td>{{$userpoint->points}}</td>
        <td>{{$userpoint->created_at->format('d M Y')}}</td>
        <td>{{$userpoint->updated_at->format('d M Y')}}</td>
        <td>
            <a href="javascript:void(0)" class="text-info edit-btns" data-id="{{$userpoint->id}}"><i class="fas fa-pen"></i></a>
            <a href="javascript:void(0)" class="text-info ms-2 delete-btns" data-idx={{++$idx}} data-id="{{$userpoint->id}}"><i class="fas fa-trash-alt"></i></a>
        </td>
    </tr>
@endforeach