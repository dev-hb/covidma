<?php

require_once 'autoload.php';

/**
 * Check if a user is connected
 * @return bool
 */
function userConnected(){
    return isset($_SESSION[APP_ID]);
}

/**
 * Redirection to a given page
 * @param $route
 */
function redirect($route){
    header("location: $route.php");
    die("We don't do that here!");
    exit;
}

/**
 * Clean and get POST data
 * @param $key
 * @param string $type
 * @return string // returns null if param does not exist
 */
function getData($key, $type='POST'){
    if($type == 'POST'){
        if(! isset($_POST[$key])) return null;
        $v = $_POST[$key];
    }else{
        if(! isset($_GET[$key])) return null;
        $v = $_GET[$key];
    }
    $v = str_replace("'", "", $v);
    $v = str_replace("\"", "", $v);
    $v = addslashes($v);
    return $v;
}

/**
 * Check if a parameter exists or not
 * @param $key
 * @param string $method
 * @return bool
 */
function paramExists($key, $method='GET'){
    if($method == 'GET') return isset($_GET[$key]);
    return isset($_POST[$key]);
}

/**
 * display the message for validation purpose
 * @param string $behavior
 * @return string
 */
function displayMessage($behavior = 'text'){
    global $message;
    if(trim($message) == "" || count(explode(";", $message)) != 2) return "";
    $msg = explode(";", $message);
    if($behavior == 'text') return "<span class='text-{$msg[0]}'>{$msg[1]}</span>";
    elseif($behavior == 'alert') return "<div class='alert alert-{$msg[0]}'>{$msg[1]}</div>";
    else return $msg[1];
}

/**
 * Change message value
 * @param $msg
 * @param string $type
 */
function setMessage($msg, $type='danger'){
    global $message;
    $message = $type.';'.$msg;
}

/**
 * Get the current connected user infos
 * @return User
 */
function getConnectedUser(){
    global $conn;
    $id = $_SESSION[APP_ID];
    $stmt = $conn->prepare("SELECT id, name, email, password FROM users WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email, $password);
    $stmt->fetch();
    return new User($id, $name, $email, $password);
}

/**
 * Debug and Die
 * @param $msg
 */
function dd($msg){
    var_dump($msg);
    die;
}

/**
 * Log out of the admin panel
 */
function logout(){
    session_unset(APP_ID);
    $_SESSION[APP_ID] = null;
    unset($_SESSION[APP_ID]);
    session_destroy();
    redirect('login');
}

/**
 * Shorten a given string depending on a number of charcters
 * @param $str
 * @param $num
 * @return string
 */
function shortened($str, $num){
    return strlen($str) <= $num ? $str : substr($str, 0, $num) . " ...";
}

/// Plotting functions

/**
 * Plot a line, area, or bar chart with given params
 * @param $id
 * @param $start_date
 * @param $end_date
 * @param $data
 * @param $ykeys
 * @param $labels
 * @param string $type
 * @param string $width
 * @param string $height
 */
function plotLinedChart($id, $start_date, $end_date, $data, $ykeys, $labels, $type='Line', $width='100%', $height='400px'){
    try {
        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);
        $days = $end_date->diff($start_date);

        $graph = "<div id='$id' style='width:$width;height:$height'></div>".
        "<script>new Morris.$type({element: \"$id\",data: $data,xkey: 'date',ykeys: $ykeys,labels: $labels});</script>";

        echo $graph;
    } catch (Exception $e) {
        dd("Format de date invalid!!");
    }
}

/**
 * Subscribe an E-mail to newsletter
 * @param $email
 * @return string
 */
function subscribe($email){
    global $conn;
    $is_exists = $conn->query("SELECT * FROM newsletter WHERE email = '$email'");
    if(mysqli_num_rows($is_exists) <= 0){
        $email = getData('email');
        $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->bind_param("s", $email);
        if($stmt->execute()) return "OK";
        else return "KO";
    }else return "EXIST";
}

/**
 * Unsubscribe an E-mail from newsletter
 * @param $email
 * @return string
 */
function unsubscribe($email){
    global $conn;
    $rs = $conn->query("DELETE FROM newsletter WHERE email='$email'");
    if($rs) return "OK";
    else return "KO";
}