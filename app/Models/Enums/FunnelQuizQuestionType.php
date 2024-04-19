<?php

namespace App\Models\Enums;

enum FunnelQuizQuestionType
{
    case SINGLE_CHOICE;
    case MULTIPLE_CHOICE;
    case TEXT_INPUT;
    case NUMBER_INPUT;

    public function value(): string
    {
        return match ($this) {
            self::SINGLE_CHOICE => 'single_choice',
            self::MULTIPLE_CHOICE => 'multiple_choice',
            self::TEXT_INPUT => 'text_input',
            self::NUMBER_INPUT => 'number',
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
