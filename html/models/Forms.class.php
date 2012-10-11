<?php
include_once('Common.class.php');
include_once("Mail.php");
include_once('Mail/mime.php'); // PEAR Mail_Mime packge

class Forms_Model extends Common_Model{


	public $db;
	public $db_user;

	public function __construct() {
		global $db, $db_user;

		$this -> db =& $db;
		$this -> db_user =& $db_user;
	}

	/**
	 * Returns form details, media details of formkey
	 * @param string $userauth_key
	 * @param int $formkey
	 * @return array, returns all the details of form in an array
	 * If no form is found, empty array is returned.
	 */
	public function getForm($userauth_key, $formkey) {
		global $db_user;
		$query = "SELECT
                        	frm.id as FormKey,
							frm.patient_ur as PatientUr,
							frm.patient_dob as PatientDob,
							frm.patient_age as PatientAge,
							frm.patient_sex as PatientSex,
							frm.patient_address as PatientAddress,
							frm.patient_suburb as PatientSuburb,
							frm.patient_state as PatientState,
							frm.patient_postcode as PatientPostcode,
							frm.patient_country as PatientCountry,
							frm.patient_tel as PatientTel,
							frm.patient_mob as PatientMob,
							frm.patient_email as PatientEmail,
							frm.study_examid as StudyExamid,
							frm.study_date as StudyDate,
							frm.study_institution as StudyInstitution,
							frm.study_operator as StudyOperator,
							frm.study_indication as StudyIndication,
							frm.study_tte_toe as StudyTteToe,
							frm.study_quality_td as StudyQualityTd,
							frm.study_height as StudyHeight,
							frm.study_weight as StudyWeight,
							frm.study_bsa as StudyBsa,
							frm.study_bmi as StudyBmi,
							frm.study_bp as StudyBp,
							frm.study_hr as StudyHr,
							frm.vv_leftventricule as VvLeftventricule,
							frm.vv_rightventricule as VvRightventricule,
							frm.sf_leftventricule as SfLeftventricule,
							frm.sf_rightventricule as SfRightventricule,
							frm.ef_lvedd as EfLvedd,
							frm.ef_lveda as EfLveda,
							frm.ef_lvesd as EfLvesd,
							frm.ef_lvesa as EfLvesa,
							frm.ef_fs as EfFs,
							frm.ef_fac as EfFac,
							frm.co_lvotd as CoLvotd,
							frm.co_lvotvti as CoLvotvti,
							frm.co_hr as CoHr,
							frm.co_co as CoCo,
							frm.co_ci as CoCi,
							frm.lafp as Lafp,
							frm.haemodynamic_state as HaemodynamicState,
							frm.pap_lvotd as PapLvotd,
							frm.pap_lvotvti as PapLvotvti,
							frm.pap_avvti as PapAvvti,
							frm.pap_ava as PapAva,
							frm.pap_avpg as PapAvpg,
							frm.pap_avgm as PapAvgm,
							frm.pap_dimindex as PapDimindex,
							frm.pap_aljet as PapAljet,
							frm.pap_alpl as PapAlpl,
							frm.pap_aoroot as PapAoroot,
							frm.pap_aseao as PapAseao,
							frm.pap_mvradius as PapMvradius,
							frm.pap_mvscale as PapMvscale,
							frm.pap_ero as PapEro,
							frm.pap_mvpl2t as PapMvpl2t,
							frm.pap_mvgp as PapMvgp,
							frm.pap_mvgm as PapMvgm,
							frm.pap_pa as PapPa,
							frm.pap_cwmr as PapCwmr,
							frm.pap_mva as PapMva,
							frm.df_e as DfE,
							frm.df_a as DfA,
							frm.df_dt as DfDt,
							frm.df_s as DfS,
							frm.df_d as DfD,
							frm.df_padur as DfPadur,
							frm.df_ad_e as DfAdE,
							frm.df_ee as DfEe,
							frm.df_ivrt as DfIvrt,
							frm.df_adur as DfAdur,
							frm.df_sd as DfSd,
							frm.df_ea as DfEa,
							frm.lv_lvh as LvLvh,
							frm.lv_ivswt as LvIvswt,
							frm.lv_pwt as LvPwt,
							frm.lv_lvmass as LvLvmass,
							frm.lv_lvimass as LvLvimass,
							frm.va_examined as VaExamined,
							frm.va_stenosys as VaStenosys,
							frm.va_regurgitation as VaRegurgitation,
							frm.va_pericardial_effusion as VaPericardialEffusion,
							frm.atria_la_diam as AtriaLaDiam,
							frm.atria_ra_diam as AtriaRaDiam,
							frm.atria_la_area as AtriaLaArea,
							frm.atria_ra_area as AtriaRaArea,
							frm.atria_trv_max as AtriaTrvMax,
							frm.atria_tvgr as AtriaTvgr,
							frm.atria_rap as AtriaRap,
							frm.atria_rsvp as AtriaRsvp,
							frm.comments as Comments,
							frm.commentsECG as CommentsECG,
							frm.added_date as AddedDate,
							frm.form_complete as FormComplete,
							frm.created_by as CreatedBy,
							frm.form_media as FormMedia,
							frm.study_rhythm as StudyRhythm,
							u.id AS userid
                        FROM 
                        	forms frm, 
                        	users u
                        WHERE
                        	(	(frm.created_by = u.id)
                        	OR		
                        		(u.id = (
                        							SELECT 
                        								fs.user_id 
                        							FROM 
                        								form_shares fs 
                        							WHERE 
                        								fs.form_id = frm.id
                        							)
                        		)
                        	)
                        AND
                        	frm.id = '".$this->db->real_escape_string($formkey)."'	
                        	";
		 
		$result = $this -> db -> query ($query);

		$formdata = array();
		$mediaarray = array();

		if ($result->num_rows > 0) {

			$formdata = $result->fetch_assoc();

				if($formkey && (!isset($patient_firstname) && !isset($patient_surname))){
					$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$formkey);

					$patients = $db_user_result->fetch_assoc();
					$formdata['PatientFirstname']	= $patients['patient_firstname'];
					$formdata['PatientSurname']	= $patients['patient_surname'];
					
					$patient_firstname	= $patients['patient_firstname'];
					$patient_surname	= $patients['patient_surname'];


			}
			$formdata['status'] = 'OK';
			/* free result set */
			$result->free();
			
			$query = "	SELECT
                				media.id,
                				media.media_type,
                				media.path 
                			FROM
                				form_media_details media
                			WHERE 
                				form_id = '" . $formkey . "'";
			$result = $this -> db -> query ($query);

			if($result->num_rows > 0)
			{
				$formdata['media'] = '1';
				while($media = $result->fetch_assoc())
				{
					if($media['media_type'] == 'VIDEO') {
						$mediaarray['videos']['video'][]['attrs'] = array('id' => $media['id'],
	                											'text' =>$media['path']
						);
					} else if($media['media_type'] == 'IMAGE') {
						$mediaarray['images']['image'][]['attrs'] = array('id' => $media['id'],
	                											'text' =>$media['path']
						);
					}

				}
			}
		}

