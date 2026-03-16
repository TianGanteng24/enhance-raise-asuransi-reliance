<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Report Sementara - no polis : {{$detail->no_polis}}</title>

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
  
    .border-solid{
      border-style: solid;
      margin : 30px 30px 30px 30px; 
      padding : 5px 5px 15px 15px;
    }

    .table-polis {
      font-family: arial, sans-serif;
      border-collapse: collapse;
      width: 100%;
    }

    .td-polis, .th-polis {
      border: 1px solid #dddddd;
      text-align: left;
      padding: 8px;
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

  <div class="border-solid" style="font-family: Arial, Helvetica, sans-serif;">
    <table >
      <tr>
        <td>
            <table>
            {{-- HEAD --}}
              
              <tr valign="top">
                <td width="150px">
                  <img src="{{ base64_image('lib_report/logo_head.png') }}">
                </td>
                <td align="center" style="padding-top:15px;">
                  <h2> LAPORAN INVESTIGASI SEMENTARA </h2>
                  <h3> {{ $detail->nm_perusahaan }} </h3>
                </td>
                <td><?php echo str_repeat("&nbsp;",5);?></td>
              </tr>
              {{-- end HEAD --}}
            </table>
            <hr>

            <table>
              <tr>
                <td colspan="2">
                  <h4>INFORMASI POLIS</h4>
                </td>
              </tr>
              <tr valign="top">
                <td>
                  <table style="font-size:13px;">
                    <tr>
                      <td>No.Polis</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>{{$detail->no_polis}}</td>
                    </tr>

                    @if (is_null($detail->nm_tertanggung))
                    @else
                    <tr>
                      <td>Nama Tertanggung</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>{{$detail->nm_tertanggung}}</td>
                    </tr>
                    @endif

                    @if (is_null($detail->nm_pemegang_polis))
                    @else
                    <tr>
                      <td>Nama Pemegang Polis</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>{{$detail->nm_pemegang_polis}}</td>
                    </tr>
                    @endif

                    @if (is_null($detail->nm_agen))
                    @else
                    <tr>
                      <td>Nama Agen</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>{{$detail->nm_agen}}</td>
                    </tr>
                    @endif

                    @if (is_null($detail->uang_pertanggungan))
                    @else
                    <tr>
                      <td>Uang Pertanggungan</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>{{$detail->matauang}} @currency($detail->uang_pertanggungan)</td>
                    </tr>
                    @endif

                    @if (is_null($detail->tgl_efektif_polis))
                    @else
                    <tr>
                      <td>Tanggal Penerbitan</td>
                      <td style="padding-left: 10px;"> : </td>
                      <td>@if(is_null($detail->tgl_efektif_polis)) - @else {{ Carbon\carbon::parse($detail->tgl_efektif_polis)->isoFormat('D MMM Y') }} @endif</td>
                    </tr>
                    @endif
                  </table>
                </td>
                
                <td style="padding-left:80px;">
                  <table style="font-size:13px;">
                    @if (is_null($detail->tgl_spaj))
                    @else
                    <tr>
                      <td>SPAJ</td>
                      <td> : </td>
                      <td>
                      @if(is_null($detail->tgl_spaj)) - @else {{ Carbon\carbon::parse($detail->tgl_spaj)->isoFormat('D MMM Y') }} @endif</td>
                    </tr>
                    @endif

                    @if (is_null($detail->tgl_joint))
                    @else
                    <tr>
                      <td>Tanggal Joint</td>
                      <td> : </td>
                      <td>{{ Carbon\carbon::parse($detail->tgl_joint)->isoFormat('D MMM Y') }}</td>
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
                </td>
              </tr>
            </table>

            @if($detail->nm_perusahaan == 'PT. ASURANSI RELIANCE INDONESIA')
            <h4 style="margin-top: 15px;">INFORMASI PESERTA RELIANCE</h4>
            <table style="font-size:13px; margin-bottom: 10px;">
              @if (!is_null($detail->nama_peserta))
              <tr>
                <td>Nama Peserta</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{$detail->nama_peserta}}</td>
              </tr>
              @endif
              @if (!is_null($detail->nomor_peserta))
              <tr>
                <td>Nomor Peserta</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{$detail->nomor_peserta}}</td>
              </tr>
              @endif
              @if (!is_null($detail->tgl_pengajuan))
              <tr>
                <td>Tanggal Pengajuan</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{ Carbon\carbon::parse($detail->tgl_pengajuan)->isoFormat('D MMM Y') }}</td>
              </tr>
              @endif
              @if (!is_null($detail->tgl_mulai))
              <tr>
                <td>Tanggal Mulai</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{ Carbon\carbon::parse($detail->tgl_mulai)->isoFormat('D MMM Y') }}</td>
              </tr>
              @endif
              @if (!is_null($detail->tgl_selesai))
              <tr>
                <td>Tanggal Selesai</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{ Carbon\carbon::parse($detail->tgl_selesai)->isoFormat('D MMM Y') }}</td>
              </tr>
              @endif
              @if (!is_null($detail->tgl_klaim))
              <tr>
                <td>Tanggal Klaim</td>
                <td style="padding-left: 10px;"> : </td>
                <td>{{ Carbon\carbon::parse($detail->tgl_klaim)->isoFormat('D MMM Y') }}</td>
              </tr>
              @endif
            </table>
            @endif

            {{-- informasi Klaim --}}
            <h4> INFORMASI KLAIM</h4>
            <table style="font-size:13px;">
              <tr valign="top">
                <td style="padding-right: 20px;">
                  <table>
                    @if (is_null($detail->tempat_meninggal))
                    @else
                      <tr>
                        <td>Tempat Meninggal</td>
                        <td style="padding-left: 35px;"> : </td>
                        <td>{{$detail->tempat_meninggal}}</td>
                      </tr>
                    @endif
                    
                    @if (is_null($detail->tgl_meninggal))
                    @else
                      <tr>
                        <td>Tanggal Meninggal</td>
                        <td style="padding-left: 35px;"> : </td>
                        <td>
                        @if(is_null($detail->tgl_meninggal)) - @else {{ Carbon\carbon::parse($detail->tgl_meninggal)->isoFormat('D MMM Y') }} @endif</td>
                      </tr>
                    @endif

                    @if (is_null($detail->tgl_dirawat_dr))
                    @else
                      <tr>
                        <td>Tanggal Di Rawat</td>
                        <td style="padding-left: 35px;"> : </td>
                        <td style="width:50%">
                        @if(is_null($detail->tgl_dirawat_dr)) - @else {{ Carbon\carbon::parse($detail->tgl_dirawat_dr)->isoFormat('D MMM Y') }} @endif</td>
                      </tr>
                    @endif

                    @if (is_null($detail->diagnosa_utama))
                    @else
                      <tr>
                        <td>Diagnosa Utama</td>
                        <td style="padding-left: 35px;"> : </td>
                        <td style="width:50%">{{$detail->diagnosa_utama}}</td>
                      </tr>
                    @endif
                  </table>
                </td>
                
                <td>
                  <table style="padding-left: 40px;">
                    @if (is_null($detail->area_investigasi))
                    @else
                      <tr>
                        <td>Area Investigasi</td>
                        <td style="padding-left: 15px;"> : </td>
                        <td style="width:30%">{{$detail->area_investigasi}}</td>
                      </tr>
                    @endif


                    @if (is_null($detail->pengaju_klaim))
                    @else
                      <tr>
                        <td>Pengajuan Klaim</td>
                        <td style="padding-left: 15px;"> : </td>
                        <td>{{$detail->pengaju_klaim}}</td>
                      </tr>
                    @endif

                    
                  </table>
                </td>
              </tr>
            </table>
            <table style="font-size:13px;">
                <tr>
                  <td>
                    @if (is_null($detail->kronologi_singkat))
                    @else
                      <tr>
                        <td>Kronologi Singkat</td>
                        <td style="padding-left: 80px;"> : </td>
                        <td>{{$detail->kronologi_singkat}}</td>
                      </tr>
                    @endif
                  </td>
              </tr>
            </table>
            
            <table>
              <tr valign="top">
                <td>
                  <h4>INFORMASI LAIN</h4>
                    @if (is_null($detail->informasi_lain))
                    @else
                      <p style="font-size:14px;">{{ $detail->informasi_lain }}</p>
                    @endif
                </td>
              </tr>
            </table>
    
        </td>
      </tr>
    </table>
  </div>

  {{-- UPdate Investigasi --}}
    <div  style="font-family: Arial, Helvetica, sans-serif;" style="page-break-inside: auto; page-break-after: auto;">
    @foreach ($kategori as $item)
    <?php $no=1; ?>
    
    <table class="border-solid">
      <tr>
        <td>
              @if ($item->kategori_investigasi !== "UPDATE LAIN")
                <b>{{$item->kategori_investigasi}}</b>         
              @endif
              @foreach ($data as $val)
                <?php if ($item->id == $val->kategoriinvestigasi_id) { ?>
                    <table style="margin-right: 20px; text-align: justify; font-size:14px;">
                      <tr>
                        <td>{!!$val->update_investigasi!!} (Tanggal : @if(is_null($val->tanggal)) - @else {{ Carbon\carbon::parse($val->tanggal)->isoFormat('D MMM Y') }} @endif)
                        </td>
                      </tr>
                    </table>
              <?php }?>
              @endforeach
        </td>
      </tr>    
    </table>  
    @endforeach
    </div>

  <div class="border-solid" style="font-family: Arial, Helvetica, sans-serif;" style="page-break-inside:avoid;">
    <h5 style="margin-bottom:5px;">KESIMPULAN SEMENTARA</h5>
    <?php $no=1; ?>
    @foreach ($kesimpulansementara as $kesimpulan)
        <table style="margin-right: 20px; text-align: justify; font-size:14px;" style="page-break-inside: auto; page-break-after: auto;">
          <tr>
            <td valign="top"><?php echo $no++; ?>. </td>
              <td>{{$kesimpulan->proses_kesimpulan_sementara}}
            </td>
          </tr>
        </table>
    @endforeach
  </div>

  <div class="border-solid" style="font-family: Arial, Helvetica, sans-serif;" style="page-break-inside:avoid;">

    <h5 style="margin-bottom:5px;">HAL-HAL MASIH DALAM PROSES DILAKUKAN</h5>


    @foreach ($masihdalamproses as $proses)
    <?php $no=1; ?>
            <table style="margin-right: 55px; text-align: justify; font-size:14px;">
              <tr>
                <td valign="top"><?php echo $no++; ?>. </td>
                  <td>{{$proses->proses_kesimpulan_sementara}}
                </td>
              </tr>
            </table>
    @endforeach
  </div>
</body>
</html>


  



  