<?php
ini_set('display_errors','off');
session_start();
$formdata = $_SESSION['data'];
$sharedby = $_SESSION['sharedby'];
$formid = $_SESSION['formid'];


?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>H.A.R.T. Scan Report</title>
<link href="css/style.css" rel="stylesheet" type="text/css" />
</head>
<body>
<table border="0" cellpadding="0" cellspacing="0">
 <tr><td> 
  <div class="wrapper">
    <!-- Start Patient Information -->
    <table class="patientInfo" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td valign="top"><!-- Start Patient Details  p: Partient-->
          <div class="pDetails" style="height:250px;">
            <div class="header">
              <h2>Patient Details</h2>
            </div>
            <div class="form">
              <table cellpadding="0" cellspacing="0" width="459px" border="0">
                <tr class="row1">

                  <td><table cellpadding="0" cellspacing="4" width="455px" border="0">
                      <tr>
                        <td align="left" valign="center" width="20px"> UR </td>
                        <td align="left" valign="top" style="width:100px;"><div class="input" style="width:100px;"><?php if(empty($formdata['PatientUr'])) $formdata['PatientUr'] ="...." ; echo $formdata['PatientUr']; ?></div></td>
                        <td align="left" valign="top" style="width:45px;"> D.O.B <br />
                          <span style="font-size:9px;">dd/mm/yyyy</span></td>
                        <td align="left" valign="top" style="width:75px;"><div class="input" style="width:75px;"><?php if(empty($formdata['PatientDob'])) $formdata['PatientDob'] ="...." ;echo $formdata['PatientDob']; ?></div></td>
                        <td align="right" valign="top" width="30px"> Age </td>
                        <td align="left" valign="top" style="width:40px;"><div class="input" style="width:40px;"><?php if(empty($formdata['PatientAge'])) $formdata['PatientAge'] ="...." ;echo $formdata['PatientAge']; ?></div></td>
                        <td align="right" valign="top" width="30px">Sex</td>
                        <td align="left" valign="top" style="width:25px;"><div class="input" style="width:25px;"><?php if(empty($formdata['PatientSex'])) $formdata['PatientSex'] ="...." ;echo $formdata['PatientSex']; ?></div></td>
                      </tr>
                    </table></td>

                </tr>
                <tr class="row2">
                  <td><table cellpadding="0" cellspacing="4" width="455px" border="0">
                      <tr>
                        <td width="56px">Surname</td>
                        <td align="left" valign="top" style="width:145px;"><div class="input" style="width:145px;"><?php if(empty($formdata['PatientSurname'])) $formdata['PatientSurname'] ="...." ;echo $formdata['PatientSurname']; ?></div></td>
                        <td width="76px" align="right">First Name</td>
                        <td align="left" valign="top" style="width:145px;"><div class="input" style="width:145px;"><?php if(empty($formdata['PatientFirstname'])) $formdata['PatientFirstname'] ="...." ;echo $formdata['PatientFirstname']; ?></div></td>

                      </tr>
                    </table></td>
                </tr>
                <tr class="row3">
                  <td><table cellpadding="0" cellspacing="4" width="459px" border="0">
                      <tr>
                        <td valign="top">Address</td>
                        <td align="left" valign="top" style="width:390px;"><div class="input" style="width:385px; height:30px;"><?php if(empty($formdata['PatientAddress'])) $formdata['PatientAddress'] ="...." ;echo $formdata['PatientAddress']; ?></div></td>

                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><table cellpadding="0" cellspacing="4" width="459px" border="0">
                      <tr>
                        <td width="56px">Suburb</td>
                        <td align="left" valign="top" style="width:80px;"><div class="input" style="width:75px;"><?php if(empty($formdata['PatientSuburb'])) $formdata['PatientSuburb'] ="...." ;echo $formdata['PatientSuburb']; ?></div></td>

                        <td width="46px" align="right">State</td>
                        <td  align="left" valign="top" style="width:80px;"><div class="input" style="width:75px;"><?php if(empty($formdata['PatientState'])) $formdata['PatientState'] ="...." ;echo $formdata['PatientState']; ?></div></td>
                        <td width="66px" align="right">Post Code</td>
                        <td  align="left" valign="top" style="width:90px;"><div class="input" style="width:85px;"><?php if(empty($formdata['PatientPostcode'])) $formdata['PatientPostcode'] ="...." ;echo $formdata['PatientPostcode']; ?></div></td>
                      </tr>
                    </table></td>
                </tr>
                <tr class="row5">

                  <td><table cellpadding="0" cellspacing="4" width="459px" border="0">
                      <tr>
                        <td width="12px">H</td>
                        <Td  align="left" valign="top" style="width:120px;"><div class="input" style="width:120px;"><?php if(empty($formdata['PatientDob'])) $formdata['PatientTel'] ="...." ; echo $formdata['PatientTel']; ?></div></Td>
                        <td width="12px" align="right">M</td>
                        <Td align="left" valign="top" style="width:120px;"><div class="input" style="width:120px;"><?php if(empty($formdata['PatientDob'])) $formdata['PatientMob'] ="...." ;  echo $formdata['PatientMob']; ?></div></Td>
                       
                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td><table cellpadding="0" cellspacing="4" width="459px" border="0">
                      <tr>
                        <td style="width:43px;">Email</td>

                        <td align="left" valign="top" style="width:390px;"><div class="input" style="width:390px;"><?php if(empty($formdata['PatientDob'])) $formdata['PatientEmail'] ="...." ; echo $formdata['PatientEmail']; ?></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>
          </div>
          <!-- Start Study Details s:Study --></td>
        <td valign="top">
		<div class="sDetails" style="height:250px;">

            <div class="header">
              <h2>Study Details</h2>
            </div>
            <div class="sdFrom">
              <table class="patientInfo" cellpadding="0" cellspacing="0" border="0">
                <tr class="row1">
                  <td><table  cellpadding="0" cellspacing="4" border="0">
                      <tr>

                        <td>Exam ID</td>
                        <td  style="width:175px;"><div class="input" style="width:175px;"><?php echo $formdata['StudyExamid']; ?></div></td>
                        <td>&nbsp;&nbsp; Date <br />
                          <span style="font-size:9px;">&nbsp;&nbsp;dd/mm/yyyy</span></td>
                        <td style="width:75px;"><div class="input" style="width:75px;"><?php echo $formdata['StudyDate']; ?></div></td>
                      </tr>
                    </table></td>

                </tr>
                <tr class="row2">
                  <td ><table  cellpadding="0" cellspacing="4" border="0">
                      <tr>
                        <td>Institution</td>
                        <td style="width:175px;"><div class="input" style="width:175px;"><?php echo $formdata['StudyInstitution']; ?></div></td>
                        <td>&nbsp;&nbsp;Operator</td>
                        <td style="width:80px;"><div class="input" style="width:80px;"><?php echo $formdata['StudyOperator']; ?></div></td>

                      </tr>
                    </table></td>
                </tr>
                <tr>
                  <td ><table class="patientInfo" cellpadding="0" cellspacing="4" border="0">
                      <tr>
                        <td><img src="images/radio<?=($formdata['StudyTteToe'] == 4)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                        <td>TTE</td>

                        <td><img src="images/radio<?=($formdata['StudyTteToe'] == 5)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                        <td>TOE</td>
                        <td width="70px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Quality&nbsp;&nbsp;</td>
                        <td><img src="images/radio<?=($formdata['StudyQualityTd'] == 6)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                        <td>Good</td>
                        <td><img src="images/radio<?=($formdata['StudyQualityTd'] == 7)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                        <td width="120px">Technically Difficult</td>

                      </tr>
                    </table></td>
                </tr>
                <tr class="row4">
                  <td><table class="patientInfo" cellpadding="0" cellspacing="4" border="0">
                      <tr>
                        <td>Indication</td>
                        <td style="width:323px;"><div class="input" style="width:323px; height:30px;" ><?php echo $formdata['StudyIndication']; ?></div></td>

                      </tr>
                    </table></td>
                </tr>
                <tr  class="row5">
                  <td><table class="patientInfo" cellpadding="0" cellspacing="4" border="0">
                      <tr>
                        <td style="width:40px;">Height</td>
                        <td style="width:40px;"><div class="input" style="width:40px;"><?php echo $formdata['StudyHeight']; ?></div></td>

                        <td style="width:40px;">Weight</td>
                        <td style="width:40px;"><div class="input" style="width:40px;"><?php echo $formdata['StudyWeight']; ?></div></td>
                        <td style="width:40px;" align="right">BSA</td>
                        <td style="width:40px;"><div class="input" style="width:30px;"><?php echo $formdata['StudyBsa']; ?></div></td>
                        <td style="width:40px;"  align="right">BMI</td>
                        <td style="width:40px;"><div class="input" style="width:30px;"><?php echo $formdata['StudyBmi']; ?></div></td>
                      </tr>

                    </table></td>
                </tr>
                <tr  class="row6">
                  <td><table class="patientInfo" cellpadding="0" cellspacing="4" border="0">
                      <tr>
                        <td style="width:20px;">BP</td>
                        <td style="width:80px;"><div class="input" style="width:80px;"><?php echo $formdata['StudyBp']; ?></div></td>
                        <td style="width:20px;">HR</td>

                        <td style="width:80px;"><div class="input" style="width:80px;"><?php echo $formdata['StudyHr']; ?></div></td>
                        <td style="width:40px;">Rhythm</td>
                        <td style="width:95px;"><div class="input" style="width:95px;"><?php echo $formdata['StudyRhythm']; ?><?php //echo '-Not Sure-' ?></div></td>
                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>

          </div></td>
      </tr>
    </table>
    <!-- End  Patient Information -->
    <!--  Start  ventricular -->
    <table class="ventricular" width="100%" cellpadding="0" cellspacing="0" border="0">
      <tr>
        <td valign="top">
		<div class="col_01" style="height:175px;">
            <div class="header">

              <h2>Ventricular Volume <span>(M-mode / 2D)</span></h2>
            </div>
            <div class="content">
			<table  width="100%" cellpadding="0" cellspacing="1" border="0">
                <tr>
                  <td align="center">
              <table  width="100%" cellpadding="0" cellspacing="4" border="0">
                <tr>

                  <td align="center"><img src="images/radio<?=($formdata['VvLeftventricule'] == 1)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Hypovolaemia</td>
                  <td><img src="images/radio<?=($formdata['VvLeftventricule'] == 2)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Normal</td>
                  <td><img src="images/radio<?=($formdata['VvLeftventricule'] == 3)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Dilated</td>
                </tr>

              </table>
              </td>
			  </tr>
			  <tr>
			  <td>
			  <table  width="100%" cellpadding="0" cellspacing="4" border="0">
                <tr>
                  <td align="center">
				  <table border="0" cellpadding="0" cellspacing="0">

				  <tr><td style='text-align:center'>&lt; 3</td></tr>
				  <tr><td style='text-align:center'><img src="images/vent_img_01.jpg" height="40" alt=""  /></td></tr>
				  <tr><td style='text-align:center'> &lt; 8</td></tr>
				  
				  </table>
				  </td>
                  <td align="center">

				  <table border="0" cellpadding="0" cellspacing="0">
				  <tr><td style='text-align:center'>3 - 5.6</td></tr>
				  <tr><td style='text-align:center'><img src="images/vent_img_02.jpg" height="40"  alt=""  /></td></tr>
				  <tr><td style='text-align:center'> 8 - 14</td></tr>
				  
				  </table>
				  </td>
                  <td align="center">

				  <table border="0" cellpadding="0" cellspacing="0">
				  <tr><td style='text-align:center'>&gt;5.6</td></tr>
				  <tr><td style='text-align:center'><img src="images/vent_img_03.jpg" height="40" alt=""  /></td></tr>
				  <tr><td style='text-align:center'>&gt;14</td></tr>
				  </table>
				  </td>
                </tr>
              </table>

              </td>
			  </tr>
			  <tr>
			  <td>
			  <table  width="100%" cellpadding="0" cellspacing="4" border="0">

                <tr>
                  <td width="20%"></td>
                  <td>RV</td>

                  <td><img src="images/radio<?=($formdata['VvRightventricule'] == 1)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Normal</td>
                  <td><img src="images/radio<?=($formdata['VvRightventricule'] == 2)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Increased</td>
                </tr>
              </table>
			  </td>
			  </tr>

			  </table>
            </div>
          </div></td>
        <td valign="top">
		<div class="col_02" style="height:175px;">
            <div class="header">
              <h2>Systolic Function</h2>
            </div>
            <div class="content">

              <table  width="100%" cellpadding="0" cellspacing="4" border="0">
                <tr>
                  <td align="center"><img src="images/radio<?=($formdata['SfLeftventricule'] == 1)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Increased</td>
                  <td><img src="images/radio<?=($formdata['SfLeftventricule'] == 2)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Normal</td>
                  <td><img src="images/radio<?=($formdata['SfLeftventricule'] == 3)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Decreased</td>

                </tr>
              </table>
              <table  width="100%" cellpadding="0" cellspacing="4" border="0">
                <tr>
                  <td align="center">
				  <table border="0" cellpadding="0" cellspacing="0">
				  <tr><td style='text-align:center'>&gt; 44</td></tr>
				  <tr><td style='text-align:center'><img src="images/systolic_img_01.jpg" height="40" alt=""  /></td></tr>

				  <tr><td style='text-align:center'>&gt; 65</td></tr>
				  </table>
				  </td>
                  <td align="center">
				  <table border="0" cellpadding="0" cellspacing="0">
				  <tr><td style='text-align:center'>28-44</td></tr>
				  <tr><td style='text-align:center'><img src="images/systolic_img_02.jpg" height="40" alt=""  /></td></tr>

				  <tr><td style='text-align:center'>50-65</td></tr>
				  </table>
				  </td>
                  <td align="center"><table border="0" cellpadding="0" cellspacing="0">
				  <tr><td style='text-align:center'>&lt;28</td></tr>
				  <tr><td style='text-align:center'><img src="images/systolic_img_03.jpg" height="40" alt=""  /></td></tr>
				  <tr><td style='text-align:center'>&lt;50</td></tr>

				  </table></td>
                </tr>
              </table>
              <table  width="100%" cellpadding="0" cellspacing="4" border="0">
                <tr>
                  <td width="20%"></td>
                  <td>RV</td>
                  <td><img src="images/radio<?=($formdata['SfRightventricule'] == 1)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>

                  <td>Normal</td>
                  <td><img src="images/radio<?=($formdata['SfRightventricule'] == 2)?'_checked':''?>.jpg" width="14" height="14" alt=""  /></td>
                  <td>Decreased</td>
                </tr>
              </table>
            </div>
          </div></td>
        <td valign="top">
		<div class="col_03" style="height:175px;">

            <div class="header">
              <h2>Ejection Fraction</h2>
            </div>
            <div class="content">
              <table cellpadding="0" cellspacing="5" border="0" width="100%" style="margin-right:3px;">
                <tr>
                  <td style="font-size:11px;">LVEDD</td>
                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo $formdata['EfLvedd']; ?></div></td>

                  <td style="font-size:11px;">LVEDA</td>
                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo $formdata['EfLveda']; ?></div></td>
                </tr>
                <tr>
                  <td style="font-size:11px;">LVESD</td>
                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo $formdata['EfLvesd']; ?></div></td>
                  <td style="font-size:11px;">LVESA</td>

                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo $formdata['EfLvesa']; ?></div></td>
                </tr>
                <tr>
                  <td style="font-size:11px;">FS</td>
                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo $formdata['EfFs']; ?></div></td>
                  <td style="font-size:11px;">EF/FAC</td>
                  <td style="width:30px;"><div style="width:30px;" class="input"><?php echo number_format($formdata['EfFac']) ?></div></td>
                </tr>

              </table>
            </div>
          </div></td>
        <td valign="top">
		<div class="col_04" style="height:175px;">
            <div class="header">
              <h2>CO</h2>
            </div>
            <div class="content">

              <table cellpadding="0" cellspacing="4" border="0" width="100%" style="margin-right:4px;">
                <tr class="row">
                  <td colspan="3" style="font-size:11px;">LVOTd</td>
                  <td style="width:25px;"><div class="input"><?php echo $formdata['CoLvotd']; ?></div></td>
                </tr>
                <tr class="row">
                  <td  colspan="3" style="font-size:11px;">LVOT VTI</td>
                  <td style="width:25px;"><div class="input"><?php echo $formdata['CoLvotvti']; ?></div></td>

                </tr>
                <tr class="row">
                  <td colspan="3" style="font-size:11px;">HR</td>
                  <td style="width:25px;"><div class="input"><?php echo $formdata['CoHr']; ?></div></td>
                </tr>
                <tr class="row2">
                  <td align="right" style="font-size:11px;">CO</td>
                  <td style="width:25px;"><div class="input"><?php echo $formdata['CoCo']; ?></div></td>

                  <td  align="right" style="font-size:11px;">CI</td>
                  <td style="width:25px;"><div class="input"><?php echo $formdata['CoCi']; ?></div></td>
                </tr>
              </table>
            </div>
          </div></td>
      </tr>
    </table>

    <!--  End  ventricular -->
	

    <!--  Start LAFP -->
    <table cellpadding="0" cellspacing="0" border="0" width="100%"  class="lafpContainer">
      <tr>
        <td valign="top">
		<div class="lafp"  style="height:222px;">
            <div class="header">
              <table cellpadding="0" cellspacing="0" border="0"><tr><td><h2>Left Atrial Filling Pressure </h2></td><td style="margin-top:8px;" align="left"><h2><span>(Interatrial Septum Motion)</span></h2></td></tr></table>
            </div>

            <div class="content">
              <table cellpadding="0" cellspacing="0" border="0" width="100%">
                <tr class="row">
                  <td width="10%" align="center" style=" border-bottom: 1px solid #003300; border-left:0px;">
				  <table cellpadding="0" cellspacing="0" border="0">
				  <tr>
				  <td style=" border-bottom: 1px solid #003300; border-left:0px;"><div class="stH">PSAX / A4Ch</div></td>
				  </tr>

				  <tr>
				  <td><img src="images/image_02.jpg" width="106" height="75" alt=""  /></td>
				  </tr>
				  </table>
				  </td>
                  <td width="30%" align="center" valign="bottom" style=" border-bottom: 1px solid #003300; border-left: 1px solid #003300;">
				<table cellpadding="0" cellspacing="0" border="0">
                <tr><td style="border:0px"><img src="images/radio<?=($formdata['Lafp'] == 1)?'_checked':''?>.jpg" width="14" height="14"  /> Low LA Pressure</td></tr>

				<tr><td style="border:0px"><table cellpadding="0" cellspacing="0" border="0"><tr>
				<td style="border:0px"><img src="images/la_01.jpg" width="66" height="75" alt="" /></td>
				<td style="border:0px"><img src="images/la_02.jpg" width="71" height="75" alt=""  /></td></tr></table></td></tr>
				</table>
				  
					</td>
                  <td width="29%" align="center" valign="bottom" style=" border-bottom: 1px solid #003300; border-left: 1px solid #003300;">
				  <table cellpadding="0" cellspacing="0" border="0">
                <tr><td style="border:0px"><img src="images/radio<?=($formdata['Lafp'] == 2)?'_checked':''?>.jpg" width="14" height="14"  /> Normal LA Pressure</td></tr>

				<tr><td style="border:0px">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				<td style="border:0px"><img src="images/la_05.jpg" width="66" height="75" alt="" /></td>
				<td style="border:0px"><img src="images/la_04.jpg" width="73" height="75" alt="" /></td>
				</tr>
				</table>
				</td></tr>
				</table>

				</td>
                  <td width="30%" align="center" valign="bottom" style=" border-bottom: 1px solid #003300; border-left: 1px solid #003300;">
				  <table cellpadding="0" cellspacing="0" border="0">
                <tr><td style="border:0px"><img src="images/radio<?=($formdata['Lafp'] == 3)?'_checked':''?>.jpg" width="14" height="14"  /> High LA Pressure</td></tr>
				<tr><td style="border:0px">
				<table cellpadding="0" cellspacing="0" border="0">
				<tr>
				<td style="border:0px"><img src="images/la_05.jpg" width="66" height="75" alt="" /></td>

				<td style="border:0px"><img src="images/la_06.jpg" width="71" height="75" alt=""  /></td>
				</tr>
				</table>
				</td></tr>
				</table>
				  
				  
                    <div>   </div></td>
                </tr>
                <tr class="row">

                  <td><img src="images/img_1.jpg" width="106" alt="" height="76"  /></td>
                  <td style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;">
                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <th colspan="2" align="center" class="head" style=" border-bottom: 1px solid #003300; border-left: 0px solid #003300;"><div >Systolic buckling</div></th>
                      </tr>
                      <tr>
                        <td align="center" width="50%"><img src="images/buckling_01.jpg" width="67" height="45" alt=""  />
                          <p>Diastole</p></td>

                        <td align="center" width="50%" style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;"><img src="images/buckling_02.jpg" width="68" height="45" alt=""  />
                          <p>Mid Systole</p></td>
                      </tr>
                    </table></td>
                  <td style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;">
                  
                  <table cellpadding="0" cellspacing="0" border="0" width="100%">
                      <tr>
                        <th colspan="2" align="center" class="head" style=" border-bottom: 1px solid #003300; border-left: 0px solid #003300;"><div>Systolic reversal</div></th>
                      </tr>

                      <tr>
                        <td align="center" width="50%"><img src="images/reversal_01.jpg" width="67" height="45" alt=""  />
                          <p>Diastole</p></td>
                        <td align="center" width="50%" style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;"><img src="images/reversal_02.jpg" width="66" height="45" alt=""  />
                          <p>Mid Systole</p></td>
                      </tr>
                    </table></td>
                  <td style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;"><table cellpadding="0" cellspacing="0" border="0" width="100%">

                      <tr>
                        <th colspan="2" align="center" class="head" style=" border-bottom: 1px solid #003300; border-left: 0px solid #003300;"><div >Fixed curvature</div></th>
                      </tr>
                      <tr>
                        <td align="center" width="50%"><img src="images/curvature_01.jpg" width="69" height="45" alt=""  />
                          <p>Diastole</p></td>
                        <td align="center" width="50%" style=" border-bottom: 0px solid #003300; border-left: 1px solid #003300;"><img src="images/curvature_02.jpg" width="67" height="45" alt=""  />
                          <p>Mid Systole</p></td>

                      </tr>
                    </table></td>
                </tr>
              </table>
            </div>
          </div></td>
        <td valign="top">
		<div class="va" style="height:222px;">
            <div class="header">
              <h2>Valve Assessment</h2>
	
            </div>
            <div class="content">
              <table width="100%" cellpadding="0" cellspacing="5" border="0" class="border_b">
				<?php 
		//		$formdata['VaExamined'] .=$formdata['VaExamined'].",";
		///		$formdata['VaStenosys'] .=$formdata['VaStenosys'].",";
			//	$formdata['VaRegurgitation'] .=$formdata['VaRegurgitation'].",";
			//	$formdata['VaPericardialEffusion'] .=$formdata['VaPericardialEffusion'].",";
				  $VaExamined = explode(',', $formdata['VaExamined']);
				  $VaStenosys = explode(',', $formdata['VaStenosys']);
				  $VaRegurgitation = explode(',', $formdata['VaRegurgitation']);
				  $VaPericardialEffusion = explode(',', $formdata['VaPericardialEffusion']);


				?>
                <tr class="row">
                  <td class="head" align="left" width="30%"><em><strong>Examined</strong></em></td>
                  <td width="15%" align="center">AV</td>
                  <td width="15%" align="center">MV</td>

                  <td width="15%" align="center">TV</td>
                  <td width="15%" align="center">PV</td>
                  <td width="10%"></td>
                </tr>
                <tr class="rowp" >
                  <td  align="right" ><em>Not Significant</em></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("1",$VaExamined))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("2",$VaExamined))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("3",$VaExamined))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td align="center"><img src="images/checkbox<?=(in_array("4",$VaExamined))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td ></td>
                </tr>
				<tr><td colspan="6" style="border-top:2px solid #000000;"></td></tr>
				<tr class="row">
                  <td  colspan="6" align="left" ><strong>Haemodynamically Significant</strong></td>
                </tr>
				<tr class="rowk" >
                  <td  align="right" ><em>Stenosis</em></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("5",$VaStenosys))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("6",$VaStenosys))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("7",$VaStenosys))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td align="center"><img src="images/checkbox<?=(in_array("8",$VaStenosys))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                <td ></td>
				</tr>
				 <tr class="rowk" >
                  <td  align="right" ><em>Regurgitation</em></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("9",$VaRegurgitation))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("10",$VaRegurgitation))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  align="center"><img src="images/checkbox<?=(in_array("11",$VaRegurgitation))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td align="center"><img src="images/checkbox<?=(in_array("12",$VaRegurgitation))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td ></td>

                </tr>
                <tr class="rowk">
                  <td width="40%"></td>
                  <td width="10%"  align="center"><img src="images/checkbox<?=(in_array("13",$VaPericardialEffusion))?'_checked':''?>.jpg" width="13" height="13"  alt=""  /></td>
                  <td  width="50%" colspan="4" align="left" >Pericardial Effusion</td>
                </tr>
              </table>
            </div>

          </div></td>
      </tr>
    </table>
    <!--  End LAFP -->
    
	<!--  Start  Hs -->
    <div class="hsContainer">
	<table cellpadding="0" border="0" cellspacing="0">
	<tr><td align="left" valign="top" style="width: 566px;">
      <div class="hs"  style="height:220px;">

        <div class="header">
          <h2>Haemodynamic State</h2>
        </div>
        <div class="content">
          <table width="100%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <td style="border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;">&nbsp;</td>
			  <?php 
			  $HaemodynamicState = explode(',',$formdata['HaemodynamicState']);
			  ?>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 1)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
 
                Normal </td>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 2)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
                Empty </td>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 3)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
                Vaso dilated </td>

              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 4)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
                Primary Systolic Failure </td>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 5)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
                Primary Diastolic Failure </td>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[0] == 6)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />

                Systolic & Diastolic Failure </td>
              <td style=" border-bottom: 2px solid #000000; border-left:0px; border-right:0px; padding:20px 0 0 0;"> <img src="images/radio<?=($HaemodynamicState[1] == 7)?'_checked':''?>.jpg" width="14" height="14" alt=""  /> <br />
                RV Failure </td>
            </tr>
            <tr ><td colspan='8' style='margin-top:10px;'>&nbsp;</td></tr>
            <tr >
              <td style='height:24px;'>Volume</td>

              <td style='height:24px;'> - </td>
              <td style='height:24px;'>Decr</td>
              <td style='height:24px;'> - </td>
              <td style='height:24px;'>Incr</td>
              <td style='height:24px;'> -  / Decr</td>
              <td style='height:24px;'>Incr</td>

              <td style='height:24px;'>RV Incr</td>
            </tr>
            <tr>
              <td style='height:24px;'>Systolic Function</td>
              <td style='height:24px;'> - </td>
              <td style='height:24px;'> -  / Incr</td>
              <td style='height:24px;'>Incr</td>

              <td style='height:24px;'>Decr</td>
              <td style='height:24px;'> - </td>
              <td style='height:24px;'>Decr</td>
              <td style='height:24px;'>RV Decr</td>
            </tr>
            <tr>
              <td style='height:24px;'>Filling Pressure</td>

              <td style='height:24px;' > - </td>
              <td style='height:24px;'>Decr</td>
              <td style='height:24px;'> - </td>
              <td style='height:24px;'> - </td>
              <td style='height:24px;'>Incr</td>
              <td style='height:24px;'>Incr</td>

              <td style='height:24px;'>Incr</td>
            </tr>
          </table>
        </div>
      </div>
      </td><td align="left" valign="top">
	  <div class="apa" style="height:220px;">
        <div class="header">

          <h2>Atria / PA pressure</h2>
        </div>
        <div class="content">
          <table width="96%" cellpadding="0" cellspacing="0" border="0">
            <tr>
              <th>LA diam</th>
              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaLaDiam']; ?></div></td>
              <th>RA diam</th>

              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaRaDiam']; ?></div></td>
            </tr>
            <tr>
              <th>LA area</th>
              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaLaArea']; ?></div></td>
              <th>RA area</th>
              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaRaArea']; ?></div></td>
            </tr>

            <tr>
              <th>TR Vmax</th>
              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaTrvMax']; ?></div></td>
              <th>TVGr</th>
              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaTvgr']; ?></div></td>
            </tr>
            <tr>
              <th>RAP</th>

              <td style="width:35px"><div class="input"><?php echo $formdata['AtriaRap']; ?></div></td>
              <th>RVSP</th>
              <td style="width:35px"><div class="input"><?php echo number_format($formdata['AtriaRsvp']); ?></div></td>
            </tr>
			
          </table>
        </div>
      </div>
		</td>

		</tr>
		</table>
	</div>
    <!--  End HS -->

    <!--  Start Comments  -->
    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="comments">
    <tr>
    	<td>

      <h2>Comments</h2>
      
        <div class="input" style="width:99%; clear:both; margin:10px 0 10px 0; height:200px;"><?php echo str_replace("\n","<br>",$formdata['Comments']); ?></div>
      
       
        	<table width="100%" border="0" cellpadding="0" cellspacing="0" >
         	<tr>
          		<td width="3%"><img src="images/checkbox.jpg" width="13" height="13" alt=""  /></td>
            <td width="57%" align="left">Refer for full echocardiography study</td>
            
            <td width="40%"> <div class="sign"><strong>Signature</strong></div></td>

          </tr>
         </table>
         
        
      
     </td>
    </tr>
    </table>
   
    <!--  Start Comments  -->
	
    <!-- Start H.R.T.A Sscan Extended -->
    <div class="extContainer">
      <div  class="extHead">

        <h2>HARTscan - Extended</h2>
      </div>
      <div class="extCc">
        <table width="100%" border="0" cellpadding="0" cellspacing="7">
          <tr>
            <td class="col1" style="border: 3px solid #003300;" valign="top"><div class="header">
                <h2>AV</h2>
              </div>

              <table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr>
                  <td align="left">LVOTd</td>
                  <td align="left">LVOT VTI</td>
                  <td align="left">AV VTI</td>
                </tr>
                <tr>

                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapLvotd']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapLvotvti']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAvvti']; ?></div></td>
                </tr>
                <tr>
                  <td>AVA</td>
                  <td>AVGp</td>
                  <td>AVGm</td>

                </tr>
                <tr>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAva']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAvpg']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAvgm']; ?></div></td>
                </tr>
                <tr>
                  <td>Dim Index</td>

                  <td>AI jet %</td>
                  <td>AI P1/2t</td>
                </tr>
                <tr>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapDimindex']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAljet']; ?></div></td>
                  <td style="width:38px;"><div class="input"><?php echo $formdata['PapAlpl']; ?></div></td>
                </tr>

              </table></td>
            <td class="col2" valign="top" style="border: 3px solid #800000;"><div class="header">
                <h2>Ao/PA</h2>
              </div>
              <table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr>
                  <td align="center">Ao Root</td>
                </tr>

                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapAoroot']; ?></div></td>
                </tr>
                <tr>
                  <td align="center">Asc Ao</td>
                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapAseao']; ?></div></td>

                </tr>
                <tr>
                  <td align="center">PA</td>
                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapPa']; ?></div></td>
                </tr>
              </table></td>

			<td class="col3" valign="top" style="border: 3px solid #000080;"><div class="header">
                <h2>MV</h2>
              </div>
              <table width="100%" border="0" cellpadding="0" cellspacing="4">
                <tr>
                  <td align="center">Radius</td>
                  <td align="center">Scale</td>

                  <td align="center">CW-MR</td>
                  <td align="center">ERO</td>
                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMvradius']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMvscale']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapCwmr']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapEro']; ?></div></td>

                </tr>
                <tr>
                  <td align="center">MV P1/2t</td>
                  <td align="center">MVA</td>
                  <td align="center">MVGp</td>
                  <td align="center">MVGm</td>
                </tr>

                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMvpl2t']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMva']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMvgp']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['PapMvgm']; ?></div></td>
                </tr>
              </table></td>
            <td class="col4" valign="top" style="border: 3px solid #800000;"><div class="header">
                <h2>Diastolic Function</h2>

              </div>
              <table width="100%" border="0" cellpadding="0" cellspacing="5">
                <tr>
                  <td  align="center">E</td>
                  <td  align="center">A</td>
                  <td align="center">A dur</td>
                  <td align="center">DT</td>

                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfE']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfA']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfAdur']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfDt']; ?></div></td>
                </tr>
                <tr>
                  <td align="center">S</td>
                  <td align="center">D</td>
                  <td align="center">S/D</td>
                  <td align="center">pA dur</td>
                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfS']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfD']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfSd']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfPadur']; ?></div></td>
                </tr>
                <tr>
                  <td align="center">E'</td>
                  <td align="center">E/A</td>
                  <td align="center">E/E'</td>
                  <td align="center">IVRT</td>
                </tr>
                <tr>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfAdE']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfEa']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfEe']; ?></div></td>
                  <td align="center" style="width:38px;"><div class="input"><?php echo $formdata['DfIvrt']; ?></div></td>
                </tr>
              </table></td>
            <td class="col5" valign="top" style="border: 3px solid #003300;"><div class="header">
                <h2>LV</h2>
              </div>
              <table width="100%" border="0" cellpadding="0" cellspacing="2">
               
			<tr>
                  <td>LVH</td>
                  <td style="">
