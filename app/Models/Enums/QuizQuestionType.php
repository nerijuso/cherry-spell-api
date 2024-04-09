<?php

namespace App\Models\Enums;

enum QuizQuestionType
{
    case SINGLE_CHOICE;
    case MULTIPLE_OR_NONE;
    case TEXT_INPUT;

    public function value(): string
    {
        return match ($this) {
            self::SINGLE_CHOICE => 'single_choice',
            self::MULTIPLE_OR_NONE => 'multiple_or_none',
            self::TEXT_INPUT => 'text_input',
        };
    }

    public static function all(): array
    {
        $items = [];
        foreach (self::cases() as $item) {
            $items[] = $item->value();
        }

        return $items;
    }
}
