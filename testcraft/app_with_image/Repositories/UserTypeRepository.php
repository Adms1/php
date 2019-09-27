<?php

namespace App\Repositories;

use App\UserType;
use Log;
use DB;

/**
 * Class UserTypeRepository.
 *
 * @package namespace App\Repositories;
 */
class UserTypeRepository
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
            return UserType::get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user type list.',['UserTypeRepository/list', $e->getMessage()]);
            return false;
        }
    }

    /**
     * store resource.
     *
     * @param array $data
     * @return \Illuminate\Http\Response
     */
    public function store($data)
    {
        try {
            $user_type = new UserType();
            $user_type->fill($data);
            $user_type->save();
            return $user_type;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user type store.',['UserTypeRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * store resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return UserType::find($id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user type store.',['UserTypeRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * store resource.
     *
     * @param array $data
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        try {
            $user_type = UserType::find($id);
            $user_type->fill($data);
            $user_type->save();
            return $user_type;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user type store.',['UserTypeRepository/store', $e->getMessage()]);
            return false;
        }
    }
}