<script type="text/javascript">
var pages = new Array('home','register','login','passwordreminder','changepassword','faculty_specialty','subscription','createform','searchform','news','creategroup','groupactions','groupactions','groupactions','groupactions','latestgroups','grouprequests','mygrouprequests','userlist','searchusers','message_autosuggest','newsdetails','viewallforms','form','groups','searchgroups','searchgroups','profile','viewmessages','viewmessage','groupuserlist','groupmessages','content','faqs','formshare','formshare','sentmessages','formhistory','locations','affiliations','deleteuser','deletemessage','deletegroup','additionalsubscription','sendingmessage','messageshome','getuserdata','setuserdata','getformpdf','mailform');
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
<option value='api/home.php'>Home</option><option value='api/register.php'>Registration</option><option value='api/login.php'>Login</option><option value='api/passwordreminder.php'>Password Reminder</option><option value='api/changepassword.php'>Change Password</option><option value='api/faculty_specialty.php'>Faculty & Speciality</option><option value='api/subscription.php'>Subscription</option><option value='api/createform.php'>Form Submission</option><option value='api/searchform.php'>Search Forms</option><option value='api/news.php'>News</option><option value='api/creategroup.php'>Create Group</option><option value='api/groupactions.php'>Join Group</option><option value='api/groupactions.php'>Unjoin Group</option><option value='api/groupactions.php'>Approve Group Request</option><option value='api/groupactions.php'>Reject Group Request</option><option value='api/latestgroups.php'>Latest Groups</option><option value='api/grouprequests.php'>Group Request Status</option><option value='api/mygrouprequests.php'>My Group Requests</option><option value='api/userlist.php'>Users List</option><option value='api/searchusers.php'>Search User</option><option value='api/message_autosuggest.php'>Auto Suggest</option><option value='api/newsdetails.php'>News Detail</option><option value='api/viewallforms.php'>View Forms</option><option value='api/form.php'>View Single Form</option><option value='api/groups.php'>My Groups</option><option value='api/searchgroups.php'>Browse Groups</option><option value='api/searchgroups.php'>Search Groups</option><option value='api/profile.php'>User Profile</option><option value='api/viewmessages.php'>Messages</option><option value='api/viewmessage.php'>View Message</option><option value='api/groupuserlist.php'>Group User List</option><option value='api/groupmessages.php'>Group Messages</option><option value='api/content.php'>Content</option><option value='api/faqs.php'>FAQS</option><option value='api/formshare.php'>Group Form Share</option><option value='api/formshare.php'>User Form Share</option><option value='api/sentmessages.php'>Sent Messages</option><option value='api/formhistory.php'>Form History</option><option value='api/locations.php'>Locations</option><option value='api/affiliations.php'>Affiliations</option><option value='api/deleteuser.php'>Delete User</option><option value='api/deletemessage.php'>Delete Message</option><option value='api/deletegroup.php'>Delete Group</option><option value='api/additionalsubscription.php'>Additional Subscription</option><option value='api/sendingmessage.php'>Send Message</option><option value='api/messageshome.php'>Messages Home</option><option value='api/getuserdata.php'>Get User Data</option><option value='api/setuserdata.php'>Set User Data</option><option value='api/getformpdf.php'>Get Form PDF</option><option value='api/mailform.php'>Send Mail PDF</option></select>
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
&lt;request&gt;
&lt;userkey&gt;036e338799416e1de5f59f865c47efc3&lt;/userkey&gt;
&lt;/request&gt;
<b>Success Response</b>
&lt;response&gt;
  &lt;messages&gt;
    &lt;message&gt;
      &lt;id&gt;1&lt;/id&gt;
      &lt;message_from&gt;madhu@gmail.com&lt;/message_from&gt;
      &lt;message_to&gt;asdasdad&lt;/message_to&gt;
      &lt;message_cc&gt;adadasd&lt;/message_cc&gt;
      &lt;message_subject&gt;asdasdasd&lt;/message_subject&gt;
      &lt;message_body&gt;adasdasd&lt;/message_body&gt;
      &lt;date&gt;08/07/2011&lt;/date&gt;
      &lt;time&gt;13:32&lt;/time&gt;
    &lt;/message&gt;
  &lt;/messages&gt;
  &lt;groups&gt;&lt;![CDATA[]]&gt;&lt;/groups&gt;
  &lt;forms&gt;
    &lt;form&gt;
      &lt;formKey&gt;10&lt;/formKey&gt;
      &lt;PatientDetailUR&gt;adfadf&lt;/PatientDetailUR&gt;
      &lt;PatientDetailSurname&gt;asdfasdf&lt;/PatientDetailSurname&gt;
      &lt;PatientDetailFirstName&gt;asdfasdf&lt;/PatientDetailFirstName&gt;
      &lt;CreatedDate&gt;2011-07-13 06:17:00&lt;/CreatedDate&gt;
      &lt;DOB&gt;asdfasdf&lt;/DOB&gt;
    &lt;/form&gt;
    &lt;form&gt;
      &lt;formKey&gt;9&lt;/formKey&gt;
      &lt;PatientDetailUR&gt;adfadf&lt;/PatientDetailUR&gt;
      &lt;PatientDetailSurname&gt;asdfasdf&lt;/PatientDetailSurname&gt;
      &lt;PatientDetailFirstName&gt;asdfasdf&lt;/PatientDetailFirstName&gt;
      &lt;CreatedDate&gt;2011-07-13 06:16:10&lt;/CreatedDate&gt;
      &lt;DOB&gt;asdfasdf&lt;/DOB&gt;
    &lt;/form&gt;
  &lt;/forms&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="register">
