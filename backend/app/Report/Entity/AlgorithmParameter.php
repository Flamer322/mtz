<?php

namespace App\Report\Entity;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Report\Entity\AlgorithmParameter
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property float $value
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter query()
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereKey($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|AlgorithmParameter whereValue($value)
 * @mixin \Eloquent
 */
class AlgorithmParameter extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'key',
        'name',
        'value',
    ];

    private static array $quantiles = [
        2 => [0.21, 0.445, 3.227, 4.602],
        4 => [1.04, 1.643, 5.992, 7.773],
        6 => [2.204, 3.064, 8.561, 10.645],
        8 => [3.490, 4.586, 11.023, 15.362],
        10 => [4.865, 6.182, 13.447, 15.987],
        12 => [6.304, 7.811, 15.814, 18.549],
        14 => [7.790, 9.468, 18.149, 21.064],
        16 => [9.312, 11.148, 20.461, 23.542],
        18 => [10.868, 12.858, 22.755, 25.939],
        20 => [12.443, 14.580, 25.029, 28.412],
        22 => [14.041, 16.312, 27.301, 30.813],
        24 => [15.659, 18.064, 29.549, 33.196],
        26 => [17.292, 19.824, 31.795, 35.563],
        28 => [18.939, 21.595, 34.022, 37.916],
        30 => [20.599, 23.357, 36.248, 40.256],
        32 => [21.271, 25.148, 38.461, 42.585],
        34 => [23.952, 26.936, 40.682, 44.903],
        36 => [25.643, 28.731, 42.582, 47.212],
        38 => [27.343, 30.537, 45.079, 49.513],
        40 => [29.051, 32.354, 47.275, 51.805],
        42 => [30.765, 34.161, 49.460, 54.090],
        44 => [32.487, 35.970, 51.643, 56.369],
        46 => [34.215, 37.796, 52.822, 58.641],
        48 => [35.949, 39.615, 55.998, 60.907],
        50 => [37.689, 41.449, 58.160, 63.167],
        52 => [39.433, 43.285, 60.334, 65.422],
        54 => [41.183, 45.121, 62.497, 67.673],
        56 => [42.937, 46.956, 64.661, 69.919],
        58 => [44.696, 48.801, 66.815, 72.160],
        60 => [46.459, 50.647, 68.972, 74.397],
        62 => [48.226, 52.487, 71.120, 76.630],
        64 => [49.996, 54.336, 73.273, 78.860],
        66 => [51.770, 56.195, 75.418, 81.085],
        68 => [53.548, 58.047, 77.571, 83.803],
        70 => [55.329, 59.891, 79.716, 85.527],
        72 => [57.113, 61.761, 81.853, 87.743],
        74 => [88.900, 63.621, 79.863, 84.000],
        76 => [60.690, 65.470, 88.140, 92.166],
        78 => [62.483, 67.345, 88.274, 94.374],
        80 => [64.278, 69.209, 90.400, 96.578],
        82 => [66.076, 71.074, 82.535, 98.780],
        84 => [67.876, 72.941, 94.663, 100.98],
        86 => [69.679, 74.814, 96.797, 103.18],
        88 => [71.484, 76.683, 98.930, 105.37],
        90 => [73.291, 78.558, 101.06, 107.57],
        92 => [75.100, 80.438, 103.18, 109.76],
        94 => [76.912, 82.313, 105.31, 111.94],
        96 => [78.725, 84.182, 107.42, 114.13],
        98 => [80.541, 86.067, 109.55, 116.32],
        100 => [82.358, 87.946, 111.66, 118.50],
        110 => [91.471, 97.358, 117.27, 129.39],
        120 => [100.62, 106.81, 140.23, 146.57],
        130 => [109.81, 116.26, 151.05, 143.34],
        140 => [119.03, 125.76, 153.85, 161.83],
        150 => [128.28, 135.21, 164.35, 172.58],
        200 => [174.84, 183.00, 216.58, 226.02],
        300 => [260.07, 279.21, 320.39, 331.79],
        400 => [364.21, 376.02, 423.58, 436.65],
        500 => [459.93, 472.21, 526.40, 540.93],
        600 => [556.06, 570.68, 628.92, 644.80],
        800 => [749.49, 766.16, 833.45, 851.67],
        1000 => [943.13, 962.17, 1037.4, 1057.7],
    ];

    public static function getX(int $numberOfFailures, int $p): float
    {
        $closest = null;

        foreach (self::$quantiles as $key => $item) {
            if ($closest === null || abs($numberOfFailures - $closest) > abs($key - $numberOfFailures)) {
                $closest = $key;
            }
        }

        return self::$quantiles[$closest][$p];
    }
}
