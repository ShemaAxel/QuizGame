<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;

use App\Http\Resources\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class QuizesController extends Controller
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
            
            
            $quizes = Quizes::where([
                ["status", "=", "1"],
            ])->get();


            return response()->json([
                "responseDescription" => "all quizes",
                "responseCode" => "100",
                "responseMessage" => "",
                "meta" => [
                    "content" => $quizes,
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


            $notValid = $this->helpers->validateQuizesRequest($request);

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

            $quize = $this->helpers->createQuize($request);

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

         /**
     * Create  
     *
     * @return Json
     */
    public function correction(Request $request)
    {
        try{
    
            $notValid = $this->helpers->validateCorrectionRequest($request);

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

            $studentPoint=0;
            $quizPoints=0;

            //search student and level
            $student =  Students::where([
                ["status", "=", "1"],
                ["stdId", "=", $request->stdId],
            ])->first();

            if(!$student){
                return response()->json([
                    "responseDescription" => "Invalid Stuent.",
                    "responseCode" => "101",
                    "responseMessage" => "Unkown Student.",
                    "meta" => [
                        "content" => "",
                    ],
                ], 200);
            }

            $level = Levels::where([
                ["status", "=", "1"],
                ["level", "=", $student->levelId],
            ])->first();

            if(!$level){
                return response()->json([
                    "responseDescription" => "Invalid level.",
                    "responseCode" => "101",
                    "responseMessage" => "Unkown level.",
                    "meta" => [
                        "content" => "",
                    ],
                ], 200);
            }

            //looping throug answers
            foreach($request->answers as $answer){


                $quiz = Quizes::where([
                    ["status", "=", "1"],
                    ["QId", "=", $answer["QId"]],
                ])->first();

                $quizPoints=$quizPoints+$quiz->marks;

                //check answers

                if($quiz->answer == $answer["answer"] ){
                    $studentPoint=$studentPoint+$quiz->marks;
                }
            }

            // calculating the %, stdPoints * 100/ quizPoints

            $percentage = ($studentPoint * 100) / $quizPoints;


            if($level->passingRate > $percentage ){

                return response()->json([
                    "responseDescription" => "Quiz Results",
                    "responseMessage" => "The student did not pass.",
                    "responseCode" => "101",
		    "passed" => false,
                    "meta" => [
                        "Quiz Total Points" => $quizPoints,
                        "Student Points" => $studentPoint,
                        "Average" => $percentage
                    ],
                ], 200);
            }else{

                // graduate student
                $student->levelId = $student->levelId+1;
                $student->save(); 

                return response()->json([
                    "responseDescription" => "Quiz Results",
                    "responseMessage" => "The student passed.",
                    "responseCode" => "100",
	 	    "passed" => true,
                    "meta" => [
                        "Quiz Total Points" => $quizPoints,
                        "Student Points" => $studentPoint,
                        "Average" => $percentage,
                        "New Level"=> $student->levelId,
                    ],
                ], 200);
            }



        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }

}
