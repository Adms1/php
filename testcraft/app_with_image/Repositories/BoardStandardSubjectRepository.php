<?php

namespace App\Repositories;

use App\BoardStandardSubject;
use Log;
use DB;

/**
 * Class BoardStandardSubjectRepository.
 *
 * @package namespace App\Repositories;
 */
class BoardStandardSubjectRepository
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
            return BoardStandardSubject::with(['board', 'subject', 'standard'])->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board standard subject list.',['BoardStandardSubjectRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store new resource.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        try {
            return BoardStandardSubject::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board standard subject store.',['BoardStandardSubjectRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $board_standard_subject_id
     * @return \Illuminate\Http\Response
     */
    public function edit($board_standard_subject_id)
    {
        try {
            return BoardStandardSubject::find($board_standard_subject_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board standard subject edit.',['BoardStandardSubjectRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $board_standard_subject_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $board_standard_subject_id)
    {
        try {
            $board_standard_subject = BoardStandardSubject::find($board_standard_subject_id);
            $board_standard_subject->fill($data);
            $board_standard_subject->save();
            return $board_standard_subject;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board standard subject update.',['BoardStandardSubjectRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get boardStandardSubjectID.
     *
     * @param int $board_id
     * @param int $standard_id
     * @param int $subject_id
     * @return \Illuminate\Http\Response
     */
/*    public function getBoardStandardSubjectID($board_id, $standard_id, $subject_id)
    {
        try {
            $board_standard_subjects = DB::select('exec SP_Web_Get_BoardStandardSubject');

            foreach ($board_standard_subjects as $key => $board_standard_subject) {
                if ($board_id == $board_standard_subject->BoardID && 
                    $standard_id == $board_standard_subject->StandardID && 
                    $subject_id == $board_standard_subject->SubjectID) {
                    return $board_standard_subject->BoardStandardSubjectID;
                }
            }
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board standard subject id.',['BoardStandardSubjectRepository/getBoardStandardSubjectID', $e->getMessage()]);
            return false;
        }
    }*/
}