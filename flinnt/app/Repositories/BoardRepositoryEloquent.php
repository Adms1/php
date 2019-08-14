<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BoardRepository;
use App\Validators\BoardValidator;
use App\Entities\Board;
use Log;

/**
 * Class BoardRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BoardRepositoryEloquent extends BaseRepository implements BoardRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Board::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return BoardValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Delete board by Id
     *
     * @param int $board_id
     * @return array $board
     */
    public function deleteBoard($board_id)
    {
        try {
            return Board::where('board_id',$board_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete board by Id.',['BoardRepository/deleteBoard', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Get board list
     *
     * @param int $boards
     * @return array $boards
     */
    public function getBoardList()
    {
        return Board::where('is_active',1)->get();
    }
}
