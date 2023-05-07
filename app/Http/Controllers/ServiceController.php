<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        return (new Resource(true))->response(['data' => $services]);
    }

    public function show($id)
    {
        $service = Service::with('comments.user')->find($id);
        return (new Resource(true))->response(['data' => $service]);
    }
}
