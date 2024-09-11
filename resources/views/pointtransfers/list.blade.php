
@foreach ($pointtransferhistorys as $idx => $pointtransferhistory)
    <tr>
        <td>{{++$idx}}</td>
        <td>{{$pointtransferhistory->students['regnumber']}}</td>
        <td>{{$pointtransferhistory->points}}</td>
        <td><span class="badge  {{ $pointtransferhistory -> accounttype == 'debit' ? 'text-bg-success' : 'text-bg-danger'}}">{{$pointtransferhistory->accounttype}}</span></td>
        <td>{{$pointtransferhistory->created_at->format('d M Y')}}</td>
        <td>{{$pointtransferhistory->updated_at->format('d M Y')}}</td>

    </tr>
@endforeach