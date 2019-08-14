<?php

namespace App\Repositories;

use App\Question;
use App\QuestionHint;
use App\TestQuestion;
use App\TestPackageTest;
use App\TestChapterTopic;
use App\QuestionExplaination;
use App\TrueFalseQuesionAnswer;
use App\FillInBlankQuestionAnswer;
use App\MultipleChoiceQuestionAnswer;
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
            return Question::where('TutorID', Auth::guard('tutor')->user()->TutorID)->limit('10')->get();
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
                // Store relation between question and BSSCT
                $this->createRelationBSSCTQuestion($data);

                // Store answer&options by question type
                switch ($data['QuestionTypeID']) {
                    /*case '1':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;*/

                    case '2':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;

                    case '4':
                        $this->storeTrueFalseQuestionAnswer($data);
                        break;

                    /*case '7':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;*/

                    default:
                        $this->storeMultipleChoiceQuestionAnswer($data);
                        break;
                }
            }
            /*print_r($question);
            die;*/
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
                        }, 'bssctQuestion' => function ($query) {
                            $query->select('TopicQuestionID', 'BSSCTopicID', 'QuestionID');
                            $query->with(['bssct' => function ($query) {
                                $query->select('BoardStandardSubjectChapterTopicID', 'BoardID', 'StandardID', 'SubjectID', 'ChapterID', 'TopicID');
                            }]);
                        }])->select('QuestionID', 'QuestionText', 'QuestionTypeID', 'Marks', 'DifficultyLevelID', 'TutorID')
                        ->find($question_id);
        } catch (\Exception $e) {
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
/*            echo "<pre>";
            print_r($data);
            echo "--------------";
            echo $question_id;
            die;*/
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

                // Update relation between question and BSSCT
                $this->updateRelationBSSCTQuestion($data);

                // Store answer&options by question type
                switch ($data['QuestionTypeID']) {
                    /*case '1':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;*/

                    case '2':
                        $this->updateFillInBlankQuestionAnswer($data);
                        break;

                    case '4':
                        $this->updateTrueFalseQuestionAnswer($data);
                        break;

                    /*case '7':
                        $this->storeFillInBlankQuestionAnswer($data);
                        break;*/

                    default:
                        $this->updateMultipleChoiceQuestionAnswer($data);
                        break;
                }
            }
            /*print_r($question);
            die;*/
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
        return Question::pluck('QuestionName','QuestionID');
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
    public function updateRelationBSSCTQuestion($data)
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

            /*$option1 = new MultipleChoiceQuestionAnswer();
            $option1->MCQAText = $data['OptionText1'];
            $option1->MCQAQuestionID = $data['QuestionID'];
            $option1->IsCorrectAnswer = ($data['OptionValue'] == '1') ? '1': '0';
            $option1->save();

            $option2 = new MultipleChoiceQuestionAnswer();
            $option2->MCQAText = $data['OptionText2'];
            $option2->MCQAQuestionID = $data['QuestionID'];
            $option2->IsCorrectAnswer = ($data['OptionValue'] == '2') ? '1': '0';
            $option2->save();

            $option3 = new MultipleChoiceQuestionAnswer();
            $option3->MCQAText = $data['OptionText3'];
            $option3->MCQAQuestionID = $data['QuestionID'];
            $option3->IsCorrectAnswer = ($data['OptionValue'] == '3') ? '1': '0';
            $option3->save();

            $option4 = new MultipleChoiceQuestionAnswer();
            $option4->MCQAText = $data['OptionText4'];
            $option4->MCQAQuestionID = $data['QuestionID'];
            $option4->IsCorrectAnswer = ($data['OptionValue'] == '4') ? '1': '0';
            $option4->save();*/

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
     * @return \Illuminate\Http\Response
     */
    public function getSectionQuestionList($question_type_id, $test_id)
    {
        try {
            //echo "<pre>";

            $chapters = TestChapterTopic::where('TestPackageTestID', $test_id)->get()->pluck('ChapterID')->filter();
            $topics = TestChapterTopic::where('TestPackageTestID', $test_id)->get()->pluck('TopicID')->filter();
            //print_r($chapters->count());
            //print_r($topics->count());

            $data = TestPackageTest::with(['testPackage'])->select('TestPackageTestID', 'TestPackageID')->find($test_id);
            //print_r($data->toArray());
            //print_r($data->testPackage);
            
            $query = BoardStandardSubjectChapterTopic::where('BoardID', $data['testPackage']['BoardID'])
                                ->where('StandardID', $data['testPackage']['StandardID'])
                                ->where('SubjectID', $data['testPackage']['SubjectID']);
            if (count($chapters) > 0) {
                //echo "chapters";
                $query = $query->whereIn('ChapterID', $chapters);
            }

            if (count($topics) > 0) {
                //echo "topics";
                $query = $query->whereIn('TopicID', $topics);
            }

            $bssctid = $query->select('BoardStandardSubjectChapterTopicID')->first();
            $bssctid = $bssctid['BoardStandardSubjectChapterTopicID'];
            // echo "-------------";
            // print_r($bssctid);
            // print_r($question_type_id);
            // print_r(Auth::guard('tutor')->user()->TutorID);
            //die;
            return Question::with(['bssctQuestion' => function($query) use ($bssctid) {
                                $query->where('BSSCTopicID', $bssctid);
                            }])
                            ->where('QuestionTypeID', $question_type_id)
                            ->where('TutorID', Auth::guard('tutor')->user()->TutorID)
                            ->get();
            /*echo "()()()";
            print_r($e);
            die;*/
            //return $e;
        } catch (\Exception $e) {
            echo $e->getMessage();
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
    public function addQuestion($data)
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
}