		return $formdata + $mediaarray;
	}

	/**
	 * Returns form details, media details for pdf of formkey
	 * @param int $formkey
	 * @param mixed $db, database connection link
	 * @return array, returns all the details of form in an array
	 * If no form is found, empty array is returned.
	 */
	public function getPdfFormData($formkey,$db) {

		global $db_user ;
		$db = $this -> db;

		$query = "SELECT
                        	frm.id as FormKey,
							frm.patient_ur as PatientUr,
							frm.patient_dob as PatientDob,
							frm.patient_age as PatientAge,
							frm.patient_sex as PatientSex,
							frm.patient_address as PatientAddress,
							frm.patient_suburb as PatientSuburb,
							frm.patient_state as PatientState,
							frm.patient_postcode as PatientPostcode,
							frm.patient_email as PatientEmail,
							frm.patient_country as PatientCountry,
							frm.patient_tel as PatientTel,
							frm.patient_mob as PatientMob,
							frm.study_examid as StudyExamid,
							DATE_FORMAT(frm.study_date,'%d/%m/%Y') as StudyDate,
							frm.study_institution as StudyInstitution,
							frm.study_operator as StudyOperator,
							frm.study_indication as StudyIndication,
							frm.study_tte_toe as StudyTteToe,
							frm.study_quality_td as StudyQualityTd,
							frm.study_height as StudyHeight,
							frm.study_weight as StudyWeight,
							frm.study_bsa as StudyBsa,
							frm.study_bmi as StudyBmi,
							frm.study_bp as StudyBp,
							frm.study_hr as StudyHr,
							frm.vv_leftventricule as VvLeftventricule,
							frm.vv_rightventricule as VvRightventricule,
							frm.sf_leftventricule as SfLeftventricule,
							frm.sf_rightventricule as SfRightventricule,
							frm.ef_lvedd as EfLvedd,
							frm.ef_lveda as EfLveda,
							frm.ef_lvesd as EfLvesd,
							frm.ef_lvesa as EfLvesa,
							frm.ef_fs as EfFs,
							frm.ef_fac as EfFac,
							frm.co_lvotd as CoLvotd,
							frm.co_lvotvti as CoLvotvti,
							frm.co_hr as CoHr,
							frm.co_co as CoCo,
							frm.co_ci as CoCi,
							frm.lafp as Lafp,
							frm.haemodynamic_state as HaemodynamicState,
							frm.pap_lvotd as PapLvotd,
							frm.pap_lvotvti as PapLvotvti,
							frm.pap_avvti as PapAvvti,
							frm.pap_ava as PapAva,
							frm.pap_avpg as PapAvpg,
							frm.pap_avgm as PapAvgm,
							frm.pap_dimindex as PapDimindex,
							frm.pap_aljet as PapAljet,
							frm.pap_alpl as PapAlpl,
							frm.pap_aoroot as PapAoroot,
							frm.pap_aseao as PapAseao,
							frm.pap_mvradius as PapMvradius,
							frm.pap_mvscale as PapMvscale,
							frm.pap_ero as PapEro,
							frm.pap_mvpl2t as PapMvpl2t,
							frm.pap_mvgp as PapMvgp,
							frm.pap_mvgm as PapMvgm,
							frm.pap_pa as PapPa,
							frm.pap_cwmr as PapCwmr,
							frm.pap_mva as PapMva,
							frm.df_e as DfE,
							frm.df_a as DfA,
							frm.df_dt as DfDt,
							frm.df_s as DfS,
							frm.df_d as DfD,
							frm.df_padur as DfPadur,
							frm.df_ad_e as DfAdE,
							frm.df_ee as DfEe,
							frm.df_ivrt as DfIvrt,
							frm.df_adur as DfAdur,
							frm.df_sd as DfSd,
							frm.df_ea as DfEa,
							frm.lv_lvh as LvLvh,
							frm.lv_ivswt as LvIvswt,
							frm.lv_pwt as LvPwt,
							frm.lv_lvmass as LvLvmass,
							frm.lv_lvimass as LvLvimass,
							frm.va_examined as VaExamined,
							frm.va_stenosys as VaStenosys,
							frm.va_regurgitation as VaRegurgitation,
							frm.va_pericardial_effusion as VaPericardialEffusion,
							frm.atria_la_diam as AtriaLaDiam,
							frm.atria_ra_diam as AtriaRaDiam,
							frm.atria_la_area as AtriaLaArea,
							frm.atria_ra_area as AtriaRaArea,
							frm.atria_trv_max as AtriaTrvMax,
							frm.atria_tvgr as AtriaTvgr,
							frm.atria_rap as AtriaRap,
							frm.atria_rsvp as AtriaRsvp,
							frm.comments as Comments,
							frm.commentsECG as CommentsECG,
							frm.added_date as AddedDate,
							frm.form_complete as FormComplete,
							frm.created_by as CreatedBy,
							frm.form_media as FormMedia,
							frm.pdffile as pdffile,
							frm.study_rhythm as StudyRhythm
                        FROM 
                        	forms frm
                        WHERE
                        	frm.id = '".$db->real_escape_string($formkey)."'";



		$result = $db -> query ($query);


		$formdata = array();
		$mediaarray = array();

		if ($result->num_rows > 0) {
			
			$formdata = $result->fetch_assoc();
			foreach ( $formdata as $patient_names)
			{
				if($patient_names['FormKey'] && (!isset($patient_firstname) && !isset($patient_surname))){
					$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$formkey );
				
					$patients = $db_user_result->fetch_assoc();
					$formdata['PatientFirstname']	= $patients['patient_firstname'];
					$formdata['PatientSurname']	= $patients['patient_surname'];
					
					$patient_firstname	= $patients['patient_firstname'];
					$patient_surname	= $patients['patient_surname'];



				}
			}
	 
		

			$formdata['status'] = 'OK';
			/* free result set */
			$result->free();
			$query = "	SELECT
                				media.id,
                				media.media_type,
                				media.path 
                			FROM
                				form_media_details media
                			WHERE 
                				form_id = '" . $formkey . "'";
			$result = $db -> query ($query);

			if($result->num_rows > 0)
			{
				$formdata['media'] = '1';
				while($media = $result->fetch_assoc())
				{
					if($media['media_type'] == 'IMAGE') {
						$mediaarray['images'][] = $media['path'];
					}
					if($media['media_type'] == 'VIDEO') {
						$mediaarray['videos'][] = $media['path'];
					}


				}
			}
		}

		return $formdata + $mediaarray;
	}

	/**
	 * Returns list of forms of a user,
	 * if inputObject has limit, returns only that many records else returns all the records
	 * @param StdObj $inputObject
	 * @return array, Returns array of forms,
	 * if no forms are found, an array with status error 'No forms found' is returned
	 */
	public function getForms($inputObject) {
		global $db_user;
		$query = "SELECT
           					frm.id as formKey,
                        	frm.patient_ur as PatientDetailUR,
                        	frm.added_date as CreatedDate,
                        	frm.patient_dob as DOB
                        FROM 
                        	forms frm, 
                        	users u
                        WHERE
                        	(	(frm.created_by = u.id)
                        	OR		
                        		(u.id = (
                        							SELECT 
                        								fs.user_id 
                        							FROM 
                        								form_shares fs 
                        							WHERE 
                        								fs.form_id = frm.id
                        							)
                        		)
                        	)
                        AND
                        	u.userkey = '".$this->db->real_escape_string($inputObject->userkey)."'
                       ".((int)$inputObject->limit > 0?'LIMIT '.$inputObject->limit:'');
		 
		$result = $this -> db -> query ($query);
		if($result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{
				//$iscompleted = 	$data['is_completed'];
				//if($data['is_completed'])
				//{
				//	unset($data['is_completed']);
				//	$formdata['completed']['form'][]['nodes'] = $data;
				//}
				//else
				//{
				//	unset($data['is_completed']);
				//	$formdata['incompleted']['form'][]['nodes'] = $data;
				//}

						
						$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$data['formKey']);

						$patients = $db_user_result->fetch_assoc();
						$data['PatientDetailFirstName']	= $patients['patient_firstname'];
						$data['PatientDetailSurname']	= $patients['patient_surname'];
						$data['PatientDetailSurName']   = $patients['patient_surname'];
									
						$data['PatientDetailName']   = $patients['patient_surname'];

						$data['patient_firstname']	= $patients['patient_firstname'];
						$data['patient_surname']	= $patients['patient_surname'];



				$formdata['forms']['form'][]['nodes'] = $data;
				
			
			}

			
			// exit;
			$formdata['status'] = 'OK';

			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'error' => 'No Forms Found.');
		}
	}

	/**
	 * Updates media information of form
	 * @param array $input, containing media information (media_type, name)
	 * @param int $formid, form id
	 * @param string $userkey, user key
	 * @return array, returns array with status ok, on successful creation,
	 * In case of failure, return status as error and error description
	 */
	public function updateMedia($input, $formid, $userkey)
	{
		$selectQuery = 'SELECT u.id
            FROM 
            	users u, forms f 
            WHERE
            	f.created_by = u.id AND f.id = "'.$formid.'" AND u.userkey = "'.$userkey.'"';

		$result = $this -> db -> query ($selectQuery);
			
		if($result->num_rows > 0)
		{
			$user = $result->fetch_assoc();
			$return = true;
			foreach($input as $val)
			{
				$str = 'INSERT INTO form_media_details
					SET
						form_id = "' . $this->db->real_escape_string( $formid ).'" ,
						media_type = "' . $this->db->real_escape_string( $val['media_type'] ).'" ,
						path = "' . $this->db->real_escape_string( $val['name'] ).'" ,
						user_id = "' . $user['id'] . '" ';
				$result = $this -> db -> query ($str);
				if (!$result) {
					$return = false;
				}
			}
			if(!$return)
			return  array ("status" => 'error',"error"   => 'Unable to upload few media items.');
			else
			return  array ("status" => 'ok',"error"   => 'Media information uploaded successfully.');

		}
		else
		{
			return  array ("status" => 'error',"error"   => 'Invalid User/Form.');
		}
	}

	/**
	 * Creates/updates form data of user authkey, pdf file
	 * @param StdObj $data, object of form data
	 * @param string $pdfname, pdf filename
	 * @return array|int, formkey is returned on successful creation or updation
	 * In case of failure, array with status error and error description is returned.
	 */
	public function createForm($data,$pdfname) {

		$selectQuery = 'SELECT u.id,u.faculty,first_name, last_name
            FROM 
            	users u 
            WHERE
            	u.userkey = "'.$data->authKey.'"';

		$result = $this -> db -> query ($selectQuery);
		if($result->num_rows > 0)
		{
			$user = $result->fetch_assoc();
			
			if(!isset($data->StudyOperator) || TRIM($data->StudyOperator) =='')
			$data->StudyOperator = TRIM($user['first_name']." ".$user['last_name']);
			
			if(isset($data->formKey) && $data->formKey != '')
			{
				$str = 'UPDATE forms ';
			}
			else
			{
				$str = 'INSERT INTO forms ';
			}


			if(preg_match('/[^\x00-\x7F]/', $data->PatientAddress)) $data->PatientAddress ="...." ;
			if(preg_match('/[^\x00-\x7F]/', $data->PatientDob)) $data->PatientDob ="...." ;
			if(preg_match('/[^\x00-\x7F]/', $data->PatientSurname)) $data->PatientSurname ="...." ;
			if(preg_match('/[^\x00-\x7F]/', $data->PatientFirstname)) $data->PatientFirstname ="...." ;
			


			$str .= '
            	SET
            	patient_ur = "' . $this->db->real_escape_string( $data->PatientUr ).'" ,
				patient_dob = "' . $this->db->real_escape_string( $data->PatientDob ).'" ,
				patient_age = "' . $this->db->real_escape_string( $data->PatientAge ).'" ,
				patient_sex = "' . $this->db->real_escape_string( $data->PatientSex ).'" ,
				patient_address = "' . $this->db->real_escape_string( $data->PatientAddress ).'" ,
				patient_suburb = "' . $this->db->real_escape_string( $data->PatientSuburb ).'" ,
				patient_state = "' . $this->db->real_escape_string( $data->PatientState ).'" ,
				patient_postcode = "' . $this->db->real_escape_string( $data->PatientPostcode ).'" ,
				patient_country = "' . $this->db->real_escape_string( $data->PatientCountry ).'" ,
				patient_tel = "' . $this->db->real_escape_string( $data->PatientTel ).'" ,
				patient_mob = "' . $this->db->real_escape_string( $data->PatientMob ).'" ,
				patient_email = "' . $this->db->real_escape_string( $data->PatientEmail ).'" ,
				study_examid = "' . $this->db->real_escape_string( $data->StudyExamid ).'" ,
				study_date = "' . $this->db->real_escape_string( $data->StudyDate ).'" ,
				study_institution = "' . $this->db->real_escape_string( $data->StudyInstitution ).'" ,
				study_operator = "' . $this->db->real_escape_string( $data->StudyOperator ).'" ,
				study_indication = "' . $this->db->real_escape_string( $data->StudyIndication ).'" ,
				study_tte_toe = "' . $this->db->real_escape_string( $data->StudyTteToe ).'" ,
				study_quality_td = "' . $this->db->real_escape_string( $data->StudyQualityTd ).'" ,
				study_height = "' . $this->db->real_escape_string( $data->StudyHeight ).'" ,
				study_weight = "' . $this->db->real_escape_string( $data->StudyWeight ).'" ,
				study_bsa = "' . $this->db->real_escape_string( $data->StudyBsa ).'" ,
				study_bmi = "' . $this->db->real_escape_string( $data->StudyBmi ).'" ,
				study_bp = "' . $this->db->real_escape_string( $data->StudyBp ).'" ,
				study_hr = "' . $this->db->real_escape_string( $data->StudyHr ).'" ,
				vv_leftventricule = "' . $this->db->real_escape_string( $data->VvLeftventricule ).'" ,
				vv_rightventricule = "' . $this->db->real_escape_string( $data->VvRightventricule ).'" ,
				sf_leftventricule = "' . $this->db->real_escape_string( $data->SfLeftventricule ).'" ,
				sf_rightventricule = "' . $this->db->real_escape_string( $data->SfRightventricule ).'" ,
				ef_lvedd = "' . $this->db->real_escape_string( $data->EfLvedd ).'" ,
				ef_lveda = "' . $this->db->real_escape_string( $data->EfLveda ).'" ,
				ef_lvesd = "' . $this->db->real_escape_string( $data->EfLvesd ).'" ,
				ef_lvesa = "' . $this->db->real_escape_string( $data->EfLvesa ).'" ,
				ef_fs = "' . $this->db->real_escape_string( $data->EfFs ).'" ,
				ef_fac = "' . $this->db->real_escape_string( $data->EfFac ).'" ,
				co_lvotd = "' . $this->db->real_escape_string( $data->CoLvotd ).'" ,
				co_lvotvti = "' . $this->db->real_escape_string( $data->CoLvotvti ).'" ,
				co_hr = "' . $this->db->real_escape_string( $data->CoHr ).'" ,
				co_co = "' . $this->db->real_escape_string( $data->CoCo ).'" ,
				co_ci = "' . $this->db->real_escape_string( $data->CoCi ).'" ,
				lafp = "' . $this->db->real_escape_string( $data->Lafp ).'" ,
				haemodynamic_state = "' . $this->db->real_escape_string( $data->HaemodynamicState ).'" ,
				pap_lvotd = "' . $this->db->real_escape_string( $data->PapLvotd ).'" ,
				pap_lvotvti = "' . $this->db->real_escape_string( $data->PapLvotvti ).'" ,
				pap_avvti = "' . $this->db->real_escape_string( $data->PapAvvti ).'" ,
				pap_ava = "' . $this->db->real_escape_string( $data->PapAva ).'" ,
				pap_avpg = "' . $this->db->real_escape_string( $data->PapAvpg ).'" ,
				pap_avgm = "' . $this->db->real_escape_string( $data->PapAvgm ).'" ,
				pap_dimindex = "' . $this->db->real_escape_string( $data->PapDimindex ).'" ,
				pap_aljet = "' . $this->db->real_escape_string( $data->PapAljet ).'" ,
				pap_alpl = "' . $this->db->real_escape_string( $data->PapAlpl ).'" ,
				pap_aoroot = "' . $this->db->real_escape_string( $data->PapAoroot ).'" ,
				pap_aseao = "' . $this->db->real_escape_string( $data->PapAseao ).'" ,
				pap_mvradius = "' . $this->db->real_escape_string( $data->PapMvradius ).'" ,
				pap_mvscale = "' . $this->db->real_escape_string( $data->PapMvscale ).'" ,
				pap_ero = "' . $this->db->real_escape_string( $data->PapEro ).'" ,
				pap_mvpl2t = "' . $this->db->real_escape_string( $data->PapMvpl2t ).'" ,
				pap_mvgp = "' . $this->db->real_escape_string( $data->PapMvgp ).'" ,
				pap_mvgm = "' . $this->db->real_escape_string( $data->PapMvgm ).'" ,
				pap_pa = "' . $this->db->real_escape_string( $data->PapPa ).'" ,
				pap_cwmr = "' . $this->db->real_escape_string( $data->PapCwmr ).'" ,
				pap_mva = "' . $this->db->real_escape_string( $data->PapMva ).'" ,
				df_e = "' . $this->db->real_escape_string( $data->DfE ).'" ,
				df_a = "' . $this->db->real_escape_string( $data->DfA ).'" ,
				df_dt = "' . $this->db->real_escape_string( $data->DfDt ).'" ,
				df_s = "' . $this->db->real_escape_string( $data->DfS ).'" ,
				df_d = "' . $this->db->real_escape_string( $data->DfD ).'" ,
				df_padur = "' . $this->db->real_escape_string( $data->DfPadur ).'" ,
				df_ad_e = "' . $this->db->real_escape_string( $data->DfAdE ).'" ,
				df_ee = "' . $this->db->real_escape_string( $data->DfEe ).'" ,
				df_ivrt = "' . $this->db->real_escape_string( $data->DfIvrt ).'" ,
				df_adur = "' . $this->db->real_escape_string( $data->DfAdur ).'" ,
				df_sd = "' . $this->db->real_escape_string( $data->DfSd ).'" ,
				df_ea = "' . $this->db->real_escape_string( $data->DfEa ).'" ,
				lv_lvh = "' . $this->db->real_escape_string( $data->LvLvh ).'" ,
				lv_ivswt = "' . $this->db->real_escape_string( $data->LvIvswt ).'" ,
				lv_pwt = "' . $this->db->real_escape_string( $data->LvPwt ).'" ,
				lv_lvmass = "' . $this->db->real_escape_string( $data->LvLvmass ).'" ,
				lv_lvimass = "' . $this->db->real_escape_string( $data->LvLvimass ).'" ,
				va_examined = "' . $this->db->real_escape_string( $data->VaExamined ).'" ,
				va_stenosys = "' . $this->db->real_escape_string( $data->VaStenosys ).'" ,
				va_regurgitation = "' . $this->db->real_escape_string( $data->VaRegurgitation ).'" ,
				va_pericardial_effusion = "' . $this->db->real_escape_string( $data->VaPericardialEffusion ).'" ,
				atria_la_diam = "' . $this->db->real_escape_string( $data->AtriaLaDiam ).'" ,
				atria_ra_diam = "' . $this->db->real_escape_string( $data->AtriaRaDiam ).'" ,
				atria_la_area = "' . $this->db->real_escape_string( $data->AtriaLaArea ).'" ,
				atria_ra_area = "' . $this->db->real_escape_string( $data->AtriaRaArea ).'" ,
				atria_trv_max = "' . $this->db->real_escape_string( $data->AtriaTrvMax ).'" ,
				atria_tvgr = "' . $this->db->real_escape_string( $data->AtriaTvgr ).'" ,
				atria_rap = "' . $this->db->real_escape_string( $data->AtriaRap ).'" ,
				atria_rsvp = "' . $this->db->real_escape_string( $data->AtriaRsvp ).'" ,
				comments = "' . $this->db->real_escape_string( $data->Comments ).'" ,
				commentsECG = "' . $this->db->real_escape_string( $data->CommentsECG ).'" ,
				added_date = "' . date('Y-m-d H:i:s') .'" ,
				form_complete = "1" ,
				pdffile = "'.$pdfname.'" ,
				study_rhythm = "'.$this->db->real_escape_string( $data->StudyRhythm ).'",
				
				form_media = "' . $this->db->real_escape_string( $data->FormMedia ).'"';


	

			if(isset($data->formKey) && $data->formKey != '')
			{
				$str .= 'WHERE id = "'. $data->formKey .'"';
				
			}

			$result = $this -> db -> query ($str);

			if ($result) {
				if(isset($data->formKey) && $data->formKey != '')
				{
					/****** update patients table ******/
						$this -> db_user -> query ('UPDATE patients 
						SET 
						patient_surname = "' . $this->db->real_escape_string( $data->PatientSurname ).'" ,
							patient_firstname = "' . $this->db->real_escape_string( $data->PatientFirstname ).'" 
							WHERE id = "'. $data->formKey .'"');
					return  $data->formKey;
				}
				else
				{
					$formKey = $this->db->insert_id;
					$this -> db_user -> query ('INSERT INTO  patients 
						SET 
						 id = "'. $formKey.'",
						patient_surname = "' . $this->db->real_escape_string( $data->PatientSurname ).'" ,
						patient_firstname = "' . $this->db->real_escape_string( $data->PatientFirstname ).'"');

						//only the created by is insert/updated on creation of file
						$this -> db -> query ('UPDATE forms SET created_by = "' . $user['id'] .'" 
							WHERE id = "'. $formKey .'"');


					return $formKey;
				}
			} else {
				return  array ("status" => 'error',"error"   => 'Error while adding form');
			}
		}
		else
		{
			return  array ("status" => 'error',"error"   => 'Authentication Failed');
		}
	}

	/**
	 * Update pdf filename of the form
	 * @param string $filename
	 * @param int $id, formkey
	 * @return bool
	 */
	public function updatePDFFile($filename,$id) {

		$str = 'UPDATE forms
            	SET
				pdffile = "'.$filename.'" 
				WHERE id = "'. $id .'"';
		$result = $this -> db -> query ($str);
		if ($result) {
			return true;
		}
		else {
			return false;
		}
	}

	/**
	 * Searches form with respect ot inputObj
	 * @param StdObj $inputObj, contains search fields
	 * @return array, returns array of forms matching the criteria
	 * if no records are found, an array with status error and error description is returned.
	 */
	public function searchForms($inputObj) {
		global $db_user;	
		$qry = '';
		$qry1 = '';
		$qry2 = '';
		$qry3 = '';
		/*if(isset($inputObj->PatientDetailSurname) && $inputObj->PatientDetailSurname != '')
		{
			//$qry .= ' AND patient_surname LIKE "%'.$inputObj->PatientDetailSurname.'%" ';
			$qry1 = 'patient_surname LIKE "'.$inputObj->PatientDetailSurname.'%" ';
		}
		if(isset($inputObj->PatientDetailFirstName) && $inputObj->PatientDetailFirstName != '')
		{
			//$qry .= ' AND patient_firstname LIKE "%'.$inputObj->PatientDetailFirstName.'%" ';
			$qry2 = 'patient_firstname LIKE "'.$inputObj->PatientDetailFirstName.'%" ';
		}*/
		$qry3 ='';
		if(isset($inputObj->PatientDetailUR) && $inputObj->PatientDetailUR != '')
		{
			//$qry .= ' AND patient_ur LIKE "%'.$inputObj->PatientDetailUR.'%" ';
			$qry3 = ' OR  patient_ur LIKE "'.$inputObj->PatientDetailUR.'%" ';
		}
			
	//	$qry = 'AND (';
	//	if(($qry1 != ''))
//		$qry .= $qry1.' OR ';
//		if(($qry2 != ''))
//		$qry .= $qry2.' OR ';
		
	//	$qry .= ')';

		$patients = $this -> db_user -> query ("SELECT id
                        FROM 
                        	patients
                        WHERE (patient_surname LIKE '".$inputObj->PatientDetailSurname."%' OR patient_firstname LIKE '".$inputObj->PatientDetailFirstName."%')");

		$patient_ids = $patients->fetch_assoc();
	
		$temp = array();
		foreach($patient_ids as $a){
			array_push($temp, $a['id']);
		}
	 	

		$query = "SELECT
           					frm.id as FormKey,
                        	frm.patient_ur as PatientDetailUR,
                        	frm.form_complete as is_completed,
                        	frm.added_date as CreatedDate,
                        	frm.patient_dob as DOB
                        FROM 
                        	forms frm, 
                        	users u
                        WHERE
							( frm.id  IN(".implode(",",$temp).")  $qry3 ) AND 
                        	(frm.created_by = u.id)
                        AND
                        	u.userkey = '".$this->db->real_escape_string($inputObj->auth)."'
                       ";

		$result = $this -> db -> query ($query);

		if($result->num_rows > 0)
		{
			$formdata = array();
			 
			while($data = $result->fetch_assoc())
			{
				$iscompleted = 	$data['is_completed'];

				
		//		unset($patient_firstname);
		//		unset($patient_surname);
		//		foreach ( $data as $patient_names)
		//		{
						
		///			if($patient_names['formKey'] && (!isset($patient_firstname) && !isset($patient_surname))){
						$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = 
".$data['formKey']);

						$patients = $db_user_result->fetch_assoc();
						$data['PatientDetailFirstName']	= $patients['patient_firstname'];
						$data['PatientDetailSurname']	= $patients['patient_surname'];
						
						$patient_firstname	= $patients['patient_firstname'];
						$patient_surname	= $patients['patient_surname'];
		//				break;
		//			}
		//		}
				if($data['is_completed'])
				{
					unset($data['is_completed']);
					$formdata['completed']['form'][]['nodes'] = $data;
				}
				else
				{
					unset($data['is_completed']);
					$formdata['incompleted']['form'][]['nodes'] = $data;
				}
			}
			return $formdata;
		}
		else
		{
			return array('status' => 'error', 'error' => 'No Forms Found.');
		}

	}

	/**
	 * Shares a form to either user or group.
	 * If form is already shared, an error is returned
	 * @param stdObj $inputObj, contains detials of formid, authkey, userid, groupid
	 * @return array, On successful sharing returns array with status ok,
	 * and returns status as error and error description on failure.
	 */
	public function shareForm($inputObj) {



		$qry = 'SELECT
        				* 
        			FROM 
        				forms f,
        				users u 
        			WHERE 
        				u.id = f.created_by 
        			AND 
        				u.userkey = \''.$inputObj->authkey.'\'';
		$result = $this -> db -> query ($qry);
		if($result->num_rows <= 0)
		return array('status' => 'error', 'error' => 'Authentication Failed.');


		$data = $result->fetch_assoc();
		$mailto = $data['username'];

		if($inputObj->userid > 0)
		{
			$qry = 'SELECT
	        				id 
	        			FROM 
	        				form_shares f
	        			WHERE 
	        				f.form_id = '. (int)$inputObj->formid .' 
	        			AND 
	        				f.user_id = '. (int)$inputObj->userid;
			$result = $this -> db -> query ($qry);
			if($result->num_rows > 0)
			return array('status' => 'error', 'error' => 'Form already shared to this user.');

			$qry = 'INSERT
		        		INTO 
		        			form_shares(form_id,user_id,added_date) 
		        		VALUES
		        			('. (int)$inputObj->formid .','. (int)$inputObj->userid .',"'. date('Y-m-d H:i:s') .'")';
			$result = $this -> db -> query ($qry);
			if($result)
			{
				return array('status' => 'OK', 'error' => 'Form shared successfully.');
			}
			else
			{
				return array('status' => 'OK', 'error' => 'Error while processing. Please try again.');
			}


		}else if($inputObj->groupid > 0)
		{
			$qry = 'SELECT
	        				id 
	        			FROM 
	        				form_groupshares f
	        			WHERE 
	        				f.form_id = '. (int)$inputObj->formid .' 
	        			AND 
	        				f.group_id = '. (int)$inputObj->groupid;
			$result = $this -> db -> query ($qry);
			if($result->num_rows > 0)
			return array('status' => 'error', 'error' => 'Form already shared to this group.');

			$qry = 'INSERT
		        		INTO 
		        			form_groupshares(form_id,group_id,added_date) 
		        		VALUES
		        			('. (int)$inputObj->formid .','. (int)$inputObj->groupid .',"'. date('Y-m-d H:i:s') .'")';
			$result = $this -> db -> query ($qry);
			if($result)
			{
					
				$header = array ('From' => $from_mail,
					'To' => $mailto,
					'Subject' => "Heartweb iPhone application");
				$file = $path.$filename; // attachment
				$text = "Hi<BR><BR>";
				$text .= "There has been a message shred with you on you Heartweb iPhone applicaiton.<BR><BR>";
				$html = '<html><body>'.$text.'</body></html>';
					
				$crlf = "\n";
				
				$mime = new Mail_mime($crlf);
				$mime->setTXTBody($text);
				$mime->setHTMLBody($html);

				$message = $mime->get();
				$header = $mime->headers($header);
				 
					
				$smtp = Mail::factory('smtp',
				array ('host' => SMTP_HOST,
					 'port' => SMTP_PORT,
					 'auth' => true,
					 'username' => SMTP_USER,
					 'password' => SMTP_PASSWORD));
				$mail = $smtp->send($mailto, $header, $message);

				
		if (PEAR::isError($mail)) {

				$fp = fopen('/var/www/html/logfiles/sharemailerror.txt', 'a');
				fwrite($fp, "error: ".$mail->getMessage()."\n\n");
				fclose($fp);

		} 

				return array('status' => 'OK', 'error' => 'Form shared successfully.');

			}
			else
			{
				return array('status' => 'OK', 'error' => 'Error while processing. Please try again.');
			}
		}
		else
		{
			return array('status' => 'error', 'error' => 'No User/Group specified.');
		}

		 


	}

	/**
	 * Returns the pdf details of user authkey and form key.
	 * @param stdObj $inputObj
	 * @return array, returns array with status ok, on successful creation,
	 * In case of failure, return status as error and error description
	 */
	public function getFormPDF($inputObj)
	{
		$qry = 'SELECT
        				pdffile, patient_ur, username, patient_dob, study_examid, first_name, last_name 
        			FROM 
        				forms f,
        				users u 
        			WHERE 
        				u.id = f.created_by 
        			AND 
        				u.userkey = \''.$inputObj->authkey.'\'
        			AND f.id = \''.$inputObj->formkey.'\'';
		$result = $this -> db -> query ($qry);
		if($result->num_rows <= 0)
		return array('status' => 'error', 'error' => 'Invalid Request.');
		else if($data = $result->fetch_assoc())
		{
			if($data['pdffile'] != '')
			{
				
				if($inputObj->email != '')
				return array('status' => 'OK', 'pdffile' => $data['pdffile'], 'email' => $inputObj->email, 'UR' => $data['patient_ur']);
				else 
				return array('status' => 'OK', 'pdffile' => $data['pdffile'], 'email' => $data['username'], 'username' => $data['username']);
			}
			else
			return array('status' => 'error', 'error' => 'PDF does not exists.');


		}
	}
	/**
	 * Returns user, form details of user with respect to formkey
	 * @param stdObj $inputObj
	 * @return array
	 */
	public function getFormPDFData($inputObj)
	{
		global $db_user;
		$qry = 'SELECT
        				f.id AS formKey,users.id AS userid,  pdffile, patient_ur, username, patient_dob, study_examid, first_name 
        			FROM 
        				forms f,
        				users u 
        			WHERE 
        				u.id = f.created_by 
        			AND 
        				u.userkey = \''.$inputObj->authkey.'\'
        			AND f.id = \''.$inputObj->formkey.'\'';
		$result = $this -> db -> query ($qry);
		if($result->num_rows > 0){
			$data = $result->fetch_assoc();

			$result_data['pdffile'] = $data["pdffile"];
			$result_data['patient_ur'] = $data["patient_ur"];
			$result_data['username'] = $data["username"];
			$result_data['patient_dob'] = $data["patient_dob"];
			$result_data['study_examid'] = $data["study_examid"];
			$result_data['formKey'] = $data["formKey"];
			$result_data['userid'] = $data["userid"];

			if($inputObj->email !="" && $inputObj->email !=null ) $result_data['same'] =0;	
			else  $result_data['same'] =1;


			foreach ( $data as $patient_names)
			{
					
				if($patient_names['formKey'] && (!isset($patient_firstname) && !isset($patient_surname))){
					$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$patient_names['formKey']);

					$patients = $db_user_result->fetch_assoc();
					$result_data['patient_firstname']	= $patients['patient_firstname'];
					$result_data['patient_surname']	= $patients['patient_surname'];
					
					$patient_firstname	= $patients['patient_firstname'];
					$patient_surname	= $patients['patient_surname'];
					break;
				}
			}
			$mediapaths = array();
				$query = "	SELECT
                				media.id,
                				media.media_type,
                				media.path 
                			FROM
                				form_media_details media
                			WHERE 
                				form_id = '" . $inputObj->formkey. "'";

			$resultmedia = $this -> db -> query ($query);
			if($resultmedia->num_rows > 0){
				while($media = $resultmedia->fetch_assoc())
				{
					array_push($mediapaths, $media['path']);

				}
			}


			$result_data['mediapaths'] = $mediapaths;
			$result_data['first_name'] = $data["first_name"];
				
		}
			
		return $result_data;
	}

	/**
	 * Returns array of recent forms of the user with limit
	 * @param unknown_type string $userauth_key
	 * @param unknown_type int $limit, if not passed all the records are returned
	 * @return array
	 */
	public function getRecentForms($userauth_key,$limit = '') {
		global $db_user;
		$query = "SELECT
           					frm.id as formKey,
                        	frm.patient_ur as PatientDetailUR,
                        	frm.added_date as CreatedDate,
                        	frm.patient_dob as DOB
                       	FROM 
                        	forms frm,
                        	users u
                        WHERE
                        	u.id = frm.created_by 
                        AND
                        	u.userkey = '".$this->db->real_escape_string($userauth_key)."'
                        ORDER BY
                        	frm.id DESC
                        LIMIT ".(($limit != '')?$limit:3)." 
                       ";
		 
		$result = $this -> db -> query ($query);
		if($result->num_rows > 0)
		{
			$formdata = array();
			while($data = $result->fetch_assoc())
			{

				$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$data['formKey']);

				$patients = $db_user_result->fetch_assoc();
				$data['PatientDetailFirstName']	= $patients['patient_firstname'];
				$data['PatientDetailSurname']	= $patients['patient_surname'];
				

				$formdata['forms']['form'][]['nodes'] = $data;
			}
			return $formdata;
		}
		else
		{
			return array('forms' => '');
		}
	}

	/**
	 * Sends pdf form through email
	 * @param string $filename
	 * @param string $path
	 * @param string $mailto
	 * @param string $from_mail
	 * @param string $from_name
	 * @param string $replyto
	 * @param string $subject
	 * @param string $message
	 * @param array $result
	 * @return array, with status key.
	 */
	public function sendMailFormPDF($filename, $path, $mailto, $from_mail, $from_name, $replyto, $subject, $message, $result)
	{
			


		$header = array ('From' => $from_mail,
			'To' => $mailto,
			'Subject' => $subject);
		$file = $path.$filename; // attachment
			
		$text = "Hi<BR><BR>";
		$text .= "This Patient Record has been shared to you by: ".$result["first_name"]."<BR><BR>";
		$text .= "Patient: ".$result["patient_firstname"]." ".$result["patient_surname"]."<BR>";
		$text .= "DOB: ".$result["patient_dob"]."<BR>";
		$text .= "UR: ".$result["patient_ur"]."<BR>";
		$text .= "ExamID: ".$result["study_examid"]."<BR><BR><BR>";
		$text .= "====== IMPORTANT INFORMATION =========<BR>";
		$text .= "Please Note <BR>";
		$text .= "The information contained within this report is of a confidential nature and should not be shared with any other person."; // text and html versions of email.
			
		$html = '<html><body>'.$text.'</body></html>';
			
			
		$filename_deidentified = 'deidentified_'.$filename;
		 $file_deidentified = $path.$filename_deidentified; // attachment2
	 	$crlf = "\n";

	


		$mime = new Mail_mime($crlf);
		$mime->setTXTBody($text);
		$mime->setHTMLBody($html);
		$mime->addAttachment($file, 'application/pdf');
			
		if($mailto == ''){
			$mime->addAttachment($file_deidentified, 'application/pdf');
			$mailto = $username;
		}
			//add extra media 
			foreach($result['mediapaths'] as $media){
				$media =	str_replace("http://108.171.185.56/uploads/formdata/",FORM_MEDIA_PATH,  $media);
				$mimetype =  mime_content_type($media);
				$mime->addAttachment($media,  $mimetype);
		
			}
	
		$message = $mime->get();
		$header = $mime->headers($header);
		 
			
		$smtp = Mail::factory('smtp',
		array ('host' => SMTP_HOST,
			 'port' => SMTP_PORT,
			 'auth' => true,
			 'username' => SMTP_USER,
			 'password' => SMTP_PASSWORD));
		$mail = $smtp->send($mailto, $header, $message);


		if (PEAR::isError($mail)) {

				$fp = fopen('/var/www/html/logfiles/mailerror.txt', 'a');
				fwrite($fp, "error: ".$mail->getMessage()."\n\n");
				fclose($fp);

			return array('status' => "Your email wasn't sent, please try again");
		} else {
			
			if( !preg_match("/^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$/i", $mailto) ) {
				return array('status' => "Your email wasn't sent, please try again");
			}else 
	
				$qry = 'INSERT INTO form_shares(form_id,user_id,added_date)  VALUES ('. $result["formKey"] .','. $result["userid"] .',"'. date('Y-m-d H:i:s') .'")';
				 $this -> db -> query ($qry);
			
				return array('status' => "Your email has been sent successfully");		
		
		}
	}


	/**
	 * Returns forms list of the group
	 * @param stdObj $data
	 * @return array, if no records are found, empty array is returned.
	 */
	public function loadGroupFormsList($data)
	{
		global $db_user;
		$result = $this -> db -> query (
                        "SELECT 
							frm.id as formKey,
                        	frm.patient_ur as PatientDetailUR,
                        	frm.added_date as CreatedDate,
                        	frm.patient_dob as DOB
                        FROM
                            forms frm WHERE 
							id 
							IN 
								(
								select 
									form_id  
								from 
									form_groupshares 
								where 
									group_id=".(int)$data->groupid."
								) "
								);

								$return = array();

								if ($result->num_rows > 0) {

									/* fetch associative array */
									while ($row = $result->fetch_assoc()) {


										unset($patient_firstname);
										unset($patient_surname);
										foreach ( $row as $patient_names)
										{
												
											if($patient_names['formKey'] && (!isset($patient_firstname) && !isset($patient_surname))){
												$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$patient_names['formKey']);

												$patients = $db_user_result->fetch_assoc();
												$patient_firstname	= $patients['patient_firstname'];
												$patient_surname	= $patients['patient_surname'];
												break;
											}
										}



										$return['forms']['form'][]['nodes'] = array (
                                       "FormKey"  => $row['formKey'], 
                                       "PatientDetailUR"  => $row['PatientDetailUR'],
									   "PatientDetailSurname" => $patient_surname,
									   "PatientDetailFirstName" => $patient_firstname,
									   "CreatedDate" => $row['CreatedDate'],
									   "DOB" => $row['DOB']
										);
									}

									/* free result set */
									$result->free();
								}
								else
								$return['forms'] = '';

								return $return;
	}

	/**
	 * Returns array of user form details
	 * @param StdObj $inputObj
	 * @return array
	 */
	public function userShareForm($inputObj) {
		global $db_user;
		$qry = 'SELECT
        				frm.id as formKey,
						frm.patient_ur as PatientDetailUR,
						frm.added_date as CreatedDate,
						frm.patient_dob as DOB 
        			FROM 
        				forms frm,
        				form_groupshares fgs,
						groups g
        			WHERE 
        				fgs.form_id = frm.id 
					AND
						fgs.group_id = g.id
        			AND 
        				g.group_owner in (SELECT id FROM users WHERE userkey = "'.$inputObj->authkey.'" ) GROUP BY frm.id';
			
		$result = $this -> db -> query ($qry);
		if($result->num_rows <= 0)
		return array('status' => 'error', 'error' => 'No forms has been shared.');
		else
		{
			$return = array();
			while ($row = $result->fetch_assoc()) {

				unset($patient_firstname);
				unset($patient_surname);
				foreach ( $row as $patient_names)
				{
						
					if($patient_names['formKey'] && (!isset($patient_firstname) && !isset($patient_surname))){
						$db_user_result = $this -> db_user-> query ("SELECT * from patients where id = ".$patient_names['formKey']);

						$patients = $db_user_result->fetch_assoc();
						$patient_firstname	= $patients['patient_firstname'];
						$patient_surname	= $patients['patient_surname'];
						break;
					}
				}

				$return['forms']['form'][]['nodes'] = array (
                                       "FormKey"  => $row['formKey'], 
                                       "PatientDetailUR"  => $row['PatientDetailUR'],
									   "PatientDetailSurname" => $patient_surname,
									   "PatientDetailFirstName" => $patient_firstname,
									   "CreatedDate" => $row['CreatedDate'],
									   "DOB" => $row['DOB']
				);
			}
			return $return;

			/* free result set */
			$result->free();

		}
			
		 


	}

	/**
	 * Deletes a user form
	 * @param StdObj $inputObj
	 * @return array, with status field, error description on failure
	 */
	public function deleteForm($inputObj) {
			
		global $db_user; 

		$sel_qry = 'SELECT * FROM forms WHERE id='.$inputObj->formkey.'';
		$result = $this -> db -> query ($sel_qry);
		if($result->num_rows <= 0) {
			return array('status' => 'error', 'error' => 'Form doesn"t exists.');
		}
		else {
				
			$selectQuery = 'SELECT u.id
            FROM 
            	users u, forms f 
            WHERE
            	f.created_by = u.id AND f.id = "'.$inputObj->formkey.'" AND u.userkey = "'.$inputObj->userkey.'"';

			$result = $this -> db -> query ($selectQuery);
				
			if($this->getUserType($inputObj->userkey) == 'SUPER USER' || $result->num_rows > 0)
			{
				$query = 'DELETE FROM
								forms WHERE
							id = "'.(int)$inputObj->formkey.'" LIMIT 1'; 
				if($this -> db -> query($query)) {
					if($this -> db -> affected_rows > 0) {
						$this -> db_user -> query('DELETE FROM patients WHERE id = "'.(int)$inputObj->formkey.'" LIMIT 1' );
						return  array('status' => 'OK','message'=>'Form deleted successfully.');
					} else {
						return  array('status' => 'error','error' => 'Unable to delete.');
					}
				} else {
					return  array('status' => 'error', 'error' => 'Unable to delete.');
				}
			}
			else
			{
				$userdata = $this->checkUserCreatedForm($inputObj->userkey, $inputObj->groupid);
				if(count($userdata) > 0)
				{
					$query = 'DELETE FROM
									forms WHERE
								id = "'.(int)$inputObj->formkey.'" LIMIT 1'; 
					if($this -> db -> query($query)) {
						if($this -> db -> affected_rows > 0) {
							
						$this -> db_user -> query('DELETE FROM patients WHERE id = "'.(int)$inputObj->formkey.'" LIMIT 1' );
							return  array('status' => 'OK','message'=>'Form deleted successfully.');
						} else {
							return  array('status' => 'error','error' => 'Unable to delete.');
						}
					} else {
						return  array('status' => 'error', 'error' => 'Unable to delete.');
					}
				}
				else
				return  array('status' => 'error', 'error' => 'Access denied.');
			}
		}
	}

	/**
	 * Returns array of user id, faculty, if form belongs to the user
	 * @param string $userkey
	 * @param int $formid
	 * @return array
	 */
	private function checkUserCreatedForm($userkey, $formid)
	{
		$selectQuery = 'SELECT u.id,u.faculty
            FROM 
            	users u, forms f
            WHERE
				u.id = f.created_by
			AND
				f.id = '.$formid.'
			AND
            	u.userkey = "' . $this->db->real_escape_string($userkey) . '"';	

		$result = $this -> db -> query ($selectQuery);

		return ($result->num_rows > 0)?$result->fetch_assoc():array();
	}

	public function removemedia($inputObj)
	{
		 $selectQuery = 'SELECT u.id
            FROM 
            	users u, forms f 
            WHERE
            	f.created_by = u.id AND f.id = "'.$inputObj->formid.'" AND u.userkey = "'.$inputObj->userkey.'"';

		$result = $this -> db -> query ($selectQuery);
			
		if($result->num_rows > 0 && isset($inputObj->mediaID))
		{

				$str = 'DELETE FROM form_media_details WHERE id ="'.$inputObj->mediaID.'" ';
				$this -> db -> query ($str);			
				return array('status' => 'OK', 'error' => 'Image removed successfully.');
		}
		else
		{
			return array('status' => 'error', 'error' => 'Image not removed.');
		}

	}
	public function getSaredUserName($usekey)
	{
		$selectQuery = "select username from users where userkey like '".$usekey."'";
		$result = $this -> db -> query ($selectQuery);
			
		while ($row = $result->fetch_assoc()) {
			$sharedby = $row['username'];
		}

		return $sharedby;

	}

	

}
