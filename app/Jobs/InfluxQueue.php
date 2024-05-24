<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use InfluxDB2\Client;
use InfluxDB2\WriteType as WriteType;
use InfluxDB2\Model\WritePrecision as WritePrecision;
use Illuminate\Support\Facades\Log;

class InfluxQueue implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $protocolLine;
    /**
     * Create a new job instance.
     */
    public function __construct($protocolLine)
    {
        Log::error(__CLASS__,[__FUNCTION__, 'called']);
        $this->protocolLine = $protocolLine;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Log::error(__CLASS__,[__FUNCTION__, 'called']);
        $token = getenv('INFLUX_CLOUD_TOKEN');
        $endpoint = getenv('INFLUX_CLOUD_ENDPOINT');
        $org = getenv('INFLUX_CLOUD_ORG');
        $bucket = getenv('INFLUX_CLOUD_BUCKET');
        $precision = WritePrecision::NS;
        $client = new Client([
            'url' => $endpoint,
            'token' => $token,
            'bucket' => $bucket,
            'org' => $org,
            'precision' => $precision,
        ]);

        // $writeApi = $client->createWriteApi();
        $writeApi = $client->createWriteApi(["writeType" => WriteType::BATCHING, 'batchSize' => 1]);
        $writeApi->write($this->protocolLine);
        dd($this->protocolLine);
        $client->close();
    }
}