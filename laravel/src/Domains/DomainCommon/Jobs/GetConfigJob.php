<?php

namespace App\Domains\DomainCommon\Jobs;

use App\Data\Repositories\Config;
use Lucid\Foundation\Job;

class GetConfigJob extends Job
{
    /**
     * Configuration keys
     *
     * @var array
     */
    protected $configKeys;

    /**
     * Create a new job instance.
     *
     * @param array $configKeys
     * @return void
     */
    public function __construct(array $configKeys = [])
    {
        //
        $this->configKeys = $configKeys;
    }

    /**
     * Execute the job.
     *
     * @return array
     */
    public function handle()
    {
        //
        $repo = new Config();

        $list = [];

        if (empty($this->configKeys))
        {
            $list = $repo->get()->toArray();
        }
        else
        {
            $list = $repo->whereIn('name', $this->configKeys)->get()->toArray();
        }

        $result = [];

        foreach ($list as $item) {
            $result[$item['name']] = $item['value'];
        }

        return $result;
    }
}