<?php if($formdata['LvLvh'] == 13)echo 'Mild'; elseif($formdata['LvLvh'] == 14)echo 'Moderate'; else echo 'Severe';?>
<?php /* Some problem here. PDF is not getting generated.?>
		<!--	<img src="images/radio<?php echo ($formdata['LvLvh'] == 13)?'_checked':''?>.jpg" width="14" height="14" alt="" />
                    &nbsp;<label>Mild</label>
                    <br />
					<br />
                    <img src="images/radio<?php echo ($formdata['LvLvh'] == 14)?'_checked':''?>.jpg" width="14" height="14" alt="" />
                    &nbsp;<label>Moderate</label>
                    <br />
					<br />
                    <img src="images/radio<?php echo ($formdata['LvLvh'] == 15)?'_checked':''?>.jpg" width="14" height="14" alt="" />

                    &nbsp;<label>Severe</label>-->
<?php */?>
</td>
                </tr>

                <tr>
                  <td>IVSWT</td>
                  <td style="padding:0 0 0 10px;">PWT</td>
                </tr>
                <tr>

                  <td><div class="input"><?php echo $formdata['LvIvswt']; ?></div></td>
                  <td style="padding:0 0 0 10px;"><div class="input"><?php echo $formdata['LvPwt']; ?></div></td>
                </tr>
                <tr>
                  <td>LV mass</td>
                  <td style="padding:0 0 0 10px;">LVi mass</td>
                </tr>
                <tr>

                  <td><div class="input"><?php echo $formdata['LvLvmass']; ?></div></td>
                  <td style="padding:0 0 0 10px;"><div class="input"><?php echo $formdata['LvLvimass']; ?></div></td>
                </tr>
              </table></td>
          </tr>
        </table>
      </div>
    </div>
    <!-- End H.R.T.A Sscan Extended -->
  </div>
</td><td width="20" align="left" valign="top"><img src="images/harta_scan.jpg" /></td></tr>
<tr><td colspan="2">HARTscan® is a registered trademark. © Copyright 2009. All rights reserved. This course and material is distrubuted by The University of Melbourne, Australia. UID:<?php echo $formdata['FormKey']; ?> 
 <?php echo "shared by ".$sharedby;  ?></td>
</td></tr>
</table>

</body>
</html>