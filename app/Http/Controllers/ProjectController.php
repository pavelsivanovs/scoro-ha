<?php

namespace App\Http\Controllers;

use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\Response;
use Laravel\Lumen\Http\ResponseFactory;

/**
 * @ProjectController
 */
class ProjectController extends Controller
{
    /**
     * Return the list of projects.
     *
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function index()
    {
        $response = $this->scoro->request('POST', 'projects/list', [
            'json' => $this->default_body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }

    /**
     * Returns the list of project statuses.
     *
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function statuses()
    {
        $body = $this->default_body;
        $body['filter'] = [
            'module' => [
                'projects'
            ]
        ];

        $response = $this->scoro->request('POST', 'statuses/list', [
            'json' => $body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }

    /**
     * Updates the status of the project.
     *
     * @param $project_id
     * @param $status_id
     * @return Response|ResponseFactory
     * @throws GuzzleException
     */
    public function updateStatus($project_id, $status_id)
    {
        $body = $this->default_body;
        $body['request'] = [
            'status' => $status_id
        ];

        $response = $this->scoro->request('POST', 'projects/modify/' . $project_id, [
            'json' => $body
        ]);

        return response($response->getBody(), $response->getStatusCode(), $this->headers);
    }
}
