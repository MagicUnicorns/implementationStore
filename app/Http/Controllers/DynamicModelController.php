<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class DynamicModelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permission:create-customer|edit-customer|delete-customer', ['only' => ['index']]);
        $this->middleware('permission:create-patient|edit-patient|delete-patient', ['only' => ['index']]);
        $this->middleware('permission:create-patient-visit|edit-patient-visit|delete-patient-visit', ['only' => ['index']]);
        $this->middleware('permission:create-invoice|edit-invoice|delete-invoice', ['only' => ['index']]);
        //what models else?
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, $modelName)
    {
        $modelClass = "App\\Models\\" . ucfirst($modelName);

        error_log($request->query('customer_id', null));
        $modelInstance = resolve($modelClass);

        if ( $modelName === "patient"){
            error_log($modelName);


            $visibleColumns = $this->getVisibleColumns($modelClass);
            $customerId = $request->query('customer_id', null);

            if($customerId){

                $data = $modelInstance->where('customer_id', $customerId)->get();
            }
            else {

                $data = $modelInstance->all();
            }



            return response()->json([
                'tableColumns' => $visibleColumns,
                'tableData' => $data,
            ]);

        }
        else if (class_exists($modelClass) && is_subclass_of($modelClass, 'Illuminate\Database\Eloquent\Model')){
            $visibleColumns = $this->getVisibleColumns($modelClass);

            $modelInstance = resolve($modelClass);
            $data = $modelInstance->all();

            return response()->json([
                'tableColumns' => $visibleColumns,
                'tableData' => $data,
            ]);
            // return response()->json($data);
        }
        else {
            return response()->json()(['error' => 'Model not found or is not valid']);
        }
    }

    private function getVisibleColumns($model){
        $modelInstance = resolve($model);



        $columns = Schema::getColumnListing($modelInstance->getTable());
        return array_diff($columns, $modelInstance->getHidden());

    }
}
