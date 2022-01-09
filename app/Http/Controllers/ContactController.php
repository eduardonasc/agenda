<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactCreateRequest;
use App\Http\Requests\ContactUpdateRequest;
use App\Http\Services\ContactService;
use App\Repositories\Contact\ContactRepository;

class ContactController extends Controller
{
    /**
     * @var ContactService
     */
    protected $service;

    /**
     * @var ContactRepository
     */
    protected $repository;

    /**
     * UserController constructor.
     *
     * @param ContactService $service
     */
    public function __construct(ContactService $service, ContactRepository $repository)
    {
        $this->service = $service;
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $contacts = $user->contacts;

        return view('contacts.index', compact('user', 'contacts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactCreateRequest $request)
    {
        $serviceResponse = $this->service->store(
            $request->name,
            $request->email,
            $request->phone,
            auth()->id()
        );

        if (!$serviceResponse['success']) {
            return back()->withError($serviceResponse['message']);
        }

        return redirect()->route('contacts.index')->withSuccess($serviceResponse['message']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $contact = $this->repository->find($id);

        return view('contacts.show', compact('contact'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $contact = $this->repository->find($id);

        return view('contacts.edit', compact('contact'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ContactUpdateRequest $request, $id)
    {
        $serviceResponse = $this->service->update(
            $id,
            $request->name,
            $request->email,
            $request->phone,
            auth()->id()
        );

        if (!$serviceResponse['success']) {
            return back()->withError($serviceResponse['message']);
        }

        return redirect()->route('contacts.index')->withSuccess($serviceResponse['message']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $serviceResponse = $this->service->destroy($id, auth()->id());

        if (!$serviceResponse['success']) {
            return back()->withError($serviceResponse['message']);
        }

        return redirect()->route('contacts.index')->withSuccess($serviceResponse['message']);
    }
}
