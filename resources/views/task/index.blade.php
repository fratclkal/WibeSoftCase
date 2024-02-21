
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

@if(Auth::check() && Auth::user()->Admin())
    <a href="{{ route('task-form') }}">Görev Ekle</a>
@else
    <p>Görev Ekleme İşlemini Yalnızca Admin Gerçekleştirebilir..</p>
@endif



<table>
    <tr>
        <th>Görev Başlığı</th>
        <th>Görev Durumu</th>
        <th>İşlemler</th>
    </tr>
    @foreach($tasks as $task)
        <tr>
            <td>{{$task->title}}</td>
            <td>{{$task->status}}</td>
            <td>
                <a href="{{route('task-form', $task->id)}}">Düzenle</a>
                <a href="{{route('task-delete', $task->id)}}">Sil</a>
            </td>
        </tr>
    @endforeach
</table>

</body>
</html>
