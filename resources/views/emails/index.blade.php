<html>
<body>
<p>Yeni bir görev oluşturuldu:</p>

<p>Başlık: {{ $title }}</p>
<p>Açıklama: {{ $subject }}</p>
<p>Zaman: {{ $time }}</p>
<p>Durum: {{ $status == 1 ? 'Aktif' : 'Pasif' }}</p>
</body>

</html>
