<?php

namespace Framework\Libraries;

class Camunda {
    const PROCESS_KEY = 'simpleChange';
    const TENANT_ID = 'change';

    public static function startProcess (array $data)
    {
        $request = app('api.restful')->requestService(
            'camunda',
            'process-definition/key/'
                . static::PROCESS_KEY . '/'
                . 'tenant-id' . '/'
                . static::TENANT_ID . '/start',
            'post',
            static::buildPayload($data),
            '',
            ['Content-Type' => 'application/json']
        );
        $result = $request->getBody()->getContents();
        return json_decode($result, true);
    }

    public static function getTask (string $instanceId)
    {
        $request = app('api.restful')->requestService(
            'camunda',
            'task',
            'get',
            ['processInstanceId' => $instanceId],
            '',
            ['Content-Type' => 'application/json']
        );
        $result = $request->getBody()->getContents();
        return json_decode($result, true);
    }

    public static function getTaskVariables (string $taskId)
    {
        $request = app('api.restful')->requestService(
            'camunda',
            "task/{$taskId}/variables",
            'get',
            [],
            '',
            ['Content-Type' => 'application/json']
        );
        $result = $request->getBody()->getContents();
        return json_decode($result, true);
    }

    public static function completeTask (array $data)
    {
        $taskId = $data['wf_task_id'];

        $request = app('api.restful')->requestService(
            'camunda',
            "task/{$taskId}/complete",
            'post',
            static::buildPayload($data),
            '',
            ['Content-Type' => 'application/json']
        );
        $result = $request->getBody()->getContents();
        return json_decode($result, true);
    }

    public static function buildPayload (array $data)
    {
        $payload = [];

        foreach ($data as $key => $value) {
            $payload[$key] = ['value' => $value];
        }

        return [
            'variables' => $payload,
            'businessKey' => $data['id']
        ];
    }
}
