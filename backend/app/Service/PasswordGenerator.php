<?php

declare(strict_types=1);

namespace App\Service;

use Hackzilla\PasswordGenerator\Generator\ComputerPasswordGenerator;
use Hackzilla\PasswordGenerator\Generator\PasswordGeneratorInterface;

final class PasswordGenerator
{
    private PasswordGeneratorInterface $generator;

    public function __construct()
    {
        $this->generator = (new ComputerPasswordGenerator())
            ->setLength(10)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_LOWER_CASE, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_UPPER_CASE, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_NUMBERS, true)
            ->setOptionValue(ComputerPasswordGenerator::OPTION_SYMBOLS, true);
    }

    public function generate(): string
    {
        return $this->generator->generatePassword();
    }
}
