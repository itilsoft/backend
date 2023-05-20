<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function getStatistics()
    {
        return (new Resource(true))->response(['data' => [
            'users' => $this->getUsers(),
            'comments' => $this->getComments(),
        ]]);
    }

    private function getUsers() {
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $userCount = User::whereDate('created_at', $date)->count();

            $data[] = [
                'date' => $date,
                'count' => $userCount,
            ];
        }

        return $data;
    }

    private function getComments() {
        $data = [];

        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i)->toDateString();
            $commentCount = Comment::whereDate('created_at', $date)->count();
            $averageStar = Comment::whereDate('created_at', $date)->avg('star');

            $data[] = [
                'date' => $date,
                'count' => $commentCount,
                'average_star' => $averageStar ? round($averageStar, 2) : 0,
            ];
        }

        return $data;
    }
}
