<?php

namespace App\Http\Controllers\V1\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Repositories\OrderRepository;
use App\Http\Requests;
use Config;
use Image;
use Auth;
use PDF;

/**
 * Class BaseController.
 *
 * @package namespace App\Http\Controllers\V1\Backend;
 */
class BaseController extends Controller
{
   
    /**
     * @var OrderRepository
     */
    protected $orderRepository; 

    /**
     * BaseController constructor.
     *
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * Single image upload for category/product primary.
     *
     * @param  Illuminate\Http\Request $request
     * @param int $id
     * @return array $data
     */
    public function imageUpload($request, $id)
    {   
        $data = array();
        if ($request->hasfile('photo')) {
            $file = $request->photo;

            $imageName = time().'.'.$request->photo->getClientOriginalExtension();

            // Save thumbnail image
            $thumbnail_path = Config::get('settings.THUMBNAIL_CATEGORY_IMG_PATH') . $id . '/';
            if (!is_dir($thumbnail_path)) {
                mkdir($thumbnail_path, 0777, true);
            }

            $img = Image::make($file->getRealPath())->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path() . '/' . $thumbnail_path . $imageName);

            // Save original image
            $original_path = Config::get('settings.ORIGINAL_CATEGORY_IMG_PATH') . $id . '/';
            if (!is_dir($original_path)) {
                mkdir($original_path, 0777, true);
            }
            $request->photo->move(public_path($original_path), $imageName);

            $data['category_image'] = $imageName;
            $data['original_name'] = $request->photo->getClientOriginalName();
        }

        if ($request->hasfile('primary_image')) {
            $file = $request->primary_image;

            $imageName = time().'.'.$request->primary_image->getClientOriginalExtension();

            // Save thumbnail image
            $thumbnail_path = Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $id . '/';
            if (!is_dir($thumbnail_path)) {
                mkdir($thumbnail_path, 0777, true);
            }

            $img = Image::make($file->getRealPath())->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path() . '/' . $thumbnail_path . $imageName);

            // Save original image
            $original_path = Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $id . '/';
            if (!is_dir($original_path)) {
                mkdir($original_path, 0777, true);
            }
            $request->primary_image->move(public_path($original_path), $imageName);

            $data['book_image_name'] = $imageName;
            $data['book_image_path'] = $id.'/'.$imageName;
        }

        if ($request->hasfile('institution_image')) {
            $file = $request->institution_image;

            $imageName = time().'.'.$request->institution_image->getClientOriginalExtension();

            // Save thumbnail image
            $thumbnail_path = Config::get('settings.THUMBNAIL_INSTITUTION_IMG_PATH') . $id . '/';
            if (!is_dir($thumbnail_path)) {
                mkdir($thumbnail_path, 0777, true);
            }

            $img = Image::make($file->getRealPath())->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path() . '/' . $thumbnail_path . $imageName);

            // Save original image
            $original_path = Config::get('settings.ORIGINAL_INSTITUTION_IMG_PATH') . $id . '/';
            if (!is_dir($original_path)) {
                mkdir($original_path, 0777, true);
            }
            $request->institution_image->move(public_path($original_path), $imageName);

            $data['institution_image'] = $imageName;
            $data['original_name'] = $request->institution_image->getClientOriginalName();
        }

        if ($request->hasfile('book_set_primary_image')) {
            $file = $request->book_set_primary_image;

            $imageName = time().'.'.$request->book_set_primary_image->getClientOriginalExtension();

            // Save thumbnail image
            $thumbnail_path = Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $id . '/';
            if (!is_dir($thumbnail_path)) {
                mkdir($thumbnail_path, 0777, true);
            }

            $img = Image::make($file->getRealPath())->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->save(public_path() . '/' . $thumbnail_path . $imageName);

            // Save original image
            $original_path = Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH') . $id . '/';
            if (!is_dir($original_path)) {
                mkdir($original_path, 0777, true);
            }
            $request->book_set_primary_image->move(public_path($original_path), $imageName);

            $data['book_set_image_name'] = $imageName;
            $data['book_set_image_path'] = $id.'/'.$imageName;
        }
        return $data;
    }

    /**
     * Upload image using fine upload.
     *
     * @param Illuminate\Http\Request $request
     * @param int $id
     * @param string $type
     * @return array $data
     */
    public function fineUpload($request, $id, $type = 'product')
    {   
        $data = array();
        if ($request->file('listing')) {
            $file = Input::file('listing');
            $fileId = $request->get('qquuid');

            // store original image
            $original_path = ($type == 'product') ? Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $id . '/' : Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH') . $id . '/';
            if (!is_dir($original_path)) {
                mkdir($original_path, 0777, true);
            }
            $original_full_path = $original_path . $fileId . ".jpg";
            $img = Image::make($file)->encode('jpg', 75);
            $img->save(public_path() . '/' . $original_full_path);

            // store thumbnail image
            $thumbnail_path = ($type == 'product') ? Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $id . '/' : Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $id . '/';
            if (!is_dir($thumbnail_path)) {
                mkdir($thumbnail_path, 0777, true);
            }
            $thumbnail_full_path = $thumbnail_path . $fileId . ".jpg";
            $thumbnail = Image::make($file)->encode('jpg', 75)->resize(150, 150, function ($constraint) {
                $constraint->aspectRatio();
            });
            $thumbnail->save(public_path() . '/' . $thumbnail_full_path);

            if ($type == 'product') {
                $data['book_image_name'] = $fileId . ".jpg";
                $data['book_image_path'] = $id .'/'. $fileId . ".jpg";
            } else {
                $data['book_set_image_name'] = $fileId . ".jpg";
                $data['book_set_image_path'] = $id .'/'. $fileId . ".jpg";
            }
        }
        return $data;
    }

    /**
     * Delete image by fine upload.
     *
     * @param int $id
     * @param int $uuid
     * @param string $type
     * @return array $data
     */
    public function fineDeleteImage($id, $uuid, $type = 'product')
    {   
        $data = array();
        //$user = Auth::user();
        //$folder_name = $user->id;
        $target = ($type == 'product') ? Config::get('settings.ORIGINAL_PRODUCT_IMG_PATH') . $id . '/' : Config::get('settings.ORIGINAL_BOOKSET_IMG_PATH') . $id . '/';
        $file = glob(public_path($target).$uuid.'.*');
        if (count($file) > 0) {
            \File::delete($file[0]);
        }

        $target = ($type == 'product') ? Config::get('settings.THUMBNAIL_PRODUCT_IMG_PATH') . $id . '/' : Config::get('settings.THUMBNAIL_BOOKSET_IMG_PATH') . $id . '/';
        $file = glob(public_path($target).$uuid.'.*');
        if (count($file) > 0) {
            \File::delete($file[0]);
        }
        return $data;
    }

    /**
     * Generate PDF view.
     *
     * @param int $order_number
     * @return \Illuminate\Http\Response
     */
    public function generatePDF($order_number)
    {
        $data = [];
        $pdf_data = $this->orderRepository->getOrderDetailsByOrderNumber($order_number);
        $pdf_data['in_word'] = $this->getIndianCurrency($pdf_data['order_total_price']);
        $data['pdf_data'] = $pdf_data;
        $pdf = PDF::loadView('front.partials.pdf', $data);
        return $pdf->download('invoice.pdf');
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
}