<pre>
<b>Description:</b>
This service is used to register the user allows to trail the application for 30 days.
<b>Service Request:</b>
&lt;request&gt;
&lt;username&gt;&lt;/username&gt;
&lt;first_name&gt;&lt;/first_name&gt; 
&lt;last_name&gt;&lt;/last_name&gt; 
&lt;password&gt;&lt;/password&gt;
&lt;confirmpassword&gt;&lt;/confirmpassword&gt;
&lt;subject&gt;&lt;/subject&gt; 
&lt;affiliation&gt;&lt;/affiliation&gt; 
&lt;location&gt;&lt;/location&gt;  
&lt;faculty&gt;&lt;/faculty&gt;
&lt;speciality&gt;&lt;/speciality&gt;
&lt;imagedata&gt;&lt;/imagedata&gt;
&lt;privacy&gt;&lt;/privacy&gt; 
&lt;user_type&gt;&lt;/user_type&gt;
&lt;device_os&gt;&lt;/device_os&gt;  
&lt;app_version_number&gt;&lt;/app_version_number&gt;
&lt;terms_accepted&gt;&lt;/terms_accepted&gt; 
&lt;device_type&gt;&lt;/device_type&gt; 
&lt;ip_address&gt;&lt;/ip_address&gt; 
&lt;udid&gt;&lt;/udid&gt; 
&lt;device_token&gt;&lt;/device_token&gt; 
&lt;push_notification&gt;&lt;/push_notification&gt; 
&lt;/request&gt;
</pre>
</div>
<div style="width:100%; display:none;" id="login">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;username&gt;&lt;/username&gt; 
&lt;password&gt;&lt;/password&gt; 
&lt;udid&gt;&lt;/udid&gt; 
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="passwordreminder">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;email&gt;&lt;/email&gt;
&lt;/request&gt; 
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="changepassword">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;udid&gt;&lt;/udid&gt;
&lt;oldpassword&gt;&lt;/oldpassword&gt;
&lt;newpassword&gt;&lt;/newpassword&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="faculty_specialty">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="subscription">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="createform">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;authKey&gt;&lt;/authKey&gt;
&lt;PatientUr&gt;&lt;/PatientUr&gt;
&lt;PatientDob&gt;&lt;/PatientDob&gt;
&lt;PatientAge&gt;&lt;/PatientAge&gt;
&lt;PatientSex&gt;&lt;/PatientSex&gt;
&lt;PatientSurname&gt;&lt;/PatientSurname&gt;
&lt;PatientFirstname&gt;&lt;/PatientFirstname&gt;
&lt;PatientAddress&gt;&lt;/PatientAddress&gt;
&lt;PatientSuburb&gt;&lt;/PatientSuburb&gt;
&lt;PatientState&gt;&lt;/PatientState&gt;
&lt;PatientPostcode&gt;&lt;/PatientPostcode&gt;
&lt;PatientEmail&gt;&lt;/PatientEmail&gt;
&lt;PatientTel&gt;&lt;/PatientTel&gt;
&lt;PatientMob&gt;&lt;/PatientMob&gt;
&lt;StudyExamid&gt;&lt;/StudyExamid&gt;
&lt;StudyDate&gt;&lt;/StudyDate&gt;
&lt;StudyInstitution&gt;&lt;/StudyInstitution&gt;
&lt;StudyOperator&gt;&lt;/StudyOperator&gt;
&lt;StudyIndication&gt;&lt;/StudyIndication&gt;
&lt;StudyTteToe&gt;&lt;/StudyTteToe&gt;
&lt;StudyQualityTd&gt;&lt;/StudyQualityTd&gt;
&lt;StudyHeight&gt;&lt;/StudyHeight&gt;
&lt;StudyWeight&gt;&lt;/StudyWeight&gt;
&lt;StudyBsa&gt;&lt;/StudyBsa&gt;
&lt;StudyBmi&gt;&lt;/StudyBmi&gt;
&lt;StudyBp&gt;&lt;/StudyBp&gt;
&lt;StudyHr&gt;&lt;/StudyHr&gt;
&lt;StudyRhythm&gt;&lt;/StudyRhythm&gt;
&lt;VvLeftventricule&gt;&lt;/VvLeftventricule&gt;
&lt;VvRightventricule&gt;&lt;/VvRightventricule&gt;
&lt;SfLeftventricule&gt;&lt;/SfLeftventricule&gt;
&lt;SfRightventricule&gt;&lt;/SfRightventricule&gt;
&lt;EfLvedd&gt;&lt;/EfLvedd&gt;
&lt;EfLveda&gt;&lt;/EfLveda&gt;
&lt;EfLvesd&gt;&lt;/EfLvesd&gt;
&lt;EfLvesa&gt;&lt;/EfLvesa&gt;
&lt;EfFs&gt;&lt;/EfFs&gt;
&lt;EfFac&gt;&lt;/EfFac&gt;
&lt;CoLvotd&gt;&lt;/CoLvotd&gt;
&lt;CoLvotvti&gt;&lt;/CoLvotvti&gt;
&lt;CoHr&gt;&lt;/CoHr&gt;
&lt;CoCo&gt;&lt;/CoCo&gt;
&lt;CoCi&gt;&lt;/CoCi&gt;
&lt;Lafp&gt;&lt;/Lafp&gt;
&lt;HaemodynamicState&gt;&lt;/HaemodynamicState&gt;
&lt;PapLvotd&gt;&lt;/PapLvotd&gt;
&lt;PapLvotvti&gt;&lt;/PapLvotvti&gt;
&lt;PapAvvti&gt;&lt;/PapAvvti&gt;
&lt;PapAva&gt;&lt;/PapAva&gt;
&lt;PapAvpg&gt;&lt;/PapAvpg&gt;
&lt;PapAvgm&gt;&lt;/PapAvgm&gt;
&lt;PapDimindex&gt;&lt;/PapDimindex&gt;
&lt;PapAljet&gt;&lt;/PapAljet&gt;
&lt;PapAlpl&gt;&lt;/PapAlpl&gt;
&lt;PapAoroot&gt;&lt;/PapAoroot&gt;
&lt;PapAseao&gt;&lt;/PapAseao&gt;
&lt;PapMvradius&gt;&lt;/PapMvradius&gt;
&lt;PapMvscale&gt;&lt;/PapMvscale&gt;
&lt;PapEro&gt;&lt;/PapEro&gt;
&lt;PapMvpl2t&gt;&lt;/PapMvpl2t&gt;
&lt;PapMvgp&gt;&lt;/PapMvgp&gt;
&lt;PapMvgm&gt;&lt;/PapMvgm&gt;
&lt;PapPa&gt;&lt;/PapPa&gt;
&lt;PapCwmr&gt;&lt;/PapCwmr&gt;
&lt;PapMva&gt;&lt;/PapMva&gt;
&lt;DfE&gt;&lt;/DfE&gt;
&lt;DfA&gt;&lt;/DfA&gt;
&lt;DfDt&gt;&lt;/DfDt&gt;
&lt;DfS&gt;&lt;/DfS&gt;
&lt;DfPadur&gt;&lt;/DfPadur&gt;
&lt;DfAdE&gt;&lt;/DfAdE&gt;
&lt;DfEe&gt;&lt;/DfEe&gt;
&lt;DfIvrt&gt;&lt;/DfIvrt&gt;
&lt;DfAdur&gt;&lt;/DfAdur&gt;
&lt;DfSd&gt;&lt;/DfSd&gt;
&lt;DfEa&gt;&lt;/DfEa&gt;
&lt;LvLvh&gt;&lt;/LvLvh&gt;
&lt;LvIvswt&gt;&lt;/LvIvswt&gt;
&lt;LvPwt&gt;&lt;/LvPwt&gt;
&lt;LvLvmass&gt;&lt;/LvLvmass&gt;
&lt;LvLvimass&gt;&lt;/LvLvimass&gt;
&lt;VaExamined&gt;&lt;/VaExamined&gt;
&lt;VaStenosys&gt;&lt;/VaStenosys&gt;
&lt;VaRegurgitation&gt;&lt;/VaRegurgitation&gt;
&lt;VaPericardialEffusion&gt;&lt;/VaPericardialEffusion&gt;
&lt;AtriaLaDiam&gt;&lt;/AtriaLaDiam&gt;
&lt;AtriaRaDiam&gt;&lt;/AtriaRaDiam&gt;
&lt;AtriaLaArea&gt;&lt;/AtriaLaArea&gt;
&lt;AtriaRaArea&gt;&lt;/AtriaRaArea&gt;
&lt;AtriaTrvMax&gt;&lt;/AtriaTrvMax&gt;
&lt;AtriaTvgr&gt;&lt;/AtriaTvgr&gt;
&lt;AtriaRap&gt;&lt;/AtriaRap&gt;
&lt;AtriaRsvp&gt;&lt;/AtriaRsvp&gt;
&lt;Comments&gt;&lt;/Comments&gt; 
&lt;FormMedia&gt;&lt;/FormMedia&gt; 
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="searchform">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;PatientDetailSurname&gt;&lt;/PatientDetailSurname&gt;
&lt;PatientDetailFirstName&gt;&lt;/PatientDetailFirstName&gt;
&lt;PatientDetailUR&gt;&lt;/PatientDetailUR&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="news">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="creategroup">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;groupname&gt;&lt;/groupname&gt;
&lt;groupsubject&gt;&lt;/groupsubject&gt;
&lt;grouplocation&gt;&lt;/grouplocation&gt;
&lt;affiliation&gt;&lt;/affiliation&gt;
&lt;messageboard&gt;&lt;/messageboard&gt;
&lt;groupimage&gt;&lt;/groupimage&gt;
&lt;imagedata&gt;&lt;/imagedata&gt;
&lt;groupprivate&gt;&lt;/groupprivate&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="groupactions">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>

