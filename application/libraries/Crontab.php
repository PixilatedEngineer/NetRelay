<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

use php\manager\crontab\CrontabManager;
include_once($_SERVER['DOCUMENT_ROOT'] . '/cron-lib/CliTool.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/cron-lib/CronEntry.php');
include_once($_SERVER['DOCUMENT_ROOT'] . '/cron-lib/CrontabManager.php');

class Crontab {

    public function add($on, $event, $include = true)
    {
        $crontab = new CrontabManager();
        $job = $crontab->newJob();
        $job->on($on);
        $job->doJob($event);
        $crontab->add($job);
        $crontab->save();
    }

    public function delete($event_id)
    {
        $crontab = new CrontabManager();
        $crontab->deleteJob('e' . $event_id . 'e');
        $crontab->save(false);
    }
}