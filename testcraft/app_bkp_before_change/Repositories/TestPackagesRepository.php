<?php

namespace App\Repositories;

use App\TestPackage;
use App\TestQuestionManual;
use App\TestPackageTest;
use App\TestChapterTopic;
use App\TestSubjectTopic;
use App\TestSection;
use App\Question;
use App\CourseSubjectTopic;
use App\TestSectionQuestionType;
use App\BoardStandardSubjectChapterTopic;
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
            return $package->OrderBy('TestPackageID', 'DESC')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package list.',['TestPackagesRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get package details by id.
     *
     * @return \Illuminate\Http\Response
     */
    public function getPackageDetail($id)
    {
        try {
            return TestPackage::find($id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get packaage detail.',['TestPackagesRepository/getPackageDetail', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Publish test.
     *
     * @return \Illuminate\Http\Response
     */
    public function testPublish($test_id)
    {
        try {
            $test = TestPackageTest::find($test_id);
            $test->StatusID = 9;
            $test->save();
            return $test;
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::channel('loginfo')
                ->error('get packaage detail.',['TestPackagesRepository/getPackageDetail', $e->getMessage()]);
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
            echo $e->getMessage();
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
    public function getTestPackageDetail($package_id)
    {
        try {
            return TestPackage::with(['board', 'standard', 'subject', 'course', 'tutor', 'tests'])
                        ->find($package_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package edit.',['TestPackagesRepository/getTestPackageDetail', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for test view by id.
     *
     * @param int $test_id
     * @return \Illuminate\Http\Response
     */
    public function getTestDetail($test_id)
    {
        try {
            return TestPackageTest::with(['testPackage', 'difficultyLevel'])
                        ->find($test_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test package edit.',['TestPackagesRepository/getTestDetail', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get total count of the remaining number of tests to create the package
     *
     * @param array $data
     * @return array $package_detail
     */
    public function getCountOfRemainNumberOfTest($test_package_id)
    {
        try {
            $test_package = TestPackage::select('NumberOfTest')->find($test_package_id);
            $total_tests = $test_package->NumberOfTest;
            $created_tests = TestPackageTest::where('TestPackageID', $test_package_id)
                                            ->where('IsActive', 1)
                                            ->count('TestPackageTestID');
/*            echo $total_tests;
            echo "--------";
            echo $created_tests;
            die;*/
            return $total_tests - $created_tests;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get total count of the remaining number of tests to create the package.',['TestPackagesRepository/getCountOfRemainNumberOfTest', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get question type count for test.
     *
     * @param int $test_id
     * @return \Illuminate\Http\Response
     */
    public function getCountOfRemainQuestionType($test_id)
    {
        try {
            /*echo "<pre>";
            echo "====";*/
            $data = TestPackageTest::with(['testPackage' => function($query) {
                                    $query->select('TestPackageID', 'IsCompetetive', 'NumberOfTest', 'QuestionFrom', 'IsAutoTestCreation', 'BoardID', 'StandardID', 'SubjectID', 'CourseID', 'TutorID', 'IsActive');
                                }])->select('TestPackageTestID', 'TestPackageID', 'DifficultyLevelID')
                                ->find($test_id);
            /*print_r($data->toArray());*/
            /*die;*/

            $test_sections = TestSection::with(['questionTypes'])
                                    ->where('TestPackageTestID', $test_id)
                                    ->get();
            $selected_ques = [];
            foreach ($test_sections as $key => $test_section) {
                foreach ($test_section['questionTypes'] as $key => $sec_que_type) {
                    if (array_key_exists($sec_que_type['QuestionTypeID'], $selected_ques)) {
                        $total = $selected_ques[$sec_que_type['QuestionTypeID']] + $sec_que_type['NumberofQuestion'];
                        $selected_ques[$sec_que_type['QuestionTypeID']] = $total;
                    } else {
                        $selected_ques[$sec_que_type['QuestionTypeID']] = $sec_que_type['NumberofQuestion'];
                    }
                }
            }
            /*echo "<pre>";
            echo "selected_ques";
            print_r($selected_ques);*/
            // die;

            if ($data['testPackage']['IsCompetetive'] == 0) {
                $ct_array = TestChapterTopic::where('TestPackageTestID', $test_id)
                                        ->select('ChapterID', 'TopicID')
                                        ->distinct()
                                        ->get();

                $chapters = $ct_array->unique('ChapterID')->pluck('ChapterID')->filter()->toArray();
                $topics = $ct_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();

                /*print_r($chapters->toArray());
                die;*/
                // $topics = TestChapterTopic::where('TestPackageTestID', $test_id)->get()->pluck('TopicID')->filter();
                //print_r($chapters->count());
                //print_r($topics->count());

                //print_r($data->testPackage);
                
                // $query = BoardStandardSubjectChapterTopic::where('BoardID', $data['testPackage']['BoardID'])
                //                     ->where('StandardID', $data['testPackage']['StandardID'])
                //                     ->where('SubjectID', $data['testPackage']['SubjectID']);
                // if (count($chapters) > 0) {
                //     //echo "chapters";
                //     $query = $query->whereIn('ChapterID', $chapters);
                // }

                // if (count($topics) > 0) {
                //     //echo "topics";
                //     $query = $query->orwhereIn('TopicID', $topics);
                // }

                // $bssctid = $query->select('BoardStandardSubjectChapterTopicID')
                //                 ->distinct('BoardStandardSubjectChapterTopicID')
                //                 ->get()
                //                 ->pluck('BoardStandardSubjectChapterTopicID');
                /*print_r($bssctid);
                die;*/
                //$bssctid = $bssctid['BoardStandardSubjectChapterTopicID'];
                //echo "--------++++-----";
                // print_r($bssctid);
                /*print_r($question_type_id);
                print_r(Auth::guard('tutor')->user()->TutorID);*/
                // die;
                $questions = Question::with(['questionType' => function($query) {
                                        $query->where('IsActive', 1);
                                    }])->whereHas('bssctQuestion.bssct', function($query) use ($data,$chapters, $topics) {
                                        $query->where('BoardID', $data['testPackage']['BoardID'])
                                            ->where('StandardID', $data['testPackage']['StandardID'])
                                            ->where('SubjectID', $data['testPackage']['SubjectID']);
                                        if (count($chapters) > 0) {
                                            $query = $query->whereIn('ChapterID', $chapters);
                                        }

                                        if (count($topics) > 0) {
                                            $query = $query->whereIn('TopicID', $topics);
                                        }
                                    })->whereHas('questionType', function($query) {
                                        $query->where('IsActive', 1);
                                    });
            } else {
                // $subjects = TestSubjectTopic::where('TestPackageTestID', $test_id)->get()->pluck('SubjectID')->filter();
                // $topics = TestSubjectTopic::where('TestPackageTestID', $test_id)->get()->pluck('TopicID')->filter();

                $st_array = TestSubjectTopic::where('TestPackageTestID', $test_id)
                        ->select('SubjectID', 'TopicID')
                        ->distinct()
                        ->get();

                /*echo "-----------<br>";
                print_r($st_array);
                die;*/

                $subjects = $st_array->unique('SubjectID')->pluck('SubjectID')->filter()->toArray();
                $topics = $st_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();


                // echo "-----------<br>";
                // echo "sub-".print_r($subjects);
                // print_r(count($subjects));
                // echo "-----div----";
                // echo "top-".print_r($topics);
                // print_r(count($topics));
                //die;
    /*            print_r($data->toArray());
                die;*/
                //print_r($data->testPackage);
                
                // $query = CourseSubjectTopic::where('CourseID', $data['testPackage']['CourseID']);
                // if (count($subjects) > 0) {
                //     //echo "chapters";
                //     $query = $query->whereIn('SubjectID', $subjects);
                // }

                // if (count($topics) > 0) {
                //     //echo "topics";
                //     $query = $query->orwhereIn('TopicID', $topics);
                // }

                // $cstid = $query->select('CourseSubjectTopicID')->distinct('CourseSubjectTopicID')->get()->pluck('CourseSubjectTopicID');
                //print_r($bssctid);
                // die;
                //$bssctid = $bssctid['BoardStandardSubjectChapterTopicID'];
                //echo "--------++++-----";
                // print_r($bssctid);
                /*print_r($question_type_id);
                print_r(Auth::guard('tutor')->user()->TutorID);*/
                // die;
                $questions = Question::with(['questionType' => function($query) {
                                            $query->where('IsActive', 1);
                                        }])->whereHas('cstQuestion.cst', function($query) use ($data, $subjects, $topics) {
                                            $query->where('CourseID', $data['testPackage']['CourseID']);
                                            if (count($subjects) > 0) {
                                                $query->whereIn('SubjectID', $subjects);
                                            }

                                            if (count($topics) > 0) {
                                                $query->whereIn('TopicID', $topics);
                                            }
                                        })->whereHas('questionType', function($query) {
                                            $query->where('IsActive', 1);
                                        });
            }

            

            if ($data['testPackage']['QuestionFrom'] == 2){
                $questions = $questions->where('TutorID', Auth::guard('tutor')->user()->TutorID);
            }

            if ($data['DifficultyLevelID']){
                $questions = $questions->where('DifficultyLevelID', $data['DifficultyLevelID']);
            }

            // if (!empty($selected_ques)) {
            //     $questions = $questions->whereNotIn('QuestionID', $selected_ques);
            // }

            $questions = $questions->where('IsActive', 1)
                                    ->where('QuestionImage', '!=' , null)
                                    ->select(DB::raw('count("QuestionTypeID") as total, QuestionTypeID'))
                                    ->groupBy('QuestionTypeID')
                                    /*->toSql();*/
                                    ->get();
                                    //->pluck('questionType.QuestionTypeName','QuestionTypeID');
                                    // ->pluck('total', 'QuestionTypeID')->toArray();
            //return $questions;

            

            /*print_r($questions);
            die;*/

            // echo "<pre>";
            // echo "()()()";
            // print_r($questions->toArray());
            //die;
            // $avail_ques = $questions->pluck('total', 'QuestionTypeID')->toArray();
            // $subtracted = array_map(function ($x, $y) { return $y-$x; } , $selected_ques, $avail_ques);
            // $result = array_combine(array_keys($avail_ques), $subtracted);

            if (!empty($selected_ques)) {
                // print_r($selected_ques);
                
                foreach ($questions as $key => $question) {
                    //echo "99";
                    if (isset($selected_ques[$question['QuestionTypeID']])) {
                        $question['total'] = $question['total'] - $selected_ques[$question['QuestionTypeID']];
                    }
                    //echo "000";
                }
            }

            /*print_r($questions->toArray());
            die;*/
            return $questions;
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::channel('loginfo')
                ->error('question list.',['QuestionRepository/getSectionQuestionList', $e->getMessage()]);
            return false;
        }
    }


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
            return TestPackageTest::where('TestPackageID', $package_id)->where('IsActive', 1)->get();
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
     * Delete test based on test id
     *
     * @param array $data
     * @return array $test
     */
    public function deleteTest($test_id)
    {
        try {
            $test = TestPackageTest::find($test_id);
            $test->IsActive = 0;
            $test->save();
            return $test;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete test based on test id.',['TestPackagesRepository/deleteTest', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get total count of the remaining number of weightages to assign ChapterTopic
     *
     * @param array $test_package_id
     * @param array $test_package_test_id
     * @return array $count
     */
    public function countWeightage($test_package_id, $test_package_test_id)
    {
        try {
            // $test_package = TestPackage::select('NumberOfTest')->find($test_package_id);
            // $total_tests = $test_package->NumberOfTest;
            // $data['Weightage']
            
            $test_package = TestPackage::find($test_package_id);
            if ($test_package->IsCompetetive == 1) {
                $assigned_chapterTopic = TestSubjectTopic::where('TestPackageTestID', $test_package_test_id)->sum('Weightage');                
            } else {
                $assigned_chapterTopic = TestChapterTopic::where('TestPackageTestID', $test_package_test_id)->sum('Weightage');
            }

            return 100 - $assigned_chapterTopic;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get total count of the remaining number of tests to create the package.',['TestPackagesRepository/getCountOfRemainNumberOfTest', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get total of the marks and question of section
     *
     * @param array $data
     * @return array $test_package_test_id
     */
    public function countMarkQuestion($test_package_test_id)
    {
        try {
            $test_sections = TestSection::with(['questionTypes'])
                        ->where('TestPackageTestID', $test_package_test_id)->get();
            //echo "<pre>";
            /*print_r($test_sections->toArray());
            die;*/

            foreach ($test_sections as $key => $test_section) {
                $test_section['TotalSecMarks'] = 0;
                $test_section['TotalSecQues'] = 0;
                foreach ($test_section['questionTypes'] as $key => $sec_que_type) {
                    $sec_que_type['TotalMarks'] = $sec_que_type['NumberofQuestion'] * $sec_que_type['QuestionMarks'];
                    $test_section['TotalSecMarks'] = $test_section['TotalSecMarks'] + $sec_que_type['TotalMarks'];
                    $test_section['TotalSecQues'] = $test_section['TotalSecQues'] + $sec_que_type['NumberofQuestion'];
                }
            }
            return $test_sections->toArray();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get total marks of test.',['TestPackagesRepository/countMark', $e->getMessage()]);
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
            return TestChapterTopic::with(['test'])->where('TestPackageTestID', $test_id)->get();
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
            return TestSection::with(['test','questionTypes.questionType', 'questionTypes.testQuestion.question'])
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

    /**
     * Store subject/topic assignment.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function assignSubjectTopic($data)
    {
        try {
            return TestSubjectTopic::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/assignSubjectTopic', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get assigned subject topic list by test id.
     *
     * @param array $test_id
     * @return \Illuminate\Http\Response
     */
    public function getAssignedSubjectTopic($test_id)
    {
        try {             
            return TestSubjectTopic::with(['test'])->where('TestPackageTestID', $test_id)->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/getAssignedSubjectTopic', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * delete assigned subject topic list by id.
     *
     * @param array $test_subject_topic_id
     * @return \Illuminate\Http\Response
     */
    public function deleteAssignedSubjectTopic($test_subject_topic_id)
    {
        try {             
            return TestSubjectTopic::where('TestSubjectTopicID', $test_subject_topic_id)->delete();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('test store.',['TestPackagesRepository/deleteAssignedSubjectTopic', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Chech all test published to publish test package.
     *
     * @param array $data
     * @param int $test_package_id
     * @return \Illuminate\Http\Response
     */
    public function checkToPublishTestPackage($test_package_id)
    {
        try {
            $test_package = TestPackage::select('NumberOfTest')->find($test_package_id);
            $total_tests = $test_package->NumberOfTest;

            $created_tests = TestPackageTest::where('TestPackageID', $test_package_id)
                                            ->where('IsActive', 1)
                                            ->where('StatusID', 9)// Published
                                            ->count('TestPackageTestID');

            return $total_tests - $created_tests;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Chech all test published to publish test package.',['TestPackagesRepository/checkToPublishTestPackage', $e->getMessage()]);
            return false;
        }
    }
}