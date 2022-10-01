<?php

namespace LaravelCommon\App\Console\Commands;

use LaravelCommon\App\Queries\LoggingConfigQuery;
use Illuminate\Console\Command;
use LaravelCommon\App\Utilities\EntityUnit;

class EnableLoggingName extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'common:enable_disable_logging
        {name : logging name}
        {enable : boolean}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Enable logging name';

    /**
     * @var LoggingConfigQuery
     */
    protected LoggingConfigQuery $loggingConfigQuery;

    /**
     * @var EntityUnit
     */
    protected EntityUnit $entityUnit;

    /**
     *
     * @param LoggingConfigQuery $loggingConfigQuery
     * @param EntityUnit $entityUnit
     */
    public function __construct(
        LoggingConfigQuery $loggingConfigQuery,
        EntityUnit $entityUnit
    ) {
        $this->loggingConfigQuery = $loggingConfigQuery;
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
        $enable = filter_var($this->argument('enable'), FILTER_VALIDATE_BOOLEAN);
        $this->info($enable);

        $loggingConfig = $this->loggingConfigQuery
            ->whereName($name)
            ->getFirst();

        if (!is_null($loggingConfig)) {
            $loggingConfig->setIsEnabled($enable);

            $this->entityUnit->preparePersistence($loggingConfig);
            $this->entityUnit->flush();
        }
        $this->info("command run successfully");
        return 0;
    }
}
