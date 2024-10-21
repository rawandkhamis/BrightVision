<?php

namespace App\Http\Controllers;

use ApiResponse;

use App\Http\Requests\ServiceRequest;
use App\Models\Service;
use App\Services\ServiceService;
use App\Traits\ApiResponse as TraitsApiResponse;


use Symfony\Component\HttpKernel\Exception\HttpException;


class ServiceController extends Controller
{
    use TraitsApiResponse;
  
    public function __construct( public ServiceService $service_service)
    {
        
    }
    public function index()
    {
        try {
          $services= $this->service_service->get_services();
          
          return $this->successResponse( $services,' all services',200);
        }  catch (\Exception $th ) {
            $status=($th instanceof HttpException)? $th->getCode():500;
             return $this->errorResponse(
               message: $th->getMessage(),
               status:$status
             
             );   
            }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        try{
       
        $service= $this->service_service->create_service($request);
        return $this->successResponse( $service,'the services was created sucessfully',201);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }

    
   
    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, string $id)
    {
        try{
            $service= $this->service_service->update_service($request,$id);

       ;
       return $this->successResponse( $service,'the services was updated sucessfully',200);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }
    public function archive($id)
    {
        try{
           $this->service_service->archive_service($id);

       ;
       return $this->successResponse( null,'sucessfully',200);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }
    public function unarchive($id)
    {
        try{
            $this->service_service->unarchive_service($id);

       ;
       return $this->successResponse( null,'sucessfully',200);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
         
         $this->service_service->delet_services($id);
       return $this->successResponse( null,'the services was deleted sucessfully',200);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }
}
