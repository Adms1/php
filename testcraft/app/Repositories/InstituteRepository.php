<?php

namespace App\Repositories;

use App\Institute;
use Log;
use DB;

/**
 * Class InstituteRepository.
 *
 * @package namespace App\Repositories;
 */
class InstituteRepository
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
            return Institute::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('institute list.',['InstituteRepository/list', $e->getMessage()]);
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
            return Institute::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('institute store.',['InstituteRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $institute_id
     * @return \Illuminate\Http\Response
     */
    public function edit($institute_id)
    {
        try {
            return Institute::find($institute_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('institute edit.',['InstituteRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $institute_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $institute_id)
    {
        try {
            $institute = Institute::find($institute_id);
            $institute->fill($data);
            $institute->save();
            return $institute;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('institute update.',['InstituteRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get institute dropdoown.
     *
     * @return array $data
     */
    public function getInstituteDropdown()
    {   
        return Institute::pluck('InstituteName','InstituteID');
    }

    /**
     * Get institute name.
     *
     * @return array $data
     */
    public function getInstituteList()
    {   
        return Institute::pluck('InstituteName');
    }
}