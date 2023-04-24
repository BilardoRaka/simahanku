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

  p {
    font-size: 0.9em;
    font-family: sans-serif;
  }
  
  h1 {
    font-size: 1.5em;
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

  </style>  
  </head>
  <body>
    <div class="hero">
      <h1>Bahan Baku PT. Nifandatama</h1>
      <hr>
      <div>
        <p>
          Dibuat oleh {{ auth()->user()->name }}
          <br>
          Per Tanggal {{ $date }}
        </p>  
        <table class="styled-table">
          <thead>
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Bahan Baku</th>
              <th scope="col">Stok</th>
            </tr>
          </thead>
          <tbody>
          @foreach($materials as $material)
            <tr>
              <td align="center">{{ $loop->iteration }}</td>
              <td align="left">{{ $material->name }}</td>
              <td align="right">{{ $material->stock }} {{ $material->unit }}</td>
            </tr> 
          @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </body>
</html>