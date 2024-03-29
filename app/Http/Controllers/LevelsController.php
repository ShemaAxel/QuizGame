<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;

use App\Http\Resources\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LevelsController extends Controller
{
    /**
     * @var $helpers an instance of the helpers class
     */
    private $helpers;

    public function __construct()
    {
        $this->helpers = Helper::instantiate();
    }


    /**
     * View all 
     *
     * @return Json
     */
    public function all()
    {
        try {
            
            
            $levels = Levels::where([
                ["status", "=", "1"],
            ])->get();


            return response()->json([
                "responseDescription" => "all levels",
                "responseCode" => "100",
                "responseMessage" => "",
                "meta" => [
                    "content" => $levels,
                ],
            ], 200);

        } catch (Exception $ex) {
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }
    }
     /**
     * Create  
     *
     * @return Json
     */
    public function create(Request $request)
    {
        try{


            $notValid = $this->helpers->validateLevelsRequest($request);

            if ($notValid) {
                Log::error("Validation Error.");
                return response()->json([
                    "responseDescription" => "Invalid Request.",
                    "responseCode" => "101",
                    "responseMessage" => "Invalid request request body",
                    "meta" => [
                        "content" => $notValid,
                    ],
                ], 200);
            }

            $level = $this->helpers->createLevel($request);

            if(!$level){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "An error occured, while saving the level.",
                    "responseCode" => "",
                    "responseMessage" => "Error Occured while saving.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

            return response()->json([
                "responseDescription" => "Level saved",
                "responseCode" => "",
                "responseMessage" => "",
                "meta" => [
                    "content" => $level,
                ],
            ], 200);

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }


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

            $level = Levels::find($id);

            if(!$level){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "Course doesnt exist.",
                    "responseCode" => "101",
                    "responseMessage" => "Course doesnt exist.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }


            $quizez = Quizes::where([
                ["status", "=", "1"],
                ["levelId", "=", $id],
            ])->get();

            return response()->json([
                "responseDescription" => "Level details",
                "responseCode" => "",
                "responseMessage" => "",
                "meta" => [
                    "level" => $level,
                    "quizzes" => $quizez,
                ],
            ], 200);
            

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }

     /**
     * findById  
     *
     * @return Json
     */
    public function findByCourseId($id)
    {
        try{

            // $levels = Levels::with('quizes')
            // ->where([["levelId", "=", $id]])->get();

            $levels = Levels::where([["courseId", "=", $id]])->get();

            if(!$levels){
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
                "responseDescription" => "Level details",
                "responseCode" => "",
                "responseMessage" => "",
                "meta" => [
                    "level" => $levels,
                ],
            ], 200);
            

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }


      /**
     * findById  
     *
     * @return Json
     */
    public function findBygradeId($id)
    {
        try{


            // $levels = Levels::with('quizes')
            // ->where([["levelId", "=", $id]])->get();

            $levels = Levels::where([["level", "=", $id]])->get();

            if(!$levels){
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
                "responseDescription" => "All the courses",
                "responseCode" => "100",
                "responseMessage" => "Courses in a specific grade.",
                "meta" => [
                    "level" => $levels,
                ],
            ], 200);
            

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }
}