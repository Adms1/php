<?php

namespace App\Repositories;

use App\QuestionType;
use Log;
use DB;

/**
 * Class QuestionTypeRepository.
 *
 * @package namespace App\Repositories;
 */
class QuestionTypeRepository
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
     * Get Question type list
     *
     * @return array $package_detail
     */
    public function getQuestionTypeList()
    {
        try {
            return QuestionType::where('IsActive', 1)->orderBy('QuestionTypeName', 'ASC')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('get question types.',['QuestionTypeRepository/getQuestionTypeList', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get question type dropdoown.
     *
     * @return array $data
     */
    public function getQuestionTypeDropdown()
    {   
        return QuestionType::where('IsActive', 1)->orderBy('QuestionTypeName', 'ASC')->get()->pluck('QuestionTypeName','QuestionTypeID');
    }
}