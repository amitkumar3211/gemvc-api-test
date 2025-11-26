<?php

namespace App\Controller;

use App\Model\SalesModel;
use Gemvc\Core\Controller;
use Gemvc\Http\Request;
use Gemvc\Http\JsonResponse;

class SalesController extends Controller
{
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Create new Sales
     * 
     * @return JsonResponse
     */
    public function create(): JsonResponse
    {
        $model = $this->request->mapPostToObject(new SalesModel());
        if(!$model instanceof SalesModel) {
            return $this->request->returnResponse();
        }
        return $model->createModel();
    }

    /**
     * Get Sales by ID
     * 
     * @return JsonResponse
     */
    public function read(): JsonResponse
    {
        $model = $this->request->mapPostToObject(new SalesModel());
        if(!$model instanceof SalesModel) {
            return $this->request->returnResponse();
        }
        return $model->readModel();
    }

    /**
     * Update existing Sales
     * 
     * @return JsonResponse
     */
    public function update(): JsonResponse
    {
        $model = $this->request->mapPostToObject(new SalesModel());
        if(!$model instanceof SalesModel) {
            return $this->request->returnResponse();
        }
        return $model->updateModel();
    }

    /**
     * Delete Sales
     * 
     * @return JsonResponse
     */
    public function delete(): JsonResponse
    {
        $model = $this->request->mapPostToObject(new SalesModel());
        if(!$model) {
            return $this->request->returnResponse();
        }
        return $model->deleteModel();
    }

    /**
     * Get list of Saless with filtering and sorting
     * 
     * @return JsonResponse
     */
    public function list(): JsonResponse
    {
        $model = new SalesModel();
        return $this->createList($model);
    }
} 