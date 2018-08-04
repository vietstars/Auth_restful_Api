<?php

namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // public function __construct()
    // {
    //     return $this->middleware('auth:api');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $contact = Contact::all();
        $contact = request()->user()->contact;
        // return ContactResource::collection($contact);
        return $contact;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $contact = $request->user()->contact()->create($request->all());
        return $contact;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        return $request->user();
        // if( $request->user()->id !== $contact->user_id ){
        //     return response()->json(['error' => 'Unathorized action'],401);
        // } else {
        //     $contact = $contact()->update($request->all());
        //     return $contact;
        // }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if( request()->user()->id !== $contact->user_id ){
            return response()->json(['error' => 'Unathorized action'],401);
        } else {
            $contact = $contact->delete();
            return response()->json(null,200);
        }
    }
}
