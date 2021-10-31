<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Route;
use Str;
use Arr;

class CardsController extends Controller
{
    public static function routes()
    {
        Route::prefix('cards')->group(function ()
        {
            Route::get('/', [self::class, 'index'])->name('cards.index');
        });
    }

    public function index(Request $request)
    {
        $cards = [
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
            self::getFakeCard(),
        ];

        return response()->json($cards, 200);
    }

    public static function getFakeCard()
    {
        $true_false = [true, true, false, true, true, false, true, true, true, false, true, true, false, true];
        $steps = [
            ['title' => 'planejamento', 'id' => 1000 ],
            ['title' => 'em_andamento', 'id' => 2000 ],
            ['title' => 'concluida',    'id' => 3000 ],
        ];

        return [
            "title" => "Card " . Str::random(5),
            "id"    => rand(1, 100).rand(1, 100),
            "step"  => Arr::random($steps),
            "color" => self::getRandomColorCode(),
            "description" => Str::random(15),
            "tags" => [
                [
                    "title" => Str::random(rand(3, 5)),
                    "color" => self::getRandomColorCode(),
                ],
                [
                    "title" => Str::random(rand(3, 5)),
                    "color" => self::getRandomColorCode(),
                ],
                [
                    "title" => Str::random(rand(3, 5)),
                    "color" => self::getRandomColorCode(),
                ],
            ],
            "checklist" => [
                "title" => 'Checklist ' . Str::random(5),
                "items" => [
                    [
                        "done" => !!Arr::random($true_false),
                        "title" => 'Checklist item ' . Str::random(5),
                    ],
                    [
                        "done" => !!Arr::random($true_false),
                        "title" => 'Checklist item ' . Str::random(5),
                    ],
                    [
                        "done" => !!Arr::random($true_false),
                        "title" => 'Checklist item ' . Str::random(5),
                    ],
                    [
                        "done" => !!Arr::random($true_false),
                        "title" => 'Checklist item ' . Str::random(5),
                    ],
                ]
            ]
        ];
    }

    public static function getRandomColorCode(string $color_name = null)
    {
        $color_codes = [
            'black'          => '#000000',
            'silver'         => '#c0c0c0',
            'gray'           => '#808080',
            'maroon'         => '#800000',
            'red'            => '#ff0000',
            'purple'         => '#800080',
            'fuchsia'        => '#ff00ff',
            'green'          => '#008000',
            'lime'           => '#00ff00',
            'olive'          => '#808000',
            'yellow'         => '#ffff00',
            'navy'           => '#000080',
            'blue'           => '#0000ff',
            'teal'           => '#008080',
            'aqua'           => '#00ffff',
            'orange'         => '#ffa500',
            'antiquewhite'   => '#faebd7',
            'aquamarine'     => '#7fffd4',
            'blueviolet'     => '#8a2be2',
            'brown'          => '#a52a2a',
            'burlywood'      => '#deb887',
            'cadetblue'      => '#5f9ea0',
            'chartreuse'     => '#7fff00',
            'chocolate'      => '#d2691e',
            'coral'          => '#ff7f50',
            'cornflowerblue' => '#6495ed',
            'cornsilk'       => '#fff8dc',
            'crimson'        => '#dc143c',
            'midnightblue'   => '#37474f',
            'success'        => '#8bc34a',
            'danger'         => '#e51c23',
        ];

        return $color_name ?  $color_codes[$color_name] ?? Arr::random($color_codes)
                            : Arr::random($color_codes);
    }
}
