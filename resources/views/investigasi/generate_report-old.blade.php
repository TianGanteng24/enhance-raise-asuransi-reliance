
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
    padding : 5px 5px 15px 15px;
  }



</style>

<div style="margin-bottom: 100px; font-family: Arial, Helvetica, sans-serif;">
<table style="margin-top: 90px">
  <tr valign="center">
    <td align="center">
      <H1>LAPORAN AKHIR INVESTIGASI</H1>
    </td>
    <td>
      <img src="{{ public_path('lib_report/logo.png') }}" >
    </td>
  </tr>
</table>


<div style="margin-left: -50px; margin-top: 30px; 
    background-color: rgb(8, 152, 235);width: 900px; height: 250px" >
    <table style="color: #ffffff;margin-left: 220px; font-size: 21px; font-display: ">
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
<table  style="margin-left: 70px;margin-right: 70px;margin-top:32px">
  <tr valign="center">
    <td align="center">
      <p style="font-size: 49px; font-weight: bold"> External <br> Investigasi </p> 
    </td>
    <td><?php echo str_repeat("&nbsp;",35);?></td>
    <td> 
      <img src="{{ public_path('lib_report/pic_1.png') }}" >
    </td>
  </tr>
</table>
</div>
{{-- page judul end --}}


{{-- star Kata Pengantar --}}
<div class="page" style="margin-top: 80px;  margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
<h2 style="text-align:center;">KATA PENGANTAR</h2>
<div class="border-dot">
<table style="padding:5px 15px 15px 5px">
  <tr>
    <td align ="" style="width: 150px;text-align: justify;">
      Kami mengucapkan terima kasih atas kepercayaan yang telah diberikan oleh <b> {{$detail->nm_perusahaan}} </b>
      kepada PT Deswa Invisco Multitama  (DIM) untuk melakukan  investigasi atas  
      klaim – klaim asuransi yang terjadi, bersama dengan ini pula secara 
       khusus kami menyampaikan laporan akhir hasil investigasi atas klaim 
       <b> No. Polis {{$detail->no_polis}} atas  {{$detail->nm_pemegang_polis}}l </b>untuk dapat diterima dengan baik, 
       perlu kami sampaikan bahwa proses investigasi <b> kami lakukan 
       dalam periode 07/07/2021 sd. 20/07/2021 *(diisi sesuai dengan periode investigasi )</b>, 
       dimana proses investigasi ini memerlukan tambahan waktu sehubungan dengan penelusuran  
       pada beberapa faskes di Malaysia dan Singapura. 
      <br><br>
      Perlu kami sampaikan bahwa Investigasi kasus ini <b> melingkupi wilayah *(diisi sesuai wilayah 
      investigasi) </b> untuk mencari dan mendapatkan informasi serta data yang berkaitan dengan Nasabah. 
      Secara lebih lengkap mengenai perjalanan  proses investigasi, temuan dilapangan, 
      kesimpulan hasil investigasi serta rekomendasi keputusan klaim dapat di lihat pada laporan akhir 
      investigasi ini. 
      <br><br>
      Kami berharap agar laporan akhir investigasi ini bisa menjadi dasar serta acuan dalam pengambilan 
      keputusan akhir klaim tersebut. 
      <br><br>	 
      Jika ada informasi atau hal‐hal dalam laporan ini yang  masih perlu untuk dimintakan penjelasan 
      lebih lanjut kami akan dengan senang hati membantu.  
      <br><br>
      Demikian informasi ini kami sampaikan, kami berharap  semoga kerjasama yang terjalin dengan 
      baik selama ini akan terus dapat kita tingkatkan kedepan.
      <br><br>
      Salam,
      <br><br>
      Jakarta, 20 Juli 2021
      <br>
      <b>Management PT Deswa Invisco Multitama (DIM)</b> 
      <br><br>
      <img src="{{ public_path('lib_report/ttd.png') }}" alt="">          
      <br>
      <?php echo str_repeat("&nbsp;",14);?><b><u>Suyadi Wahri</u></b>
      <br>
      <?php echo str_repeat("&nbsp;",18);?><b><i>Direktur</i></b>
    </td>
  </tr>
</table>
</div>
</div>
{{-- End Page Kata pengantar --}}

