<?php

namespace App\Repositories;

use App\User;
use Log;
use DB;

/**
 * Class UserRepository.
 *
 * @package namespace App\Repositories;
 */
class UserRepository
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
     * @param int $data
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        try {
            return User::with('userType')->get();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user list.',['UserRepository/list', $e->getMessage()]);
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
            $user = User::create($data);
            return $user;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user store.',['UserRepository/store', $e->getMessage()]);
            return false;
        }
    }

    /**
     * get user data resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            return User::find($id);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user store.',['UserRepository/edit', $e->getMessage()]);
            return false;
        }
    }

    /**
     * update resource.
     *
     * @param array $data
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        try {
            $user_type = User::find($id);
            $user_type->fill($data);
            $user_type->save();
            return $user_type;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('user update.',['UserRepository/update', $e->getMessage()]);
            return false;
        }
    }
}