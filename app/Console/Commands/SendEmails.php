<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SendEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mail:send {user?} {--i|VIP}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Mandar correos VIP o no VIP';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = $this->argument('user');
        if(!$user){
            $user = $this->ask('What is your user?');
        }
        
        $vip = $this->option('VIP');
        $this->info("enviando un correo a $user");
        if($vip){
            $this->info("$user es VIP");
        }
        $this->line('Display this on the screen');
$this->error('Something went wrong!');
$this->info('The command was successful!');
$this->table(
            ['Name', 'Email'],
            [['Luis', 'luis@dominio.com'],['Juan', 'juan@dominio.com']]
        );

    }
}
