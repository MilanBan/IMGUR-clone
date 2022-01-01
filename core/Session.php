<?php

namespace Core;

class Session {

    protected const FLASH_KEY = 'flash_messages';
    protected static bool $starter = false;

    public function __construct() {
        session_start();
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ( $flashMessages as $key => &$flashMessage ) {
            $flashMessage['remove'] = true;
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;

    }

    public static function start() {
        if (!self::$starter){
            session_start();
            self::$starter = true;
        }
    }

    public static function setFlash( $key, $message ) {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value'  => $message,
        ];
    }

    public static function getFlash( $key ) {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? false;
    }

    public static function set( $key, $value ) {
        $_SESSION[$key] = $value;
    }

    public static function get( $key ) {
        return $_SESSION[$key] ?? false;
    }

    public static function remove( $key ) {
        unset( $_SESSION[$key] );
    }

    public static function destroy(){
        if(self::$starter){
            self::$starter =false;
            session_unset();
            session_destroy();
        }
    }

    public function __destruct() {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        foreach ( $flashMessages as $key => &$flashMessage ) {
            if ( $flashMessage['remove'] ) {
                unset( $flashMessages[$key] );
            }
        }

        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}