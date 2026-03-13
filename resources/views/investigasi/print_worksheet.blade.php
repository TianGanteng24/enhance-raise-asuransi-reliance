<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Claim Worksheet - no polis : {{$detail->no_polis}}</title>
  
  <style>

  /* @page { 
    margin: 10px; 
    margin-top: 0cm;
    margin-bottom: 0cm;
  
    margin: 0;
    page-break-before: always;
  } */
  
  
  @page {
        size: A4;
        margin: 0;
        margin-top: 25px;
    }
    
    .page {
        margin: 0;
        page-break-before: always;
    }
  
    @media print{
    pre, blockquote {page-break-inside: avoid;}
    table { page-break-inside:auto }
    tr { page-break-inside:avoid; page-break-after:auto }
  }
  
  #table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-right: 30px;
  margin-left : 30px;
}

#table td, #table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#table tr:nth-child(even){background-color: #f2f2f2;}

#table tr:hover {background-color: #ddd;}

#table th {
  padding-top: 8px;
  padding-bottom: 8px;
  text-align: left;
  background-color: #EC6245;
  color: white;
}

 h3 {
  font-family: Arial, Helvetica, sans-serif;
  margin-left: 30px;
}

  </style>
  
</head>
<body>

    <h3>CLAIM WORKSHEET INVESTIGATION</h3>
    <div class="table-responsive">
        <table id="table">
              <thead>
                  <tr>
                  <th style="width:40%;">INFORMASI KLAIM</th>
                  <th>KETERANGAN</th>
                  </tr>
              </thead>
              <tbody style="line-height: 10px;">
                  <tr>
                      <td class="fw fs-sm">No Case</td>
                      <td class="fw fs-sm">{{$detail->no_case}}{{$detail->number_case}}</td> 
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Tanggal Registrasi</td>
                      <td class="fw fs-sm">
                      {{ Carbon\carbon::parse($detail->tgl_registrasi)->isoFormat('D MMM Y') }}    
                      </td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Nama Perusahaan</td>
                      <td class="fw fs-sm">{{$detail->nm_perusahaan}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Mata Uang</td>
                      <td class="fw fs-sm">{{$detail->matauang}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">No Polis</td>
                      <td class="fw fs-sm">{{$detail->no_polis}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Nama Tertanggung</td>
                      <td class="fw fs-sm">{{$detail->nm_tertanggung}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Nama Pemegang Polis</td>
                      <td class="fw fs-sm">{{$detail->nm_pemegang_polis}}</td>
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Nama Agen</td>
                  <td class="fw fs-sm">{{$detail->nm_agen}}</td>
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Uang Pertanggungan</td>
                  <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->uang_pertanggungan)</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Tanggal SPAJ</td>
                      <td class="fw fs-sm">
                          @if (is_null($detail->tgl_spaj))
                              -
                          @else
                              {{ Carbon\carbon::parse($detail->tgl_spaj)->isoFormat('D MMM Y') }}
                          @endif                                      
                      </td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Tgl Efektif Polis</td>
                      <td class="fw fs-sm">
                          @if (is_null($detail->tgl_efektif_polis))
                              -
                          @else
                              {{ Carbon\carbon::parse($detail->tgl_efektif_polis)->isoFormat('D MMM Y') }}</td>
                          @endif    
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Usia Polis</td>
                  <td class="fw fs-sm">{{$detail->usia_polis}}</td>
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Premi</td>
                  <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->premi)</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Total Premi</td>
                    <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->total_premi)</td>
                  </tr>
                  
                  <tr>
                    <td class="fw fs-sm">Provinsi</td>
                    <td class="fw fs-sm">{{$detail->provinsi_alamat}}</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Kabupaten/Kota</td>
                    <td class="fw fs-sm">{{$detail->kabupaten}}</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Kecamatan</td>
                    <td class="fw fs-sm">{{$detail->kecamatan}}</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Alamat Tertanggung</td>
                    <td style="line-height:1.3;">{{$detail->alamat_tertanggung}}</td>
                  </tr>
              </tbody>
        </table>  
      
        <table id="table">
              <thead>
                  <tr>
                  <th style="width:40%;">INFORMASI POLIS</th>
                  <th>KETERANGAN</th>
                  </tr>
              </thead>
              <tbody style="line-height: 10px;">
                  <tr>
                  <td class="fw fs-sm">Jenis Klaim</td>
                  <td class="fw fs-sm">{{$detail->jenis_klaim}}</td>
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Tempat Meninggal/Tempat dirawat</td>
                  <td class="fw fs-sm">{{$detail->tempat_meninggal}} {{$detail->rumah_sakit}}</td>
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Tanggal Meninggal</td>
                      @if (is_null($detail->tgl_meninggal))
                          -
                      @else
                          <td class="fw fs-sm">{{ Carbon\carbon::parse($detail->tgl_meninggal)->isoFormat('D MMM Y') }}</td>
                      @endif
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Tanggal Di Rawat </td>
                  <td class="fw fs-sm">
                      @if (is_null($detail->tgl_dirawat_dr))
                          -
                      @else
                          {{ Carbon\carbon::parse($detail->tgl_dirawat_dr)->isoFormat('D MMM Y') }}
                      @endif
                      s.d
                      @if (is_null($detail->tgl_dirawat_smp))
                          -
                      @else
                          {{ Carbon\carbon::parse($detail->tgl_dirawat_smp)->isoFormat('D MMM Y') }}</td>
                      @endif
                  </tr>
                  <tr>
                  <td class="fw fs-sm">Diagnosa Utama</td>
                  <td style="line-height:1.3;" class="fw fs-sm">{{$detail->diagnosa_utama}}</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Tempat Perawatan</td>
                    <td class="fw fs-sm">{{$detail->tempat_perawatan}}</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Jumlah Klaim</td>
                    <td class="fw fs-sm">{{$detail->matauang}} @currency($detail->jml_klaim)</td>
                  </tr>
                  <tr>
                    <td class="fw fs-sm">Area Investigasi</td>
                    <td class="fw fs-sm">{{$detail->area_investigasi}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Provinsi</td>
                      <td class="fw fs-sm">{{$detail->provinsi}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Tgl Kirim Dokumen</td>
                      <td class="fw fs-sm">
                          @if (is_null($detail->tgl_kirim_dokumen))
                              -
                          @else
                              {{ Carbon\carbon::parse($detail->tgl_kirim_dokumen)->isoFormat('dddd, D MMM Y') }}
                          @endif
                      </td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Metode</td>
                      <td class="fw fs-sm">{{$detail->metode_investigasi}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Plan</td>
                      <td class="fw fs-sm">{{$detail->plan}}</td>
                  </tr>
                  <tr>
                      <td class="fw fs-sm">Keterlibatan Agen</td>
                      <td class="fw fs-sm">{{$detail->agen_terlibat}}</td>
                  </tr>
              </tbody>
        </table>

        @if (is_null($detail->informasi_lain))
        @else
        <table id="table" class="page">
            <thead>
                <tr>
                <th>TAMBAHAN INFORMASI LAINNYA</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="fw fs-sm">{{$detail->informasi_lain}}</td>
                </tr>
            </tbody>
        </table>
        @endif
        
      </div>
 
</body>
</html>


  



  