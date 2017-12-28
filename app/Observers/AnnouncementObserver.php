<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hubert Sadecki
 * Date: 2017-12-27
 * Time: 20:50
 */

namespace App\Observers;


use App\Announcement;
use App\Jobs\GetAnnouncementAddress;

class AnnouncementObserver
{
    /**
     * Listen to the Announcement created event.
     *
     * @param  Announcement $announcement
     * @return void
     */
    public function created(Announcement $announcement)
    {
        dispatch(new GetAnnouncementAddress($announcement));
        $announcement->setNiceURL();
    }
}