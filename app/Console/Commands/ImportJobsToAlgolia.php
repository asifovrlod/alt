<?php

namespace App\Console\Commands;

use Algolia\AlgoliaSearch\SearchClient;
use Illuminate\Console\Command;
use Statamic\Facades\Entry;
use Symfony\Component\Console\Attribute\AsCommand;

#[AsCommand(name: 'algolia:import-jobs', description: 'Index Statamic jobs collection into Algolia')]
class ImportJobsToAlgolia extends Command
{
    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $appId = config('scout.algolia.id');
        $apiKey = config('scout.algolia.secret');

        if (empty($appId) || empty($apiKey)) {
            $this->error('Missing Algolia credentials. Set ALGOLIA_APP_ID and ALGOLIA_SECRET in your environment.');
            return self::FAILURE;
        }

        $indexName = trim((string) config('scout.prefix')) . 'jobs';

        $client = SearchClient::create($appId, $apiKey);
        $index = $client->initIndex($indexName);

        $jobs = Entry::query()
            ->whereCollection('jobs')
            ->get()
            ->map(function ($job) {
                return [
                    'objectID' => $job->id(),
                    'title' => $job->get('title'),
                    'job_details' => $job->get('job_details'),
                    'location' => $job->get('location'),
                    'slug' => $job->slug(),
                    'url' => method_exists($job, 'absoluteUrl') ? $job->absoluteUrl() : $job->url(),
                    'published_at' => optional($job->date())->toDateString(),
                ];
            })
            ->values()
            ->all();

        if (empty($jobs)) {
            $this->info('No jobs found to index.');
            return self::SUCCESS;
        }

        foreach (array_chunk($jobs, 1000) as $chunk) {
            $index->saveObjects($chunk);
            $this->info('Indexed ' . count($chunk) . ' jobs...');
        }

        $this->info('✅ All jobs indexed to Algolia!');

        return self::SUCCESS;
    }
}