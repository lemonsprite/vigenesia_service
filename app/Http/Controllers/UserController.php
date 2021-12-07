<?php

namespace App\Http\Controllers;

use App\Http\Resources\MotivasiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResource
     */
    public function index()
    {
        // Ambil data ditambah relasi tabel motivasi
        $user = User::with(['hasMotivasi']);

        // Return respon API
        return UserResource::collection($user->get())->response();
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResource
     */
    public function show($id)
    {
        // Ambil data berdasar ID
        $user = User::find($id)->get();

        // Return respon API
        return UserResource::collection($user);
    }
}
