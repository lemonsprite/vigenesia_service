<?php

namespace App\Http\Controllers;

use App\Http\Resources\MotivasiResource;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Test\Constraint\ResponseFormatSame;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResource
     */
    public function index()
    {
        // // Ambil data ditambah relasi tabel motivasi
        // $user = User::with(['hasMotivasi']);

        // // Return respon API
        // return UserResource::collection($user->get())->response();

        // Ambil data user dan return
        $user = User::all();
        return response($user, 201);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResource
     */
    public function show($id)
    {
        // Ambil data ditambah relasi tabel motivasi
        $user = User::with(['hasMotivasi'])->where('id', $id);

        // Return respon API
        return UserResource::collection($user->get())->response();
    }
}
