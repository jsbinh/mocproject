<?php

namespace Framework\Observers;

use Framework\Models\Change;
use Framework\Models\ChangeStatus;
use Framework\User;
use Framework\Libraries\Camunda;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

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
        $data['assignee_id'] = isset($data['assignee_id'])
                                ? intval($data['assignee_id'])
                                : null;

        $data = $this->mapData($data);

        //
        $camunda = Camunda::startProcess($data);
        $task = Camunda::getTask($camunda['id']);

        (new Change())->where('id', $data['id'])
                      ->update([
                          'wf_instance_id' => $camunda['id'],
                          'wf_task_id' => Arr::get($task, '0.id', null)
                      ]);

        Log::info('change created', [$data, $camunda, $task]);
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

        Camunda::completeTask($data);
        $task = Camunda::getTask($data['wf_instance_id']);

        Log::info('change updated -- task', [$task, $data]);

        // task ended
        if (empty($task)) return;

        $variables = Camunda::getTaskVariables($taskId = $task[0]['id']);
        $decisionValue = Arr::get($variables, 'decision.value');

        Log::info('change updated -- vars', [$variables, $decisionValue]);

        // variables don't need to be updated
        if (empty($decisionValue)) return;

        $update = [];
        if ($decisionValue['next_assignee'] ?? null) {
            $update['assignee_id'] = (new User())->where('email', $decisionValue['next_assignee'])->first()->id;
        }

        if ($decisionValue['next_status'] ?? null) {
            $update['status_id'] = (new ChangeStatus())->where('name', $decisionValue['next_status'])->first()->id;

            Mail::send(
                'assignee-mail',
                ['change_id' => $data['id']],
                function ($message) use ($update, $data) {
                    $assigneeId = $update['assignee_id'] ?? $data['assignee_id'];
                    $message->to((new User())->where('id', $assigneeId)->first()->email)
                            ->subject("[Change #{$data['id']}] To-do Mail");
                }
            );
        }

        $update['flow'] = json_encode($decisionValue);

        // if ($decisionValue['next_action'] ?? null == 'send_approval_mail') {
        //     // Log::info('SEND APPROVAL MAIL');
        //     Mail::send(
        //         'approval-mail',
        //         ['change_id' => $data['id']],
        //         function ($message) use ($decisionValue, $data) {
        //             $message->to($decisionValue['next_approver'])
        //                     ->subject("[Change #{$data['id']}] Approval Mail");
        //         }
        //     );
        // }

        (new Change())->where('id', $data['id'])
                      ->update([
                          'wf_task_id' => $taskId
                      ] + $update);

        Log::info('change updated', [$data, $update]);
    }

    protected function mapData($data)
    {
        if ($data['status_id']) {
            $data['status'] = (new ChangeStatus())->where('id', $data['status_id'])->first()->name;
        } else {
            $data['status'] = '';
        }

        if ($data['assignee_id']) {
            $data['assignee'] = (new User())->where('id', $data['assignee_id'])->first()->email;
        } else {
            $data['assignee'] = '';
        }

        return $data;
    }
}
