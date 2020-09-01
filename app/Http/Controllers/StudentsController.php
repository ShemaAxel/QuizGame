<?php

namespace App\Http\Controllers;


use App\Students;
use App\Quizes;
use App\Levels;

use App\Http\Resources\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StudentsController extends Controller
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
     * View all Students 
     *
     * @return Json
     */
    public function all()
    {
        try {
            
            
            $students = Students::where([
                ["status", "=", "1"],
            ])->get();


            return response()->json([
                "responseDescription" => "all students",
                "responseCode" => "100",
                "responseMessage" => "",
                "meta" => [
                    "content" => $students,
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

            Log::info('Accessing create students Endpoint');

            $notValid = $this->helpers->validateStudentRequest($request);

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

            $student = $this->helpers->createStudent($request);

            if(!$student){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "An error occured, while saving the student.",
                    "responseCode" => "",
                    "responseMessage" => "Error Occured while saving.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

            return response()->json([
                "responseDescription" => "Student saved",
                "responseCode" => "",
                "responseMessage" => "",
                "meta" => [
                    "content" => $student,
                ],
            ], 200);

        }catch(Exception $ex){
            Log::error("Application . Exception : " . $ex->getMessage());

            return response()->json($ex->getMessage(), 500);
        }

    }
}