<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator as ValidatorFacade;
use Illuminate\Validation\Validator;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {--email= : Admin email} {--password= : Admin password} {--no-input : No input will be asked}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create system administrator';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->option('email');
        $password = $password_confirm = $this->option('password');
        $noInput = $this->option('no-input');

        if (! $noInput && ! $email) {
            $email = $this->ask('Enter your email address');
        }

        $validation = $this->makeValidation(['email' => $email], [
            'email' => 'required|email|unique:users',
        ]);

        if ($validation instanceof Validator) {
            return $this->tryAgain($validation, $noInput);
        }

        if (! $noInput && ! $password) {
            $password = $this->secret('Enter your password');
            $password_confirm = $this->secret('Confirm password');
        }

        $validation = $this->makeValidation(['password' => $password, 'password_confirmation' => $password_confirm],
            [
                'password' => 'required|confirmed',
            ]);

        if ($validation instanceof Validator) {
            return $this->tryAgain($validation, $noInput);
        }

        DB::transaction(function () use ($email, $password, $noInput) {

            $this->line('Email: '.$email);

            if (! $noInput && $this->confirm('Do you wish to continue?')) {
                $this->createUser($email, $password);
            } elseif ($noInput) {
                $this->createUser($email, $password);
            }
        });
    }

    private function createUser($email, $password)
    {
        $user = new Admin();
        $user->email = $email;
        $user->name = 'demo';
        $user->password = bcrypt($password);

        $user->save();
    }

    private function tryAgain(Validator $validator, $exitOnFail = false)
    {
        foreach ($validator->errors()->all() as $error) {
            $this->error($error);
        }

        if (! $exitOnFail) {
            return $this->call('make:admin');
        } else {
            throw new \Exception('Admin creating failed');
        }
    }

    private function makeValidation($fields, $validations)
    {
        $validation = ValidatorFacade::make($fields, $validations);

        if ($validation->fails()) {
            return $validation;
        }

        return true;
    }
}
