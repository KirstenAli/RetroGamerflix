<?php

namespace App\Http\Controllers;

use App\Http\Requests\GameRequest;
use App\Models\Game;

class AdminGameController extends Controller
{
    public function store(GameRequest $request)
    {
        $validatedData = $this->processGameRequest($request);

        $game = Game::create($validatedData);

        return response()->json(['message' => 'Game created successfully', 'game' => $game]);
    }

    public function update(Game $game, GameRequest $request)
    {
        $validatedData = $this->processGameRequest($request);

        $game->update($validatedData);

        return response()->json(['message' => 'Game updated successfully']);
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return response()->json(['message' => 'Game deleted successfully']);
    }

    private function processGameRequest(GameRequest $request){
        return $this->processFiles($request, ['thumbnail', 'rom']);
    }

    private function processFiles(GameRequest $request, $keys)
    {
        $validatedData = $request->validated();

        foreach ($keys as $key) {
            $fileName = $this->saveFile($request, $key);
            $this->processFileKey($validatedData,$key, $fileName);
        }

        return $validatedData;
    }

    private function saveFile(GameRequest $request, $key){
        $fileName = null;

        if ($request->hasFile($key)) {
            $file = $request->file($key);
            $fileName = $file->getClientOriginalName();
            $file->storeAs($key.'s', $fileName, 'public');
        }

        return $fileName;
    }

    private function processFileKey(&$validatedData, $key, $value){
        if($value){
            $validatedData[$key] = $value;
        } else{
            unset($validatedData[$key]);
        }
    }
    
    public function adminPanel(){
        return view('adminPanel');
    }
}
