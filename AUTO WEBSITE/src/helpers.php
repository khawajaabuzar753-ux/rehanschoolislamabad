<?php

declare(strict_types=1);

function startSession(): void
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

function sanitize(?string $value): string
{
    return htmlspecialchars((string)($value ?? ''), ENT_QUOTES, 'UTF-8');
}

function setFlash(string $type, string $message, ?string $whatsappMessage = null): void
{
    startSession();
    $_SESSION['flash'] = [
        'type' => $type,
        'message' => $message,
        'whatsapp' => $whatsappMessage,
    ];
}

function getFlash(): ?array
{
    startSession();
    if (!isset($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

function urlForWhatsApp(string $message, string $phone = '923232147444'): string
{
    $encoded = urlencode($message);
    return "https://wa.me/{$phone}?text={$encoded}";
}

function formatTime(?string $time): string
{
    if (empty($time)) {
        return '-';
    }

    return date('h:i A', strtotime($time));
}

function formatDate(?string $date): string
{
    if (empty($date)) {
        return '-';
    }

    return date('d M Y', strtotime($date));
}

function timeForInput(?string $time): string
{
    if (empty($time)) {
        return '';
    }

    return substr($time, 0, 5);
}


