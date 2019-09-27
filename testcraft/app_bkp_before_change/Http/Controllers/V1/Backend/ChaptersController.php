<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ChapterRepository;
use Config;
use Lang;

class ChaptersController extends Controller
{
    /**
     * @var ChapterRepository
     */
    protected $chapterRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ChapterRepository $chapterRepository)
    {
        $this->chapterRepository = $chapterRepository;
    }

    /**
     * Chapter Dropdown list by ajax call based on board_id, standard_id, subject_id.
     *
     * @return \Illuminate\Http\Response
     */
    public function chapter_ajaxget(Request $request)
    {
        $board_id = $request->board_id;
        $standard_id = $request->standard_id;
        $subject_id = $request->subject_id;

        $chapters = $this->chapterRepository->getChapterDropdown($board_id, $standard_id, $subject_id);

        return response()->json([
            'success' => true,
            'data'  => $chapters,
        ]);
    }
}
