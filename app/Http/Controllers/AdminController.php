<?php

namespace App\Http\Controllers;

use App\Http\Resources\Resource;
use App\Models\Comment;
use App\Models\Service;
use App\Models\User;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
    public function getStatistics()
    {
        $services = $this->getServices();

        return (new Resource(true))->response([
            'data' => [
                'averageRatingOfAllServices' => $services['averageRatingOfAllServices'],
                'mostCommentingServices' => $services['mostCommentingServices'],
                'mostRatingServices' => $services['mostRatingServices'],
                'users' => $this->getUsers(),
                'comments' => $this->getComments(),
            ]]);
    }

    private function getServices()
    {
        $services = Service::with('comments')->get();
        $totalStar = 0;

        foreach ($services as $s) {
            $s->commentsCount = $s->comments->count();
            $s->averageStar = $s->averageStar();
            $totalStar += $s->averageStar;
            unset($s->comments);
        }

        return [
            'averageRatingOfAllServices' => round($totalStar / $services->count(), 2),
            'mostCommentingServices' => $services->sortByDesc('commentsCount')->values(),
            'mostRatingServices' => $services->sortByDesc('averageStar')->values(),
        ];
    }

    private function getUsers()
    {
        $result = [];
        $days = [];

        for ($i = 6; $i >= 0; $i--) {
            $days[] = Carbon::now()->subDays($i);
        }

        $users = User::query()->whereBetween('created_at', [
            $days[0]->startofDay()->toDateTimeString(),
            $days[count($days) - 1]->endOfDay()->toDateTimeString()
        ])->get();

        foreach ($days as $d) {
            $result[] = [
                'date' => $d->toDateString(),
                'count' => $users->whereBetween('created_at', [
                    $d->startofDay()->toDateTimeString(), $d->endOfDay()->toDateTimeString()
                ])->count(),
            ];
        }

        return $result;
    }

    private function getComments()
    {
        $result = [];
        $days = [];

        for ($i = 6; $i >= 0; $i--) {
            $days[] = Carbon::now()->subDays($i);
        }

        $comments = Comment::query()->whereBetween('created_at', [
            $days[0]->startofDay()->toDateTimeString(),
            $days[count($days) - 1]->endOfDay()->toDateTimeString()
        ])->get();

        foreach ($days as $d) {
            $commentsOfDay = $comments->whereBetween('created_at', [
                $d->startofDay()->toDateTimeString(), $d->endOfDay()->toDateTimeString()
            ]);
            $result[] = [
                'date' => $d->toDateString(),
                'count' => $commentsOfDay->count(),
            ];
        }

        return $result;
    }
}
