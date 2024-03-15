<?php

namespace App\Helpers;

class StringUtils 
{
    /**
     * Format a slug to a text type.
     * @param string $slug
     * @return string 
     * @exemple your-slug|your_slug => Your slug
    */
    public static function slugToText(string $slug): string
    {
        $slug = str_replace(['-', '_'], " ", $slug);
        $slug = ucfirst($slug);
        return $slug;
    }

    public static function maskCPF(string $cpf): string
    {
        return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '$1.$2.$3-$4', $cpf);
    }

    public static function maskPhoneNumberPtBR(string $phoneNumber): string
    {
        return preg_replace('/^(\d{2})(\d{5})(\d{4})$/', "($1) $2-$3", $phoneNumber);
    }
}