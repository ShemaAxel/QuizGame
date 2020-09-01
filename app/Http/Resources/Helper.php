<?php

namespace App\Http\Resources;


use App\Students;
use App\Quizes;
use App\Levels;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Validator;

class Helper
{
     /**
     * Singleton instance of the class
     */
    public static $singleton = null;

    public static function instantiate()
    {
        if (is_null(self::$singleton)) {
            self::$singleton = new Helper();
        }
        return self::$singleton;
    }


    public function validateStudentRequest($request){

        try {

            $validator = \Validator::make($request->all(), [
                "stdFname"=>"required",
                "stdLname"=>"required",
                "age"=>"required",
                "levelId"=>"required"
            ])->validate();

            return null;
        } catch (ValidationException $e) {
            $arr = [];
            foreach ($e->errors() as $key => $value) {
                $arr[$key] = $value[0];
            }

            return $arr;
        }
    }

    public function validateQuizesRequest($request){

        try {

            $validator = \Validator::make($request->all(), [
                "levelId"=>"required",
                "type"=>"required",
                "question"=>"required",
                "answer"=>"required",
                "response"=>"required",
                "marks"=>"required",
            ])->validate();

            return null;
        } catch (ValidationException $e) {
            $arr = [];
            foreach ($e->errors() as $key => $value) {
                $arr[$key] = $value[0];
            }

            return $arr;
        }
    }

    public function validateLevelsRequest($request){

        try {

            $validator = \Validator::make($request->all(), [
                "levelDescription"=>"required",
                "levelName"=>"required",
                "passingRate" => "required",
            ])->validate();

            return null;
        } catch (ValidationException $e) {
            $arr = [];
            foreach ($e->errors() as $key => $value) {
                $arr[$key] = $value[0];
            }

            return $arr;
        }
    }

    public function validateCorrectionRequest($request){

        try {

            $validator = \Validator::make($request->all(), [
                "stdId"=>"required",
            ])->validate();

            return null;
        } catch (ValidationException $e) {
            $arr = [];
            foreach ($e->errors() as $key => $value) {
                $arr[$key] = $value[0];
            }

            return $arr;
        }
    }


    public function createStudent($request){

        $student = new Students;
        $student->stdFname = $request->stdFname;
        $student->stdLname = $request->stdLname;
        $student->age = $request->age;
        $student->levelId = $request->levelId;

        $student->dateCreated = $student->dateModified = date("Y-m-d H:i:s");
        $student->save();

        return $student;
    }

    public function createQuize($request){

        $quize = new Quizes;
        $quize->levelId = $request->levelId;
        $quize->type = $request->type;
        $quize->question = $request->question;
        $quize->answer = $request->answer;
        $quize->response = $request->response;
        $quize->marks = $request->marks;

        $quize->dateCreated = $quize->dateModified = date("Y-m-d H:i:s");
        $quize->save();

        return $quize;
    }

    public function createLevel($request){

        $level = new Levels;
        $level->levelDescription = $request->levelDescription;
        $level->levelName = $request->levelName;
        $level->passingRate = $request->passingRate;

        
        $level->dateCreated = $level->dateModified = date("Y-m-d H:i:s");
        $level->save();

        return $level;
    }

}
