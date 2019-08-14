<?php

namespace App\Repositories;

use Config;
use App\DifficultyLevel;

/**
 * Class BaseRepository.
 *
 * @package namespace App\Repositories;
 */
class BaseRepository
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
     * Single image upload for category/product primary.
     *
     * @param  Illuminate\Http\Request $request
     * @return array $data
     */
    public function imageUpload($request, $type)
    {   
        $data = array();
        if ($request->hasfile('photo')) {
            $file = $request->photo;

            $imageName = time().'.'.$request->photo->getClientOriginalExtension();

            switch ($type) {
                case 'course':
                    // Save original image
                    $original_path = Config::get('settings.COURSE_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;

                case 'board':
                    // Save original image
                    $original_path = Config::get('settings.BOARD_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;

                case 'subject':
                    // Save original image
                    $original_path = Config::get('settings.SUBJECT_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;

                case 'standard':
                    // Save original image
                    $original_path = Config::get('settings.STANDARD_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;

                case 'package':
                    // Save original image
                    $original_path = Config::get('settings.PACKAGE_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;

                case 'user':
                    // Save original image
                    $original_path = Config::get('settings.USER_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    break;
                
                default:
                    # code...
                    break;
            }

            $request->photo->move(public_path($original_path), $imageName);

            $data['image_name'] = $imageName;
            $data['original_name'] = $request->photo->getClientOriginalName();
        }
        return $data;
    }

    /**
     * Get difficulty level dropdown.
     *
     * @return array $data
     */
    public function getDifficultyLevelDropdown()
    {   
        return DifficultyLevel::pluck('DLName','DifficultyLevelID');
    }
}
