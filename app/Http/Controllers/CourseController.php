<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;
use App\History;
use App\Course;


use App\Http\Resources\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
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
            
            
            $courses = Course::where([
                ["status", "=", "1"],
            ])->get();


            return response()->json([
                "responseDescription" => "all levels",
                "responseCode" => "100",
                "responseMessage" => "",
                "meta" => [
                    "content" => $courses,
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


            $notValid = $this->helpers->validateCourseRequest($request);

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

            $quize = $this->helpers->createCourse($request);

            if(!$quize){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "An error occured, while saving the Quiz.",
                    "responseCode" => "",
                    "responseMessage" => "Error Occured while saving.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

            return response()->json([
                "responseDescription" => "Quiz saved",
                "responseCode" => "",
                "responseMessage" => "",
                "meta" => [
                    "content" => $quize,
                ],
            ], 200);

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }

    
}