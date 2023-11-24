<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GameController extends Controller
{
    public function getAll()
    {
        return Game::all();
    }

    public function addFavorite(Game $game)
    {
        $user = Auth::user();
        return $this->addToCollection($user, $game, 'favoriteGames', 'Game added to favorites');
    }

    public function getFavorites()
    {
        $user = Auth::user();
        return $user->favoriteGames;
    }

    public function addRecentlyPlayed(Game $game)
    {
        $user = Auth::user();
        return $this->addToCollection($user, $game, 'recentlyPlayedGames', 'Game added to recently played');
    }

    public function getRecentlyPlayed()
    {
        $user = Auth::user();
        return $user->recentlyPlayedGames;
    }

    public function removeFavorite(Game $game)
    {
        Auth::user()->favoriteGames()->detach($game);
        return ['message' => 'Game removed from favorites'];
    }

    public function addToCollection($user, $game, $collectionName, $message)
    {
        $collection = $user->{$collectionName}();

        if (!$collection->find($game->id)) {
            $collection->attach($game);
            return ['message' => $message];
        }

        return ['message' => "Game is already in $collectionName"];
    }

    public function removeRecentlyPlayed(Game $game)
    {
        Auth::user()->recentlyPlayedGames()->detach($game);
        return ['message' => 'Game removed from recently played'];
    }

    public function getThumbnail($fileName)
    {
        return $this->getFile($fileName, 'thumbnails');
    }

    public function getRom($fileName)
    {
        return $this->getFile($fileName, 'roms');
    }

    public function getAllGamesContain($str)
    {
        $games = Game::where('title', 'like', '%' . $str . '%')->get();
        return $games;
    }

    private function getFile($fileName,$directory)
    {
        return response()->file(Storage::disk('public')->path($directory.'/'.$fileName));
    }

    public function playGame($fileName){
        return view('game')->with('fileName', $fileName);
    }

    public function index()
    {
        return view('index');
    }

    public function mainBanner()
    {
        return $this->getFile('mainBanner.jpg', 'banners');
    }

    public function logo()
    {
        return $this->getFile('logo.png', 'logos');
    }

    public function welcomeAudio()
    {
        return $this->getFile('audioTheme.mp3', 'audio');
    }
}
