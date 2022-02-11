<?php namespace App\Core;

class ReturnMessage {

    const OK = 200;
    const CREATED = 201;
    const ACCEPTED = 202;
    const NON_AUTHORITATIVE_INFO = 203;
    const NO_CONTENT = 204;
    const RESET_CONTENT = 205;
    const PARTIAL_CONTENT = 206;

    const MOVED_PERMANENTLY = 301;
    const TEMP_REDIRECT = 307;

    const BAD_REQUEST = 400;
    const UNAUTHORIZED = 401;
    const PAYMENT_REQUIRED = 402;
    const FORBIDDEN = 403;
    const NOT_FOUND = 404;
    const METHOD_NOT_ALLOWED = 405;
    const NOT_ACCEPTABLE = 406;
    const PROXY_AUTH_REQUIRE = 407;
    const REQUEST_TIMEOUT = 408;
    const CONFLICT = 409;
    const GONE = 410;
    const LENGTH_REQUIRED = 411;
    const PRECONDITION_FAILED = 412;
    const REQUEST_ENTITY_LARGE = 413;
    const REQUEST_URL_LONG = 414;
    const UNSUPPORTED_MEDIA_TYPE = 415;
    const REQUEST_RANGE_NOT_SATISFIABLE = 416;
    const EXCEPTION_FAIL = 417;
    const INTERNAL_SERVER_ERROR = 500;
    const NOT_IMPLEMENTED = 501;
    const BAD_GATEWAY = 502;
    const SERVICE_UNAVAILABLE = 503;
    const GATEWAY_TIMEOUT = 504;
    const VERSION_NOT_SUPPORTED = 505;

}
