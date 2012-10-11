<?php
ini_set('display_errors','on');
	$urls = array (
	'Home' => 'api/home.php',
	'Registration' => 'api/register.php',
'Login' => 'api/login.php',
'Password Reminder' => 'api/passwordreminder.php',
'Change Password' => 'api/changepassword.php',
'Faculty & Speciality' => 'api/faculty_specialty.php',
'Subscription' => 'api/subscription.php',
'Form Submission' => 'api/createform.php',
'Search Forms' => 'api/searchform.php',
'News' => 'api/news.php',
'Create Group' => 'api/creategroup.php',
'Join Group' => 'api/groupactions.php',
'Unjoin Group' => 'api/groupactions.php',
'Approve Group Request' => 'api/groupactions.php',
'Reject Group Request' => 'api/groupactions.php',
'Latest Groups' => 'api/latestgroups.php',
'Group Request Status' => 'api/grouprequests.php',
'My Group Requests' => 'api/mygrouprequests.php',
'Users List' => 'api/userlist.php',
'Search User' => 'api/searchusers.php',
'Auto Suggest' => 'api/message_autosuggest.php',
'News Detail' => 'api/newsdetails.php',
'View Forms' => 'api/viewallforms.php',
'View Single Form' => 'api/form.php',
'My Groups' => 'api/groups.php',
'Browse Groups' => 'api/searchgroups.php',
'Search Groups' => 'api/searchgroups.php',
'User Profile' => 'api/profile.php',
'Messages' => 'api/viewmessages.php',
'View Message' => 'api/viewmessage.php',
'Group User List' => 'api/groupuserlist.php',
'Search Groups' => 'api/searchgroups.php',
'Group Messages' => 'api/groupmessages.php',
'Content' => 'api/content.php',
'FAQS' => 'api/faqs.php',
'Group Form Share' => 'api/formshare.php',
'User Form Share' => 'api/formshare.php',
'Sent Messages' => 'api/sentmessages.php',
'Form History' => 'api/formhistory.php',
'Group Messages' => 'api/groupmessages.php',
'Locations' => 'api/locations.php',
'Affiliations' => 'api/affiliations.php',
'Delete User' => 'api/deleteuser.php',
'Delete Message' => 'api/deletemessage.php',
'Delete Group' => 'api/deletegroup.php',
'Additional Subscription' => 'api/additionalsubscription.php',
'Send Message' => 'api/sendingmessage.php',
'Messages Home' => 'api/messageshome.php',
'Get User Data' => 'api/getuserdata.php',
'Set User Data' => 'api/setuserdata.php',
'Get Form PDF' => 'api/getformpdf.php',
'Send Mail PDF' => 'api/mailform.php',
'In App Purchase' => 'api/inapppurchase.php',
'User Shared Forms' => 'api/usersharedforms.php',
'Delete Form' => 'api/deleteform.php',
'Form Media Upload' => 'api/formmedia.php');
	
	 	asort($urls);
?>
<script type="text/javascript">
<?php foreach($urls as $val)
$temp[] = str_replace(array('api/','.php'),array('',''),$val);
$pages =  implode('\',\'',$temp);
?>
var pages = new Array('<?=$pages?>');
	function changeAction(select) {
		var url = select.value;
		if(url == 'api/register.php')
			document.getElementById('filename').style.display = '';
			else
			document.getElementById('filename').style.display = 'none';
			
		//document.demoform.action = url;
		var page = url.split('/');
		page = page[1];
		page = page.split('.');
		page = page[0];

		for(var i = 0; i < pages.length; i++)
		{
			if(document.getElementById(pages[i]))
			{
				document.getElementById(pages[i]).style.display='none';
			}
		}
		
		if(document.getElementById(page))
		{
			document.getElementById(page).style.display='';
		}
		
	}
</script>
<table border="0" cellpadding="0" cellspacing="0"><tr><td align="left" valign="top">
<form action="" method="post" id="demoform" name="demoform" enctype="multipart/form-data">
	Url: <select id="service" name="service" onchange="changeAction(this);">
			<option value="">Select a service</option>
<?php
		foreach ($urls as $name => $url)
			print "<option value='$url'>$name</option>";
?>
</select>
<br />
Request:<br />
<textarea name="data" rows="20" cols="75"></textarea><br />
<input style="display:none;" type="file" name="filename" id="filename">
	<input type="button" onclick="document.demoform.action = document.getElementById('service').value; document.demoform.submit();" value="Try!" />
</form></td></tr><tr><td align="left" valign="top"><div style="width:390px; margin-top:38px;"><b><u>Sample Web Service Request and Response formats.</u></b>
<br>

<div style="width:100%; display:none;" id="home">
<pre>
<b>Description:</b>
This service is used to get the latest messages, groups and forms.
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey>036e338799416e1de5f59f865c47efc3</userkey>
</request>');?>

