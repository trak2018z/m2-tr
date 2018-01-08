<?php

namespace App\Jobs;

use App\Announcement;
use App\Http\Controllers\Google\GoogleLocationType;
use App\Http\Controllers\Google\GoogleMapsController;
use App\Log;
use App\Place;
use App\PlaceType;
use DB;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class GetPlacesNearby implements ShouldQueue
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

        try{
            $place_types = PlaceType::all();

            $radius = 2000;
            DB::transaction(function() use ($place_types, $radius) {

                $place_ids = [];
                $gc = new GoogleMapsController();
                $error = false;
                foreach($place_types as $pt){
                    $type = $pt->token;
                    $result = $gc->placeSearch($this->announcement->latitude, $this->announcement->longitude, GoogleLocationType::get($type), $radius);

                    do{
                        if(!$result->success){
                            if($result->code == 404){
                                break;
                            } else {
                                $this->handleError(new Exception($result->response->message,$result->code), __LINE__);
                                $error = true;
                                break;
                            }
                        } else {
                            foreach($result->response->result->results as $p){
                                $place = Place::firstOrCreate([
                                    'google_id' => $p->place_id
                                ],[
                                    'name' => $p->name,
                                    'address1' => $p->vicinity,
                                    'address2' => '',
                                    'latitude' => $p->geometry->location->lat,
                                    'longitude' => $p->geometry->location->lng,
                                    'place_type_id' => $pt->id,
                                    'google_id' => $p->place_id
                                ]);

                                $place_ids[$place->id] = ["distance" => $this->vincentyGreatCircleDistance($this->announcement->latitude, $this->announcement->longitude,$p->geometry->location->lat,$p->geometry->location->lng)];
                            }
                        }
                        $next = isset($result->response->result->next_page_token) && !is_null($result->response->result->next_page_token);
                        if($next){
                            sleep(3);
                            $token = $result->response->result->next_page_token;
                            $result = $gc->placeSearchNext($token);
                        }
                    } while($next);

                    if($error){
                        break;
                    }

                }

                $this->announcement->places()->attach($place_ids);
                $this->announcement->active = 2;
                if(!$this->announcement->save()){
                    throw new Exception("Wystąpił błąd podczas aktywowania ogłszenia ID: {$this->announcement->id}.");
                }

            });
            Log::logSuccess("Pobrano miejsca w zakresie {$radius} metrów od nieruchomości id {$this->announcement->id}.");
        } catch(Exception $e){
            $this->handleError($e, __LINE__);
        } catch(\Throwable $e){
            $this->handleError($e, __LINE__);
        }

    }

    public function vincentyGreatCircleDistance(
        $latitudeFrom, $longitudeFrom, $latitudeTo, $longitudeTo, $earthRadius = 6371000)
    {
        // convert from degrees to radians
        $latFrom = deg2rad($latitudeFrom);
        $lonFrom = deg2rad($longitudeFrom);
        $latTo = deg2rad($latitudeTo);
        $lonTo = deg2rad($longitudeTo);

        $lonDelta = $lonTo - $lonFrom;
        $a = pow(cos($latTo) * sin($lonDelta), 2) +
            pow(cos($latFrom) * sin($latTo) - sin($latFrom) * cos($latTo) * cos($lonDelta), 2);
        $b = sin($latFrom) * sin($latTo) + cos($latFrom) * cos($latTo) * cos($lonDelta);

        $angle = atan2(sqrt($a), $b);
        return $angle * $earthRadius;
    }

    /**
     * @param $exception Exception
     * @param $line
     */
    private function handleError($exception, $line)
    {
        Log::logError($exception->getMessage(), $exception->getCode(), $line);
        $this->release(3 * 60);
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