Join

&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;mode&gt;join&lt;/mode&gt;
&lt;/request&gt;

Unjoin

&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;mode&gt;unjoin&lt;/mode&gt;
&lt;/request&gt;

Approve

&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;mode&gt;approve&lt;/mode&gt;
&lt;/request&gt;

Reject

&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;mode&gt;reject&lt;/mode&gt;
&lt;/request&gt;



<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="latestgroups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="grouprequests">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="mygrouprequests">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;auth&gt;&lt;/auth&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="userlist">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="searchusers">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;firstname&gt;&lt;/firstname&gt;
&lt;lastname&gt;&lt;/lastname&gt;
&lt;username&gt;&lt;/username&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="message_autosuggest">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="newsdetails">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;newsid&gt;&lt;/newsid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="viewallforms">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="form">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;formid&gt;&lt;/formid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="groups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="profile">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;username&gt;&lt;/username&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="viewmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;lastupdatedate&gt;&lt;/lastupdatedate&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="viewmessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;messageid&gt;&lt;/messageid&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="groupuserlist">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="searchgroups">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>

Browse Groups

&lt;request&gt;
&lt;userkey&gt;7297ff45d77f93bd7a9a07962a703a94&lt;/userkey&gt;
&lt;page&gt;1&lt;/page&gt;
&lt;/request&gt;

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="groupmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="content">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="faqs">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No input request format.

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="formshare">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>

