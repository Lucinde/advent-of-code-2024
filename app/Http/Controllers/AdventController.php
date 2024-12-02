<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Collection;

class AdventController extends Controller
{
    public function index() {
        $day1 = $this->day1();
        $day1PartTwo = $this->day1PartTwo();
        $day2 = $this->day2();

        return view('welcome', compact('day1', 'day1PartTwo', 'day2'));
    }

    public function day1(): int {
        list($column1, $column2) = $this->getColumnsFromFile();
        $zipped = $column1->zip($column2);

        $differences = $zipped->map(function ($pair) {
            return abs($pair[0] - $pair[1]);
        });

        return $differences->sum();
    }

    public function day1PartTwo():int {
        list($column1, $column2) = $this->getColumnsFromFile();

        $similarityScore = 0;
        foreach ($column1 as $number) {
            $found = $column2->filter(fn($item) => $item === $number)->count();
            $itemCount = $number * $found;
            $similarityScore += $itemCount;
        }

        return $similarityScore;
    }

    public function getColumnsFromFile(): array
    {
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

        // Zip the two collections and return the zipped collection
        return [$column1, $column2];
    }

    public function day2() {
        $filePath = storage_path('/app/public/sources/advent2.txt');
        $lines = File::lines($filePath);

        $reports = [];

        foreach ($lines as $line) {
            $levels = array_map('intval', preg_split('/\s+/', trim($line))); // Split line into numbers
            
            $differences = [];
            $isIncreasing = true;
            $isDecreasing = true;

            // Analyze levels
            for ($i = 1; $i < count($levels); $i++) {
                $diff = $levels[$i] - $levels[$i - 1];
                $differences[] = $diff;
        
                // Check valid range for differences
                if (abs($diff) < 1 || abs($diff) > 3) {
                    $isIncreasing = false;
                    $isDecreasing = false;
                }
        
                // Check increasing/decreasing trends
                if ($diff < 0) {
                    $isIncreasing = false;
                }
                if ($diff > 0) {
                    $isDecreasing = false;
                }
            }

            $reports[] = [
                'levels' => $levels,
                'differences' => $differences,
                'is_increasing' => $isIncreasing,
                'is_decreasing' => $isDecreasing,
            ];
        }

        $safeLevels = 0;
        foreach($reports as $report) {
            if($report['is_increasing'] || $report['is_decreasing']){
                $safeLevels++;
            }
        }

        return $safeLevels;       
    }

}
