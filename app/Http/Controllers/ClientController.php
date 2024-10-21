<?php

namespace App\Http\Controllers;

use ApiResponse;
use App\Http\Requests\ClientRequest;
use App\Models\Client;
use App\Services\clientService;

use App\Traits\ApiResponse as TraitsApiResponse;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ClientController extends Controller
{
  use TraitsApiResponse; 
  public function __construct( public clientService $service_client)
  {
      
  }
  public function index()
  {
      try {
        $clients= $this->service_client->get_client();
        
        return $this->successResponse( $clients,' all clients',200);
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
  public function store(ClientRequest $request)
  {
      try{
     
      $client= $this->service_client->create_client($request);
      return $this->successResponse( $client,'the clients was created sucessfully',201);
         
  } 
  catch (\Exception $th ) {
    $status=($th instanceof HttpException)? $th->getCode():500;
     return $this->errorResponse(
       message: $th->getMessage(),
       status:$status
     
     );   
    }
  }

  
  public function update(ClientRequest $request, string $id)
  {
      try{
          $client= $this->service_client->update_client($request,$id);

     ;
     return $this->successResponse( $client,'the clients was updated sucessfully',200);
         
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
         $this->service_client->archive_client($id);

     ;
     return $this->successResponse( null,' sucessfully',200);
         
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
         $this->service_client->unarchive_client($id);

     ;
     return $this->successResponse( null,' sucessfully',200);
         
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

        $this->service_client->delet_client($id);
     return $this->successResponse( null,'the clients was deleted sucessfully',200);
         
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
