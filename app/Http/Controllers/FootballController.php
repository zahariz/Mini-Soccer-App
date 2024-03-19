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
    // Validasi data
    foreach ($request->matches as $key => $match) {
        $request->validate([
            "matches.$key.tim1" => 'required|different:matches.*.away_club',
            "matches.$key.goal1" => 'required',
            "matches.$key.tim2" => 'required|different:matches.*.tim',
            "matches.$key.goal2" => 'required',
        ]);
    }

    // Simpan Multiple input match
    foreach ($request->matches as $match) {
        Matches::create([
            'tim1' => $match['tim1'],
            'goal1' => $match['goal1'],
            'tim2' => $match['tim2'],
            'goal2' => $match['goal2'],
        ]);
    }

    return redirect()->back()->with('status', 'Matches successfully created!');
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

        return view('standing.index', [
            'clubStatus' => $clubStatus
        ]);


    }


}
