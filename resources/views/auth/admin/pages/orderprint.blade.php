<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1 style="font-size : 30px; font-family: Calibri">LEMBAR SERVICE UNTUK {{$order->user->nama}}</h1>
    <ul>
        <strong><li style="font-size : 30px; font-family: Calibri">{{$order->barang->jenis->jenis . ' ' .
          $order->barang->merk->merk. ' ' .
          $order->barang->tipe->tipe}}</li></strong>
         <strong><li style="font-size: 30px; font-family: Calibri">RSUD BLAMBANGAN - {{$order->ruangan->nama}}</li></strong>         
          <strong><li style="font-size: 30px; font-family: Calibri">{{$order->nama_pelapor}} / {{$order->no_pelapor}}</li></strong>
          <strong><li style="font-size: 30px;">KENDALA : {{$order->pesan_kerusakan}}</li></strong>
    </ul>
    <strong><span style="font-size : 25px; font-family: Calibri">Jika ada pergantian part / sudah selesai mohon konfirmasi ke nomor 085-228-221-800</span></strong>
    <i><p style="font-size: 12px; font-family: Calibri">Printed Date : {{Carbon\Carbon::parse(now())->format('d-M-Y H:i')}}<span id="tanggalwaktu"></span></p></i>
<script>
var dt = new Date();
// document.getElementById("tanggalwaktu").innerHTML = dt.toLocaleString();
</script>
</body>
</html>