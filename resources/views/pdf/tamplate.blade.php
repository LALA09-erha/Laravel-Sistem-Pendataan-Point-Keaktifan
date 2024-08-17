<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Transkip Point Mahasiswa</title>
    <style>
      .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
    </style>
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        {{-- <img src="" alt=""> --}}
      </div>
      <h1>Universitas Trunojoyo Madura <br>Fakultas Teknik</h1>
      <h2 style="text-align:center">Transkip Point Mahasiswa</h2>
      
      <div id="project">
        <div><span>Nama</span> {{$data['name']}}</div>
        <div><span>NIM</span> {{$data['nim']}}</div>
        <div><span>Tahun Ajaran</span> {{$data['tahun_ajaran']}}</div>
        <div><span>Email</span> {{$data['email']}}</div>         
        <div><span>PRODI</span> {{$data['prodi']}}</div>
      </div>
    </header>
    <main>
      <table>
        <thead>

          <tr>
            <th class="service">NO</th>
            <th class="desc">Nama Kegiatan</th>
            <th></th>
            <th>Status</th>
            <th>Point Kegiatan</th>
          </tr>
        </thead>
        <tbody>
          @php
          $no = 1;
          @endphp
          @foreach ($mahasiswa as $item)
          <tr>
            <td class="service">{{$no}}</td>
            <td class="desc">{{$item['data_kegiatan']}}</td>
            <td class="unit"></td>
            <td class="qty">{{$item['status']}}</td>
            <td class="total">{{$item['point_kegiatan']}}</td>
          </tr>                   
          @php
          $no++;
          @endphp
          @endforeach
          <tr>
            <td colspan="4" class="grand total">Total Point</td>
            <td class="grand total">{{$data['total_point']}}</td>
          </tr>
        </tbody>
      </table>
      {{-- buat div untuk ttd admin --}}
      <div style="float:right; text-align:center; margin-top:50px">
        <p>Mengetahui</p>
        <p>Admin</p>
        <br>
        <br>
        <br>
        <p>______________________</p>
      </div>


      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Semua data transkip nilai diatas adalah benar dan sah</div>
      </div>
    </main>
    <footer>
    </footer>
  </body>
</html>