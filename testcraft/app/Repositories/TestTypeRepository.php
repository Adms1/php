<?php

namespace App\Repositories;

use App\Unit;
use App\Topic;
use App\Chapter;
use App\TestType;
use App\TestPackage;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class TestTypeRepository.
 *
 * @package namespace App\Repositories;
 */
class TestTypeRepository
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
            return TestType::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test type list.',['TestTypeRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get test types dropdoown.
     *
     * @return array $data
     */
    public function getTestTypeDropdown()
    {   
        return TestType::pluck('TestTypeName','TestTypeID');
    }

    /**
     * Get test types dropdoown.
     *
     * @return array $data
     */
    public function storeTestPackageTest($data)
    {   
        return TestType::pluck('TestTypeName','TestTypeID');
    }

    /**
     * Get test chapter dropdoown.
     *
     * @param int $package_id
     * @return array $data
     */
    public function getChapterDropdown($package_id)
    {   
        $package_data = TestPackage::find($package_id);

        return BoardStandardSubjectChapterTopic::with(['chapter'])
                                        ->where('BoardID', $package_data->BoardID)
                                        ->where('StandardID', $package_data->StandardID)
                                        ->where('SubjectID', $package_data->SubjectID)
                                        ->get()
                                        ->pluck('chapter.ChapterName','chapter.ChapterID');
    }

    /**
     * Get test topic dropdoown.
     *
     * @param int $package_id
     * @return array $data
     */
    public function getTopicDropdown($package_id)
    {   
        $package_data = TestPackage::find($package_id);

        return BoardStandardSubjectChapterTopic::with(['topic'])
                                        ->where('BoardID', $package_data->BoardID)
                                        ->where('StandardID', $package_data->StandardID)
                                        ->where('SubjectID', $package_data->SubjectID)
                                        ->get()
                                        ->pluck('topic.TopicName','topic.TopicID');
    }

    /**
     * Get test unit dropdoown.
     *
     * @return array $data
     */
    public function getUnitDropdown()
    {   
        return Unit::pluck('UnitName','UnitID');
    }
}