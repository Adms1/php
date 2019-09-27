<?php

namespace App\Repositories;

use App\Board;
use App\BoardStandardSubjectChapterTopic;
use Log;
use DB;

/**
 * Class BoardRepository.
 *
 * @package namespace App\Repositories;
 */
class BoardRepository
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
            return Board::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board list.',['BoardRepository/list', $e->getMessage()]);
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
            return Board::create($data);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board store.',['BoardRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get resource for edit view by id.
     *
     * @param int $board_id
     * @return \Illuminate\Http\Response
     */
    public function edit($board_id)
    {
        try {
            return Board::find($board_id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board edit.',['BoardRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update resource by board_id.
     *
     * @param array $data
     * @param int $board_id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $board_id)
    {
        try {
            $board = Board::find($board_id);
            $board->fill($data);
            $board->save();
            return $board;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('board update.',['BoardRepository/update', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get board dropdoown.
     *
     * @return array $data
     */
    public function getBoardDropdown()
    {   
        return Board::where('IsActive', 1)->pluck('BoardName','BoardID');
    }

    /**
     * Get board dropdoown.
     *
     * @return array $data
     */
    public function getBSSCTBasedBoardDropdown()
    {   
        return BoardStandardSubjectChapterTopic::leftJoin('Board', 'Board.BoardID', 'BoardStandardSubjectChapterTopic.BoardID')
                    ->where('BoardStandardSubjectChapterTopic.IsActive', 1)
                    ->distinct('BoardName', 'BoardStandardSubjectChapterTopic.BoardID')
                    ->orderBy('BoardName', 'ASC')
                    ->get()
                    ->pluck('BoardName','BoardID');
    }
}