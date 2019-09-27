<?php

namespace App\Repositories;

use App\Question;
use App\QuestionHint;
use App\TestQuestionManual;
use App\TestPackageTest;
use App\TestChapterTopic;
use App\TestSubjectTopic;
use App\CourseSubjectTopic;
use App\QuestionExplaination;
use App\IntegerQuestionAnswer;
use App\TrueFalseQuesionAnswer;
use App\TestSectionQuestionType;
use App\FillInBlankQuestionAnswer;
use App\CourseSubjectTopicQuestion;
use App\MultipleChoiceQuestionAnswer;
use Freshbitsweb\Laratables\Laratables;
use App\BoardStandardSubjectChapterTopic;
use App\BoardStandardSubjectChapterTopicQuestion;
use Auth;
use Log;
use DB;

/**
 * Class QuestionRepository.
 *
 * @package namespace App\Repositories;
 */
class QuestionRepository
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
            return Question::with(['questionType', 'difficultyLevel'])->where('TutorID', Auth::guard('tutor')->user()->TutorID)
                            ->orderBy('QuestionID', 'DESC')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('question list.',['QuestionRepository/list', $e->getMessage()]);
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
            // Store Question
            DB::beginTransaction();
            $question = Question::create($data);
            if ($question['QuestionID']) {
                $data['QuestionID'] = $question['QuestionID'];
                // Store Hint
                $hint = QuestionHint::create($data);
                // Store Explaination
                $explaination = QuestionExplaination::create($data);

                if ($data['DifficultyLevelID'] == 4) {
                    // Store relation between question and CST
                    $this->createRelationCSTQuestion($data);
                } else {
                    // Store relation between question and BSSCT
                    $this->createRelationBSSCTQuestion($data);
                }

                // Store answer&options by question type
                switch ($data['QuestionTypeID']) {
                    case '2':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;

                    case '4':
                        $this->storeTrueFalseQuestionAnswer($data);
                        break;

                    case '8':
                        $this->storeIntegerQuestionAnswer($data);
                        break;

                    default:
                        $this->storeMultipleChoiceQuestionAnswer($data);
                        break;
                }
            }

            DB::commit();
            return $question;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')
                ->error('question store.',['QuestionRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $question_id
     * @return \Illuminate\Http\Response
     */
    public function edit($question_id)
    {
        try {
            return Question::with(['hint' => function ($query) {
                            $query->select('QuestionID', 'QuestionHintID', 'HintText');
                        }, 'explaination' => function ($query) {
                            $query->select('QuestionID', 'QuestionExplainationID', 'ExplainationText');
                        }, 'questionType' => function ($query) {
                            $query->select('QuestionTypeID', 'QuestionTypeName');
                        }, 'bssctQuestion' => function ($query) {
                            $query->select('TopicQuestionID', 'BSSCTopicID', 'QuestionID');
                            $query->with(['bssct' => function ($query) {
                                $query->select('BoardStandardSubjectChapterTopicID', 'BoardID', 'StandardID', 'SubjectID', 'ChapterID', 'TopicID');
                            }]);
                        }, 'cstQuestion' => function ($query) {
                            $query->select('CourseSubjectTopicQuestionID', 'CourseSubjectTopicID','QuestionID');
                            $query->with(['cst' => function ($query) {
                                $query->select('CourseSubjectTopicID', 'CourseID', 'SubjectID', 'TopicID');
                            }]);
                        }])->select('QuestionID', 'QuestionText', 'QuestionTypeID', 'Marks', 'DifficultyLevelID', 'TutorID', 'IsActive')
                        ->find($question_id);
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::channel('loginfo')
                ->error('question edit.',['QuestionRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by question_id.
     *
     * @param array $data
     * @param int $question_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $question_id)
    {
        try {
            // Update Question
            DB::beginTransaction();
            $question = Question::find($question_id);
            $question->fill($data);
            $question->save();
            if ($question['QuestionID']) {
                $data['QuestionID'] = $question['QuestionID'];

                // Update Hint
                $hint = QuestionHint::where('QuestionID', $question_id)->first();
                $hint->fill($data);
                $hint->save();
                
                // Update Explaination
                $explaination = QuestionExplaination::where('QuestionID', $question_id)->first();
                $explaination->fill($data);
                $explaination->save();

                if ($data['DifficultyLevelID'] == 4) {
                    // Update relation between question and CST
                    $this->updateRelationCSTQuestion($data, $question_id);
                } else {
                    // Update relation between question and BSSCT
                    $this->updateRelationBSSCTQuestion($data, $question_id);
                }

                // Store answer&options by question type
                switch ($data['QuestionTypeID']) {
                    case '2':
                        $this->updateFillInBlankQuestionAnswer($data);
                        break;

                    case '4':
                        $this->updateTrueFalseQuestionAnswer($data);
                        break;

                    case '8':
                        $this->updateIntegerQuestionAnswer($data);
                        break;

                    default:
                        $this->updateMultipleChoiceQuestionAnswer($data);
                        break;
                }
            }
            DB::commit();
            return $question;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('question update.',['QuestionRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get question dropdoown.
     *
     * @return array $data
     */
    public function getQuestionDropdown()
    {   
        return Question::where('IsActive', 1)->pluck('QuestionName','QuestionID');
    }

    /**
     * Store relation between question and BSSCT.
     *
     * @param array $data
     * @return array $data
     */
    public function createRelationBSSCTQuestion($data)
    {   
        try {
                $bssctid = BoardStandardSubjectChapterTopic::where('BoardID', $data['BoardID'])
                                ->where('StandardID', $data['StandardID'])
                                ->where('SubjectID', $data['SubjectID'])
                                ->where('ChapterID', $data['ChapterID'])
                                ->where('TopicID', $data['TopicID'])
                                ->select('BoardStandardSubjectChapterTopicID')
                                ->first();
                if ($bssctid) {
                    $data['BSSCTopicID'] = $bssctid['BoardStandardSubjectChapterTopicID'];
                    return $bssct_question = BoardStandardSubjectChapterTopicQuestion::create($data);
                }
                return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create fill in blank options & answer.',['QuestionRepository/storeFillInBlankQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update relation between question and BSSCT.
     *
     * @param array $data
     * @return array $data
     */
    public function updateRelationBSSCTQuestion($data, $question_id)
    {   
        try {
                $bssctid = BoardStandardSubjectChapterTopic::where('BoardID', $data['BoardID'])
                                ->where('StandardID', $data['StandardID'])
                                ->where('SubjectID', $data['SubjectID'])
                                ->where('ChapterID', $data['ChapterID'])
                                ->where('TopicID', $data['TopicID'])
                                ->select('BoardStandardSubjectChapterTopicID')
                                ->first();
                if ($bssctid) {
                    $data['BSSCTopicID'] = $bssctid['BoardStandardSubjectChapterTopicID'];

                    $bssct_question = BoardStandardSubjectChapterTopicQuestion::where('QuestionID', $question_id)->first();
                    $bssct_question->fill($data);
                    $bssct_question->save();
                    return $bssct_question;
                }
                return false;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update fill in blank options & answer.',['QuestionRepository/updateRelationBSSCTQuestion', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store relation between question and CST.
     *
     * @param array $data
     * @return array $data
     */
    public function createRelationCSTQuestion($data)
    {   
        try {
                $cstid = CourseSubjectTopic::where('CourseID', $data['CourseID'])
                                ->where('SubjectID', $data['SubjectID'])
                                ->where('TopicID', $data['TopicID'])
                                ->select('CourseSubjectTopicID')
                                ->first();
                if ($cstid) {
                    //echo "----------";
                    $data['CourseSubjectTopicID'] = $cstid['CourseSubjectTopicID'];
                    return $cst_question = CourseSubjectTopicQuestion::create($data);
                }
                return false;
        } catch (\Exception $e) {
            //print_r($e->getMessage());
            Log::channel('loginfo')
                ->error('Create relation between question and CST.',['QuestionRepository/createRelationCSTQuestion', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update relation between question and CST.
     *
     * @param array $data
     * @return array $data
     */
    public function updateRelationCSTQuestion($data, $question_id)
    {   
        try {
                $cstid = CourseSubjectTopic::where('CourseID', $data['CourseID'])
                                ->where('SubjectID', $data['SubjectID'])
                                ->where('TopicID', $data['TopicID'])
                                ->select('CourseSubjectTopicID')
                                ->first();

                if ($cstid) {
                    $data['CourseSubjectTopicID'] = $cstid['CourseSubjectTopicID'];
                    $cst_question = CourseSubjectTopicQuestion::where('QuestionID', $question_id)->first();
                    $cst_question->fill($data);
                    $cst_question->save();
                    return $cst_question;
                }
                return false;
        } catch (\Exception $e) {
            echo $e->getMessage();
            Log::channel('loginfo')
                ->error('Update fill in blank options & answer.',['QuestionRepository/updateRelationBSSCTQuestion', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store fill in blank options & answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function storeFillInBlankQuestionAnswer($data)
    {   
        try {
            $answer = new FillInBlankQuestionAnswer();
            $answer->FIBText = $data['OptionText'][0];
            $answer->FIBQuestionID = $data['QuestionID'];
            $answer->save();
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create fill in blank options & answer.',['QuestionRepository/storeFillInBlankQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update fill in blank options & answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function updateFillInBlankQuestionAnswer($data)
    {   
        try {
            $answer = FillInBlankQuestionAnswer::where('FIBQuestionID', $data['QuestionID'])->first();
            if ($answer) {
                $answer->FIBText = $data['OptionText'][0];
                $answer->FIBQuestionID = $data['QuestionID'];
                $answer->save();
            } else {
                $this->storeFillInBlankQuestionAnswer($data);
            }
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update fill in blank options & answer.',['QuestionRepository/updateFillInBlankQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store true/false answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function storeTrueFalseQuestionAnswer($data)
    {   
        try {
            $answer = new TrueFalseQuesionAnswer();
            $answer->IsTrue = $data['IsTrue'];
            $answer->TorFQuestionID = $data['QuestionID'];
            $answer->save();
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create fill in blank options & answer.',['QuestionRepository/storeFillInBlankQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update true/false answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function updateTrueFalseQuestionAnswer($data)
    {   
        try {
            $answer = TrueFalseQuesionAnswer::where('TorFQuestionID', $data['QuestionID'])->first();
            if ($answer) {
                $answer->IsTrue = $data['IsTrue'];
                $answer->TorFQuestionID = $data['QuestionID'];
                $answer->save();
            } else {
                $this->storeTrueFalseQuestionAnswer($data);
            }
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update fill in blank options & answer.',['QuestionRepository/updateTrueFalseQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store integer type answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function storeIntegerQuestionAnswer($data)
    {   
        try {
            $answer = new IntegerQuestionAnswer();
            $answer->INTQuestionID = $data['QuestionID'];
            $answer->INTText = $data['MinValue'].','.$data['MaxValue'];
            $answer->MinValue = $data['MinValue'];
            $answer->MaxValue = $data['MaxValue'];
            $answer->save();
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create integer type answer.',['QuestionRepository/storeIntegerQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update integer type answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function updateIntegerQuestionAnswer($data)
    {   
        try {
            $answer = IntegerQuestionAnswer::where('INTQuestionID', $data['QuestionID'])->first();
            if ($answer) {
                $answer->INTText = $data['MinValue'].','.$data['MaxValue'];
                $answer->MinValue = $data['MinValue'];
                $answer->MaxValue = $data['MaxValue'];
                $answer->save();
            } else {
                $this->storeIntegerQuestionAnswer($data);
            }
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update integer type answer.',['QuestionRepository/updateIntegerQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }


    /**
     * Store MCQ/MCQ2 options & answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function storeMultipleChoiceQuestionAnswer($data)
    {   
        try {
            foreach ($data['OptionText'] as $key => $option) {
                $answer = new MultipleChoiceQuestionAnswer();
                $answer->MCQAText = $option;
                $answer->MCQAQuestionID = $data['QuestionID'];
                $answer->IsCorrectAnswer = (in_array(++$key, $data['OptionValue'])) ? '1': '0';
                $answer->save();                
            }
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Create MCQ/MCQ2 options & answer.',['QuestionRepository/storeMultipleChoiceQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update MCQ/MCQ2 options & answer for question.
     *
     * @param array $data
     * @return array $data
     */
    public function updateMultipleChoiceQuestionAnswer($data)
    {   
        try {
            // delete all option by question id than create new
            MultipleChoiceQuestionAnswer::where('MCQAQuestionID', $data['QuestionID'])->delete();
            $answer = $this->storeMultipleChoiceQuestionAnswer($data);
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update MCQ/MCQ2 options & answer.',['QuestionRepository/updateMultipleChoiceQuestionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get Option/Answer for QuestionID
     *
     * @param int $QuestionID
     * @param int $QuestionTypeID
     * @return array $data
     */
    public function getQuestionOptionAnswer($QuestionID, $QuestionTypeID)
    {   
        try {
            switch ($QuestionTypeID) {
                case '2':
                    $answer = $this->getFillInBlankQuestionOptionAnswer($QuestionID);
                    break;

                case '4':
                    $answer = $this->getTrueFalseQuestionOptionAnswer($QuestionID);
                    break;

                case '8':
                    $answer = $this->getIntegerQuestionOptionAnswer($QuestionID);
                    break;
                
                default:
                    $answer = $this->getMultipleChoiceQuestionOptionAnswer($QuestionID);
                    break;
            }
            return $answer;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Get options & answer.',['QuestionRepository/getQuestionOptionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get answer of fill in blank by question id
     *
     * @param int $QuestionID
     * @return array $data
     */
    public function getFillInBlankQuestionOptionAnswer($QuestionID)
    {   
        try {
            return FillInBlankQuestionAnswer::where('FIBQuestionID', $QuestionID)->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get fill in blank options & answer.',['QuestionRepository/getFillInBlankQuestionOptionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get answer of true/false by question id
     *
     * @param int $QuestionID
     * @return array $data
     */
    public function getTrueFalseQuestionOptionAnswer($QuestionID)
    {   
        try {
            return TrueFalseQuesionAnswer::where('TorFQuestionID', $QuestionID)->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get true/false options & answer.',['QuestionRepository/getTrueFalseQuestionOptionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get answer of integer type by question id
     *
     * @param int $QuestionID
     * @return array $data
     */
    public function getIntegerQuestionOptionAnswer($QuestionID)
    {   
        try {
            return IntegerQuestionAnswer::where('INTQuestionID', $QuestionID)->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get integer type options & answer.',['QuestionRepository/getIntegerQuestionOptionAnswer', $e->getMessage()]);
            return false;
        }
    }

   /**
     * Get answer of true/false by question id
     *
     * @param int $QuestionID
     * @return array $data
     */
    public function getMultipleChoiceQuestionOptionAnswer($QuestionID)
    {   
        try {
            return MultipleChoiceQuestionAnswer::where('MCQAQuestionID', $QuestionID)->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get multiple choice options & answer.',['QuestionRepository/getMultipleChoiceQuestionOptionAnswer', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get section based question list.
     *
     * @param int $question_type_id
     * @param int $test_id
     * @param array $selected_ques
     * @return \Illuminate\Http\Response
     */
    public function getSectionQuestionList($question_type_id, $test_id, $selected_ques)
    {
        try {
            $data = TestPackageTest::with(['testPackage' => function($query) {
                                    $query->select('TestPackageID', 'IsCompetetive', 'NumberOfTest', 'QuestionFrom', 'IsAutoTestCreation', 'BoardID', 'StandardID', 'SubjectID', 'CourseID', 'TutorID', 'IsActive');
                                }])->select('TestPackageTestID', 'TestPackageID')
                                ->find($test_id);

            if ($data['testPackage']['IsCompetetive'] == 0) {
                $ct_array = TestChapterTopic::where('TestPackageTestID', $test_id)
                                        ->select('ChapterID', 'TopicID')
                                        ->distinct()
                                        ->get();

                $chapters = $ct_array->unique('ChapterID')->pluck('ChapterID')->filter()->toArray();
                $topics = $ct_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();

                $questions = Question::whereHas('bssctQuestion.bssct', function($query) use ($data,$chapters, $topics) {
                                        $query->where('BoardID', $data['testPackage']['BoardID'])
                                            ->where('StandardID', $data['testPackage']['StandardID'])
                                            ->where('SubjectID', $data['testPackage']['SubjectID']);
                                        if (count($chapters) > 0) {
                                            $query = $query->whereIn('ChapterID', $chapters);
                                        }

                                        if (count($topics) > 0) {
                                            $query = $query->whereIn('TopicID', $topics);
                                        }
                                    });
            } else {
                $st_array = TestSubjectTopic::where('TestPackageTestID', $test_id)
                        ->select('SubjectID', 'TopicID')
                        ->distinct()
                        ->get();

                $subjects = $st_array->unique('SubjectID')->pluck('SubjectID')->filter()->toArray();
                $topics = $st_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();

                $questions = Question::whereHas('cstQuestion.cst', function($query) use ($data, $subjects, $topics) {
                                        $query->where('CourseID', $data['testPackage']['CourseID']);
                                        if (count($subjects) > 0) {
                                            $query = $query->whereIn('SubjectID', $subjects);
                                        }

                                        if (count($topics) > 0) {
                                            $query = $query->whereIn('TopicID', $topics);
                                        }
                                    });
            }

            if ($data['testPackage']['QuestionFrom'] == 2){
                $questions = $questions->where('TutorID', Auth::guard('tutor')->user()->TutorID);
            }

            if ($data['DifficultyLevelID']){
                $questions = $questions->where('DifficultyLevelID', $data['DifficultyLevelID']);
            }

            if (!empty($selected_ques)) {
                $questions = $questions->whereNotIn('QuestionID', $selected_ques);
            }

            $questions = $questions->where('IsActive', 1)
                                    ->where('QuestionImage', '!=' , null)
                                    ->where('QuestionTypeID', $question_type_id)->get();
            return $questions;

        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('question list.',['QuestionRepository/getSectionQuestionList', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store questions to section related test.
     *
     * @param array $data
     * @return array $data
     */
    public function addSelectedQuestion($data)
    {   
        try {
            foreach ($data['QuestionID'] as $key => $que) {
                $question = new TestQuestionManual();
                $question->TestSectionQuestionTypeID = $data['TestSectionQuestionTypeID'];
                $question->TestPackageTestID = $data['TestPackageTestID'];
                $question->QuestionID = $que;
                $question->save();
            }
            return $question;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Store question to related section.',['QuestionRepository/addSelectedQuestion', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store questions to section related test.
     *
     * @param int $question_type_id
     * @param int $test_id
     * @return array $data
     */
    public function getSelectedSectionQuestionList($question_type_id, $test_id)
    {   
        try {
            return TestQuestionManual::where('TestSectionQuestionTypeID', $question_type_id)
                                ->where('TestPackageTestID', $test_id)
                                ->select('QuestionID')
                                ->get()->pluck('QuestionID');
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Store question to related section.',['QuestionRepository/getSelectedSectionQuestionList', $e->getMessage()]);
            return false;
        }
    }

    /**
     * delete selected questions from section related test.
     *
     * @param int $question_type_id
     * @return array $data
     */
    public function deleteSelectedQuestion($test_question_id)
    {   
        try {
            return TestQuestionManual::find($test_question_id)->delete();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('delete question to related section.',['QuestionRepository/deleteSelectedQuestion', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Get Section information
     *
     * @param int $question_type_id
     * @param int $test_id
     * @return array $data
     */
    public function getSectionInfo($question_type_id)
    {   
        try {
            return TestSectionQuestionType::with(['section' => function($query) {
                                    $query->select('TestSectionID', 'SectionName');
                                }, 'questionType' => function($query) {
                                    $query->select('QuestionTypeID', 'QuestionTypeName');
                                }])
                                ->where('TestSectionQuestionTypeID', $question_type_id)
                                ->first();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Store question to related section.',['QuestionRepository/getSectionInfo', $e->getMessage()]);
            return false;
        }
    }

    /**
     * return data of the simple datatables.
     *
     * @param int $question_type_id
     * @param int $test_id
     * @param array $selected_ques
     */
    public function getDatatablesData($question_type_id, $test_id, $selected_ques)
    {
        try {
            $data = TestPackageTest::with(['testPackage' => function($query) {
                                    $query->select('TestPackageID', 'IsCompetetive', 'NumberOfTest', 'QuestionFrom', 'IsAutoTestCreation', 'BoardID', 'StandardID', 'SubjectID', 'CourseID', 'TutorID', 'IsActive');
                                }])->select('TestPackageTestID', 'TestPackageID', 'DifficultyLevelID')
                                ->find($test_id);

            if ($data['testPackage']['IsCompetetive'] == 0) {
                $ct_array = TestChapterTopic::where('TestPackageTestID', $test_id)
                                        ->select('ChapterID', 'TopicID')
                                        ->distinct()
                                        ->get();

                $chapters = $ct_array->unique('ChapterID')->pluck('ChapterID')->filter()->toArray();
                $topics = $ct_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();

                return Laratables::recordsOf(Question::class, function($query) use ($data, $chapters, $topics, $question_type_id, $selected_ques) {
                        $query = $query->whereHas('bssctQuestion.bssct', function($query) use ($data,$chapters, $topics, $question_type_id, $selected_ques) {
                                $query->where('BoardID', $data['testPackage']['BoardID'])
                                    ->where('StandardID', $data['testPackage']['StandardID'])
                                    ->where('SubjectID', $data['testPackage']['SubjectID']);
                                if (count($chapters) > 0) {
                                    $query = $query->whereIn('ChapterID', $chapters);
                                }

                                if (count($topics) > 0) {
                                    $query = $query->whereIn('TopicID', $topics);
                                }
                            });

                            if ($data['testPackage']['QuestionFrom'] == 2){
                                $query = $query->where('TutorID', Auth::guard('tutor')->user()->TutorID);
                            }

                            if ($data['DifficultyLevelID']){
                                $query = $query->where('DifficultyLevelID', $data['DifficultyLevelID']);
                            }

                            if (!empty($selected_ques)) {
                                $query = $query->whereNotIn('QuestionID', $selected_ques);
                            }

                            return $query->where('QuestionTypeID', $question_type_id);
                        });
            } else {
                $st_array = TestSubjectTopic::where('TestPackageTestID', $test_id)
                        ->select('SubjectID', 'TopicID')
                        ->distinct()
                        ->get();

                $subjects = $st_array->unique('SubjectID')->pluck('SubjectID')->filter()->toArray();
                $topics = $st_array->unique('TopicID')->pluck('TopicID')->filter()->toArray();

                return Laratables::recordsOf(Question::class, function($query) use ($data, $subjects, $topics, $question_type_id, $selected_ques) {
                        $query = $query->whereHas('cstQuestion.cst', function($query) use ($data,$subjects, $topics, $question_type_id, $selected_ques) {
                                $query->where('CourseID', $data['testPackage']['CourseID']);
                                if (count($subjects) > 0) {
                                    $query = $query->whereIn('SubjectID', $subjects);
                                }

                                if (count($topics) > 0) {
                                    $query = $query->whereIn('TopicID', $topics);
                                }
                            });

                            if ($data['testPackage']['QuestionFrom'] == 2){
                                $query = $query->where('TutorID', Auth::guard('tutor')->user()->TutorID);
                            }

                            if ($data['DifficultyLevelID']){
                                $query = $query->where('DifficultyLevelID', $data['DifficultyLevelID']);
                            }

                            if (!empty($selected_ques)) {
                                $query = $query->whereNotIn('QuestionID', $selected_ques);
                            }

                            return $query->where('QuestionTypeID', $question_type_id);
                        });
            }
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('question list.',['QuestionRepository/getSectionQuestionList', $e->getMessage()]);
            return false;
        }
    }
}