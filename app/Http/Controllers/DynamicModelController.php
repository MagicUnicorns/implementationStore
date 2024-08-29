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
        //what models else?
    }
    /**
     * Display a listing of the resource.
     */
    public function index($modelName)
    {
        $modelClass = "App\\Models\\" . ucfirst($modelName);

        if (class_exists($modelClass) && is_subclass_of($modelClass, 'Illuminate\Database\Eloquent\Model')){
            $modelInstance = resolve($modelClass);

            $data = $modelInstance->all();

            $columns = Schema::getColumnListing($modelInstance->getTable());
            $visibleColumns = array_diff($columns, $modelInstance->getHidden());

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
}
