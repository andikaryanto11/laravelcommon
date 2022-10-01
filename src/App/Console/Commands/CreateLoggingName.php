<?php

namespace LaravelCommon\App\Console\Commands;

use Illuminate\Console\Command;
use LaravelCommon\App\Entities\LoggingConfig;
use LaravelCommon\App\Utilities\EntityUnit;

class CreateLoggingName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'common:data:logging
        {name : logging name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create logging config data name';

    /**
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     *
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        EntityUnit $entityUnit
    ) {
        $this->entityUnit = $entityUnit;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->info("Command is running...");

        $name = $this->argument('name');
        $loggingConfig = new LoggingConfig();
        $loggingConfig->setName($name);

        $this->entityUnit->preparePersistence($loggingConfig);
        $this->entityUnit->flush();
        $this->info("$name name is created");
        return 0;
    }
}
