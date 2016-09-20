<?php

/*
 * =============================================================================
 *
 * Collabmed Solutions Ltd
 * Project: Collabmed Health Platform
 * Author: Samuel Okoth <sodhiambo@collabmed.com>
 *
 * =============================================================================
 */

namespace Ignite\Core\Library;

/**
 * Description of Validation
 *
 * @author Samuel Dervis <samueldervis@gmail.com>
 */
class Validation {

    /**
     * Ward Validation
     * @return array The validation rules
     */
    public static function validate_wards() {
        return [
            "clinic_id" => "required",
            "name" => "required",
            "type" => "required",
            "gender" => "required",
            "age_group" => "required",
            "cost" => "required|numeric"
        ];
    }

    /**
     * @return array Patient Scheduling Validation
     */
    public static function validate_patient_schedule() {
        return [
            "patient" => "required",
            //"procedure" => "required",
            "doctor" => "required",
            "clinic" => "required",
            "date" => "required|date",
            "time" => "required",
            "category" => "required",
        ];
    }

    /**
     * Deposit Validation
     * @return array Validation rulles
     */
    public static function validate_deposits() {
        return ["name" => "required", "amount" => "required|numeric"];
    }

    /**
     * User validation
     * @return array User validation rules
     */
    public static function validate_user() {
        return [
            "title" => "required",
            "first_name" => "required|alpha|max:30",
            "middle_name" => "alpha|max:30",
            "last_name" => "required|alpha|max:30",
            //"job" => "",
            //"mpdb" => "",
            "login" => "required|unique:users,username",
            "email" => "required|email|unique:users,email",
            "password" => "required",
            "user_group" => "required",
            "mobile" => "required"
        ];
    }

    /**
     * User validation [EDITING]
     * @return array Edit user rules
     */
    public static function validate_edit_user() {
        return [
            "title" => "required",
            "first_name" => "required|alpha|max:30",
            "middle_name" => "alpha|max:30",
            "last_name" => "required|alpha|max:30",
            "job" => "",
            "mpdb" => "",
            "login" => "required",
            "email" => "required|email",
            "mobile" => "required"
        ];
    }

    /**
     * Bed Validation Rules
     * @return array
     */
    public static function validate_beds() {
        return [
            "ward" => "required|numeric",
            "number" => "required",
            "type" => "required",
        ];
    }

    /**
     * Validate Insurance companies
     * @return array
     */
    public static function validate_insurance_companies() {
        return [
            "name" => "required",
            "address" => "required",
            "telephone" => "required",
            "mobile" => "",
            "email" => "required|email",
            "fax" => "",
            "town" => "required",
            "street" => "",
            "building" => "",
            "code" => ""
        ];
    }

    /**
     * @return array Procedure Category Validation rules
     */
    public static function validate_procedure_category() {
        return ["name" => "required|unique:procedure_categories,name", "applies_to" => "required"];
    }

    public static function validate_schedule_category() {
        return ["name" => "required|unique:appointment_categories,name"];
    }

    /**
     * @return array Procedure Validation
     */
    public static function validate_procedures() {
        return [
            "name" => "required",
            "code" => "required|unique:procedures,code",
            "category" => "required",
            "cash_charge" => "numeric",
            "status" => "required",
        ];
    }

    /**
     *
     * @return array Validation rules
     */
    public static function validate_sms() {
        return [
            "message" => "required",
            "numbers" => "required"
        ];
    }

    /**
     * @return array Checkin Validation Rules
     */
    public static function validate_checkin() {
        return [
            "destination" => "required",
            "purpose" => "required",
            "payment_mode" => 'required',
        ];
    }

    /**
     * @return array Patient Document Upload validations
     */
    public static function validate_patient_documents() {
        return [
            "type" => "required",
            "file" => "required",
        ];
    }

    /**
     * @return array Validation for profile
     */
    public static function validate_update_profile() {
        return [
            "image" => "image",
            "first_name" => "required",
            "middle_name" => "",
            "last_name" => "required",
            "mobile" => "required",
            "email" => "email",
            "login" => "required",
        ];
    }

}
