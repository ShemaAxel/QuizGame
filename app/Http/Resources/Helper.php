<?php

namespace App\Http\Resources;


use App\Students;
use App\Quizes;
use App\Levels;
use App\OutboundSMS;


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
                "levelId"=>"required",
                "MSISDN"=>"required",
                "type"=>"required",
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
                "level" => "required",
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
        $student->MSISDN = $request->MSISDN;
        $student->levelId = $request->levelId;
        $student->passwordHash = password_hash($this->generatePIN(), PASSWORD_ARGON2I);
        $student->type = $request->type;

        $student->dateCreated = $student->dateModified = date("Y-m-d H:i:s");
        $student->save();

        Log::info('Logging SMS');
        $body = "Your PIN is : " . $this->PIN;
        $this->logPasswordSMS($request->MSISDN, $body);


        return $student;
    }

    // PINSMS

    public function logPasswordSMS($tel, $body)
    {
        log::info('Logging PIN sms for '.$tel);

        $sms = new OutboundSMS;
        $sms->MSISDN = $tel;
        $sms->message = $body;
        $sms->status = 0;
        $sms->dateCreated = $sms->dateModified = date("Y-m-d H:i:s");
        $sms->save();
    }


    //generate arandom number

    public function generatePIN()
    {
        $this->PIN = mt_rand(1000, 9999);
        return $this->PIN;
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
        $level->level = $request->level;

        
        $level->dateCreated = $level->dateModified = date("Y-m-d H:i:s");
        $level->save();

        return $level;
    }

    public function loginRequestValidator($request){
        try {

            log::info('Validating Login request ');

            $validator = \Validator::make($request->all(), [
                "MSISDN" => "required",
                "password" => "required",
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

    /**
     * Process Login.
     * @param  telephone
     * @param  PIN
     * @return bool
     */

    public function loginProcessor($student, $PIN)
    {
        if (password_verify($PIN, $student->passwordHash)) {
            return true;
        } else {
            return false;
        }

    }

}
