<?php

namespace App\Http\Controllers;

use App\Http\Libraries\BaseApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = (new BaseApi)->index('/user');

        return view('index')->with([
            'users' => $users
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = [
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
            'email' => $request['email']
        ];

        $baseApi = new BaseApi;
        $response = $baseApi->create('/user/create', $payload);

        if($response->failed()) {
            $errors = $response->json('data');

            $messages = "<ul>";
            foreach ($errors as $key => $msg) {
                $messages .= "<li>$key : $msg</li>";
            }
            $messages .= "</ul>";

            return back()->with('messageFailed', "Failed $messages");
        }

        return back()->with('messageSuccess', 'Success added data');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $payload = [
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName']
        ];

        $response = (new BaseApi)->update('/user', $id, $payload);

        if($response->failed()) {
            $errors = $response->json('data');

            $messages = "<ul>";
            foreach ($errors as $key => $msg) {
                $messages .= "<li>$key : $msg</li>";
            }
            $messages .= "</ul>";

            return back()->with('messageFailed', "Failed $messages");
        }

        return back()->with('messageSuccess', 'Success added data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $response = (new BaseApi)->delete('/user', $id);

        if($response->failed()) {
            return back()->with('messageFailed', "Failed to delete");
        }

        return back()->with('messageSuccess', "Delete success");
    }
}
