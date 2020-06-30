<?php

namespace Framework\Observers;

use Framework\Models\Change;
use Framework\Models\ChangeStatus;
use Framework\User;
use Log;

class ChangeObserver
{
    /**
     * Listen to the Change created event.
     *
     * @param  Change  $change
     * @return void
     */
    public function created(Change $change)
    {
        //
        $data = $change->toArray();
        $data['status_id'] = isset($data['status_id'])
                                ? intval($data['status_id'])
                                : null;
        $data['approver_id'] = isset($data['approver_id'])
                                ? intval($data['approver_id'])
                                : null;
        $data['assignee_id'] = isset($data['assignee_id'])
                                ? intval($data['assignee_id'])
                                : null;

        $data = $this->mapData($data);

        Log::info('change created', [$data]);
    }

    /**
     * Listen to the Change deleting event.
     *
     * @param  Change  $change
     * @return void
     */
    public function deleting(Change $change)
    {
        //
        Log::info('change deleting', [$change]);
    }

    public function updated(Change $change)
    {
        //
        if (! $change->isDirty('status_id')) return;

        $data = $change->toArray();
        $data = $this->mapData($data);

        Log::info('change updated', [$data]);
    }

    protected function mapData($data)
    {
        if ($data['status_id']) {
            $data['status'] = (new ChangeStatus())->where('id', $data['status_id'])->first()->name;
        } else {
            $data['status'] = '';
        }

        if ($data['approver_id']) {
            $data['approver'] = (new User())->where('id', $data['approver_id'])->first()->email;
        } else {
            $data['approver'] = '';
        }

        if ($data['assignee_id']) {
            $data['assignee'] = (new User())->where('id', $data['assignee_id'])->first()->email;
        } else {
            $data['assignee'] = '';
        }

        return $data;
    }
}
