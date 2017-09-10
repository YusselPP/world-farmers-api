<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Instantiate a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('scope:write-contacts')->only('store|update|destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // http://world-farmers.com/api/contacts?page=1&per_page=1
        return Contact::orderBy($request->query('order_by', 'name'))
            ->paginate($request->query('per_page', 1));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Add validation
        Contact::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show(Contact $contact)
    {
        return response()->json($contact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        // return response()->json($request->ajax());
        // return response()->json($request->all());
        // $request->validate([
        //     'name' => 'required|max:100',
        //     'phoneNumber' => 'required|max:100'
        //     'name' => 'required|max:100'
        //     'name' => 'required|max:100'
        //     'name' => 'required|max:100'
        //     'name' => 'required|max:100'
        //     'name' => 'required|max:100'
        //     'name' => 'required|max:100'
        // ]);
        $contact->fill($request->all());
        $contact->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
    }
}
