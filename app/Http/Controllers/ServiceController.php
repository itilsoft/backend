<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::all();
        foreach ($services as $s) {
            $s->average_star = $s->averageStar();
        }
        return (new Resource(true))->response(['data' => $services]);
    }

    public function show($id)
    {
        $service = Service::with('comments.user')->find($id);
        $service->average_star = $service->averageStar();
        return (new Resource(true))->response(['data' => $service]);
    }
}