<b>Success Response</b>
<?=htmlentities('<response>
  <messages>
    <message>
      <id>1</id>
      <message_from>madhu@gmail.com</message_from>
      <message_to>asdasdad</message_to>
      <message_cc>adadasd</message_cc>
      <message_subject>asdasdasd</message_subject>
      <message_body>adasdasd</message_body>
      <date>08/07/2011</date>
      <time>13:32</time>
    </message>
  </messages>
  <groups><![CDATA[]]></groups>
  <forms>
    <form>
      <formKey>10</formKey>
      <PatientDetailUR>adfadf</PatientDetailUR>
      <PatientDetailSurname>asdfasdf</PatientDetailSurname>
      <PatientDetailFirstName>asdfasdf</PatientDetailFirstName>
      <CreatedDate>2011-07-13 06:17:00</CreatedDate>
      <DOB>asdfasdf</DOB>
    </form>
    <form>
      <formKey>9</formKey>
      <PatientDetailUR>adfadf</PatientDetailUR>
      <PatientDetailSurname>asdfasdf</PatientDetailSurname>
      <PatientDetailFirstName>asdfasdf</PatientDetailFirstName>
      <CreatedDate>2011-07-13 06:16:10</CreatedDate>
      <DOB>asdfasdf</DOB>
    </form>
  </forms>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="register">
<pre>
<b>Description:</b>
This service is used to register the user allows to trail the application for 30 days.
<b>Service Request:</b>
<?=htmlentities('<request>
<username></username>
<first_name></first_name> 
<last_name></last_name> 
<password></password>
<confirmpassword></confirmpassword>
<subject></subject> 
<affiliation></affiliation> 
<location></location>  
<faculty></faculty>
<speciality></speciality>
<imagedata></imagedata>
<privacy></privacy> 
<user_type></user_type>
<device_os></device_os>  
<app_version_number></app_version_number>
<terms_accepted></terms_accepted> 
<device_type></device_type> 
<ip_address></ip_address> 
<udid></udid> 
<device_token></device_token> 
<push_notification></push_notification> 
</request>
');?>
</pre>
</div>
<div style="width:100%; display:none;" id="login">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<username></username> 
<password></password> 
<udid></udid> 
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="passwordreminder">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<email></email>
</request> ');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="changepassword">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<auth></auth>
<udid></udid>
<oldpassword></oldpassword>
<newpassword></newpassword>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="faculty_specialty">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="subscription">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="createform">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<authKey></authKey>
<PatientUr></PatientUr>
<PatientDob></PatientDob>
<PatientAge></PatientAge>
<PatientSex></PatientSex>
<PatientSurname></PatientSurname>
<PatientFirstname></PatientFirstname>
<PatientAddress></PatientAddress>
<PatientSuburb></PatientSuburb>
<PatientState></PatientState>
<PatientPostcode></PatientPostcode>
<PatientEmail></PatientEmail>
<PatientTel></PatientTel>
<PatientMob></PatientMob>
<StudyExamid></StudyExamid>
<StudyDate></StudyDate>
<StudyInstitution></StudyInstitution>
<StudyOperator></StudyOperator>
<StudyIndication></StudyIndication>
<StudyTteToe></StudyTteToe>
<StudyQualityTd></StudyQualityTd>
<StudyHeight></StudyHeight>
<StudyWeight></StudyWeight>
<StudyBsa></StudyBsa>
<StudyBmi></StudyBmi>
<StudyBp></StudyBp>
<StudyHr></StudyHr>
<StudyRhythm></StudyRhythm>
<VvLeftventricule></VvLeftventricule>
<VvRightventricule></VvRightventricule>
<SfLeftventricule></SfLeftventricule>
<SfRightventricule></SfRightventricule>
<EfLvedd></EfLvedd>
<EfLveda></EfLveda>
<EfLvesd></EfLvesd>
<EfLvesa></EfLvesa>
<EfFs></EfFs>
<EfFac></EfFac>
<CoLvotd></CoLvotd>
<CoLvotvti></CoLvotvti>
<CoHr></CoHr>
<CoCo></CoCo>
<CoCi></CoCi>
<Lafp></Lafp>
<HaemodynamicState></HaemodynamicState>
<PapLvotd></PapLvotd>
<PapLvotvti></PapLvotvti>
<PapAvvti></PapAvvti>
<PapAva></PapAva>
<PapAvpg></PapAvpg>
<PapAvgm></PapAvgm>
<PapDimindex></PapDimindex>
<PapAljet></PapAljet>
<PapAlpl></PapAlpl>
<PapAoroot></PapAoroot>
<PapAseao></PapAseao>
<PapMvradius></PapMvradius>
<PapMvscale></PapMvscale>
<PapEro></PapEro>
<PapMvpl2t></PapMvpl2t>
<PapMvgp></PapMvgp>
<PapMvgm></PapMvgm>
<PapPa></PapPa>
<PapCwmr></PapCwmr>
<PapMva></PapMva>
<DfE></DfE>
<DfA></DfA>
<DfDt></DfDt>
<DfS></DfS>
<DfPadur></DfPadur>
<DfAdE></DfAdE>
<DfEe></DfEe>
<DfIvrt></DfIvrt>
<DfAdur></DfAdur>
<DfSd></DfSd>
<DfEa></DfEa>
<LvLvh></LvLvh>
<LvIvswt></LvIvswt>
<LvPwt></LvPwt>
<LvLvmass></LvLvmass>
<LvLvimass></LvLvimass>
<VaExamined></VaExamined>
<VaStenosys></VaStenosys>
<VaRegurgitation></VaRegurgitation>
<VaPericardialEffusion></VaPericardialEffusion>
<AtriaLaDiam></AtriaLaDiam>
<AtriaRaDiam></AtriaRaDiam>
<AtriaLaArea></AtriaLaArea>
<AtriaRaArea></AtriaRaArea>
<AtriaTrvMax></AtriaTrvMax>
<AtriaTvgr></AtriaTvgr>
<AtriaRap></AtriaRap>
<AtriaRsvp></AtriaRsvp>
<Comments></Comments> 
<FormMedia></FormMedia> 
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="searchform">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<auth></auth>
<PatientDetailSurname></PatientDetailSurname>
<PatientDetailFirstName></PatientDetailFirstName>
<PatientDetailUR></PatientDetailUR>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="news">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="creategroup">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<auth></auth>
<groupname></groupname>
<groupsubject></groupsubject>
<grouplocation></grouplocation>
<affiliation></affiliation>
<messageboard></messageboard>
<groupimage></groupimage>
<imagedata></imagedata>
<groupprivate></groupprivate>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="groupactions">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('
Join

<request>
<auth></auth>
<groupid></groupid>
<mode>join</mode>
</request>

Unjoin

<request>
<auth></auth>
<groupid></groupid>
<mode>unjoin</mode>
</request>

Approve

<request>
<auth></auth>
<groupid></groupid>
<mode>approve</mode>
</request>

Reject

<request>
<auth></auth>
<groupid></groupid>
<mode>reject</mode>
</request>


');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="latestgroups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="grouprequests">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<auth></auth>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="mygrouprequests">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<auth></auth>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="userlist">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="searchusers">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<firstname></firstname>
<lastname></lastname>
<username></username>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="message_autosuggest">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="newsdetails">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<newsid></newsid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="viewallforms">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="form">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<formid></formid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="groups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="profile">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<username></username>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="viewmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<lastupdatedate></lastupdatedate>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="viewmessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<messageid></messageid>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="groupuserlist">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<groupid></groupid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="searchgroups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('
Browse Groups

<request>
<userkey>7297ff45d77f93bd7a9a07962a703a94</userkey>
<page>1</page>
</request>
');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="groupmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="content">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="faqs">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="formshare">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('
Group Form Share

<request>
<authkey></authkey>
<groupid></groupid>
<formid></formid>
</request>

User Form Share

<request>
<authkey></authkey>
<userid></userid>
<formid></formid>
</request>
');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="sentmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<lastupdatedate></lastupdatedate>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="formhistory">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="groupmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('
Request 1

<request>
<userkey>7297ff45d77f93bd7a9a07962a703a94</userkey>
<groupid>1</groupid>
<lastupdatedate>2011-07-08 15:54:44</lastupdatedate>
</request>

Request 2
<request>
<userkey>7297ff45d77f93bd7a9a07962a703a94</userkey>
<groupid>1</groupid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="locations">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="affiliations">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="deleteuser">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<userid></userid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="deletegroup">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<groupid></groupid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="additionalsubscription">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<userid></userid>
<days></days>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="sendingmessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
	<userkey></userkey>
	<to></to>
	<cc></cc>
	<subject></subject>
	<message></message>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="deletemessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<messageid></messageid>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="messageshome">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="setuserdata">
<pre>
<b>Description:</b>

<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<Firstname></Firstname>
<Lastname></Lastname>
<Faculty></Faculty>
<Speciality></Speciality>
<Country></Country>
<State></State>
<Location></Location>
<ImageData></ImageData>
<Affiliation></Affiliation>
<Subject></Subject>
<Privacy>public || private</Privacy>
</request>
');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>
<div style="width:100%; display:none;" id="getuserdata">
<pre>
<b>Description:</b>


<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="getformpdf">
<pre>

<b>Service Request:</b>
<?=htmlentities('<request>
<authkey></authkey>
<formkey></formkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>


<div style="width:100%; display:none;" id="mailform">
<pre>

<b>Service Request:</b>
<?=htmlentities('<request>
<authkey></authkey>
<formkey></formkey>
<email></email>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="inapppurchase">
<pre>

<b>Service Request:</b>
<?=htmlentities('<request>
<authkey></authkey>
<receipt></receipt>
<secretkey></secretkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="usersharedforms">
<pre>

<b>Service Request:</b>
<?=htmlentities('<request>
<authkey></authkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

<div style="width:100%; display:none;" id="deleteform">
<pre>

<b>Service Request:</b>
<?=htmlentities('<request>
<userkey></userkey>
<formkey></formkey>
</request>');?>

<b>Response</b>
<?=htmlentities('<response>
</response>
');?>

</pre>
</div>

</div>
</td></tr></table>