Group Form Share

&lt;request&gt;
&lt;authkey&gt;&lt;/authkey&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;formid&gt;&lt;/formid&gt;
&lt;/request&gt;

User Form Share

&lt;request&gt;
&lt;authkey&gt;&lt;/authkey&gt;
&lt;userid&gt;&lt;/userid&gt;
&lt;formid&gt;&lt;/formid&gt;
&lt;/request&gt;

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="sentmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;lastupdatedate&gt;&lt;/lastupdatedate&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="formhistory">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="groupmessages">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>

Request 1

&lt;request&gt;
&lt;userkey&gt;7297ff45d77f93bd7a9a07962a703a94&lt;/userkey&gt;
&lt;groupid&gt;1&lt;/groupid&gt;
&lt;lastupdatedate&gt;2011-07-08 15:54:44&lt;/lastupdatedate&gt;
&lt;/request&gt;

Request 2
&lt;request&gt;
&lt;userkey&gt;7297ff45d77f93bd7a9a07962a703a94&lt;/userkey&gt;
&lt;groupid&gt;1&lt;/groupid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="locations">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="affiliations">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
No Input Request Format

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="deleteuser">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;userid&gt;&lt;/userid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="deletegroup">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;groupid&gt;&lt;/groupid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="additionalsubscription">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;userid&gt;&lt;/userid&gt;
&lt;days&gt;&lt;/days&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="sendingmessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
	&lt;userkey&gt;&lt;/userkey&gt;
	&lt;to&gt;&lt;/to&gt;
	&lt;cc&gt;&lt;/cc&gt;
	&lt;subject&gt;&lt;/subject&gt;
	&lt;message&gt;&lt;/message&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>

