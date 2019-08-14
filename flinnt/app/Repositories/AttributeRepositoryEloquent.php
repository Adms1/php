<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AttributeRepository;
use App\Validators\AttributeValidator;
use App\Entities\BookAttribute;
use App\Entities\Attribute;
use Log;

/**
 * Class AttributeRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AttributeRepositoryEloquent extends BaseRepository implements AttributeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Attribute::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return AttributeValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
 
    /**
     * Delete attribute by Id
     *
     * @param int $attribute_id
     * @return array $attributes
     */
    public function deleteAttribute($attribute_id)
    {
        try {
            return Attribute::where('attribute_id',$attribute_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete attribute by Id.',['AttributeRepository/deleteAttribute', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Add new attribute value of product based on product id
     *
     * @param array $data
     * @param int $product_id
     * @return array $book_attribute
     */
    public function addAttributeToProduct($data, $product_id)
    {
        try {
            $book_attribute = new BookAttribute;
            $book_attribute->book_id = $product_id;
            $book_attribute->attribute_id = $data['attribute_id'];
            $book_attribute->attribute_value = $data['attribute_val'];
            $book_attribute->save();
            return $book_attribute;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Add new attribute value of product based on product id.',['AttributeRepository/addAttributeToProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Update attribute value of product based on book product id
     *
     * @param array $data
     * @return array $book_attribute
     */
    public function updateAttributeValueOfProduct($data)
    {
        try {
            $book_attribute = BookAttribute::find($data['book_attribute_id']);
            $book_attribute->attribute_value = $data['attribute_value'];
            $book_attribute->save();
            return $book_attribute;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Update attribute value of product based on book product id.',['AttributeRepository/updateAttributeValueOfProduct', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete attribute of product based on book product id
     *
     * @param array $data
     * @return array $book_attribute
     */
    public function deleteAttributeOfProduct($data)
    {
        try {
            $book_attribute = BookAttribute::find($data['book_attribute_id'])->delete();
            return $book_attribute;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete attribute of product based on book product id.',['AttributeRepository/deleteAttributeOfProduct', $e->getMessage()]);
            return false;
        }
    }
}