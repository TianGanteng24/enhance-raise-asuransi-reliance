<html>
  <head>
    <style>
      @page { margin: 100px 25px; }
      header { position: fixed; top: -70px; left: 0px; right: 0px;  height: 70px; 
              margin-bottom: 50px}
      footer { position: fixed; bottom: -100px; left: 0px; right: 0px;  height: 50px; }
      /* .page { page-break-after: always;}
      .page:last-child {  page-break-after: avoid; } */
      
      
      table.garis{ 
        padding-top: 100px;
        border-collapse: collapse;
        border: 1px solid black;
        font-family: Arial, Helvetica, sans-serif;
      }
      table.garis td{ 
      border-collapse: collapse;
      border: 1px solid black;
    }

    table.garis th{ 
      border-collapse: collapse;
      border: 1.5px solid black;
    }
    </style>
  </head>
  <body>
    <header>
        <div style="font-family: Arial, Helvetica, sans-serif;">
          <table>
            <tr valign="top">
              <td width="150px">
                <img src="{{ public_path('lib_report/logo_head.png') }}">
              </td>
              <td><?php echo str_repeat("&nbsp;",25);?></td>
              <td align="center">
                <h2> PENDING INVESTIGASI REPORT </h2>
                    14/06/2021 S/D 14/06/2021
              </td>
              <td><?php echo str_repeat("&nbsp;",5);?></td>
            </tr>
          </table>
        </div>
      <hr style="border: 2px solid black;">
    </header>
    <footer>footer on each page</footer>
    <main>
      <div>
         <table class="garis" style="padding-top :80px">
           <thead>
              <tr>
                <th>&nbsp;No&nbsp;</th>
                <th>&nbsp;No. Polis&nbsp;</th>
                <th>&nbsp;Nama Tertanggung&nbsp;</th>
                <th>&nbsp;Nama Pemegang Polis&nbsp;</th>
                <th>&nbsp;Efektif Polis&nbsp;</th>
                <th>&nbsp;Uang Pertanggungan&nbsp;</th>
                <th>&nbsp;Jenis Klaim&nbsp;</th>
                <th>&nbsp;Agent&nbsp;</th>
                <th>&nbsp;Investigator&nbsp;</th>
              </tr>
           </thead>
           <tbody>
             <?php $no=1; ?>
             @foreach ($data as $item)
                <tr>
                  <td align="center">&nbsp;<?php echo $no++ ?>&nbsp;</td>
                  <td>&nbsp;{{$item->no_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_tertanggung}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_pemegang_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->tgl_efektif_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->uang_pertanggungan}}&nbsp;</td>
                  <td>&nbsp;{{$item->jenis_klaim}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_agen}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_investigator}}&nbsp;</td>
                </tr>
             @endforeach
           </tbody>
         </table>
      </div>
    </main>
  </body>
</html>
  