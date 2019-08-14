<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LanguageRepository;
use App\Validators\LanguageValidator;
use App\Entities\Language;
use Log;

/**
 * Class LanguageRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class LanguageRepositoryEloquent extends BaseRepository implements LanguageRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Language::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return LanguageValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
 
    /**
     * Delete language by Id
     *
     * @param int $language_id
     * @return array $languages
     */
    public function deleteLanguage($language_id)
    {
        try {
            return Language::where('language_id',$language_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete language by Id.',['LanguageRepository/deleteLanguage', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get language by language_ids
     *
     * @param int $language_ids
     * @return array $languages
     */
    public function getLanguagesBasedOnProducts($language_ids)
    {
        return Language::whereIn('language_id',$language_ids)->pluck('language_name','language_id');
    }

    /**
     * Get language list
     *
     * @return array $languages
     */
    public function getLanguageList()
    {
        return Language::where('is_active',1)->get();
    }
}
