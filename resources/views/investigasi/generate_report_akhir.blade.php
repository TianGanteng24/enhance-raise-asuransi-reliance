<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Akhir - no polis : {{$detail->no_polis}}</title>

  <style type="text/css">

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

  .border-dot{
    border-style: dotted; 
    padding : 5px 5px 5px 15px;
  }

  .table-polis {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
  }

  .td-polis, .th-polis {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 5px;
  }

  div {
  margin-bottom: 15px;
  padding: 4px 12px;
  }

  .danger {
    background-color: #ffdddd;
    border-left: 35px solid #f44336;
  }

  .success {
    background-color: #ddffdd;
    border-left: 35px solid #04AA6D;
  }

  .info {
    background-color: #e7f3fe;
    border-left: 35px solid #2196F3;
  }


  .warning {
    background-color: #ffffcc;
    border-left: 35px solid #ffeb3b;
  }

  .table-invest {
    border: 1px solid black;
  }



  </style>
</head>

<body>
@php
function base64_image($relativePath){
    $candidates = [
        base_path('public/'.$relativePath),
        base_path($relativePath),
        storage_path('app/public/'.$relativePath),
        base_path('storage/app/public/'.$relativePath),
    ];
    $file = null;
    foreach ($candidates as $path) {
        if (file_exists($path)) {
            $file = $path;
            break;
        }
    }
    if (!$file) {
        return '';
    }
    $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
    $mimeMap = [
        'png' => 'image/png',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'gif' => 'image/gif',
        'svg' => 'image/svg+xml',
        'webp' => 'image/webp',
    ];
    $mime = $mimeMap[$ext] ?? 'application/octet-stream';
    return 'data:'.$mime.';base64,'.base64_encode(file_get_contents($file));
}
@endphp

  <div style="margin-bottom: 100px; font-family: Arial, Helvetica, sans-serif;">
  <table style="margin-top: 90px">
    <tr valign="center">
      <td align="center">
        <H1>LAPORAN HASIL INVESTIGASI</H1>
      </td>
      <td>
        <img src="{{ base64_image('lib_report/logo.png') }}" >
      </td>
    </tr>
  </table>


  <div style="margin-left: -70px; margin-top: 30px; 
      background-color: #4379aa;width: 900px; height: 250px" >
      <table align="center" style="color: #ffffff; font-size: 21px;">
        <tr align="center">
          <td>
            <h2 style="color: #ffffff;">{{$detail->nm_perusahaan}}</h2>
          </td>
        </tr>
        <tr align="center">
          <td>
            <b>Policy No. {{$detail->no_polis}}</b>
          </td>
          </tr>
        <tr align="center">
          <td>
            <b>Pemegang Polis : {{$detail->nm_pemegang_polis}}</b>
          </td>
        </tr>
        <tr align="center">
          <td>
            <b>Tertanggung : {{$detail->nm_tertanggung}}</b>
          </td>
        </tr>
      </table>
  </div> <br> <br>
  <table  style="margin-top:32px">
    <tr valign="center">
      <td align="center">
        <p style="font-size: 38px; font-weight: bold; margin-left:90px;"> External <br> Investigation </p> 
      </td>
      <td> 
        <img style="margin-left:25px;" src="{{ base64_image('lib_report/pic_1.png') }}" >
      </td>
    </tr>
  </table>
  </div>
  {{-- page judul end --}}


  {{-- star Kata Pengantar --}}
  <div class="page" style="margin-left: 40px; margin-right: 30px; font-family: Arial, Helvetica, sans-serif;">
    <h2 style="text-align: center; margin-bottom: 30px;">KATA PENGANTAR</h2>
    <div class="border-dot" style="padding: 20px; line-height: 1.8;">
      
      <p style="text-align: justify; margin-bottom: 7px;">
        Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan oleh <b>{{$detail->nm_perusahaan}}</b> kepada PT Deswa Invisco Multitama (DIM) untuk melakukan investigasi atas klaim-klaim asuransi yang terjadi. Bersama dengan ini pula secara khusus kami menyampaikan laporan akhir hasil investigasi atas klaim <b>No. Polis {{$detail->no_polis}} atas nama {{$detail->nm_tertanggung}}</b>.
      </p>

      <p style="text-align: justify; margin-bottom: 7px;">
        Perlu kami sampaikan bahwa proses investigasi kami lakukan dalam periode <b>@if (is_null($detail->tgl_registrasi)) - @else {{ Carbon\carbon::parse($detail->tgl_registrasi)->isoFormat('D MMM Y') }} @endif s/d. @if (is_null($detail->tgl_kirim_dokumen)) - @else {{ Carbon\carbon::parse($detail->tgl_kirim_dokumen)->isoFormat('D MMM Y') }} @endif</b>, {{$detail->tambahan_waktu}}.
      </p>

      <p style="text-align: justify; margin-bottom: 7px;">
        Perlu kami sampaikan bahwa Investigasi kasus ini melingkupi wilayah <b>{{$detail->area_investigasi}}</b> untuk mencari dan mendapatkan informasi serta data yang berkaitan dengan Nasabah. Secara lebih lengkap mengenai perjalanan proses investigasi, temuan di lapangan, kesimpulan hasil investigasi serta rekomendasi keputusan klaim dapat dilihat pada laporan akhir investigasi ini.
      </p>

      <p style="text-align: justify; margin-bottom: 7px;">
        Kami berharap agar laporan akhir investigasi ini bisa menjadi dasar serta acuan dalam pengambilan keputusan akhir klaim tersebut.
      </p>

      <p style="text-align: justify; margin-bottom: 7px;">
        Jika ada informasi atau hal-hal dalam laporan ini yang masih perlu untuk dimintakan penjelasan lebih lanjut, kami akan dengan senang hati membantu.
      </p>

      <p style="text-align: justify; margin-bottom: 15px;">
        Demikian informasi ini kami sampaikan. Kami berharap semoga kerjasama yang terjalin dengan baik selama ini akan terus dapat kita tingkatkan kedepan.
      </p>

      <div style="margin-top: 25px;">
        <p style="margin: 0; margin-bottom: 10px;">Salam,</p>

        <p style="margin: 0; margin-bottom: 30px;">Jakarta, @if (is_null($detail->tgl_kirim_dokumen)) - @else {{ Carbon\carbon::parse($detail->tgl_kirim_dokumen)->isoFormat('D MMM Y') }} @endif</p>

        <p style="margin: 0; margin-bottom: 15px;"><b>Management PT Deswa Invisco Multitama (DIM)</b></p>

        <img src="{{ base64_image('lib_report/ttd.png') }}" alt="Tanda Tangan" style="max-width: 120px; height: auto; margin-bottom: 5px;">

        <p style="margin: 0; margin-bottom: 2px;"><b><u>Suyadi Wahri</u></b></p>
        <p style="margin: 0;"><b><i>Direktur</i></b></p>
      </div>

    </div>
  </div>
  {{-- End Page Kata pengantar --}}

  {{-- Star Daftar Isi --}}
  <div class="page" style="margin-left: 40px; margin-right: 30px; font-family: Arial, Helvetica, sans-serif;">
  <table style="margin-left: 25px;">
    <tr>
      <td>
        <img src="{{ base64_image('lib_report/logo_head.png') }}" alt="">
      </td>
      <td>
        <h2><?php echo str_repeat("&nbsp;",10);?>DAFTAR ISI</h2>
      </td>
    </tr>
  </table>
  <div class="border-dot" style="margin-top:30px">
  <table style="padding: 5px 15px 15px 5px">
    <tr>
      <td>
        
        1. Pengantar
        <br> 
        2. Daftar Isi
        <br>
        3. Metode Investigasi
        <br>
        4. Informasi Polis & Klaim
        <br>
        5. Hal-Hal Memerlukan Pendalaman
        <br>
        6. Investigasi Lapangan
        <br>
        7. Kesimpulan Investigasi
        <br>
        8. Rekomendasi Keputusan Klaim
        <br>
        9. Lampiran (Suporting Dokumen Investigasi)


      </td>
    </tr>
  </table>
  </div>
  </div>
  {{-- End Star Daftar Isi --}}

  {{-- page metode --}}
  {{-- <?php echo str_repeat("<br>",50);?> --}}
  <div class="page" style=" margin-left: 40px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
    <table style="margin-left: 25px;">
      <tr>
        <td>
          <img src="{{ base64_image('lib_report/logo_head.png') }}" alt="">
        </td>
        <td>
          <h2><?php echo str_repeat("&nbsp;",10);?>METODE INVESTIGASI</h2>
        </td>
      </tr>
    </table>
  <!-- <img style="margin-top: 25px;" src="{{ base64_image('lib_report/metode.png') }}"> -->
    <div class="metode" style="margin-top:35px; padding-right:30px; padding-left:30px;">
      <h2>Metode Investigasi</h2>
      <div class="danger">
        <p><strong></strong>Pemeriksaan Dokumen Klaim & Polis.</p>
      </div>

      <div class="success">
        <p><strong></strong>Tindak lanjut atas indikasi dari pemeriksaan dokumen klaim & polis.</p>
      </div>

      <div class="info">
        <p><strong></strong>Melakukan pengecekan lapangan sesuai tahapan yang diperlukan guna mendapatkan validasi dan informasi yang diperlukan untuk proses investigasi.</p>
      </div>

      @if ($detail->metode_investigasi =="")
        <div class="warning">
          <p><strong></strong>Wawancara dengan berbagai macam pihak termasuk Ahli Waris secara langsung.</p>
        </div>
      @elseif ($detail->metode_investigasi !=="")
        <div class="warning">
          <p><strong></strong>{{$detail->metode_investigasi}}</p>
        </div>
      @endif
      
    </div>
    
  </div>
  {{-- end page metode --}}

  {{-- page informasi --}}
  <div class="page" style=" margin-left: 40px; margin-right: 30px;font-family: Arial, Helvetica, sans-serif;">
    <table style="margin-left: 25px;">
      <tr>
        <td>
          <img src="{{ base64_image('lib_report/logo_head.png') }}" alt=""> 
        </td>
        <td >
        <h2 style="text-align: center; margin-left : 50px">INFORMASI POLIS, KLAIM & <br>
          PENDALAMAN INVESTIGASI </h2>
        </td>
      </tr>
    </table>

    <div class="border-dot" style="margin-top:30px;">
      <table>
        <tr valign="top">
          <td>
            <h5><u> INFORMASI POLIS </u></h5>
            <table style="font-size:14px;">
              <tr>
                <td>Policy</td>
                <td> : </td>
                <td>{{$detail->no_polis}}</td>
              </tr>
              <tr>
                <td>Nama Pemegang Polis</td>
                <td> : </td>
                <td>{{$detail->nm_pemegang_polis}}</td>
              </tr>
              <tr>
                <td>Nama Tertanggung</td>
                <td> : </td>
                <td>{{$detail->nm_tertanggung}}</td>
              </tr>
              <tr>
                <td>Tanggal Penerbitan</td>
                <td> : </td>
                <td>
                  @if(is_null($detail->tgl_efektif_polis)) - @else {{ Carbon\carbon::parse($detail->tgl_efektif_polis)->isoFormat('D MMM Y') }} @endif
                </td>
              </tr>
              <tr>
                <td>Uang Pertanggungan</td>
                <td> : </td>
                <td>{{$detail->matauang}} @currency($detail->uang_pertanggungan)</td>
              </tr>

              @if (is_null($detail->plan))
              @else
              <tr>
                <td>Plan</td>
                <td> : </td>
                <td>{{ $detail->plan }}</td>
              </tr>
              @endif

              @if (is_null($detail->tgl_spaj))
              @else
              <tr>
                <td>SPAJ</td>
                <td> : </td>
                <td>
                  @if (is_null($detail->tgl_spaj)) - @else {{ Carbon\carbon::parse($detail->tgl_spaj)->isoFormat('D MMM Y') }} @endif
                </td>
              </tr>
              @endif

              @if (is_null($detail->tgl_joint))
              @else
              <tr>
                <td>Tanggal Joint</td>
                <td> : </td>
                <td>
                  @if (is_null($detail->tgl_joint)) - @else {{ Carbon\carbon::parse($detail->tgl_joint)->isoFormat('D MMM Y') }} @endif
                </td>
              </tr>
              @endif

              @if (is_null($detail->premi))
              @else
              <tr>
                <td>Premi</td>
                <td> : </td>
                <td>{{$detail->matauang}} @currency($detail->premi)</td>
              </tr>
              @endif

              @if (is_null($detail->total_premi))
              @else
              <tr>
                <td>Total Premi</td>
                <td> : </td>
                <td>{{$detail->matauang}} @currency($detail->total_premi)</td>
              </tr>
              @endif
              
              
              
              

              @if (is_null($detail->pekerjaan))
              @else
              <tr>
                <td>Pekerjaan Tertanggung</td>
                <td> : </td>
                <td>{{$detail->pekerjaan}}</td>
              </tr>
              @endif

              @if (is_null($detail->usia_polis))
              @else
              <tr>
                <td>Usia Polis</td>
                <td> : </td>
                <td>{{$detail->usia_polis}}</td>
              </tr>
              @endif
              
              

              @if (is_null($detail->alamat_tertanggung))
              @else
              <tr>
                <td>Alamat</td>
                <td> : </td>
                <td>{{$detail->alamat_tertanggung}}</td>
              </tr>
              @endif
            </table>
            @if($detail->nm_perusahaan == 'PT. ASURANSI RELIANCE INDONESIA')
            <h5 style="margin-top: 10px;"><u>INFORMASI PESERTA RELIANCE</u></h5>
            <table style="font-size: 13px; width: 100%; border-collapse: collapse;">
              @if(!is_null($detail->nama_peserta))<tr><td style="padding: 3px 0;">Nama Peserta</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{$detail->nama_peserta}}</td></tr>@endif
              @if(!is_null($detail->nomor_peserta))<tr><td style="padding: 3px 0;">Nomor Peserta</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{$detail->nomor_peserta}}</td></tr>@endif
              @if(!is_null($detail->tgl_mulai))<tr><td style="padding: 3px 0;">Tanggal Mulai</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{ Carbon\carbon::parse($detail->tgl_mulai)->isoFormat('D MMM Y') }}</td></tr>@endif
              @if(!is_null($detail->tgl_pengajuan))<tr><td style="padding: 3px 0;">SPAJ/Tanggal Pengajuan</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{ Carbon\carbon::parse($detail->tgl_pengajuan)->isoFormat('D MMM Y') }}</td></tr>@endif
              @if(!is_null($detail->tgl_selesai))<tr><td style="padding: 3px 0;">Tanggal Selesai</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{ Carbon\carbon::parse($detail->tgl_selesai)->isoFormat('D MMM Y') }}</td></tr>@endif
              @if(!is_null($detail->tgl_klaim))<tr><td style="padding: 3px 0;">Tanggal Klaim</td><td style="padding: 3px 0;"> : </td><td style="padding: 3px 0;">{{ Carbon\carbon::parse($detail->tgl_klaim)->isoFormat('D MMM Y') }}</td></tr>@endif
            </table>
            @endif
          </td>
          <td style="padding-left:20px;">
            <h5><u> INFORMASI KLAIM </u></h5>
            <table style="font-size:14px;">
              @if (is_null($detail->tgl_meninggal))
                @if (is_null($detail->tgl_dirawat_dr))
                  
                  @else
                  <tr>
                    <td>Tanggal Dirawat</td>
                    <td> : </td>
                    <td>
                      @if (is_null($detail->tgl_dirawat_dr)) - @else {{ Carbon\carbon::parse($detail->tgl_dirawat_dr)->isoFormat('D MMM Y') }} @endif
                      - @if (is_null($detail->tgl_dirawat_smp)) - @else {{ Carbon\carbon::parse($detail->tgl_dirawat_smp)->isoFormat('D MMM Y') }} @endif
                    </td>
                  </tr>
                @endif
              
              @else
              <tr>
                <td>Tanggal Meninggal</td>
                <td> : </td>
                <td>
                  @if (is_null($detail->tgl_meninggal)) - @else {{ Carbon\carbon::parse($detail->tgl_meninggal)->isoFormat('D MMM Y') }} @endif
                </td>
              </tr>
              @endif
              
             @if (is_null($detail->tempat_meninggal))
                @if (is_null($detail->rumah_sakit))
                  
                @else
                  <tr>
                    <td>Tempat dirawat</td>
                    <td> : </td>
                    <td>{{$detail->rumah_sakit}}</td>
                  </tr>
                @endif
             @else
              <tr>
                <td>Tempat Meninggal</td>
                <td> : </td>
                <td>{{$detail->tempat_meninggal}} {{$detail->rumah_sakit}}</td>
              </tr>
              @endif

              @if (is_null($detail->diagnosa_utama))
              @else
              <tr>
                <td>Diagnosa</td>
                <td> : </td>
                <td>{{$detail->diagnosa_utama}}</td>
              </tr>
              @endif
              
              @if (is_null($detail->jml_klaim))
              @else
              <tr>
                <td>Jumlah Klaim</td>
                <td> : </td>
                <td>{{$detail->matauang}} @currency($detail->jml_klaim)</td>
              </tr>
              @endif

              @if (is_null($detail->area_investigasi))
              @else
              <tr>
                <td>Area Investigasi</td>
                <td> : </td>
                <td>{{$detail->area_investigasi}}</td>
              </tr>
              @endif

              @if (is_null($detail->pengaju_klaim))
              @else
              <tr>
                <td>Pengaju Klaim</td>
                <td> : </td>
                <td>{{$detail->pengaju_klaim}}</td>
              </tr>
              @endif

              @if (is_null($detail->kronologi_singkat))
              @else
              <tr>
                <td>Konologi Singkat</td>
                <td> : </td>
                <td>{{$detail->kronologi_singkat}}</td>
              </tr>
              @endif

            </table>
          </td>
        </tr>
      </table>
      
      <table>
        <tr valign="top">
          <td>
            <h5><u> INFORMASI LAIN </u></h5>
              @if (is_null($detail->informasi_lain))
              @else
                <p style="font-size:14px;">{{ $detail->informasi_lain }}</p>
              @endif
          </td>
        </tr>
      </table>
    </div>

    <h4><u>PENDALAMAN INVESTIGASI</u></h4>
    <div class="border-dot">
      <table style="margin-right: 25px;">
        <tr>
          <td>
            <b>DIM</b> melakukan  pengecekan pada dokumen klaim, pada Surat Permohonan Penutupan Asuransi (SPPA)/Surat Penutupan Asuransi Jiwa(SPAJ) serta indikasi&#45;indikasi 
            lainnya maka ada beberapa hal yang perlu dibuktikan dalam investigasi di lapangan 
            nantinya : 
          </td>
        </tr>
      </table>
      <table style="margin-right: 20px; text-align: justify">
            <tr valign="top">
              <td>1. </td>
              <td>
                Membuktikan bahwa benar Tertanggung membeli polis asuransi secara mandiri (sendiri) dan bukan  
                “dipakai” sebagai perpanjangan tangan orang&#45;orang yang mencari keuntungan atas polis tersebut.
              </td>
            </tr>
          <tr valign="top">
              <td>2. </td>
              <td>
                Membuktikan kesesuaian antara informasi yang diberikan pada Surat Permohonan Penutupan Asuransi (SPPA)/Surat Penutupan Asuransi Jiwa(SPAJ) serta fakta&#45;fakta yang ada dilapangan  
                nantinya, terutama menyangkut penandatanganan Surat Permohonan Penutupan Asuransi (SPPA)/Surat Penutupan Asuransi Jiwa(SPAJ),financial background,dll. 
              </td>
            </tr>
            <?php
              $no=2;
            ?>
            @foreach ($pendalaman as $item)
            <?php $no++; ?>
            <tr valign="top">
              <td>{{$no}}.</td>
              <td>
                {{$item->pendalaman}}
              </td>
            </tr>
            @endforeach
      </table>
    </div>
  </div>
  {{-- end page informasi --}}

  {{-- INvestigasi Lapangan --}}

  <div class="page" style="margin-left: 30px; margin-right: 20px;font-family: Arial, Helvetica, sans-serif;">
    <table style="margin-left: 25px;">
      <tr>
        <td>
          <img src="{{ base64_image('lib_report/logo_head.png') }}" alt=""> 
        </td>
        <td >
        <h2 style="text-align: center; margin-left : 40px">INVESTIGASI LAPANGAN</h2>
        </td>
      </tr>
    </table>


    @foreach ($kategori as $item)
    <?php $no=1; ?>
    <div class="border-dot" style="margin-top:30px; margin-bottom:30px ;">
      
    @if ($item->kategori_investigasi !== "UPDATE LAIN")    
    <p style="font-weight: bold;margin-bottom: 1px;">{{$item->kategori_investigasi}}</p>
    @endif  
      
      @foreach ($data as $val)
        <?php if ($item->kategoriinvestigasi_id == $val->kategoriinvestigasi_id) { ?>
            <!--<table style="margin-right: 30px; text-align: justify">-->
            <!--  <tr>-->
                
            <!--    <td>-->
                    <p style="page-break-after: auto;">{!!$val->update_investigasi!!} 
                        <span style="font-size:12px;">
                            @if ($val->tampilkan_tgl == '1')
                            (Tanggal Penelusuran : @if(is_null($val->tanggal)) - @else {{ Carbon\carbon::parse($val->tanggal)->isoFormat('D MMM Y') }} @endif)
                            @endif
                        </span>
                    </p>
            <!--        </td>-->

            <!--  </tr>-->
            <!--</table>-->
                <div style="page-break-inside: auto;">
                  <table style="page-break-after: auto;">
                    
                    
                      {{-- {{$val->investigasi_id}} --}}
                      <?php  
                          $con = 1;
                        ?>
                        <tr style="width:300px; page-break-inside:avoid; page-break-after:auto">
                        @foreach ($foto as $res)
                        
                      
                          <?php if ($val->id_upin == $res->updateinvestigasi_id) { 
                                $picture = $res->path;
                          ?>
                        
                          
                              <td>
                                <p><img src="{{ base64_image('storage/'.$picture) }}" alt="" style="width: 230; height: 170"></p>
                                <p style="font-size:10px;" align=center;>{{$res->judul}}</p>
                              
                              </td>
                              <?php if ($con/2 == 1  ) { 
                                  $con = 0;
                              ?>
                              
                                </tr>
                                <tr>
                              <?php   }  ?>
                            
                            <?php $con++;}  ?>
                              
                          
                        @endforeach
                      </tr>
                  </table>
                </div>
      <?php }?>
      @endforeach
    </div>
    @endforeach




  {{-- End INvestigasi Lapangan --}}


  {{-- kepemilikan polis --}}

  <!-- <div  class="page" style="font-family: Arial, Helvetica, sans-serif;"> -->

  <!--<div class="page border-dot" style="font-family: Arial, Helvetica, sans-serif;margin-top:30px;">-->
  <!--  <h4>KEPEMILIKAN POLIS ASURANSI</h4>-->
  <!--  <table class="table-polis" style="page-break-after: auto;">-->
  <!--    <tr>-->
  <!--      <th class="th-polis">No</th>-->
  <!--      <th class="th-polis">Perusahaan Asuransi</th>-->
  <!--      <th class="th-polis">Issued Polis</th>-->
  <!--      <th class="th-polis">Uang Pertanggungan</th>-->
  <!--      <th class="th-polis">Klaim</th>-->
  <!--      <th class="th-polis">Keputusan</th>-->
  <!--    </tr>-->
  <!--    <tr>-->
  <!--      <td class="td-polis">1</td>-->
  <!--      <td class="td-polis">{{$detail->nm_perusahaan}}</td>-->
  <!--      <td class="td-polis">@if (is_null($detail->tgl_efektif_polis)) - @else {{ Carbon\carbon::parse($detail->tgl_efektif_polis)->isoFormat('D MMM Y') }} @endif</td>-->
  <!--      <td class="td-polis">{{$detail->matauang}} @currency($detail->uang_pertanggungan)</td>-->
  <!--      <td class="td-polis"></td>-->
  <!--      <td class="td-polis"></td>-->
  <!--    </tr>-->
  <!--    <?php $no=2; ?>-->
  <!--    @foreach ($polislain as $polis)-->
  <!--    <tr>-->
  <!--      <td class="td-polis"><?php echo $no++; ?></td>-->
  <!--      <td class="td-polis">{{$polis->nm_perusahaan}}</td>-->
  <!--      <td class="td-polis"></td>-->
  <!--      <td class="td-polis"></td>-->
  <!--      <td class="td-polis"></td>-->
  <!--      <td class="td-polis"></td>-->
  <!--    </tr>-->
  <!--    @endforeach-->
  <!--  </table>-->
  <!--</div>-->
  {{-- End kepemilikan polis --}}


  {{-- kesimpulan --}}

  <div class="page" style="font-family: Arial, Helvetica, sans-serif;">
    <table style="margin-bottom:30px;">
      <tr>
        <td>
          <img src="{{ base64_image('lib_report/logo_head.png') }}" alt=""> 
        </td>
        <td >
        <h2 style="text-align: center; margin-left : 30px">KESIMPULAN AKHIR INVESTIGASI</h2>
        </td>
      </tr>
    </table>

    <?php $no=1; ?>
    <h4>KESIMPULAN</h4>
    <div class="border-dot">
      <p style="font-weight: bold;margin-bottom:2px;">
      Berdasarkan investigasi yang telah kami lakukan dan juga telah kami jabarkan secara 
      detail diatas berikut ini kami sampaikan kesimpulan hasil investigasi atas case ini sbb :
      </p>
      @foreach ($kesimpulan as $val)
        <!-- <div class="mr-3"> -->
        <!-- <table style=" text-align: justify;">
          <tr>
            <td>{!!$val->kesimpulan!!}</td>
          </tr> -->
        </table>
        <p>{!!$val->kesimpulan!!}</p>
        <!-- </div> -->
      @endforeach
    </div>
  </div>

  <table style="page-break-inside: auto; page-break-after: auto;">
    <tr>
      <td>
      <div style="page-break-after: auto; font-family: Arial, Helvetica, sans-serif;">
        <h4>REKOMENDASI KEPUTUSAN KLAIM</h4>
        <?php $no=1; ?>
        <div class="border-dot">
          <p style="font-weight: bold;margin-bottom:3px;">
            Bahwa berdasarkan kesimpulan hasil investigasi yang kami sampaikan sebelumnya, maka berikut
            kami sampaikan rekomendasi keputusan klaim yang dapat diambil lebih lanjut :
          </p>
          @foreach ($rekomendasi as $val)
            
            <table style="page-break-after: auto;text-align: justify;">
              <tr>
                <td valign="top" ><?php echo $no++; ?></td>
                <td style="padding-left:20px;"> {{$val->rekomendasi}}</td>
              </tr>
            </table>
            
          @endforeach
            

            <table style="page-break-after: auto;text-align: justify;">
              <tr>
                <td valign="top" ><?php echo $no++; ?>.</td>
                <td style="padding-left:20px;">Apa yang kami sampaikan di atas pada dasarnya adalah sebuah rekomendasi keputusan secara umum berdasarkan common practice, insurance perspective dan juga field finding, namun demikian hal tersebut kami kembalikan kepada Perusahaan Asuransi menyangkut keputusan akhir berdasarkan ketentuan Polis yang dimiliki serta pertimbangan lainnya.</td>
              </tr>

              <!--Update 05-02-2025-->
              <tr>
                <td valign="top"><?php echo $no++; ?>.</td>
                <td style="padding-left:20px;">Sesuai dengan keputusan Mahkamah Konstitusi terkait pembatalan Pasal 251 KUHD, dimana perusahaan asuransi sudah tidak bisa lagi membatalkan polis dan klaim asuransi secara sepihak, maka hendaknya setiap perusahaan asuransi harus melakukan dan menjalankan long term risk mitigation dimana beberapa hal yang harus dilakukan adalah penguatan pada saat seleksi resiko dengan melakukan pengecekan lapangan langsung untuk mengetahui kondisi yang benar untuk kasus-kasus tertentu, melakukan KYC lapangan untuk polis-polis yang sedang berjalan serta melakukan investigasi secara massive dan mendalam terhadap klaim-klaim yang diterima.</td>
              </tr>
            </table>
        </div>
      </div>
      </td>
    </tr>
  </table>

  {{-- End kesimpulan --}}

  {{-- lampiran --}}

  <div style="margin-top: 60px; font-family: Arial, Helvetica, sans-serif;">
    <?php $no=1;?>
        <div class="page" style="margin-right: 20px; margin-bottom: 20px; margin-top: 20px">
          <h2 style="text-align: center; margin-left : 0px;margin-bottom:20px;">LAMPIRAN</h2>
      @foreach ($lampiran as $key)
          <?php $data_img = $key->path;?>
          <div>
            
            <p><img style="width: 680px; height: 800px;" src="{{ base64_image('storage/'.$data_img) }}" alt=""></p>
            <p align="center" style="font-weight: bold;font-style:italic;">{{$key->title}}</p>
          </div>
      @endforeach
        </div>
      
  </div>
  {{--end lampiran--}} 


  </body>

</html>