<div style="width:100%; display:none;" id="deletemessage">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;messageid&gt;&lt;/messageid&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>

<div style="width:100%; display:none;" id="messageshome">
<pre>
<b>Description:</b>
This service is used to .
<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="setuserdata">
<pre>
<b>Description:</b>

<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;Firstname&gt;&lt;/Firstname&gt;
&lt;Lastname&gt;&lt;/Lastname&gt;
&lt;Faculty&gt;&lt;/Faculty&gt;
&lt;Speciality&gt;&lt;/Speciality&gt;
&lt;Country&gt;&lt;/Country&gt;
&lt;State&gt;&lt;/State&gt;
&lt;Location&gt;&lt;/Location&gt;
&lt;ImageData&gt;&lt;/ImageData&gt;
&lt;Affiliation&gt;&lt;/Affiliation&gt;
&lt;Subject&gt;&lt;/Subject&gt;
&lt;Privacy&gt;public || private&lt;/Privacy&gt;
&lt;/request&gt;

<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>
<div style="width:100%; display:none;" id="getuserdata">
<pre>
<b>Description:</b>


<b>Service Request:</b>
&lt;request&gt;
&lt;userkey&gt;&lt;/userkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>

<div style="width:100%; display:none;" id="getformpdf">
<pre>

<b>Service Request:</b>
&lt;request&gt;
&lt;authkey&gt;&lt;/authkey&gt;
&lt;formkey&gt;&lt;/formkey&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>


<div style="width:100%; display:none;" id="mailform">
<pre>

<b>Service Request:</b>
&lt;request&gt;
&lt;authkey&gt;&lt;/authkey&gt;
&lt;formkey&gt;&lt;/formkey&gt;
&lt;email&gt;&lt;/email&gt;
&lt;/request&gt;
<b>Response</b>
&lt;response&gt;
&lt;/response&gt;

</pre>
</div>

</div>
</td></tr></table>
