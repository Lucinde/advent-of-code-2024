<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

class AdventController extends Controller
{
    public function index() {
        $day1 = $this->day1();

        return view('welcome', compact('day1'));
    }

    public function day1(): int {
        $filePath = storage_path('/app/public/sources/advent1.txt');
        $lines = File::lines($filePath);

        // Process the lines into collections
        $column1 = collect();
        $column2 = collect();

        foreach ($lines as $line) {
            [$col1, $col2] = preg_split('/\s+/', trim($line)); 
            $column1->push((int)$col1);
            $column2->push((int)$col2);
        }

        // Sort both collections in ascending order
        $column1 = $column1->sort()->values();
        $column2 = $column2->sort()->values();

        // Zip the two collections together and calculate the sum of the differences
        $zipped = $column1->zip($column2);

        $differences = $zipped->map(function ($pair) {
            return abs($pair[0] - $pair[1]);
        });

        return $differences->sum();
      }
}