{{-- Star Daftar Isi --}}
<div class="page" style="margin-top: 60px; margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt="">
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
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">

<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt="">
    </td>
    <td>
      <h2><?php echo str_repeat("&nbsp;",10);?>METODE INVESTIGASI</h2>
    </td>
  </tr>
</table>
<img style="margin-top: 25px;" src="{{ public_path('lib_report/metode.png') }}">
</div>
{{-- end page metode --}}

{{-- page informasi --}}
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px;font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
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
      <h5><u> INFORMASI KLAIM </u></h5>
      <table>
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
          <td></td>
        </tr>
        <tr>
          <td>UP Dasar</td>
          <td> : </td>
          <td></td>
        </tr>
        <tr>
          <td>Plan</td>
          <td> : </td>
          <td></td>
        </tr>
        <tr>
          <td>SPAJ</td>
          <td> : </td>
          <td>{{$detail->tgl_spaj}}</td>
        </tr>
        <tr>
          <td>Total Premi</td>
          <td> : </td>
          <td>{{$detail->total_premi}}</td>
        </tr>
        <tr>
          <td>Pekerjaan Tertanggung</td>
          <td> : </td>
          <td>{{$detail->pekerjaan}}</td>
        </tr>
        <tr>
          <td>Usia Polis</td>
          <td> : </td>
          <td>{{$detail->usia_polis}}</td>
        </tr>
        <tr>
          <td>Alamat</td>
          <td> : </td>
          <td>{{$detail->alamat_tertanggung}}</td>
        </tr>
      </table>
    </td>
      <td><?php echo str_repeat("&nbsp;",10);?></td>
    <td>
      <h5><u> INFORMASI KLAIM </u></h5>
      <table>
        <tr>
          <td>Tanggal Meningal</td>
          <td> : </td>
          <td>{{$detail->tgl_meninggal}}</td>
        </tr>
        <tr>
          <td>Tempat Meninggal</td>
          <td> : </td>
          <td>{{$detail->tempat_meninggal}}</td>
        </tr>
        <tr>
          <td>Diagnosa</td>
          <td> : </td>
          <td>{{$detail->diagnosa_utama}}</td>
        </tr>
        <tr>
          <td>Area Investigasi</td>
          <td> : </td>
          <td>{{$detail->area_investigasi}}</td>
        </tr>
        <tr>
          <td>Pengaju Klaim</td>
          <td> : </td>
          <td>12 September 2021</td>
        </tr>
        <tr>
          <td>Konologi Singkat</td>
          <td> : </td>
          <td>12 September 2021</td>
        </tr>
      </table>
    </td>
  </tr>
</table>
</div>

<h4><u>PENDALAMAN INVESTIGASI</u></h4>
<div class="border-dot">
<table style="margin-right: 25px;">
  <tr>
    <td>
      <b>DIM</b> melakukan  pengecekan pada dokumen klaim, pada Surat Penutupan Asuransi Jiwa (SPAJ) serta indikasi‐indikasi 
      lainnya maka ada beberapa hal yang perlu dibuktikan dalam investigasi di lapangan 
      nantinya : 
    </td>
  </tr>
</table>
<table style="margin-right: 55px; text-align: justify">
      <tr valign="top">
        <td>1. </td>
        <td>
          Membuktikan bahwa benar Tertanggung membeli polis asuransi secara mandiri (sendiri) dan bukan  
          “dipakai” sebagai perpanjangan tangan orang‐orang yang mencari keuntungan atas polis tersebut.
        </td>
      </tr>
     <tr valign="top">
        <td>2. </td>
        <td>
          Membuktikan kesesuaian antara informasi yang diberikan pada SPAJ serta fakta‐fakta yang ada dilapangan  
          nantinya, terutama menyangkut penandatanganan SPAJ,financial background,dll. 
        </td>
      </tr>
     <tr valign="top">
        <td>3. </td>
        <td>
          Melakukan 	 pengecekan ke beberapa fasilitas kesehatan yang ada disekitar tempat tinggal 
          Tertanggung termasuk pengecekan pada beberapa faskes di Malaysia dan Singapura untuk 
          mengetahui riwayat perawatan.
        </td>
      </tr>
</table>
</div>
</div>
{{-- end page informasi --}}

