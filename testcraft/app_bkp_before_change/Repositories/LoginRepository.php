<?php

namespace App\Repositories;

use App\User;
use Log;
use DB;

/**
 * Class LoginRepository.
 *
 * @package namespace App\Repositories;
 */
class LoginRepository
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
     * Do Login.
     *
     * @param int $data
     * @return \Illuminate\Http\Response
     */
    // public function doLogin($data)
    // {
    //     try {
    //         return DB::select('exec SP_Get_Student_Login ?, ?', 
    //                     array(
    //                         $data['email'],
    //                         $data['password']
    //                     )
    //                 );
    //     } catch (\Exception $e) {
    //         Log::channel('loginfo')
    //             ->error('login process.',['LoginRepository/doLogin', $e->getMessage()]);
    //         return false;
    //     }
    // }    

}
