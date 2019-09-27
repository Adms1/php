<?php

namespace App\Repositories;

use App\Tutor;
use App\Institute;
use App\InstituteTutor;
use Auth;
use Log;
use DB;
use Config;
use Session;

/**
 * Class TutorRepository.
 *
 * @package namespace App\Repositories;
 */
class TutorRepository
{

    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct()
    {
    
    }

    /**
     * Get resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return Tutor::with('tutor')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor list.',['TutorRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * store resource.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        try {
            $tutor = Tutor::where('TutorEmail', $data['TutorEmail'])->where('TutorPhoneNumber', $data['TutorPhoneNumber'])->first();
            if (!$tutor) {
                $tutor = Tutor::create($data);
                $this->instituteTutorRelation($data['InstituteName'], $tutor['TutorID']);
            }
            return $tutor;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor store.',['TutorRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get tutor data resource.
     *
     * @param int $tutor_id
     * @return \Illuminate\Http\Response
     */
    public function edit($tutor_id)
    {
        try {
            return Tutor::with('institutes')->find($tutor_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor store.',['TutorRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * update resource.
     *
     * @param array $data
     * @param int $tutor_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $tutor_id)
    {
        try {
            $tutor = Tutor::find($tutor_id);
            $tutor->fill($data);
            $tutor->save();
            if ($tutor) {
                $this->instituteTutorRelation($data['InstituteName'], $tutor['TutorID']);
            }
            return $tutor;
        } catch (\Exception $e) {
            /*echo "<pre>";
            $e->getMessage();
            die;*/
            Log::channel('loginfo')
                ->error('tutor update.',['TutorRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Create institute tutor relation.
     *
     * @param int $institute_name
     * @param int $tutor_id
     * @return \Illuminate\Http\Response
     */
    public function instituteTutorRelation($institute_name, $tutor_id)
    {
        try {
            // Find institute by name if exist then get institute id else add new institute
            $institute = Institute::where('InstituteName', $institute_name)->first();
            if (empty($institute)) {
                $institute = new Institute();
                $institute->InstituteName = $institute_name;
                $institute->save();
            }

            //Delete other institute relation with tutor by tutor id
            InstituteTutor::where('TutorID', $tutor_id)->delete();

            // Create relation between tutor and institute
            $institute_tutor = new InstituteTutor();
            $institute_tutor->InstituteID = $institute->InstituteID;
            $institute_tutor->TutorID = $tutor_id;
            $institute_tutor->IsActive = 1;
            $institute_tutor->save();
            return $institute_tutor;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create institute tutor relation.',['TutorRepository/instituteTutorRelation', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Send OTP to mobile number
     *
     * @param num $phone_number
     * @return \Illuminate\Http\Response
     */
    public function sendOtp($phone_number)
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => Config::get('settings.APP_URL'),
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "StudentMobile=$phone_number",
              CURLOPT_HTTPHEADER => array(
                "cache-control: no-cache",
                "content-type: application/x-www-form-urlencoded",
              ),
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
                //echo "cURL Error #:" . $err;
                //die;
            } else {
                $obj = json_decode($response);
                Session::put('otp', $obj->data);
                return $obj;
            }
            return true;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor sendOtp.',['TutorRepository/sendOtp', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update user active.
     *
     * @param array $data
     * @param int $tutor_id
     * @return \Illuminate\Http\Response
     */
    public function activeTutorByID($tutor_id)
    {
        try {
            $tutor = Tutor::find($tutor_id);
            $tutor->StatusID = 1;
            $tutor->save();
            Auth::guard('tutor')->login($tutor);
            return $tutor;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor active.',['TutorRepository/activeTutorByID', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get tutor data resource.
     *
     * @param int $phone_number
     * @return \Illuminate\Http\Response
     */
    public function checkUserExistByMobile($phone_number)
    {
        try {
            return Tutor::where('TutorPhoneNumber', $phone_number)
                        ->where('IsActive', 1)->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('tutor store.',['TutorRepository/edit', $e->getMessage()]);
            return false;
        }
    }
}