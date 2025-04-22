<?php

namespace App\Class;

class Session
{

    /**
     * Start the session if it hasn't been started already.
     */
    public static function start()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Set a session variable.
     *
     * @param string $key   The session variable name.
     * @param mixed  $value The value to store in the session.
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * Get a session variable.
     *
     * @param string $key The session variable name.
     * @return mixed The value of the session variable or null if not set.
     */
    public static function get($key)
    {
        return isset($_SESSION[$key]) ? $_SESSION[$key] : null;
    }

    /**
     * Check if a session variable exists.
     *
     * @param string $key The session variable name.
     * @return bool True if the session variable exists, false otherwise.
     */
    public static function has($key)
    {
        return isset($_SESSION[$key]);
    }

    /**
     * Remove a session variable.
     *
     * @param string $key The session variable name.
     */
    public static function remove($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }


    public static function auth()
    {
        global $db;
        $conn = $db->conn();

        $stmt = $conn->prepare("SELECT * FROM users WHERE id = ?");
        $userId = Session::get('user_id');
        $stmt->bindParam(1, $userId, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch();
    }

    /**
     * Destroy the session and remove all session variables.
     */
    public static function destroy()
    {
        session_unset();  // Unset all session variables
        session_destroy(); // Destroy the session
    }
}
