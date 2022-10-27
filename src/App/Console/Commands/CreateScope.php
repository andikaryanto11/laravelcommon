<?php

namespace LaravelCommon\App\Console\Commands;

use Illuminate\Console\Command;
use LaravelCommon\App\Repositories\ScopeRepository;
use LaravelOrm\Entities\EntityManager;

class CreateScope extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'common:data:create-scope  
    {name : Name of scope}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new scope';

    /**
     * Undocumented variable
     *
     * @var ScopeRepository
     */
    protected ScopeRepository $scopeRepository;

    /**
     * Undocumented variable
     *
     * @var EntityManager
     */
    protected EntityManager $entityManager;

    /**
     * Create a new command instance.
     *
     * @param ScopeRepository $scopeRepository
     * @param EntityManager $entityManager
     */
    public function __construct(
        ScopeRepository $scopeRepository,
        EntityManager $entityManager
    ) {
        $this->scopeRepository = $scopeRepository;
        $this->entityManager = $entityManager;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $name = $this->argument('name');
        $scope = $this->scopeRepository->newEntity();
        $scope->setName($name);
        $this->entityManager->persist($scope);
        $this->info('Scope created');
        return 0;
    }
}
