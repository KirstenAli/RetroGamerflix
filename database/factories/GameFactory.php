<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Game>
 */
class GameFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private array|bool $thumbnails;
    private array|bool $roms;
    private array $genres = [];
    private array $gameNames = [];

    private array $gameDescriptions  = [];

    public function __construct($count = null,
                                ?Collection $states = null,
                                ?Collection $has = null,
                                ?Collection $for = null,
                                ?Collection $afterMaking = null,
                                ?Collection $afterCreating = null,
                                $connection = null,
                                ?Collection $recycle = null){
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection, $recycle);
        $this->init();
    }

    public function definition(): array
    {
        return [
            'title' => $this->fakeGameName(),
            'genre' => $this->fakeGenre(),
            'description' => $this->fakeGameDescription(),
            'thumbnail' => $this->fakeThumbnail(),
            'rom' => $this->fakeRom()
        ];
    }

    public function init(): void
    {
        $this->thumbnails = $this->getFilesFromDir('../thumbnails/*');
        $this->roms = $this->getFilesFromDir('../roms/*');

        $this->genres = [
            'Action',
            'Adventure',
            'Role-Playing Game (RPG)',
            'Platformer',
            'Simulation',
            'Strategy',
            'Puzzle',
            'Sports and Racing',
            'Fighter',
            'Shooter',
            'Survival',
            'Open World'];

        $this->gameNames = [
            "Super Mario Bros.",
            "The Legend of Zelda",
            "Metroid",
            "Donkey Kong",
            "Pac-Man",
            "Mega Man",
            "Castlevania",
            "Final Fantasy",
            "Dragon Quest",
            "Kirby's Adventure",
            "Super Metroid",
            "Super Mario World",
            "The Legend of Zelda: A Link to the Past",
            "Super Mario 64",
            "The Legend of Zelda: Ocarina of Time",
            "Donkey Kong Country",
            "Super Mario Kart",
            "The Legend of Zelda: Majora's Mask",
            "Pokémon Red and Blue",
            "Chrono Trigger",
            "EarthBound",
            "Super Mario Sunshine",
            "The Legend of Zelda: Wind Waker",
            "Metroid Prime",
            "The Legend of Zelda: Twilight Princess",
            "Super Mario Galaxy",
            "Super Smash Bros. Melee",
            "Animal Crossing",
            "Paper Mario",
            "GoldenEye 007",
            "Star Fox 64",
            "The Legend of Zelda: Breath of the Wild",
            "Super Mario Odyssey",
            "Super Smash Bros. Ultimate",
            "Splatoon",
            "Mario Kart 8 Deluxe",
            "The Legend of Zelda: Skyward Sword",
            "Fire Emblem: Awakening",
            "Super Mario 3D World",
            "The Legend of Zelda: Link's Awakening",
            "Donkey Kong Country: Tropical Freeze",
            "Super Mario Bros. 3",
            "The Legend of Zelda: Spirit Tracks",
            "Kid Icarus: Uprising",
            "Metroid: Samus Returns",
            "The Legend of Zelda: Phantom Hourglass",
            "Super Mario Galaxy 2",
            "Mario Kart: Double Dash!!",
            "Star Fox",
            "F-Zero"
        ];

        $this->gameDescriptions = [
            "Platforming masterpiece featuring Mario's adventures.",
            "Epic quest of Link to save Princess Zelda and defeat Ganon.",
            "Sci-fi action-adventure starring Samus Aran.",
            "Jumpman (Mario) must rescue Pauline from Donkey Kong.",
            "Maze-chomping classic starring a yellow hero.",
            "Run-and-gun action with the Blue Bomber, Mega Man.",
            "Vampire-hunting action-platformer series.",
            "Legendary RPG series with epic stories and characters.",
            "Japanese RPG series with classic turn-based gameplay.",
            "Pink puffball Kirby's dreamy adventures.",
            "Atmospheric platformer with Samus Aran.",
            "Mario and Luigi's journey in Dinosaur Land.",
            "Link's heroic quest in the land of Hyrule.",
            "Pioneering 3D platformer with Mario's exploration.",
            "Epic adventure through time with Link.",
            "Kong family platforming fun.",
            "Wild racing action with Mario characters.",
            "Link's race against time in Termina.",
            "Gotta catch 'em all in the world of Pokémon.",
            "Time-traveling RPG with a compelling storyline.",
            "Quirky RPG adventure with Ness and friends.",
            "Mario's sunny platformer with FLUDD.",
            "Link's seafaring journey in the Great Sea.",
            "First-person exploration as Samus Aran.",
            "Link's journey between light and shadow.",
            "Gravity-defying platforming with Mario.",
            "Epic crossover brawls with Nintendo characters.",
            "Charming life-simulation in a quaint village.",
            "Mario's RPG adventures in a papercraft world.",
            "Classic FPS based on the James Bond movie.",
            "Intense space battles with the Star Fox team.",
            "Link's open-world adventure in Hyrule.",
            "Mario's globe-trotting journey for Power Moons.",
            "The ultimate crossover fighting game.",
            "Ink-based shooter with colorful characters.",
            "Wild and fun racing with Mario and friends.",
            "Link's journey in the skies above Hyrule.",
            "Tactical RPG with engaging characters and strategy.",
            "Multiplayer 3D platforming with Mario and friends.",
            "Link's adventures on Koholint Island.",
            "Kong family platforming in the icy Arctic.",
            "Iconic platforming adventure with Mario and friends.",
            "Link's adventures with a train in Hyrule.",
            "Action-packed adventures with Pit, the angel.",
            "Remake of Metroid II with Samus Aran's return.",
            "Link's nautical adventure on the DS.",
            "Sequel to the acclaimed gravity-defying platformer.",
            "Racing duo with two characters per kart.",
            "Intergalactic dogfights with Fox McCloud and team.",
            "High-speed futuristic racing with Captain Falcon."
        ];
    }

    function fakeRom(){
        return $this->getRandomStringFromArray($this->roms);
    }

    function fakeThumbnail(){
        return $this->getRandomStringFromArray($this->thumbnails);
    }

    function fakeGenre(){
        return $this->getRandomStringFromArray($this->genres);
    }

    function fakeGameName(){
        return $this->getRandomStringFromArray($this->gameNames);
    }

    function fakeGameDescription(){
        return $this->getRandomStringFromArray($this->gameDescriptions);
    }

    function getFilesFromDir($path): array{
        $files = glob($path);
        return array_map('basename', $files);
    }

    function getRandomStringFromArray(array $array) {
        if (empty($array)) {
            return null;
        }

        $randomIndex = array_rand($array);
        return $array[$randomIndex];
    }
}
