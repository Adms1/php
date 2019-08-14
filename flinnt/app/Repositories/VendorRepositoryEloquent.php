<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\VendorRepository;
use App\Validators\VendorValidator;
use App\Entities\InstitutionVendor;
use App\Entities\RoleVendor;
use App\Entities\Vendor;
use Auth;
use Log;
use DB;

/**
 * Class VendorRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class VendorRepositoryEloquent extends BaseRepository implements VendorRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Vendor::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {
        return VendorValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Delete vendor by vendor Id
     *
     * @param int $vendor_id
     * @return array $vendor
     */
    public function deleteVendor($vendor_id)
    {
        try {
            return vendor::where('vendor_id',$vendor_id)->update(['is_active' => 0]);
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Delete vendor by vendor Id.',['VendorRepository/deleteVendor', $e->getMessage()]);
            return false;
        }
    }
    
    /**
     * Add vendor role.
     *
     * @param array $data
     * @return array $vendor_role
     */
    public function addVendorRole($data)
    {
        try {
            $vendor_role =  new RoleVendor();
            $vendor_role->role_id = 2;
            $vendor_role->vendor_id = $data->vendor_id;
            return $vendor_role->save();
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Add vendor role.',['VendorRepository/addVendorRole', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Store selected vendors for login institution
     *
     * @param array $vendor_ids
     * @return array $institution_vendor
     */
    public function storeSelectedVendor($vendor_ids)
    {
        try {
            $institution_id = Auth::guard('institution')->user()->institution_id;

            // Delete old selected vendors
            InstitutionVendor::where('institution_id', $institution_id)->delete();
            foreach ($vendor_ids as $key => $vendor_id) {
                // Store selected vendors
                $institution_vendor = new InstitutionVendor();
                $institution_vendor->institution_id = $institution_id;
                $institution_vendor->vendor_id = $vendor_id;
                $institution_vendor->save();
            }
            return $institution_vendor;
        } catch (\Exception $e) {
            Log::channel('loginfo')
                ->error('Store selected vendors for login institution.',['VendorRepository/storeSelectedVendor', $e->getMessage()]);
            return false;
        }
    }

    /**
     * Get vendor list
     *
     * @return array $vendors
     */
    public function getVendorList()
    {
        return Vendor::with(['country' => function ($query) { 
                            $query->select('country_id','sortname');
                            return $query;
                        }, 'state'  => function ($query) { 
                            $query->select('state_id','name');
                            return $query;
                        }, 'status'  => function ($query) { 
                            $query->select('status_id','status_name');
                            return $query;
                        }])->where('vendor.is_active', 1)
                        ->get(['vendor_id','vendor_country_id','vendor_state_id', 'vendor_status_id', 'vendor_name', 'email', 'vendor_phone', 'vendor_city', 'vendor_gst_number']);

        /*return DB::table('vendor')
                ->join('country', 'vendor.vendor_country_id', '=', 'country.country_id')
                ->join('state', 'vendor.vendor_state_id', '=', 'state.state_id')
                ->join('status', 'vendor.vendor_status_id', '=', 'status.status_id')
                ->where('vendor.is_active', 1)
                ->get();*/
    }

    /**
     * Get vendors which are approved by flinnt admin
     *
     * @return array $approved_vendor
     */
    public function getApprovedVendorList()
    {
        return Vendor::with(['country' => function ($query) { 
                            $query->select('country_id','sortname');
                            return $query;
                        }, 'state'  => function ($query) { 
                            $query->select('state_id','name');
                            return $query;
                        }, 'status'  => function ($query) { 
                            $query->select('status_id','status_name');
                            return $query;
                        }])->where('vendor.is_active', 1)
                        ->where('vendor.vendor_status_id', 1)
                        ->get(['vendor_id','vendor_country_id','vendor_state_id', 'vendor_status_id', 'vendor_name', 'email', 'vendor_phone', 'vendor_city', 'vendor_gst_number']);


        /*return DB::table('vendor')
                ->join('country', 'vendor.vendor_country_id', '=', 'country.country_id')
                ->join('state', 'vendor.vendor_state_id', '=', 'state.state_id')
                ->join('status', 'vendor.vendor_status_id', '=', 'status.status_id')
                ->where('vendor.is_active', 1)
                ->where('vendor.vendor_status_id', 1)
                ->get();*/
    }

    /**
     * Get vendor details by vendor id
     *
     * @param int $vendor_id
     * @return array $vendor
     */
    public function getVendorByID($vendor_id)
    {
        return Vendor::with(['country' => function ($query) { 
                            $query->select('country_id','sortname', 'name');
                            return $query;
                        }, 'state'  => function ($query) { 
                            $query->select('state_id','state.name as state_name');
                            return $query;
                        }, 'status'  => function ($query) { 
                            $query->select('status_id','status_name');
                            return $query;
                        }])->where('vendor.vendor_id', $vendor_id)
                        ->first(['vendor_id', 'vendor_country_id', 'vendor_state_id', 'vendor_status_id', 'vendor_address1', 'vendor_address2', 'vendor_name', 'email', 'vendor_phone', 'vendor_pin', 'vendor_city', 'vendor_gst_number']);

        // return DB::table('vendor')
        //         ->join('country', 'vendor.vendor_country_id', '=', 'country.country_id')
        //         ->join('state', 'vendor.vendor_state_id', '=', 'state.state_id')
        //         ->join('status', 'vendor.vendor_status_id', '=', 'status.status_id')
        //         ->select('*', 'state.name as state_name', 'country.name as country_name' )
        //         ->where('vendor.vendor_id', $vendor_id)
        //         ->first();
    }

    /**
     * Get selected vendors based on login institution id
     *
     * @return array $selected_vendors
     */
    public function getSelectedVendorsByInstitution()
    {
        $institution_id = Auth::guard('institution')->user()->institution_id;
        return InstitutionVendor::where('institution_id', $institution_id)->pluck('vendor_id')->toArray();
    }

    
}