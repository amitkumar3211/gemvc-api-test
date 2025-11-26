<?php
/**
 * this is model layer. what so called Data logic layer
 * classes in this layer shall be extended from relevant classes in Table layer
 * classes in this layer  will be called from controller layer
 */
namespace App\Model;

use App\Table\SalesTable;
use Gemvc\Http\JsonResponse;
use Gemvc\Http\Response;

class SalesModel extends SalesTable
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Create new Sales
     * 
     * @return JsonResponse
     */
    public function createModel(): JsonResponse
    {
        $success = $this->insertSingleQuery();
        if ($this->getError()) {
            return Response::internalError("Failed to create Sales: " . $this->getError());
        }
        return Response::created($success, 1, "Sales created successfully");
    }

    /**
     * Get Sales by ID
     * 
     * @return JsonResponse
     */
    public function readModel(): JsonResponse
    {
        $item = $this->selectById($this->id);
        if (!$item) {
            return Response::notFound("Sales not found");
        }
        return Response::success($item, 1, "Sales retrieved successfully");
    }

    /**
     * Update existing Sales
     * 
     * @return JsonResponse
     */
    public function updateModel(): JsonResponse
    {
        $item = $this->selectById($this->id);
        if (!$item) {
            return Response::notFound("Sales not found");
        }
        $success = $this->updateSingleQuery();
        if ($this->getError()) {
            return Response::internalError("Failed to update Sales: " . $this->getError());
        }
        return Response::updated($success, 1, "Sales updated successfully");
    }

    /**
     * Delete Sales
     * 
     * @return JsonResponse
     */
    public function deleteModel(): JsonResponse
    {
        $item = $this->selectById($this->id);
        if (!$item) {
            return Response::notFound("Sales not found");
        }
        $success = $this->deleteByIdQuery($this->id);
        if ($this->getError()) {
            return Response::internalError("Failed to delete Sales: " . $this->getError());
        }
        return Response::deleted($success, 1, "Sales deleted successfully");
    }
} 