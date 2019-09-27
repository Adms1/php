<?php

namespace App\Repositories;

use Config;
use App\DifficultyLevel;
use Illuminate\Support\Facades\Input;
use Image;

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
                    // path original image
                    $original_path = Config::get('settings.COURSE_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.COURSE_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'board':
                    // path original image
                    $original_path = Config::get('settings.BOARD_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.BOARD_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'subject':
                    // path original image
                    $original_path = Config::get('settings.SUBJECT_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.SUBJECT_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'standard':
                    // path original image
                    $original_path = Config::get('settings.STANDARD_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.STANDARD_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'package':
                    // path original image
                    $original_path = Config::get('settings.PACKAGE_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.PACKAGE_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'user':
                    // path original image
                    $original_path = Config::get('settings.USER_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.USER_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;

                case 'tutor':
                    // path original image
                    $original_path = Config::get('settings.TUTOR_IMG_PATH') . '/';
                    if (!is_dir($original_path)) {
                        mkdir($original_path, 0777, true);
                    }
                    // image path for testcraft.in
                    $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.TUTOR_IMG_PATH') . '/';
                    if (!is_dir($front_path)) {
                        mkdir($front_path, 0777, true);
                    }
                    break;
                
                default:
                    # code...
                    break;
            }

            // Save image for testcraft.in
            /*$img = Image::make($file->getRealPath());
            $img->save($front_path . $imageName);*/

            // Save Thumbnail Image in testcraft.in
            $thumb_img = Image::make($file->getRealPath())->resize(225, 300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumb_img->save(public_path($original_path) . $imageName);
            $thumb_img->save($front_path . $imageName);

            // Save original image
            $request->photo->move(public_path($original_path), $imageName);

            $data['image_name'] = $imageName;
            $data['original_name'] = $request->photo->getClientOriginalName();
        }
        return $data;
    }

    /**
     * Convert Number to Words in Indian currency format with paise value 
     *
     * @param float $number
     * @return float $rupees
     */
    function getIndianCurrency(float $number)
    {
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'one', 2 => 'two',
            3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
            7 => 'seven', 8 => 'eight', 9 => 'nine',
            10 => 'ten', 11 => 'eleven', 12 => 'twelve',
            13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
            16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
            19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
            40 => 'forty', 50 => 'fifty', 60 => 'sixty',
            70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
        $digits = array('', 'hundred','thousand','lakh', 'crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
    }

    /**
     * Get difficulty level dropdown.
     *
     * @return array $data
     */
    public function getDifficultyLevelDropdown()
    {   
        return DifficultyLevel::where('IsActive', 1)->pluck('DLName','DifficultyLevelID');
    }

    /**
     * Get difficulty level dropdown by question type.
     *
     * @int $is_competetive
     * @return array $data
     */
    public function getDifficultyByAjax($is_competetive)
    {   
        if ($is_competetive == 0) {
            return DifficultyLevel::where('IsActive', 1)
                            ->where('DifficultyLevelID', '!=', 4)
                            ->pluck('DLName','DifficultyLevelID');
        } else {
            return DifficultyLevel::where('IsActive', 1)
                            ->where('DifficultyLevelID', '=', 4)
                            ->pluck('DLName','DifficultyLevelID');
        }
    }

    /**
     * Upload CKEditor images
     *
     * @param  Illuminate\Http\Request $request
     * @return string $data
     */
    public function uploadCKEditorImage($request)
    {   
        $CKEditor = $request->input('CKEditor');
        $funcNum  = $request->input('CKEditorFuncNum');
        $message  = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');
            if ($file->isValid()) {
                $filename =rand(1000,9999).$file->getClientOriginalName();
                $original_path = Config::get('settings.CKEDITOR_IMG_PATH') . '/';
                if (!is_dir($original_path)) {
                    mkdir($original_path, 0777, true);
                }

                // image path for testcraft.in
                $front_path = Config::get('settings.IMAGE_URL') . '/' . Config::get('settings.CKEDITOR_IMG_PATH') . '/';
                if (!is_dir($front_path)) {
                    mkdir($front_path, 0777, true);
                }
                // Save image for testcraft.in
                $img = Image::make($file->getRealPath());
                $img->save($front_path . $filename);

                // Save image in backend public path
                $file->move(public_path($original_path), $filename);
                $url = Config::get('settings.CKEDITOR_IMAGE_URL') . Config::get('settings.CKEDITOR_IMG_PATH') . '/' .  $filename;
            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
