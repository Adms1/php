<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\InstitutionRepository;
use App\Validators\InstitutionValidator;
use App\Entities\InstitutionBoardStandardSubject;
use App\Entities\InstitutionBoardStandard;
use App\Entities\InstitutionVendor;
use App\Entities\Institution;
use App\Entities\RoleVendor;
use Auth;
use Log;
use DB;

/**
 * Class InstitutionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class InstitutionRepositoryEloquent extends BaseRepository implements InstitutionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Institution::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return InstitutionValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
    /**
     * Delete institution by Id
     *
     * @param int $institution_id
     * @return array $institution
     */
    public function deleteInstitution($institution_id)
    {
        try {
            return Institution::where('institution_id',$institution_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete institution by Id.',['InstitutionRepository/deleteInstitution', $e->getMessage()]);
            return false;
        }
    } 

    /**
     * Get institution list
     *
     * @return array $institution
     */
    public function getInstitutionList()
    {
        return Institution::with(['country' => function ($query) {
                                $query->select('country_id', 'name');
                            }, 'state' => function ($query) {
                                $query->select('state_id', 'name');
                            }, 'status'  => function ($query) {
                                $query->select('status_id', 'status_name');
                            }])
                            ->select('institution_id', 'country_id', 'state_id', 'status_id', 'institution_name', 'contact_name', 'phone', 'city')
                            ->where('is_active', 1)
                            ->get();
        /*return DB::table('institution')
                ->join('country', 'institution.country_id', '=', 'country.country_id')
                ->join('state', 'institution.state_id', '=', 'state.state_id')
                ->join('status', 'institution.status_id', '=', 'status.status_id')
                ->where('institution.is_active', 1)
                ->get();*/
    }
    
    /**
     * Add institution role
     *
     * @param array $data
     * @return array $vendor_role
     */
    public function addInstitutionRole($data)
    {
        try {
            $vendor_role = new RoleVendor();
            $vendor_role->role_id = 3;
            $vendor_role->vendor_id = $data->institution_id;
            return $vendor_role->save();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Add institution role.',['InstitutionRepository/addInstitutionRole', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update institution
     *
     * @param array $data
     * @param int $institution_id
     * @return array $institution
     */
    public function updateInstitution($data, $institution_id)
    {
        try {
            $institution = Institution::find($institution_id);
            $institution->fill($data);
            $institution->save();
            return $institution;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update institution.',['InstitutionRepository/updateInstitution', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store standards to board
     *
     * @param array $data
     * @return array $institution_board_standard
     */
    public function assignBoardStandard($data)
    {   
        try {
            DB::beginTransaction();
            $institution_id = Auth::guard('institution')->user()->institution_id;
            if (count($data['standard_id']) > 0) {
                foreach ($data['standard_id'] as $key => $standard_id) {
                    $institution_board_standard = new InstitutionBoardStandard();
                    $institution_board_standard->institution_id = $institution_id;
                    $institution_board_standard->board_id = $data['board_id'];
                    $institution_board_standard->standard_id = $standard_id;
                    $institution_board_standard->save();
                    $this->assignBoardStandardSubject($data['board_id'], $standard_id, $data['subject_id']);
                }
            }
            DB::commit();
            return $institution_board_standard;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Store standards to board.',['InstitutionRepository/assignBoardStandard', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Store subjects of standards
     *
     * @param int $board_id
     * @param int $standard_id
     * @param array $subject_ids
     * @return array $institution_board_standard_subject
     */
    public function assignBoardStandardSubject($board_id, $standard_id, $subject_ids)
    {   
        try {
            DB::beginTransaction();
            $institution_id = Auth::guard('institution')->user()->institution_id;
            if (count($subject_ids) > 0) {
                foreach ($subject_ids as $key => $subject_id) {
                    $institution_board_standard_subject = new InstitutionBoardStandardSubject();
                    $institution_board_standard_subject->institution_id = $institution_id;
                    $institution_board_standard_subject->board_id = $board_id;
                    $institution_board_standard_subject->standard_id = $standard_id;
                    $institution_board_standard_subject->subject_id = $subject_id;
                    $institution_board_standard_subject->save();
                }
            }
            DB::commit();
            return $institution_board_standard_subject;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Store subjects of standards.',['InstitutionRepository/assignBoardStandardSubject', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get all list of boards with related standards based on login institution id
     *
     * @return array $institution
     */
    public function getBoardStandardList()
    {   
        $institution_id = Auth::guard('institution')->user()->institution_id;

        return InstitutionBoardStandard::with(['board' => function ($query) {
                                        $query->select('board_id', 'board_name');
                                    }, 'standard' => function ($query) {
                                        $query->select('standard_id', 'standard_name');
                                    }])
                                    ->select('institution_board_standard_id', 'institution_id', 'board_id', 'standard_id', 'is_active')
                                    ->where('institution_id', $institution_id)
                                    ->get();

        /*return DB::table('institution_board_standard')
                ->join('board', 'board.board_id', '=', 'institution_board_standard.board_id')
                ->join('standard', 'standard.standard_id', '=', 'institution_board_standard.standard_id')
                ->select('institution_board_standard_id', 'institution_id', 'institution_board_standard.board_id', 'institution_board_standard.standard_id', 'standard_name', 'board_name', 'institution_board_standard.is_active')
                ->where('institution_board_standard.institution_id', $institution_id)
                //->where('institution_board_standard.is_active', 1)
                ->get();*/
    }

    /**
     * Get all list of subjects with related standards based on login institution id
     *
     * @param int $board_id
     * @param int $standard_id
     * @return array $subjects
     */
    public function getBoardStandardSubjectList($board_id, $standard_id)
    {   
        $institution_id = Auth::guard('institution')->user()->institution_id;

        $subjects = InstitutionBoardStandardSubject::with(['subject'])
                ->where('institution_id', $institution_id)
                ->where('board_id', $board_id)
                ->where('standard_id', $standard_id)
                ->get()
                ->pluck('subject.subject_name')->toArray();
        return implode(", ", $subjects);


        /*$subjects = DB::table('institution_board_standard_subject')
                ->join('subject', 'subject.subject_id', '=', 'institution_board_standard_subject.subject_id')
                ->where('institution_board_standard_subject.institution_id', $institution_id)
                ->where('institution_board_standard_subject.board_id', $board_id)
                ->where('institution_board_standard_subject.standard_id', $standard_id)
                ->pluck('subject_name')->toArray();
        return implode(", ", $subjects);*/
    }

    /**
     * Get all subjects of related standards by board id
     *
     * @param int $board_id
     * @param int $standard_id
     * @return array $subjects
     */
    public function getBoardStandardSubjectId($board_id, $standard_id)
    {   
        $assign_subjects = array();
        $institution_id = Auth::guard('institution')->user()->institution_id;

        $assign = InstitutionBoardStandardSubject::where(['board_id' => $board_id, 'institution_id' => $institution_id, 'standard_id' => $standard_id])->get();
        
        if (count($assign) > 0) {
            foreach ($assign as $key => $assign_subject) {
                $subject_array[] = $assign_subject->subject_id;
            }
            $assign_subjects = $subject_array;
        }
        return $assign_subjects;
    }

    /**
     * Update standards of related board by board id
     *
     * @param array $data
     * @param int $board_id
     * @param int $standard_id
     * @return array $institution
     */
    public function updateBoardStandard($data, $board_id, $standard_id)
    {   
        try {
            DB::beginTransaction();
            $institution_id = Auth::guard('institution')->user()->institution_id;

            InstitutionBoardStandardSubject::where(['board_id' => $board_id, 'standard_id' => $standard_id, 'institution_id' => $institution_id])->delete();
            DB::commit();
            return $this->assignBoardStandardSubject($board_id, $standard_id, $data['subject_id']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Update standards of related board by board id.',['BooksetRepository/updateBoardStandard', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Active/Inactive Board/Standard
     *
     * @param  int $institution_board_standard_id
     * @param  int $status
     * @return array $institution
     */
    public function changeBoardStandardStatus($institution_board_standard_id, $status)
    {
        try {
            return InstitutionBoardStandard::where('institution_board_standard_id',$institution_board_standard_id)->update(['is_active' => $status]);
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('Active/Inactive Board/Standard.',['BooksetRepository/changeBoardStandardStatus', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get institution list for front end filtration
     *
     * @param  int $institution_id
     * @return array $institutions
     */
    public function getInstitutionsListForFilter($institution_id)
    {
        $institution_vendor = InstitutionVendor::join('institution', 'institution.institution_id', '=', 'institution_vendor.institution_id');

        if ($institution_id) {
            $institution_vendor = $institution_vendor->where('institution_vendor.institution_id', $institution_id);
        }

        return $institution_vendor;
    }
}
