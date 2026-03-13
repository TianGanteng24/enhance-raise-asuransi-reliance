<html>
  <head>
    <style>
    @page { margin: 180px 50px; }
    #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px;  text-align: center; }
    #footer { position: fixed; left: 0px; bottom: -280px; right: 0px; height: 150px; }
    #footer .page:after { content: counter(page, upper-roman); }
      
      
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

    td{
      font-size: 14px;
    }
    </style>
  </head>
  <body>
    <div id="header">
        <div style="font-family: Arial, Helvetica, sans-serif;">
          <table style="padding-top: -500px">
            <tr valign="top">
              <td width="150px">
                <img src="{{ asset('lib_report/logo_head.png') }}">
              </td>
              <td><?php echo str_repeat("&nbsp;",25);?></td>
              <?php $convertTgl1 = date('d-m-Y', strtotime($tgl1)); ?>
              <?php $convertTgl2 = date('d-m-Y', strtotime($tgl2)); ?>
              <td align="center">
                <h2 style="margin-bottom:5px;margin-top:35px;"> PORTOFOLIO CASE REPORT </h2>
                    Periode : <b> <?php echo $convertTgl1;?> S/D  <?php echo $convertTgl2;?> </b><br>
                    Perusahaan : <b>{{$peru->nm_perusahaan}}</b> 
              </td>
              <td><?php echo str_repeat("&nbsp;",5);?></td>
            </tr>
          </table>
        </div>
      <hr style="border: 2px solid black;">
    </div>
    <div id="footer"></div>
   
      <div id="content">
         <table class="garis" style="padding-top :0px; font-size: 14px;">
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
                <th>&nbsp;Status&nbsp;</th>
              </tr>
           </thead>
           <tbody>
             <?php $no=1; ?>
             @foreach ($data as $item)
                <tr>
                  <td align="center">&nbsp;<?php echo $no++ ?>&nbsp;</td>
                  <td align="center">&nbsp;{{$item->no_polis}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_tertanggung}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_pemegang_polis}}&nbsp;</td>
                  <td align="center">&nbsp;{{$item->tgl_efektif_polis}}&nbsp;</td>
                  <td style="text-align:right;">&nbsp;{{$item->matauang}} @currency($item->uang_pertanggungan)&nbsp;</td>
                  <td align="center">&nbsp;{{$item->jenis_klaim}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_agen}}&nbsp;</td>
                  <td>&nbsp;{{$item->nm_investigator}}&nbsp;</td>
                  <td align="center">&nbsp;
                    <?php if($item->status==2){?>
                      Wait approved
                    <?php }else if($item->status==1){ ?>
                      Complete
                    <?php }else {?>
                    On progress
                    <?php } ?>
                  &nbsp;</td>
                </tr>
             @endforeach
           </tbody>
         </table>
      </div>
   
  </body>
</html>
  