<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;
use App\History;


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
            $answers =[];

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
            $row=0;
            foreach($request->answers as $answer){


                $quiz = Quizes::where([
                    ["status", "=", "1"],
                    ["QId", "=", $answer["QId"]],
                ])->first();

                $quizPoints=$quizPoints+$quiz->marks;

                //check answers

                if($quiz->response == $answer["answer"] ){
                    $studentPoint=$studentPoint+$quiz->marks;

                    $quiz->passed = true;
                    $quiz->answered = $answer["answer"];

                    $answers[$row]=$quiz;

                }else{

                    $quiz->passed = false;
                    $quiz->answered = $answer["answer"];

                    $answers[$row]=$quiz;
                }//if
            
            $row++;
            }//for

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
                        "Average" => $percentage,
                        "Answers" => $answers,
                    ],
                ], 200);
            }else{

                // graduate student

                $level = Levels::where([
                    ["status", "=", "1"],
                    ["level", "=", $student->levelId+1],
                ])->first();

                if(!$level){
                    return response()->json([
                        "responseDescription" => "Upper level doesnt exist.",
                        "responseCode" => "101",
                        "responseMessage" => "Level doesnt exist: ".($student->levelId+1),
                        "meta" => [
                            "content" => "",
                        ],
                    ], 200);
                }


                $student->levelId = $student->levelId+1;
                $student->save(); 



                //log to history
                $history = new History;
                $history->studentId=$request->stdId;
                $history->average=$percentage;
                $history->points=$studentPoint;
                $history->data= json_encode($answers);
                $history->level=$student->levelId;

                $history->dateCreated = $history->dateModified = date("Y-m-d H:i:s");
                
                if($history->save()){

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
                                    "Answers" => $answers,
                                ],
                            ], 200);
                }else{

                    return response()->json([
                        "responseDescription" => "Failed",
                        "responseMessage" => "Failed",
                        "responseCode" => "101",
                        "passed" => true,
                                "meta" => null
                            ], 200);
                }
            }



        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }

}
