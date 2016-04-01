<?php if ($level=="0") { ?>
<section>
  <div class="col-sm-12 col-md-12 col-lg-3">
    <div class="row">
     <div class="list-group">
	     <div class="panel" style="border:0px;">
          <div class="list-group-item" style="background-color:#ff5722;">
              <h3 class="panel-title" style="font-weight:600; color:white; padding: 1px 150px 1px 10px;margin-top:10px; margin-botom:30px;">MEMBER</h3>
  		    </div>
      		    <div class="list-group-item"> 
      		      <div class="row">
      			        <div class="col-sm-3">	
      					      <div class="container">
                        <br/>
                        <?php if ($foto=="" || $foto==null){ ?>
                         <img class="profile-img-card-lrg" src="<?php echo $base_url; ?>/img/Avatar_member.png" />
                         <?php } else { ?>
        			           <img class="profile-img-card-lrg" src="<?php echo $base_url_member; ?>/foto/<?php echo $foto; ?>" />
                         <?php } ?>
                          <br/>
        		          </div>
        	          </div>
              	    <div class="col-sm-3">	
              				<div class="container" style="font-family:Arial;">
                        <br/>
              				  <h4 style="font-weight:600;"><?php echo $nama; ?></h4>
              				  <h5><?php echo $email; ?></h5>
                        <br/>
              				</div>
                    </div>
              	</div>	
        	    </div>		
              <div class="list-group-item">
        			<br/>
                <div class="container">
                <table class="sidebarProfile">
                  <tr>
                    <td>Id Customer</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="textBold"><?php echo $id;  ?></td>    
                  </tr>
                  <tr>
                    <td>Phone</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="textBold"><?php echo $notelp;  ?></td>    
                  </tr>
                  <tr>
                    <td>Location</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="textBold"><?php echo $tempat;  ?></td>    
                  </tr>
                  <tr>
                    <td>Unit</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="textBold"><?php echo $keterangan;  ?></td>    
                  </tr>
                  <tr>
                    <td>Package Active</td>
                    <td>&nbsp;:&nbsp;</td>
                    <td class="textBold"><?php echo $paket;  ?></td>    
                  </tr>
                  <tr>
                    <td>Active Until</td> 
                    <td>&nbsp;:&nbsp;</td>
                    <?php if($tanggal_akhir==""){ ?>
                      <td class="textBold"><?php echo "Not Active";  ?></td>
                    <?php } else { ?>
                    <td class="textBold"><?php $thn_akhir = substr($tanggal_akhir, 0,4);
                                      $bln_akhir = substr($tanggal_akhir, 5,2);
                                      $tgl_akhir = substr($tanggal_akhir, 8,10);
                                      $month_akhir = bulan($bln_akhir); echo $tgl_akhir.' '.$month_akhir.' '.$thn_akhir;  ?></td> 
                    <?php } ?>                  
                  </tr>
                </table>    
                  <h5><a  style="margin-top:20px;" href="<?php echo $base_url_member; ?>/edit-profile" class="btn btn-default background-btn-gray"><b>Update Your Profile</b></a></h5> 
                          <br/>  

        	      </div>	
            </div>
      </div>
    </div>
    </div>.
  </div>   
</section>
<?php } else { 
switch ($level) {
  case '7':
    $level_user="ADMIN WEB";
    $panel="#FF5F21";
  break;
  case '5':
    $level_user="SALES MANAGER";
    $panel="#FF5F21";
  break;
  case '501':
    $level_user="SALES";
    $panel="#FF5F20";
  break;
  case '4':
    $level_user="ADMIN HELPDESK";
    $panel="#d50000";
  break;
  case '401':
    $level_user="HELPDESK";
    $panel="#d50000";
  break;
  case '3':
    $level_user="ADMIN SUPPORT";
    $panel="#263238";
  break;
  case '301':
    $level_user="FIELD ENGINEER";
    $panel="#263238";
  break;
  case '302':
    $level_user="ASS FIELD ENGINEER";
    $panel="#263238";
  break;
  case '2':
    $level_user="BILLING";
    $panel="#1b5e20";
  break;  
  case '1':
    $level_user="ADMIN";
    $panel="#FF4523";
  break;  
  }
?>
<section>
  <div class="col-sm-12 col-md-12 col-lg-3">
     <div class="list-group">
       <div class="panel" style="border:0px;" >
          <div class="list-group-item" style="background-color:<?php echo $panel ?>;">
              <h3 class="panel-title" style="font-weight:600; color:white; padding: 1px 150px 1px 10px;margin-top:10px; margin-botom:10px;"><?php echo $level_user; ?></h3>
          </div>
          <div class="list-group-item"> 
            <div class="row">
                <div class="col-sm-3">  
                  <div class="container">
                    <br/>
                     <img class="profile-img-card profile-img-card-lrg" src="<?php echo $base_url_member; ?>/foto/<?php echo $foto; ?>" />
                      <br/>
                  </div>
                </div>
                <div class="col-sm-3">  
                  <div class="container" style="font-family:Arial;">
                    <br/>
                    <h4 style="font-weight:600;"><?php echo $nama; ?></h4>
                    <h5><?php echo $email; ?></h5>
                    <br/>
                  </div>
                </div>
            </div>  
          </div>    
          <div class="list-group-item">
          <br/>
            <div class="row">
              <div class="container">
                 <div class="col-sm-3">
                            <h5 style="font-weight:600;">Phone : <?php echo $notelp; ?></h5>  
                      <br/>  
                  </div> 
              </div>
            </div>  

        </div>
      </div>
    </div> 
  </div>  
</section>
<?php } ?>