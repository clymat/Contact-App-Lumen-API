<?php

namespace App\Http\Controllers;


use App\Models\Contact;
use Illuminate\Http\Request;


class ContactController extends Controller{

    
    
    //update a contact
    public function updateContact( Request $request, $id){

       

        $this->validate($request,[

        'name' => 'string',
        'email' => 'email',
        'occupation' => 'string',
        'business'=> 'string'

    ]);


        $contact= $request->user()->business->contacts()->find($id);

        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->type = $request->input('type');
        $contact->phone = $request->input('phone');
        $contact->occupation = $request->input('occupation');
        $contact->business = $request->input('business');
        $contact->address = $request->input('address');
        $contact->save();

        return response()->json($contact, 200);
        
         
    
        
     } 
    


   //List all Contacts
    public function listAll(Request $request) {

         $showContacts = $request->user()->business->contacts;

            return response()->json($showContacts, 200);

    }    
             
         

            

    


     
    //Get Contact
    public function find(Request $request, $id){

        $contact = $request->user()->business->contacts()->find($id);
       

        return response()->json($contact);
    }


    //Delete Contact
    public function deleteContact(Request $request, $id) {

        $request->user()->business->contacts()->find($id)->delete();

        
        return response()->json('User has been sucessfully deleted.', 200);
        
        
       
    }
        
     

    //Create Contact

    public function createContact(Request $request){

       
        $this->validate($request, [
            'name' => 'required|string',
            'email' => 'required|email|unique:contacts,email',
            'type' =>  'required| string', 
            'phone'=> 'required| numeric',
            'occupation' => 'required',
            'business' => 'required',
            'address' => 'required'
    
        ], [
        'name.required' => 'You must enter your name.',
        'email.required' => 'An email is required.',
        'type.required' => 'You must provide your contact type.',
        'phone.required' => 'The phone number is required in numeric form only.',
        'occupation.required' => 'Your must enter you contact job occupation.',
        'business.required' => 'Please enter your contact company name.',
        'address.required' => 'your contact address is required.'


        ]);
        


        $contact =  new Contact();
        $contact->name=$request->input('name');
        $contact->email=$request->input('email');
        $contact->type=$request->input('type');
        $contact->phone=$request->input('phone');
        $contact->occupation=$request->input('occupation');
        $contact->business=$request->input('business');
        $contact->address=$request->input('address');
        $request->user()->business->contacts()->save($contact);


        
        return response()->json($contact, 201);

    }


}