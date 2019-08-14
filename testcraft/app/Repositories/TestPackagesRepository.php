<?php

namespace App\Repositories;

use App\TestPackage;
use App\TestPackageTest;
use App\TestChapterTopic;
use App\TestSection;
use App\TestSectionQuestionType;
use Auth;
use Log;
use DB;

/**
 * Class TestPackagesRepository.
 *
 * @package namespace App\Repositories;
 */
class TestPackagesRepository
{

    /**
     * Create a new model instance.
     *
     * @return void
     */
    public function __construct(TestPackage $table)
    {
        $this->table = $table;
    }

    /**
     * Get resource list.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            $package = $this->table;
            if (Auth::guard('tutor')->check()) {
                $tutor_id = Auth::guard('tutor')->user()->TutorID;
                $package = $package->where('TutorID', $tutor_id);
            } 
            return $package->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package list.',['TestPackagesRepository/list', $e->getMessage()]);
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
            return TestPackage::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package store.',['TestPackagesRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $test_package_id
     * @return \Illuminate\Http\Response
     */
    public function edit($test_package_id)
    {
        try {
            return TestPackage::with(['board', 'standard', 'subject'])->find($test_package_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package edit.',['TestPackagesRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $test_package_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $test_package_id)
    {
        try {
            $test_package = TestPackage::find($test_package_id);
            $test_package->fill($data);
            $test_package->save();
            return $test_package;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package update.',['TestPackagesRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by id.
     *
     * @param array $data
     * @param int $test_package_test_id
     * @return \Illuminate\Http\Response
     */
    public function testUpdate($data, $test_package_test_id)
    {
        try {
            $test = TestPackageTest::find($test_package_test_id);
            $test->fill($data);
            $test->save();
            return $test;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test update.',['TestPackagesRepository/testUpdate', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    /*public function storeTestPackageTest($data)
    {
        try {
            $test_detail = new TestPackageTest();
            $test_detail->TestPackageID = $data['PackageID'];
            $test_detail->TestTypeID = $data['TestTypeID'];
            $test_detail->NumberofTest = $data['NumberofQuestion'];

            switch ($data['TestTypeID']) {
                case '1':
                    $test_detail->ChapterID = $data['TypeID'];
                    break;
                case '2':
                    $test_detail->TopicID = $data['TypeID'];
                    break;
                case '3':
                    $test_detail->UnitID = $data['TypeID'];
                    break;
            }

            $test_detail->save();
            return $test_detail;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package detail add.', ['TestPackagesRepository/storeTestPackageTest', $e->getMessage()]);
            return false;
        }
    }*/

    /**
     * Get resource for test package edit view by id.
     *
     * @param int $test_package_id
     * @return \Illuminate\Http\Response
     */
    /*public function getPackageDetail($test_package_id)
    {
        try {
            return TestPackageTest::with(['testType', 'chapter', 'topic', 'unit'])
                ->where('TestPackageID', $test_package_id)
                ->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package edit.',['TestPackagesRepository/list', $e->getMessage()]);
            return false;
        }
    }*/

    /**
     * Delete package based on package id
     *
     * @param array $data
     * @return array $package_detail
     */
    /*public function deletePackageDetail($data)
    {
        try {
            $package_detail = TestPackageTest::find($data['package_detail_id'])->delete();
            return $package_detail;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete package based on package id.',['TestPackagesRepository/deletePackageDetail', $e->getMessage()]);
            return false;
        }
    }*/

    /**
     * Get total count of the remaining number of tests to create the package
     *
     * @param array $data
     * @return array $package_detail
     */
    /*public function getCountOfRemainNumberOfTest($test_package_id)
    {
        try {
            $test_package = TestPackage::select('NumberOfTest')->find($test_package_id);
            $total_tests = $test_package->NumberOfTest;
            $created_tests = TestPackageTest::where('TestPackageID', $test_package_id)->sum('NumberOfTest');
            return $total_tests - $created_tests;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get total count of the remaining number of tests to create the package.',['TestPackagesRepository/getCountOfRemainNumberOfTest', $e->getMessage()]);
            return false;
        }
    }*/

    /**
     * Store new test.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function testStore($data)
    {
        try {             
            return TestPackageTest::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/testStore', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get test list by package id.
     *
     * @param array $package_id
     * @return \Illuminate\Http\Response
     */
    public function getTests($package_id)
    {
        try {             
            return TestPackageTest::where('TestPackageID', $package_id)->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/testStore', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get test test id.
     *
     * @param array $test_id
     * @return \Illuminate\Http\Response
     */
    public function getTest($test_id)
    {
        try {             
            return TestPackageTest::find($test_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get test detail.',['TestPackagesRepository/getTest', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store chapter/topic assignment.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function assignChapterTopic($data)
    {
        try {
            $test_assign = new TestChapterTopic();
            $test_assign->TestPackageTestID = $data['TestPackageTestID'];
            $test_assign->Weightage = $data['Weightage'];

            switch ($data['TestTypeID']) {
                case '1':
                    $test_assign->ChapterID = $data['TypeID'];
                    break;
                case '2':
                    $test_assign->TopicID = $data['TypeID'];
                    break;
                case '3':
                    $test_assign->UnitID = $data['TypeID'];
                    break;
            }

            $test_assign->save();
            return $test_assign;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/assignChapterTopic', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get assigned chapter topic list by test id.
     *
     * @param array $test_id
     * @return \Illuminate\Http\Response
     */
    public function getAssignedChapterTopic($test_id)
    {
        try {             
            return TestChapterTopic::where('TestPackageTestID', $test_id)->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/getAssignedChapterTopic', $e->getMessage()]);
            return false;
        }
    }

    /**
     * delete assigned chapter topic list by id.
     *
     * @param array $test_chapter_topic_id
     * @return \Illuminate\Http\Response
     */
    public function deleteAssignedChapterTopic($test_chapter_topic_id)
    {
        try {             
            return TestChapterTopic::where('TestChapterTopicID', $test_chapter_topic_id)->delete();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/getAssignedChapterTopic', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store section to test.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function addSection($data)
    {
        try {
            $section = TestSection::where('TestPackageTestID', $data['TestPackageTestID'])
                                    ->where('SectionName',$data['SectionName'])
                                    ->first();
            if (empty($section)) {
                $section = TestSection::create($data);
            }

            if ($section) {
                $data['TestSectionID'] = $section['TestSectionID'];
                TestSectionQuestionType::create($data);
                return $section;
            }
            return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('section store.',['TestPackagesRepository/addSection', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get section list by test id.
     *
     * @param array $test_id
     * @return \Illuminate\Http\Response
     */
    public function getSectionList($test_id)
    {
        try {             
            return TestSection::with(['questionTypes.questionType'])
                        ->has('questionTypes')
                        ->where('TestPackageTestID', $test_id)->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('section list.',['TestPackagesRepository/getSectionList', $e->getMessage()]);
            return false;
        }
    }

    /**
     * delete section and get section list by id.
     *
     * @param array $test_section_question_type_id
     * @return \Illuminate\Http\Response
     */
    public function deleteSection($test_section_question_type_id)
    {
        try {             
            return TestSectionQuestionType::find($test_section_question_type_id)->delete();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('delete section.',['TestPackagesRepository/deleteSection', $e->getMessage()]);
            return false;
        }
    }
}