{{-- INvestigasi Lapangan --}}
<div class="page" style="margin-top: 50px; margin-left: 50px; margin-right: 50px;font-family: Arial, Helvetica, sans-serif;">
<table style="margin-left: 25px;">
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
    </td>
    <td >
    <h2 style="text-align: center; margin-left : 50px">INVESTIGASI LAPANGAN</h2>
    </td>
  </tr>
</table>

<div class="border-dot" style="margin-top:30px;">
@foreach ($kategori as $item)
<?php $no=1; ?>
<p style="font-weight: bold;margin-bottom: 1px;">{{$item->kategori_investigasi}}</p>
  @foreach ($data as $val)
    <?php if ($item->id == $val->kategoriinvestigasi_id) { ?>
        <table style="margin-right: 55px; text-align: justify">
          <tr>
            <td valign="top"><?php echo $no++; ?>. </td>
            <td>{{$val->update_investigasi}}. - tgl investigasi : {{$val->tanggal}}
            </td>
          </tr>
        </table>
       
            <table>
              <?php  
                $arr = [];
                $con = 0;
              ?>
              <tr style="width:300px">
                  @foreach ($foto as $res)
                    <?php if ($val->id == $res->updateinvestigasi_id) { 
                          $picture = $res->path;
                          array_push($arr,$res->path);
                          $con = count($arr);  
                    ?>
                        <td>
                          <p><img src="{{ asset('media/photos/'.$picture) }}" alt="" style="width: 250; height: 200"><br/> </p>
                        </td>
                        <?php if ($con==2) { 
                          $con=0;
                        ?>
                          </tr>
                        <?php } ?>
                      
                      <?php } ?>
                  @endforeach
                </tr>
            </table>
   <?php }?>
  @endforeach
@endforeach
</div>
{{-- End INvestigasi Lapangan --}}


{{-- kesimpulan --}}

<div class="page" style="margin-top: 50px; font-family: Arial, Helvetica, sans-serif;">
<table>
  <tr>
    <td>
      <img src="{{ public_path('lib_report/logo_head.png') }}" alt=""> 
    </td>
    <td >
    <h2 style="text-align: center; margin-left : 30px">KESIMPULAN AKHIR INVESTIGASI</h2>
    </td>
  </tr>
</table>

<?php $no=1; ?>
<div style="margin-top:30px;">
    <h4>KESIMPULAN</h4>
</div>
<div class="border-dot">
  <p style="font-weight: bold;margin-bottom:2px;">
  Berdasarkan investigasi yang telah kami lakukan dan juga telah kami jabarkan secara 
  detail diatas berikut ini kami sampaikan kesimpulan akhir investigasi atas case ini sbb :
  </p>
  @foreach ($kesimpulan as $val)
    <div>
    <table style="margin-right: 80px; text-align: justify">
      <tr>
        <td valign="top" style="margin-right: 80px;"><?php echo $no++; ?>. </td>
        <td>{{$val->kesimpulan}}</td>
      </tr>
    </table>
    </div>
  @endforeach
  </div>
    <br>

    <h4>REKOMENDASI KEPUTUSAN KLAIM</h4>
  <?php $no=1; ?>
  <div class="border-dot">
    <p style="font-weight: bold;margin-bottom:3px;">
      Bahwa berdasarkan kesimpulan akhir investigasi yang kami sampaikan sebelumnya, maka berikut
      kami sampaikan rekomendasi keputusan klaim yang dapat diambil lebih lanjut :
    </p>
    @foreach ($rekomendasi as $val)
      <div class="mr-3">
      <table style="margin-right: 80px; text-align: justify">
        <tr>
          <td valign="top"><?php echo $no++; ?>. </td>
          <td>{{$val->rekomendasi}}</td>
        </tr>
      </table>
      </div>
    @endforeach
  </div>
</div>
{{-- End kesimpulan --}}

{{-- lampiran --}}
<div class="page" style="margin-top: 60px; margin-left: 50px; margin-right: 50px; font-family: Arial, Helvetica, sans-serif;">
  <h2 style="text-align: center; margin-left : 30px">LAMPIRAN</h2>
  <p style="font-weight:bold;font-style:italic; text-align:center;">(*setiap dokumen pendukung yang terdapat pada laporan dilampirkan disini
     dan satu dokumen untuk satu halaman)
  </p>
</div>
{{--end lampiran--}}

