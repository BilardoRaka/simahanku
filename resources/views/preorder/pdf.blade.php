<!DOCTYPE html>
<html>
  <head>
  <title>Data Bahan Baku</title>
  <style type="text/css">  
  .styled-table {
      border-collapse: collapse;
      margin: 25px 0;
      font-size: 0.9em;
      font-family: sans-serif;
      min-width: 400px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
      margin-left:auto;
      margin-right:auto;
  }

  .styled-table thead tr {
      background-color: #0275d8;
      color: #ffffff;
      text-align: center;
  }

  .styled-table th,
  .styled-table td {
      padding: 12px 15px;
  }

  .styled-table tbody tr {
      border-bottom: 1px solid #dddddd;
  }

  .styled-table tbody tr:nth-of-type(even) {
      background-color: #f3f3f3;
  }

  .styled-table tbody tr:last-of-type {
      border-bottom: 2px solid #0275d8;
  }

  @page {
      margin: 20px 20px 20px 20px !important;
      padding: 20px 20px 20px 20px !important;
  }

  .text {
    font-size: 1,2em;
    font-family: sans-serif;
  }
  
  h1 {
    font-size: 1.8em;
    font-family: sans-serif;
    text-align: center;
  }

  .hero {
    position: relative;
    width: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .hero::before {    
    content: "";
    background-image: url('http://simahanku.test/images/nifandatama.png');
    background-position: center;
    background-repeat: no-repeat;
    position: absolute;
    top: 0px;
    right: 0px;
    bottom: 0px;
    left: 0px;
    opacity: 0.15;
  }

  ul {
    list-style-position: inside;
    padding-left: 0;
  }

  </style>  
  </head>
  <body>
    <div class="hero">
      <h1>Preorder PT. Nifandatama</h1>
      <hr>
      <div>
        <p class="text">
          <b>Keterangan Preorder</b>
          <br>
          Preorder dilakukan oleh {{ $preorder->user->name }}
          <br>
          Waktu Dibuat {{ $preorder->created_at->format('H:i d-m-Y') }}
          <br>
          Waktu Konfirmasi {{ $preorder->updated_at->format('H:i d-m-Y') }}
        </p>
        <p class="text">
          <b>Identitas Pelanggan</b>
          <br>
          Nama Pelanggan : {{ $preorder->customer->name }}
          <br>
          Alamat Pelanggan : {{ $preorder->customer->address }}
          <br>
          Nomor Telepon : {{ $preorder->customer->phone }}
          <br>
          Email : {{ $preorder->customer->email }}  
        </p>  
        <p class="text">
          <b>Produk Dipesan</b>
          <br>
          Nama Produk : {{ $preorder->product->name }}
          <br>
          Jumlah : {{ $preorder->amount }} Buah
          <br>
          <ul class="text">
            <b>Bahan Baku Dibutuhkan untuk Produksi</b>
            @foreach($preorder->product->material as $material)
              <li>
                {{ number_format($material->pivot->amount*$preorder->amount,0,',','.') }} {{ $material->unit }} {{ $material->name }}
              </li>
            @endforeach
          </ul>
        </p>
      </div>
    </div>
  </body>
</html>