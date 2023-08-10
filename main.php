<?php


/**
 * Return boolean to indicate if the request method is POST
 * 
 * @return boolean: TRUE if request method is POST -or- FALSE if not 
 */
function isPost() {
    return $_SERVER["REQUEST_METHOD"] == "POST";
}


/**
 * Get a value from an array
 * 
 * @param array $array: The array
 * @param string $key : The key
 * 
 * @return: Value if this is set -or- empty string
 */
function getArrayValue($data, $key) { 
    return isset($data[$key]) ? $data[$key] : ''; 
}


/**
 * Get a value from the values array
 * 
 * @param array $array: The array
 * @param string $key : The key
 * 
 * @return: Value if this is set -or- empty string
 */
function getValue($data, $key) { 
    return isset($data["values"][$key]) ? $data["values"][$key] : ''; 
}


/**
 * Display an error message 
 * 
 * @param array $data: Data from form validation
 * @param string $key: The key
 * 
 * @return string: Error message(s) if there are error(s) -or- empty string if no errors
 */
function showError($data, $key) {
    if (empty(getArrayValue($data["errors"], $key))) {
        return '';
    }
    else {
        return '<span class="error">* ' . getArrayValue($data["errors"], $key) . '</span>';
    }
}


/**
 * Return POST input
 * 
 * @param string $key: The input key
 */
function getPostValue($key, $default="") {
    return isset($_POST[$key]) ? $_POST[$key] : $default;
}


/**
 * Display log
 * 
 * @param string $message: The log message
 */
function showLog($message) {
    echo $message;
}