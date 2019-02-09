<?php

/**
 * Mime Type: application/x-www-urlencoded
 * @author Nathan Good <me@nategood.com>
 */

namespace Httpful\Handlers;

class FormHandler extends MimeHandlerAdapter {

    /**
     * @param string $body
     * @return mixed
     */
    public function parse($body) {
        $parsed = array();
        parse_str($body, $parsed);
        return $parsed;
    }

    /**
     * @param mixed $payload
     * @return string
     */
    public function serialize($payload) {       
        $data = [];
        $string = '';
        foreach ($payload as $key => $param) {
            if (is_array($param)) {
                foreach ($param as $value) {
                    $string .= '&' . $key . '=' . urlencode($value);
                }
            } else {
                $data[$key] = $param;
            }
        }

        return http_build_query($data, null, '&') . $string;
    }

}
