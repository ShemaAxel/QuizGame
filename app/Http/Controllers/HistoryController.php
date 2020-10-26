<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;
use App\History;

use App\Http\Resources\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class HistoryController extends Controller
{
    /**
     * findById  
     *
     * @return Json
     */
    public function findById($id)
    {
        try{

            // $levels = Levels::with('quizes')
            // ->where([["levelId", "=", $id]])->get();

            $history = History::where([["studentId", "=", $id]])->get();

            if(!$history){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "Level doesnt exist.",
                    "responseCode" => "101",
                    "responseMessage" => "Level doesnt exist.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

            return response()->json([
                "responseDescription" => "Student history",
                "responseCode" => "100",
                "responseMessage" => "Student performance history",
                "meta" => [
                    "details" => $history,
                ],
            ], 200);
            

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }
}