<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Traits\ApiResponse;

use contactService;

use Symfony\Component\HttpKernel\Exception\HttpException;

class ContactController extends Controller
{
    use ApiResponse;
   
   
    public function __construct( public contactService $service_contact)
    {
        
    }
    public function index()
    {
        try {
          $contacts= $this->service_contact->get_contact();
          
          return $this->successResponse( $contacts,' all contacts',200);
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
    public function store(ContactRequest $request)
    {
        try{
       
        $contact= $this->service_contact->create_contact($request);
        return $this->successResponse( $contact,'the contacts was created sucessfully',201);
           
    } 
    catch (\Exception $th ) {
      $status=($th instanceof HttpException)? $th->getCode():500;
       return $this->errorResponse(
         message: $th->getMessage(),
         status:$status
       
       );   
      }
    }
  
       public function update(ContactRequest $request, string $id)
    {
        try{
            $contact= $this->service_contact->update_contact($request,$id);
  
       ;
       return $this->successResponse( $contact,'the contacts was updated sucessfully',200);
           
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
          $this->service_contact->archive_contact($id);
  
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
          $this->service_contact->unarchive_contact($id);
  
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
         
         $this->service_contact-> delet_contact($id);
       return $this->successResponse( null,'the contact was deleted sucessfully',200);
           
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
  
