<?php
namespace App\Api;

use App\Controller\SalesController;
use Gemvc\Core\ApiService;
use Gemvc\Http\Request;
use Gemvc\Http\JsonResponse;

class Sales extends ApiService
{
    /**
     * Constructor
     * 
     * @param Request \$request The HTTP request object
     */
    public function __construct(Request $request)
    {
        parent::__construct($request);
    }

    /**
     * Create new Sales
     * 
     * @return JsonResponse
     * @http POST
     * @description Create new Sales in database
     * @example /api/Sales/create
     */
    public function create(): JsonResponse
    {
        if(!$this->request->definePostSchema([
            'name' => 'string',
            'description' => 'string',
            'amount' => 'float'
        ])) {
            return $this->request->returnResponse();
        }
        return (new SalesController($this->request))->create();
    }

    /**
     * Read Sales by ID
     * 
     * @return JsonResponse
     * @http GET
     * @description Get Sales by id from database
     * @example /api/Sales/read/?id=1
     */
    public function read(): JsonResponse
    {
        // Validate GET parameters
        if(!$this->request->defineGetSchema(["id" => "int"])) {
            return $this->request->returnResponse();
        }
        
        //get the id from the url and if not exist or not type of int return 400 die()
        $id = $this->request->intValueGet("id");
        if(!$id) {
            return $this->request->returnResponse();
        }
        
        //manually set the id to the post request
        $this->request->post['id'] = $id;
        return (new SalesController($this->request))->read();
    }

    /**
     * Update Sales
     * 
     * @return JsonResponse
     * @http POST
     * @description Update existing Sales in database
     * @example /api/Sales/update
     */
    public function update(): JsonResponse
    {
        if(!$this->request->definePostSchema([
            'id' => 'int',
            '?name' => 'string',
            '?description' => 'string',
            '?amount' => 'float'
        ])) {
            return $this->request->returnResponse();
        }
        return (new SalesController($this->request))->update();
    }

    /**
     * Delete Sales
     * 
     * @return JsonResponse
     * @http POST
     * @description Delete Sales from database
     * @example /api/Sales/delete
     */
    public function delete(): JsonResponse
    {
        if(!$this->request->definePostSchema([
            'id' => 'int',
        ])) {
            return $this->request->returnResponse();
        }
        return (new SalesController($this->request))->delete();
    }

    /**
     * List all Saless
     * 
     * @return JsonResponse
     * @http GET
     * @description Get list of all Saless with filtering and sorting
     * @example /api/Sales/list/?sort_by=name&find_like=name=test
     */
    public function list(): JsonResponse
    {
        // Define searchable fields and their types
        $this->request->findable([
            'name' => 'string',
            'description' => 'string',
            'amount' => 'float'
        ]);

        // Define sortable fields
        $this->request->sortable([
            'id',
            'name',
            'description',
            'amount'
        ]);
        
        return (new SalesController($this->request))->list();
    }

    /**
     * Generates mock responses for API documentation
     * 
     * @param string \$method The API method name
     * @return array<mixed> Example response data for the specified method
     * @hidden
     */
    public static function mockResponse(string $method): array
    {
        return match($method) {
            'create' => [
                'response_code' => 201,
                'message' => 'created',
                'count' => 1,
                'service_message' => 'Sales created successfully',
                'data' => [
                    'id' => 1,
                    'name' => 'Sample Sales',
                    'description' => 'Sales description',
                    'amount' => 100.50
                ]
            ],
            'read' => [
                'response_code' => 200,
                'message' => 'OK',
                'count' => 1,
                'service_message' => 'Sales retrieved successfully',
                'data' => [
                    'id' => 1,
                    'name' => 'Sample Sales',
                    'description' => 'Sales description',
                    'amount' => 100.50
                ]
            ],
            'update' => [
                'response_code' => 209,
                'message' => 'updated',
                'count' => 1,
                'service_message' => 'Sales updated successfully',
                'data' => [
                    'id' => 1,
                    'name' => 'Updated Sales',
                    'description' => 'Updated description',
                    'amount' => 150.75
                ]
            ],
            'delete' => [
                'response_code' => 210,
                'message' => 'deleted',
                'count' => 1,
                'service_message' => 'Sales deleted successfully',
                'data' => null
            ],
            'list' => [
                'response_code' => 200,
                'message' => 'OK',
                'count' => 2,
                'service_message' => 'Saless retrieved successfully',
                'data' => [
                    [
                        'id' => 1,
                        'name' => 'Sales 1',
                        'description' => 'Description 1',
                        'amount' => 150.75
                    ],
                    [
                        'id' => 2,
                        'name' => 'Sales 2',
                        'description' => 'Description 2',
                        'amount' => 150.75
                    ]
                ]
            ],
            default => [
                'success' => false,
                'message' => 'Unknown method'
            ]
        };
    }
} 