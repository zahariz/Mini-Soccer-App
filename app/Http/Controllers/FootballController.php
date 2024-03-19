<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClubCreateRequest;
use App\Models\Club;
use App\Models\Matches;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FootballController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function viewClub(Request $request)
    {
        $query = Club::query();

        // Cek apakah ada parameter pencarian yang diteruskan melalui URL
        if ($request->has('search')) {
            // Dapatkan nilai pencarian dari parameter 'search'
            $searchTerm = $request->input('search');

            // Filter Tim berdasarkan kriteria pencarian
            $query->where('tim', 'like', '%' . $searchTerm . '%')
                ->orWhere('city', 'like', '%' . $searchTerm . '%');
        }

        // Ambil data Tim setelah diterapkan pencarian (jika ada)
        $clubs = $query->get();
        return view('club.index', [
            'clubs' => $clubs
        ]);
    }

    public function createClub()
    {
        return view('club.create');
    }

    public function storeClub(ClubCreateRequest $request)
    {
        $data = $request->validated();

        $clubs = new Club($data);

        $clubs->save();

        return Redirect::route('football.clubs.index')->with('status', 'Club successfully created!');
    }

    public function createMatches()
    {
        $clubs = Club::all();
        return view('matches.create', [
            'clubs' => $clubs
        ]);
    }

    public function viewMatches(Request $request)
    {
        $query = Matches::query()->with(['homeClub','awayClub']);

        // Cek apakah ada parameter pencarian yang diteruskan melalui URL
        if ($request->has('search')) {
            // Dapatkan nilai pencarian dari parameter 'search'
            $searchTerm = $request->input('search');

            // Filter Tim berdasarkan kriteria pencarian
            $query->where('tim1', 'like', '%' . $searchTerm . '%')
                ->orWhere('goal1', 'like', '%' . $searchTerm . '%')
                ->orWhere('tim2', 'like', '%' . $searchTerm . '%')
                ->orWhere('goal2', 'like', '%' . $searchTerm . '%');
        }

        // Ambil data Tim setelah diterapkan pencarian (jika ada)
        $matches = $query->get();
        return view('matches.index', [
            'matches' => $matches
        ]);
    }

    public function storeMatches(Request $request)
    {
        $request->validate([
            'tim1' => 'required|different:tim2',
            'tim2' => 'required|different:tim1',
            'goal1' => 'required',
            'goal2' => 'required'
        ]);

        // dd($request->all());

        Matches::create([
            'tim1' => $request->tim1,
            'goal1' => $request->goal1,
            'tim2' => $request->tim2,
            'goal2' => $request->goal2
        ]);

        return Redirect::back()->with('status', 'Matches successfully created!');
    }

    public function standings()
    {
        $clubs = Club::all();

        $clubStatus = [];

        foreach($clubs as $club)
        {
            $clubStatus[$club->id] = [
                'club' => $club,
                'total_main' => 0,
                'menang' => 0,
                'seri' => 0,
                'kalah' => 0,
                'goal_for' => 0,
                'goal_against' => 0,
                'poin' => 0
            ];
        }

        $matches = Matches::all();

        foreach($matches as $match)
        {
            $statusHomeClub = &$clubStatus[$match->tim1];
            $statusAwayClub = &$clubStatus[$match->tim2];

            $statusHomeClub['total_main']++;
            $statusAwayClub['total_main']++;

            $statusHomeClub['goal_for'] += $match->goal1;
            $statusHomeClub['goal_against'] += $match->goal2;
            $statusAwayClub['goal_for'] += $match->goal1;
            $statusAwayClub['goal_against'] += $match->goal2;

            if($match->goal1 > $match->goal2)
            {
                $statusHomeClub['menang']++;
                $statusAwayClub['kalah']++;
            } elseif($match->goal1 < $match->goal2)
            {
                $statusHomeClub['kalah']++;
                $statusAwayClub['menang']++;
            } else {
                $statusHomeClub['seri']++;
                $statusAwayClub['seri']++;
            }
        }

        foreach($clubStatus as &$stats) {
            $stats['poin'] = $stats['menang'] * 3 + $stats['seri'];
        }

        usort($clubStatus, function($a, $b){
            return $b['poin'] <=> $a['poin'];
        });

        return $clubStatus;


    }


}
