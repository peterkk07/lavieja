<?php

function utf8ize($d) {
    if (is_array($d)) {
        foreach ($d as $k => $v) {
            $d[$k] = utf8ize($v);
        }
    } else if (is_string ($d)) {
        return utf8_encode($d);
    }
    return $d;
}

function json_response($message = null, $code = 200, $data = null)
{
    header_remove();
    http_response_code($code);

    $status = array(
        200 => '200 OK',
        400 => '400 Bad Request',
        422 => 'Unprocessable Entity',
        500 => '500 Internal Server Error'
    );

    return json_encode(array(
        'status' => $code < 300, // success or not?
        'message' => $message,
        'data' => $data
    ));
}