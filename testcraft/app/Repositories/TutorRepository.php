<?php

namespace App\Repositories;

use App\Tutor;
use App\Institute;
use App\InstituteTutor;
use Auth;
use Log;
use DB;

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
            $tutor = Tutor::create($data);
            $this->instituteTutorRelation($data['InstituteName'], $tutor['TutorID']);
            Auth::guard('tutor')->login($tutor);
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
            return Tutor::find($tutor_id);
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
            $tutor_type = Tutor::find($tutor_id);
            $tutor_type->fill($data);
            $tutor_type->save();
            return $tutor_type;
        } catch (\Exception $e) {
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
}