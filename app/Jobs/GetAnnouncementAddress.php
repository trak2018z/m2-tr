<?php

namespace App\Jobs;

use App\Announcement;
use App\Http\Controllers\Google\GoogleMapsController;
use App\Log;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetAnnouncementAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Announcement
     */
    private $announcement;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Announcement $announcement)
    {
        $this->announcement = $announcement;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $result = (new GoogleMapsController())->geocodeCoordinates($this->announcement->latitude, $this->announcement->longitude, \GoogleMapsGeocoder::TYPE_STREET_ADDRESS);
        if(!$result->success){
            $this->handleError(new Exception($result->response->message,$result->code), __LINE__);
        } else {
            $address = $result->response->result->results[0];
            $this->announcement->address = $address->formatted_address;
            $this->announcement->address_short = $address->address_components[1]->short_name.", ".$address->address_components[2]->short_name;
            if(!$this->announcement->save()){
                $this->handleError(new Exception("Wystąpił błąd podczas zapisywania adresu ogłoszenia do bazy danych.",500), __LINE__);
            }
        }
    }

    /**
     * @param $exception Exception
     * @param $line
     */
    private function handleError($exception, $line)
    {
        Log::logError($exception->getMessage(), $exception->getCode(), $line);
        $this->release(5 * 60);
        $this->fail(new Exception($exception->getMessage(), $exception->getCode()));
    }

    /**
     * The job failed to process.
     *
     * @param  Exception $exception
     * @return void
     */
    public function failed(Exception $exception)
    {
        // Send user notification of failure, etc...
    }

}
