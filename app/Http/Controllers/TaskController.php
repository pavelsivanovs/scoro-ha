<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * @TaskController
 */
class TaskController extends Controller
{
    /**
     * Returns the list of the tasks.
     *
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function index()
    {
        $response = $this->scoro->request('POST', 'tasks/list', [
            'json' => $this->default_body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }

    /**
     * Return the list of the task statuses.
     *
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function statuses()
    {
        $body = $this->default_body;
        $body['filter'] = [
            'module' => [
                'tasks'
            ]
        ];

        $response = $this->scoro->request('POST', 'statuses/list', [
            'json' => $body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }

    /**
     * Updates the status of the task.
     *
     * @param $task_id
     * @param $status_id
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function updateStatus($task_id, $status_id)
    {
        $body = $this->default_body;
        $body['request'] = [
            'status' => $status_id
        ];

        $response = $this->scoro->request('POST', 'tasks/modify/' . $task_id, [
            'json' => $body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }
}
