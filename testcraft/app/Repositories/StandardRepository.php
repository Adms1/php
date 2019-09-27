<?php

namespace App\Repositories;

use App\Standard;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class StandardRepository.
 *
 * @package namespace App\Repositories;
 */
class StandardRepository
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
            return Standard::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('standard list.',['StandardRepository/list', $e->getMessage()]);
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
            return Standard::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('standard store.',['StandardRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function edit($standard_id)
    {
        try {
            return Standard::find($standard_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('standard edit.',['StandardRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $standard_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $standard_id)
    {
        try {
            $standard = Standard::find($standard_id);
            $standard->fill($data);
            $standard->save();
            return $standard;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('standard update.',['StandardRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get standard dropdoown.
     *
     * @return array $data
     */
    public function getStandardDropdown()
    {   
        return Standard::where('IsActive', 1)->pluck('StandardName','StandardID');
    }

    /**
     * Get ajax resource by id.
     *
     * @param int $board_id
     * @return \Illuminate\Http\Response
     */
    public function getStandardListByBoardID($board_id)
    {
        try {
            return BoardStandardSubjectChapterTopic::leftJoin('Standard', 'Standard.StandardID', 'BoardStandardSubjectChapterTopic.StandardID')
                                ->where('BoardStandardSubjectChapterTopic.IsActive', 1)
                                ->where('BoardID', $board_id)
                                ->select('StandardName', 'Standard.StandardID', 'OrderNumber')
                                ->distinct()
                                ->orderBy('Standard.OrderNumber')
                                ->get()
                                ->pluck('StandardName', 'StandardID');

        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('standard list by ajax.', ['StandardRepository/getStandardListByBoardId', $e->getMessage()]);
            return false;
        }
    }
}