<?php
declare(strict_types=1);

/** Escape output HTML (anti-XSS). */
function e(mixed $nilai): string
{
    return htmlspecialchars((string) $nilai, ENT_QUOTES, 'UTF-8');
}
