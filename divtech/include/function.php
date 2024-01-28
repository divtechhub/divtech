<?php

function check_account_type($account_typpe, $available_accounts)
{
    // get current account type
    $account = isset($_SESSION['account_type']) ? $_SESSION['account_type'] : '';
    // get Availble account   
    $available_accounts = isset($available_accounts) ? $available_accounts : '';
    $allow = true;
    if (!empty($account_typpe)) {
        if ($account_typpe == $account) {
            if (in_array($account, $available_accounts) && ($allow === true)) {
            } else {
                // logout();
                header("Location: ../auth/index.php");
            }
        } else {
            logout();
            header("Location: ../auth/index.php");
        }
    } else {
        logout();
        header("Location: ../auth/index.php");
    }
}

//checks if u login
function isLoggedIn()
{
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
        return true;
    }
}

//secure strings
function secure_str($str)
{
    $str = trim(strip_tags($str));
    return ($str);
}
//gets age
function getAge($dob)
{
    $dob = date_diff(date_create($dob), date_create('today'))->y;
    return $dob;
}


// check phone number validity
function check_phone_number($num)
{
    if (strlen($num) != 10 || !is_numeric($num)) return false;
    return
        preg_match('/^023/', $num) ||
        preg_match('/^024/', $num) ||
        preg_match('/^054/', $num) ||
        preg_match('/^055/', $num) ||
        preg_match('/^059/', $num) ||
        preg_match('/^027/', $num) ||
        preg_match('/^057/', $num) ||
        preg_match('/^026/', $num) ||
        preg_match('/^056/', $num) ||
        preg_match('/^028/', $num) ||
        preg_match('/^020/', $num) ||
        preg_match('/^050/', $num);
}

//changes to 233
function contact($number)
{
    if (strlen($number) == 10) {
        $num = substr($number, 1, strlen($number) - 1);
        $PHONE = "233" . $num;
    } else if (strlen($number) == 12) {
        $num = substr($number, 3, strlen($number) - 1);
        $PHONE = "233" . $num;
    } else {
        $PHONE = $number;
    }

    return $PHONE;
}

//encrypt
function encrypt_var($string)
{
    $encrypted = ($string * 18273746482) / 679686;
    return urlencode(base64_encode($encrypted));
}

//decrypt
function decrypt_var($string)
{
    $result =  (int) round((base64_decode(urldecode($string)) / 18273746482)  * 679686);
    return (gettype($result) !== "integer" || $result === 0) ? null : $result;
}

//logout 
function logout()
{
    session_destroy();
}

function trialdates_branch()
{
    $Date = date('Y-m-d');
    return date('Y-m-d', strtotime($Date . ' + 14 days'));
}


function SetDates_branch($days)
{
    $Date = date('Y-m-d');
    return date('Y-m-d', strtotime($Date . ' + ' . $days . ' days'));
}
function responseJS(string $type, $message)
{
    $account = ucwords(secure_str(isset($_SESSION['account_type']) ? ($_SESSION['account_type']) : 'Client'));
    die(json_encode([
        $type => true,
        "data" => $message,
        "account_type" => $account,
    ]));
}
