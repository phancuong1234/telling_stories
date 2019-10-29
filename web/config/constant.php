<?php
if ( ! defined( 'LOGIN_ANOTHER_DEVICE')) {
    define('LOGIN_ANOTHER_DEVICE', 'Có người đang đăng nhập tài khoản này');
}

if ( ! defined( 'LOGIN_FAIL')) {
    define('LOGIN_FAIL', 'Sai email hoặc password');
}

if ( ! defined( 'ADMIN')) {
    define('ADMIN', 1);
}
if ( ! defined( 'MOD')) {
    define('MOD', 2);
}
if ( ! defined( 'DELETE_SUCCESS')) {
    define('DELETE_SUCCESS', 'Delete success!');
}
if ( ! defined( 'DEFAULT_NULL')) {
    define('DEFAULT_NULL', 0);
}
if ( ! defined( 'DELETE_FAIL')) {
    define('DELETE_FAIL', 'Delete fail!');
}
if ( ! defined( 'CREATE_SUCCESS')) {
    define('CREATE_SUCCESS', 'Add success!');
}
if ( ! defined( 'UPDATE_SUCCESS')) {
    define('UPDATE_SUCCESS', 'Update success!');
}
if ( ! defined( 'MESSAGE_ERROR_METHOD')) {
    define('MESSAGE_ERROR_METHOD', 'Method không cho phép');
}
/*table user*/
if ( ! defined( 'ERROR_CREATE_USER')) {
    define('ERROR_CREATE_USER', 'email existed');
}
if ( ! defined( 'STATE_ACTIVE')) {
    define('STATE_ACTIVE', 0);
}
if ( ! defined( 'STATE_BLOCK')) {
    define('STATE_BLOCK', 1);
}
if ( ! defined( 'CHANGE_STATE_SUCCESS')) {
    define('CHANGE_STATE_SUCCESS', 'CHANGED STATE');
}

//DELETE_FALSE
if ( ! defined( 'DELETE_FALSE')) {
    define('DELETE_FALSE', 0);
}
//DELETE_TRUE
if ( ! defined( 'DELETE_TRUE')) {
    define('DELETE_TRUE', 1);
}
/*end table user*/

//code error api
if ( ! defined( 'CODE_ERROR_METHOD')) {
    define('CODE_ERROR_METHOD', 405);
}
if ( ! defined( 'CODE_ERROR_VALID')) {
    define('CODE_ERROR_VALID', 422);
}if ( ! defined( 'CODE_ERROR_CREATE')) {
    define('CODE_ERROR_CREATE', 207);
}
    //msg error api
if ( ! defined( 'MESSAGE_ERROR_VALID')) {
    define('MESSAGE_ERROR_VALID', 'email or password invalid');
}

