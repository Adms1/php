<?php

namespace App\Repositories;

use App\Unit;
use App\UnitChapter;
use Log;
use DB;

/**
 * Class UnitRepository.
 *
 * @package namespace App\Repositories;
 */
class UnitRepository
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
            return Unit::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('unit list.',['UnitRepository/list', $e->getMessage()]);
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
            // Find unit by name if exist then get unit id else add new unit
            $unit = Unit::where('UnitName', $data['UnitName'])->first();
            if (empty($unit)) {
                $unit = new Unit();
                $unit->UnitName = $data['UnitName'];
                $unit->save();
            }
            // Create relation between unit and unit chapters
            if ($unit) {
                foreach ($data['ChapterID'] as $key => $chapter) {
                    $unit_chapter = new UnitChapter();
                    $unit_chapter->UnitID = $unit['UnitID'];
                    $unit_chapter->BoardID = $data['BoardID'];
                    $unit_chapter->StandardID = $data['StandardID'];
                    $unit_chapter->SubjectID = $data['SubjectID'];
                    $unit_chapter->ChapterID = $chapter;
                    $unit_chapter->save();
                }
                return $unit;
            }
            return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('unit store.',['UnitRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $unit_id
     * @return \Illuminate\Http\Response
     */
    public function edit($unit_id)
    {
        try {
            return UnitChapter::with(['unit'])
                                ->where('UnitID', $unit_id)
                                ->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('unit edit.',['UnitRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by unit_id.
     *
     * @param array $data
     * @param int $unit_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $unit_id)
    {
        try {
            // Find unit by name if exist then get unit id else add new unit

            $unit = Unit::find($unit_id);
            $unit->fill($data);
            $unit->save();

            /*$unit = Unit::where('UnitName', $data['UnitName'])->first();
            if (empty($unit)) {
                $unit = new Unit();
                $unit->UnitName = $data['UnitName'];
                $unit->save();
            }*/
            // delete old and create new relation between unit and unit chapters
            if ($unit) {
                UnitChapter::where('UnitID', $unit_id)->delete();
                foreach ($data['ChapterID'] as $key => $chapter) {
                    $unit_chapter = new UnitChapter();
                    $unit_chapter->UnitID = $unit['UnitID'];
                    $unit_chapter->BoardID = $data['BoardID'];
                    $unit_chapter->StandardID = $data['StandardID'];
                    $unit_chapter->SubjectID = $data['SubjectID'];
                    $unit_chapter->ChapterID = $chapter;
                    $unit_chapter->save();
                }
                return $unit;
            }
            return false;


            // $unit = Unit::find($unit_id);
            // $unit->fill($data);
            // $unit->save();
            // if ($unit) {
            //     UnitChapter::where('UnitID', $unit_id)->delete();
            //     $data['UnitID'] = $unit['UnitID'];
            //     UnitChapter::create($data);
            // }
            // return $unit;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('unit update.',['UnitRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Unit name.
     *
     * @return array $data
     */
    public function getUnitList()
    {   
        return Unit::pluck('UnitName');
    }
}