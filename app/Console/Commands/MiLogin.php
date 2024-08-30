<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MiLogin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:login {--U|usuario=} {--P|password=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->line("Bienvenido/a");


        $usuario = $this->option("usuario");
        $password = $this->option("password");
        if(empty($usuario)){
            $usuario = $this->ask("usuario");
        }
        if(empty($password)){
            $password = $this->secret("password");
        }
        
        if($usuario == 'admin' && $password == 'password'){
            $this->info("Logueo correcto");
            return 0;
        }else{
            $this->error("Logueo Incorrecto");
            return 1;
        }

    }
}
