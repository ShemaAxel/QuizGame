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

            $student = Students::where([
                ["status", "=", "1"],
                ["MSISDN","=",$request->MSISDN]
            ])->first();

            if($student){
                Log::error("An error occured");
                return response()->json([
                    "responseDescription" => "Number already taken",
                    "responseCode" => "",
                    "responseMessage" => "Number aleady taken.",
                    "meta" => [
                        "content" => $request->MSISDN,
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



    /**
     * User Login end point
     *
     * @return Json
     */
    public function login(Request $request)
    {
        try {

            Log::info('Access Login');

            $notValid = $this->helpers->loginRequestValidator($request);

            if ($notValid) {
                Log::error("Validation Error.");
                return response()->json([
                    "responseDescription" => "Invalid Request.",
                    "responseCode" => "",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => $notValid,
                    ],
                ], 200);
            }


            $student = Students::where([
                ["status", "=", "1"],
                ["MSISDN","=",$request->MSISDN]
            ])->first();


            if ($student) {
                //if status 0 not active
                if ($student->status==1) {              
                    Log::info('Validating credentials.');

                    $login = $this->helpers->loginProcessor($student, $request->password);

                    if ($login) {

                        Log::info('Successfully logged in.'.$student);

                        return response()->json([
                            "responseDescription" => "Success.",
                            "responseCode" => "100",
                            "responseMessage" => "Success",
                            "meta" => [
                                "content" => $student,
                            ],
                        ], 200);

                    } else {

                        Log::error('Invalid Credentials.'.$request->MSISDN);

                        return response()->json([
                            "responseDescription" => "Invalid Credentials.",
                            "responseCode" => "101",
                            "responseMessage" => "Invalid Credentials.",
                            "meta" => [
                                "content" => null,
                            ],
                        ], 200);
                    }
                }else{

                    Log::error('User is not active.');

                    return response()->json([
                        "responseDescription" => "User not active.",
                        "responseCode" => "103",
                        "responseMessage" => "Inactive user.",
                        "meta" => [
                            "content" => null,
                        ],
                    ], 200);

                }
            } else {

                Log::error('Invalid Credentials.'.$request->MSISDN);

                return response()->json([
                    "responseDescription" => "Invalid Credentials.",
                    "responseCode" => "101",
                    "responseMessage" => "Invalid Credentials.",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

        } catch (Exception $ex) {

            Log::error("Application . Exception : " . $ex->getMessage());
            return response()->json($ex->getMessage(), 500);
        }
    }

    public function deactivate($id){

        try{
            
            $student = Students::where([
                ["stdId", "=", $id]
            ])->first();

            if($student){
                $student->status =0;
                $student->save();

                return response()->json([
                    "responseDescription" => "User Deactive.",
                    "responseCode" => "100",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => $student,
                    ],
                ], 200);
            }else{
                return response()->json([
                    "responseDescription" => "User dont exit.",
                    "responseCode" => "103",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

        } catch (Exception $ex) {

            Log::error("Application . Exception : " . $ex->getMessage());
            return response()->json($ex->getMessage(), 500);
        }

    }

    public function activate($id){

        try{
            
            $student = Students::where([
                ["stdId", "=", $id]
            ])->first();

            if($student){
                $student->status =1;
                $student->save();

                return response()->json([
                    "responseDescription" => "User Deactive.",
                    "responseCode" => "100",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => $student,
                    ],
                ], 200);
            }else{
                return response()->json([
                    "responseDescription" => "User dont exit.",
                    "responseCode" => "103",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => null,
                    ],
                ], 200);
            }

        } catch (Exception $ex) {

            Log::error("Application . Exception : " . $ex->getMessage());
            return response()->json($ex->getMessage(), 500);
        }

    }


    public function updateStudent(Request $request){

        try{
            
            $notValid = $this->helpers->validateStudentRequest($request);

            if ($notValid) {
                Log::error("Validation Error.");
                return response()->json([
                    "responseDescription" => "Invalid Request.",
                    "responseCode" => "",
                    "responseMessage" => "",
                    "meta" => [
                        "content" => $notValid,
                    ],
                ], 200);
            }

            $student = Students::where([
                ["MSISDN", "=", $request->MSISDN]
            ])->first();

            if (!$student) {
                Log::error("Validation Error.");
                return response()->json([
                    "responseDescription" => "Student dont exist.",
                    "responseCode" => "",
                    "responseMessage" => "",
                    "meta" => [
                        "MSISDN" => $request->MSISDN,
                    ],
                ], 200);
            }

            $student->stdFname = $request->stdFname;
            $student->stdLname = $request->stdLname;
            $student->age = $request->age;
            $student->MSISDN = $request->MSISDN;
            $student->levelId = $request->levelId;
            $student->type = $request->type;
            $student->save();

        } catch (Exception $ex) {

            Log::error("Application . Exception : " . $ex->getMessage());
            return response()->json($ex->getMessage(), 500);
        }

    }
}