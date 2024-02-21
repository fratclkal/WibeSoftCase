

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>

<form action="{{ route('task-save', isset($tasks) ? $tasks->id : 0) }}" method="POST">
    @csrf

    <label for="">Görev Başlığı</label>
    <input type="text" name="title" value="{{ $tasks->title}}" placeholder="Görev Başlığı Giriniz..">
    <br>
    <label for="">Görev Açıklaması</label>
    <textarea maxlength="50"  name="subject" minlength="50"> {{ isset($tasks) ? $tasks->subject : '' }}</textarea>
    <br>
    <label for="">Email</label>
    <input type="text" name="email" value="{{ isset($tasks) ? $tasks->email : '' }}" placeholder="Email Giriniz..">
    <br>
    <label for="">Statü</label>
    <select name="status">
        <option value="1" {{ isset($tasks) && $tasks->status == 1 ? 'selected' : ''}}>Aktif</option>
        <option value="0" {{ isset($tasks) && $tasks->status == 0 ? 'selected' : ''}}>Pasif</option>
    </select>
    <br>
    <label for="">Görev Zamanı</label>
    <input type="date" name="time" value="{{ isset($tasks) ? \Carbon\Carbon::parse($tasks->time)->format('Y-m-d') : '' }}">    <br>
    <br>
    <button type="submit">Ekle</button>

</form>

</body>
</html>
