<?php
namespace App\Http\Controllers\Api;

use App\Contact;
use App\Http\Controllers\Controller;
use App\Http\Resources\Contact as ContactResource;
use Illuminate\Http\Request; 

class ContactController extends Controller
{
    /**
     * construct auth:api
     */
    public function __construct()
    {
        return $this->middleware('auth:api');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Contact $contact)
    {
        // $data = ContactResource::collection($contact->all());
        $data = request()->user()->contact;
        return response()->json([
            'data' => $data,
            'mesage' => 'success!',
            'error' => 0
        ],200);
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
        $data = new ContactResource($contact);
        return response()->json([
            'data' => $data,
            'mesage' => 'success!',
            'error' => 0
        ],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return new ContactResource($contact); //trả về firstOrFail, Contact $contact
        // $contact = Contact::find($id);
        // if( $contact !== null ){
        //     $data = new ContactResource($contact);
        //     return response()->json([
        //         'data' => $data,
        //         'mesage' => 'success!',
        //         'error' => 0
        //     ],200);
        // } else {
        //     return response()->json([
        //         'data' => null,
        //         'mesage' => 'Contact not found!',
        //         'error' => 1
        //     ],400);
        // }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function edit($id)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        if( $request->user()->id !== $contact->user_id ){
            return response()->json([
                'data' => null,
                'mesage' => 'Unathorized action',
                'error' => 1
            ],401);
        } else {
            $data = $contact->update($request->all()); //data return true or false
            return response()->json([
                'data' => new ContactResource($contact), //return contact detail
                'mesage' => 'updated!',
                'error' => 0
            ],200);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        if( request()->user()->id !== $contact->user_id ) //không đúng user_id báo lỗi 401
        {
            return response()->json([
                'data' => null,
                'mesage' => 'Unathorized action',
                'error' => 1
            ],401);
        } else  //kiểm tra đúng user_id thì cho xoá thông tin
        {
            $data = $contact->delete(); // data return true or false
            return response()->json([
                'data' => new ContactResource($contact), //return contact detail
                'mesage' => 'deleted!',
                'error' => 0
            ],200);
        }
    }
}
