<?php
session_start();

function isLoggedIn(): bool {
    return isset($_SESSION['user']);
}

function getUserName(): string {
    return $_SESSION['user']['name'] ?? '';
}