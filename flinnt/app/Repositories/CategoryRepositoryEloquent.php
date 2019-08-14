<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\CategoryRepository;
use App\Entities\Category;
use App\Entities\ParentCategoryBrg;
use App\Validators\CategoryValidator;
use Config;
use Log;
use DB;

/**
 * Class CategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class CategoryRepositoryEloquent extends BaseRepository implements CategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Category::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return CategoryValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Re-Set checkbox values
     *
     * @param string $value
     * @return string $int_value
     */
    public function setCheckboxValue($value)
    {
        $int_value = ($value == 'on')  ? 1 : 0;
        return $int_value;
    }

    /**
     * Insert new category
     *
     * @param array $data
     * @return array $category
     */
    public function createCategory($data)
    {
        try {
            DB::beginTransaction();
            $category = new Category();
            $category->fill($data);
            $category->save();
            if ($category->category_id) {
                foreach ($data['par_cat_id'] as $key => $cat_id) {
                    if ($cat_id != 0) {
                        $bridge_data = $this->getBridgeDataById($cat_id);
                        $cat_id = $bridge_data->child_category_id;
                    }
                    $category_brg = new ParentCategoryBrg();
                    $category_brg->child_category_id = $category->category_id;
                    $category_brg->parent_category_id = $cat_id;
                    $category_brg->save();
                }
            }
            DB::commit();
            return $category;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('Insert new category.',['CategoryRepository/createCategory', $e->getMessage()]);
            return false;
        }
    }

    public function getBridgeDataById($bridge_id){
        //return ParentCategoryBrg::find($bridge_id);
        $categories = DB::table('category_tree')
                ->join('category', 'category.category_id', '=', 'category_tree.child_category_id')
                ->select('category_tree.category_tree_id', 'category_tree.child_category_id', 'category_tree.parent_category_id', 'category.category_name', 'category_image', 'is_active')
                ->where('category_tree_id', $bridge_id)
                ->first();
        return $categories;
    }

    public function getBridgeDataByCategoryId($category_id){
        $categories = DB::table('category_tree')
                ->join('category', 'category.category_id', '=', 'category_tree.child_category_id')
                ->select('category_tree.category_tree_id', 'category_tree.child_category_id', 'category_tree.parent_category_id', 'category.category_name', 'category_image', 'is_active')
                ->where('category_tree.child_category_id', $category_id)
                ->first();
        return $categories;
    }

    public function getCategoryList(){
        try {
            DB::beginTransaction();
            $data = array();
            $categories = $this->getCategoryDropdownList($is_dropdown = 0);
            foreach ($categories as $key => $category) {
                $bridge_info = $this->getBridgeDataById($key);
                $bridge_data = new \stdClass();
                $bridge_data->bridge_id = $key;
                $bridge_data->category_name = $category;
                $bridge_data->is_active = $bridge_info->is_active;
                $bridge_data->category_image = Config::get('settings.THUMBNAIL_CATEGORY_IMG_PATH') . $bridge_info->child_category_id . '/' .$bridge_info->category_image;
                $bridge_data->category_id = $bridge_info->child_category_id;
                $data[] = $bridge_data;
            }
            DB::commit();
            return $data;
        } catch (\Exception $e) {
            DB::rollback();
            Log::channel('loginfo')->error('getCategoryList.',['CategoryRepository/getCategoryList', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get category list
     *
     * @return array $categories
     */
    public function getCategoryDropdownList($is_dropdown = 1)
    {
        //$category = Category::with(['childrenCategory'])->get()->toArray();
        //echo "<pre>";
        //$categories = Category::get()->toArray();
        //$categories = ParentCategoryBrg::where('parent_category_id', 0)->get();
        //$categories = ParentCategoryBrg::select('child_category_id', 'parent_category_id')->get()->toArray();

        $categories = $this->getSubcategory($parentId = 0, $is_dropdown);

        //$category = ParentCategoryBrg::with(['childCategory'])->get()->toArray();
        $data = array();
        //$data = $this->childrenCategories($categories);

        //$data = $this->buildTree($categories);
        $data = $this->buildCategoryTree($is_dropdown, $categories);
        // foreach ($categories as $key => $category) {
        //     $category_data = Category::find($category['category_id']);
        //     $parent['id'] = $category['category_id'];
        //     $parent['name'] = $category_data['category_name'];
        //     $data[] = $parent;
        //     $children = ParentCategoryBrg::where('parent_category_id', $category['category_id'])->get();
        //     if (count($children) > 0) {
        //         foreach ($children as $key => $child) {
        //             $child_data = Category::find($child['category_id']);
        //             $parent['id'] = $child['category_id'];
        //             $parent['name'] = "-".$child_data['category_name'];
        //             $data[] = $parent;
        //         }
        //     }
        // }

        //$data = $this->formatTree($data);
        /*echo "<pre>";
        print_r($data);
        die;*/
/*        $category->fill($data);
        $category->save();
        if ($category->category_id) {
            foreach ($data['par_cat_id'] as $key => $cat_id) {
                $category_brg = new ParentCategoryBrg();
                $category_brg->category_id = $category->category_id;
                $category_brg->parent_category_id = $cat_id;
                $category_brg->save();
            }
        }*/
        /*echo "<pre>";
        print_r($category);
        die;*/
        return $data;
    }

    // public function childrenCategories($categories) {
    //     foreach ($categories as $key => $category) {
    //         $category_data = Category::find($category['category_id']);
    //         $parent['id'] = $category['category_id'];
    //         $parent['name'] = $category_data['category_name'];
    //         $data[] = $parent;
    //         $children = ParentCategoryBrg::where('parent_category_id', $category['category_id'])->get();

    //         if (count($children) > 0) {
    //             $data[] = $this->childrenCategories($children);
    //         }
    //     }
    //     return $data;
    // }

    // public function buildTree(array $elements, $parentId = 0) {
    //     $branch = array();

    //     foreach ($elements as $element) {
    //         if ($element['parent_category_id'] == $parentId) {
    //             $children = $this->buildTree($elements, $element['category_id']);
    //             if ($children) {
    //                 $element['children'] = $children;
    //             }
    //             $branch[] = $element;
    //         }
    //     }

    //     return $branch;
    // }


    // public function single_array($arr){
    //     foreach($arr as $key){
    //         if(is_array($key)){
    //             $arr1=$this->single_array($key);
    //             foreach($arr1 as $k){
    //                 $new_arr[]=$k;
    //             }
    //         }
    //         else{
    //             $new_arr[]=$key;
    //         }
    //     }
    //     return $new_arr;
    // }


    // function formatTree($tree, $parent = 0, $tree2 = array(), $nested = ''){
    //     /*echo "<pre>";
    //     echo $parent;*/
    //     foreach($tree as $i => $item){
    //         if (is_array($item)) {
    //             if ($item['parent_category_id'] == $parent) {
    //                 /*if ($parent != 0) {
    //                     $nested = ' - ';
    //                 }*/
    //                 $tree2[] = $item['category_id'];
    //                 //$tree2[] = $nested.$item['category_name'];
    //                 /*echo ">";
    //                 print_r($tree2);*/
    //                 if (isset($item['children'])) {
    //                     //$nested = ' - '. $nested;
    //                     /*print_r($item['children']);*/
    //                     $newtree = $this->formatTree($item['children'], $item['category_id'], $tree2, $nested);
    //                     foreach ($newtree as $key => $value) {
    //                         if (!in_array($value, $tree2)) 
    //                         $tree2[] = $value;
    //                     }
    //                 }
    //             }
    //         }
    //     }
    //     return $tree2;
    // }


    public function buildCategoryTree($is_dropdown, $categories, $parentId = 0, $tree2 = array()){
        foreach ($categories as $category) {
            $parent_cat_name = $this->getCategoryNameById($category['parent_category_id']);
            if ($parentId != 0) {
                $tree2[$category['category_tree_id']] = $parent_cat_name. ">>" .$category['category_name'];
            } else {
                $tree2[$category['category_tree_id']] = $category['category_name'];
            }
            // Get Child Categories
            $subcategories = $this->getSubcategory($category['child_category_id'], $is_dropdown);
            if(count($subcategories) > 0) {
                $tree2 = $this->buildCategoryTree($is_dropdown, $subcategories, $category['child_category_id'], $tree2);
            }
        }
        return $tree2;
    }

    public function getSubcategory($parentId, $is_dropdown = 1){
        $categories = DB::table('category_tree')
                        ->join('category', 'category.category_id', '=', 'category_tree.child_category_id')
                        ->select('category_tree.category_tree_id', 'category_tree.child_category_id', 'category_tree.parent_category_id', 'category.category_name')
                        ->where('parent_category_id', $parentId);
        if ($is_dropdown == 1) {
            $categories = $categories->where('category.is_active', 1);
        }
        $categories = $categories->get();
        return $categories = json_decode(json_encode($categories), true);
    }

    public function getCategoryNameById($category_id){
        $parent_name = [];
        $category = $this->getCategoryDetailById($category_id);

        if ($category) {
            array_unshift($parent_name, $category->category_name);
            if ($category->parent_category_id != 0) {
                $category_name = $this->getCategoryNameById($category->parent_category_id);
                array_unshift($parent_name, $category_name);
            }
        }

        if (is_array($parent_name)){
            $parent_name = implode(">>", $parent_name);
        }
        return $parent_name;
    }

    public function getCategoryDetailById($category_id) {
        return DB::table('category')
                ->join('category_tree', 'category_tree.child_category_id', '=', 'category.category_id')
                ->select('category_tree.category_tree_id', 'category.category_id', 'category_tree.parent_category_id', 'category.category_name')
                ->where('category.category_id', $category_id)
                ->first();
    }

    /**
     * Update category
     *
     * @param array $data
     * @param int $category_id
     * @return array $category
     */
    public function updateCategory($data, $category_id)
    {
        try {
            $category = Category::find($category_id);
            $category->fill($data);
            $category->save();
            return $category;
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Update category.',['CategoryRepository/updateCategory', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Delete category by Bridge Id
     *
     * @param int $bridge_id
     */
    public function deleteCategory($category_id)
    {
        try {
            return Category::where('category_id',$category_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Delete category by Bridge Id.',['CategoryRepository/deleteCategory', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Active/Inactive Category
     *
     * @param  int $category_id
     * @param  int $status
     */
    public function changeCategoryStatus($category_id, $status)
    {
        try {
            return Category::where('category_id',$category_id)->update(['is_active' => $status]);
        } catch (\Exception $e) {
            Log::channel('loginfo')->error('Active/Inactive Category.',['CategoryRepository/changeCategoryStatus', $e->getMessage()]);
            return false;
        }
    }
}
