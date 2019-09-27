<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Question extends Model
{
    protected $table = 'Question';
    protected $primaryKey = 'QuestionID';
    public $timestamps = false;

    /**
     * The attributes default value.
     *
     * @var array
     */
    protected $attributes = [
        'IsActive' => '1',
        'IsTranslated' => '0',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'QuestionID',
        'QuestionText',
        'QuestionTypeID',
        'Marks',
        'DifficultyLevelID',
        'QuestionImage',
        'TutorID',
        'IsTranslated',
        'IsActive',
        'CreateDate'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'CreateDate' => 'datetime',
        'Marks' => 'decimal:2',
    ];

    /**
     * Set to null if empty
     * @param $input
     */
    public function setTutorIDAttribute()
    {
        $this->attributes['TutorID'] = Auth::guard('tutor')->user()->TutorID;
    }

    /**
     * Question has one QuestionHint model
     */
    public function hint()
    {
        return $this->hasone(QuestionHint::class, 'QuestionID');
    }

    /**
     * Question has one QuestionExplaination model
     */
    public function explaination()
    {
        return $this->hasone(QuestionExplaination::class, 'QuestionID');
    }

    /**
     * Question belongs to BoardStandardSubjectChapterTopicQuestion model
     */
    public function bssctQuestion()
    {
        return $this->hasone(BoardStandardSubjectChapterTopicQuestion::class, 'QuestionID');
    }

    /**
     * Question belongs to CourseSubjectTopicQuestion model
     */
    public function cstQuestion()
    {
        return $this->hasone(CourseSubjectTopicQuestion::class, 'QuestionID');
    }

    /**
     * Question belongs to QuestionType model
     */
    public function questionType()
    {
        return $this->belongsTo(QuestionType::class, 'QuestionTypeID');
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomAction($question)
    {
        return view('partials.question_checkbox_action', compact('question'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomImage($question)
    {
        return view('partials.question_image_action', compact('question'))->render();
    }

    /**
     * Returns the action column html for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomView($question)
    {
        return view('partials.question_view_action', compact('question'))->render();
    }

    /**
     * Returns the name column value for datatables.
     *
     * @param \App\User
     * @return string
     */
    /*public static function laratablesCustomQuestionText($question)
    {
        return $question->QuestionText;
    }*/

    /**
     * Returns the name column value for datatables.
     *
     * @param \App\User
     * @return string
     */
    public static function laratablesCustomQuestionTypeID($question)
    {
        return $question->QuestionTypeID;
    }

    /**
     * Additional columns to be loaded for datatables.
     *
     * @return array
     */
    public static function laratablesAdditionalColumns()
    {
        return ['QuestionTypeID', 'QuestionImage', 'QuestionText'];
    }

    /**
     * title column should be used for sorting when name column is selected in Datatables.
     *
     * @return string
     */
    // public static function laratablesOrderCasinoID()
    // {
    //     return 'mCasinoName';
    // }

    /**
     * Adds the condition for searching the name of the user in the query.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @param string search term
     * @param \Illuminate\Database\Eloquent\Builder
     */
    /*public static function laratablesSearchName($query, $searchValue)
    {
        return $query->orWhere('mCasinoName', 'like', '%'. $searchValue. '%')
            ->orWhere('mCasinoID', 'like', '%'. $searchValue. '%')
        ;
    }*/

    /**
     * Returns string status from boolean status for the datatables.
     *
     * @return string
     */
    // public function laratablesIsActive()
    // {
    //     return $this->IsActive ? 'Active' : 'Inactive';
    // }

    /**
     * Specify row class name for datatables.
     *
     * @return string
     */
    // public function laratablesRowClass()
    // {
    //     return $this->IsActive ? 'text-success' : 'text-danger';
    // }

    /**
     * Returns the data attribute for row id of the user.
     *
     * @return array
     */
    // public function laratablesRowData()
    // {
    //     return [
    //         'id' => $this->QuestionID,
    //     ];
    // }

    /**
     * Fetch only active users in the datatables.
     *
     * @param \Illuminate\Database\Eloquent\Builder
     * @return \Illuminate\Database\Eloquent\Builder
     */
    // public static function laratablesQueryConditions($query)
    // {
    //     return $query->where('active', true);
    // }

    /**
     * Set user full name on the collection.
     *
     * @param \Illuminate\Support\Collection
     * @return \Illuminate\Support\Collection
     */
    // public static function laratablesModifyCollection($casino)
    // {
    //     //echo "<pre>";
    //     foreach ($casino as $key => $casino_data) {
    //         //print_r($casino_data);
    //         $casino_data['mCasinoConfig'] = json_decode($casino_data['mCasinoConfig']);
    //     }
    //     //print_r($casino);
    //     return $casino->map(function ($casino) {
    //         $casino->mCasinoChips = (isset($casino->mCasinoConfig->mCasinoChips)) ? $casino->mCasinoConfig->mCasinoChips : '';
    //         $casino->mOwnerName = (isset($casino->mCasinoConfig->mOwnerName)) ? $casino->mCasinoConfig->mOwnerName : '';
    //         //echo "-----------------------";
    //         //print_r($casino);
    //         //echo "====================";
    //         //foreach ($casino as $key => $casino_data) {
    //             //print_r($casino_data);

    //             //$casino_data['mCasinoConfig'] = json_decode($casino_data['mCasinoConfig']);
    //         //}
    //         //print_r($casino);
            
    //         return $casino;
    //     });
    // }

    /**
     * Eager load media items of the role for displaying in the datatables.
     *
     * @return callable
     */
    // public static function laratablesRoleRelationQuery()
    // {
    //     return function ($query) {
    //         $query->with('media');
    //     };
    // }
}