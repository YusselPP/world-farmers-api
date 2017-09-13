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
     * ex: http://world-farmers.com/api/contacts?page=1&per_page=1&order_by=name
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $contact = new Contact;
        $total = Contact::toBase()->getCountForPagination();
        $perPage = $request->query('per_page', 1);
        $page = $request->query('page', 1);
        $order_by = $request->query('order_by', 'name');

        if (!$contact->hasColumn($order_by)) {
            $order_by = Contact::getDefaulOrderBy();
        }

        if ($perPage < 1 || $perPage > PHP_INT_MAX) {
            $perPage = 1;
        }

        $lastPage = max((int) ceil($total / $perPage), 1);

        if ($page < 1 || $page > $lastPage) {
            $page = $lastPage + 1;
        }

        $request->query->set('page', $page);


        return Contact::orderBy($order_by)
            ->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Contact::$rules);
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
        $request->validate(Contact::$rules);
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
