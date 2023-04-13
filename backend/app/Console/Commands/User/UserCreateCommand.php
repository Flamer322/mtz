<?php

declare(strict_types=1);

namespace App\Console\Commands\User;

use App\User\Command\Create;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Contracts\Validation\Factory;

final class UserCreateCommand extends Command
{
    protected $signature = 'mtz:user:create';

    protected $description = 'Добавление нового пользователя';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle(Create\Handler $handler, Factory $validator): int
    {
        $data = null;

        $data['name'] = $this->ask('Name:');
        $data['email'] = $this->ask('Email:');
        $data['password'] = $this->secret('Password:');
        $data['role'] = $this->ask('Role:');

        try {
            $violation = $validator->make($data, Create\Command::rules());

            if ($violation->fails()) {
                $this->error($violation->errors()->toJson());
                return self::INVALID;
            }

            $handler->handle(new Create\Command($data));

            $this->info('Пользователь успешно создан');

            return self::SUCCESS;
        } catch (Exception $e) {
            $this->error($e->getMessage());
            return self::FAILURE;
        }
    }
}
